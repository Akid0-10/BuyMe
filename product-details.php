<?php

// Database connection and categories
include "config.php";
require_once "login.php";

// User must login first to access the page
if (!isset($_SESSION["username"])) {

    header("Location: index.php");
    die();
}

// Pass the id from the menu to product detail
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $_SESSION["prodId"] = $id;
}

// Using sentiment analysis
include "vendor/autoload.php";
use Sentiment\Analyzer;

$_SESSION["status"] = "";
$analyzer = new Analyzer();
$username = $_SESSION["username"];
if (!empty($_SESSION["name"])) {
    $name = $_SESSION["name"];
}

// User posted their review
if (isset($_POST["write"])) {


    // Check if the user already review the product. Only 1 review permitted from the user on the same product
    $check_user = "SELECT username FROM product_review WHERE username = '$username' AND product_name = '$name'";
    $res = mysqli_query($conn, $check_user);

    // User have not review the product yet
    if ($res->num_rows == 0) {

        $text = $_POST["write"];
        $prodId = $_SESSION["prodId"];
        $rating = 0;

        $get_prod = "SELECT product_id, product_name FROM product WHERE product_id = '$prodId'";
        $res = mysqli_query($conn, $get_prod);

        while ($row = mysqli_fetch_assoc($res)) {

            $id = $row["product_id"];
            $name = $row["product_name"];
        }

        // Get sentiment analysis from user review
        $review_analysis = $analyzer->getSentiment($text);
        $review = end($review_analysis);

        // Sentiment analysis calssification
        if ($review > 0.5) {
            $rating = 5;
        } else if ($review >= 0 && $review < 0.5) {
            $rating = 4;
        } else if ($review == 0.5) {
            $rating = 3;
        } else if ($review < 0 && $review > -0.5) {
            $rating = 2;
        } else {
            $rating = 1;
        }

        $username = $_SESSION["username"];
        $type = $_SESSION["type"];
        $brand = $_SESSION["brand"];

        $add_review = "INSERT INTO product_ranking(product_name, product_id, product_review, rating) VALUES ('$name', '$id', '$text', '$rating')";
        $add_user_review = "INSERT INTO product_review(username, product_name, type, brand, rating) VALUES ('$username', '$name', '$type', '$brand', '$rating')";


        if (mysqli_query($conn, $add_review)) {
            $_SESSION["prodId"] = $id;
            mysqli_query($conn, $add_user_review);
        }
    }

    // User already reviewed the product
    else {
        // $_SESSION["prodId"] = $id;
        $_SESSION["status"] = "You have already reviewed this product";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <title>BuyMe Online Shopping</title>

</head>

<body>

    <!-- ------Top Navigation Bar------ -->
    <div class="container">
        <div class="navbar">
            <div class="nav-logo">
                <a href="customer.php">
                    <img src="images/Logo.png">
                </a>
            </div>
            <div class="name">
                <a href="customer.php">
                    <h1>BUYME ONLINE SHOPPING</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="user-profile.php"><i class="fa-solid fa-user"></i>
                            <?php echo $_SESSION["username"]; ?>'s
                        </a></li>
                    <li><a href=""><i class="fa-solid fa-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="product-container">
        <div class="row">
            <div class="col">
                <!-- ------Dislay the product pictures------ -->
                <?php

                if (empty($id)) {
                    $prodId = $_SESSION["prodId"];
                } else {
                    $prodId = $id;
                }

                $select_all_prod = "SELECT * FROM product WHERE product_id = '$prodId'";
                $rs = mysqli_query($conn, $select_all_prod);

                if ($rs->num_rows > 0) {

                    while ($row = $rs->fetch_assoc()) {

                        $pic = base64_encode($row["product_pic"]);
                    }

                    echo "<img src='data:image/jpg;charset=utf8;base64," . $pic . "'>";
                }
                ?>
            </div>
            <div class="col">
                <!-- ------Display product's information------ -->
                <?php

                if (empty($id)) {
                    $id = $_SESSION["prodId"];
                } else {
                    $prodId = $id;
                }
                $select_all_prod = "SELECT * FROM product WHERE product_id = '$prodId'";
                $rs = mysqli_query($conn, $select_all_prod);

                if ($rs->num_rows > 0) {

                    while ($row = $rs->fetch_assoc()) {

                        $name = $row["product_name"];
                        $type = $row["type"];
                        $brand = $row["brand"];
                        $price = $row["price"];
                    }

                    $_SESSION["name"] = $name;
                    $_SESSION["type"] = $type;
                    $_SESSION["brand"] = $brand;

                    echo "<p>" . $type . "</p><br>";
                    echo "<h1>" . $name . "</h1><br>";
                    echo "<h4>RM " . $price . "</h4><br>";
                }

                ?>

                <button class="btn">Add to cart</button>
            </div>
        </div>

        <!-- ------Form for user to write their review------ -->
        <div class="row-2">
            <form action="product-details.php" method="post">
                <input type="text" name="write" id="write" placeholder="Write Review">
                <p id="error">
                    <?php echo $_SESSION["status"]; ?>
                </p>
            </form>
        </div>

        <!-- ------Sentiment analysis of the product review with the calssification------ -->
        <div class="row-2">
            <?php

            $analyzer = new Analyzer();

            $prodId = $_SESSION["prodId"];
            $excel = 0;
            $good = 0;
            $average = 0;
            $poor = 0;
            $bad = 0;

            $check_review = "SELECT product_review FROM product_ranking WHERE product_id = '$prodId'";
            $rs = mysqli_query($conn, $check_review);
            $count = mysqli_num_rows($rs);

            if ($rs->num_rows > 0) {

                while ($row = mysqli_fetch_assoc($rs)) {

                    $text = $row["product_review"];
                    $review_analysis = $analyzer->getSentiment($text);
                    $review = end($review_analysis);

                    if ($review > 0.5) {
                        $excel++;
                    } else if ($review >= 0 && $review < 0.5) {
                        $good++;
                    } else if ($review == 0.5) {
                        $average++;
                    } else if ($review < 0 && $review > -0.5) {
                        $poor++;
                    } else {
                        $bad++;
                    }

                    $excel_res = round($excel / $count * 100, 2);
                    $good_res = round($good / $count * 100, 2);
                    $average_res = round($average / $count * 100, 2);
                    $poor_res = round($poor / $count * 100, 2);
                    $bad_res = round($bad / $count * 100, 2);
                }
            } else {

                $excel_res = 0;
                $good_res = 0;
                $average_res = 0;
                $poor_res = 0;
                $bad_res = 0;
            }


            echo '<h2>Review</h2><p>' . $count . '</p><br><br>
            <hr><br>';
            echo '<label for="excel">Excellent</label>
            <progress id="excel" value="' . $excel_res . '" max="100"></progress>&nbsp;&nbsp;' . $excel_res . '%
            <label for="excel">Great</label>
            <progress id="excel" value="' . $good_res . '" max="100"></progress>&nbsp;&nbsp;' . $good_res . '%
            <label for="excel">Average</label>
            <progress id="excel" value="' . $average_res . '" max="100"></progress>&nbsp;&nbsp;' . $average . '%
            <label for="excel">Poor</label>
            <progress id="excel" value="' . $poor_res . '" max="100"></progress>&nbsp;&nbsp;' . $poor_res . '%
            <label for="excel">Bad</label>
            <progress id="excel" value="' . $bad_res . '" max="100"></progress>&nbsp;&nbsp;' . $bad_res . '%'

                ?>
        </div>

        <div class="row-2">

            <h2>User's Reviews</h2><br>

            <?php

            // $username = $_SESSION["username"];
            // $name = $_SESSION["name"];
            
            $get_review = "SELECT product_review FROM product_ranking WHERE product_id = '$prodId'";
            $res = mysqli_query($conn, $get_review);

            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {

                    $comment = $row["product_review"];
                    echo "<i class='fa-solid fa-user'></i>&nbsp;&nbsp;<p>" . $comment . "</p><br>";

                }
            }

            ?>
        </div>

    </div>

    <!-- ------Log Out and Back Button------ -->
    <div class="row row-btn">
        <button id="backBtn" onclick="back()">Back</button>
        <button id="logoutBtn" onclick="logOut()">Log Out</button>
    </div>

    <!-- ------Footer------ -->
    <div class="footer">
        <div class="footer-container">
            <div class="row">
                <div class="footer-col">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and iOS</p>
                    <div class="app-logo">
                        <img src="images/play-store.png">
                        <img src="images/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <h3>Follow us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Tiktok</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright &copy; 2022 - BuyMe Online Shopping</p>
        </div>
    </div>

    <!-- ------JavaScripts function for logout and back button------ -->
    <script>

        function logOut() {

            document.location.href = "logout.php"
        }

        function back() {

            document.location.href = "customer.php";
        }

    </script>

</body>

</html>