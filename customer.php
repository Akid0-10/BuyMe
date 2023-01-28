<?php
// Database connection and username for the current user
include "config.php";
require_once "login.php";

// User must login first to access the page
if (!isset($_SESSION["username"])) {

    header("Location: index.php");
    die();
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
                    <div class="search-bar">
                        <form>
                            <input type="text" name="search" id="search" placeholder="Search...">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
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

    <!-- ------The product categories. To display the product according to their type.------ -->
    <div class="categories-container">
        <h2>Categories</h2>
        <div class="grid-categories">
            <form action="customer.php" method="post">
                <button name="wallet">
                    <div class="cat"><a><img src="images/Wallet - LUIS Cognac.png">Wallet</a></div>
                </button>
                <button name="handbag">
                    <div class="cat"><a><img src="images/Handbag - CarloRino Looney Tunes.png">Handbag</a></div>
                </button>
                <button name="tshirt">
                    <div class="cat"><a><img src="images/Men Shirt - Polo Joseph Abboud.webp">T-Shirt</a></div>
                </button>
                <button name="skincare">
                    <div class="cat"><a><img src="images/Skin Care - Cetaphil Cleanser.webp">Skin Care</a></div>
                </button>
                <button name="blouse">
                    <div class="cat"><a><img src="images/Blouse - Plain Edition Green.webp">Blouse</a></div>
                </button>
                <button name="hijab">
                    <div class="cat"><a><img src="images/Hijab - Ariani Bawal.jpg">Hijab</a></div>
                </button>
                <button name="makeup">
                    <div class="cat"><a><img src="images/Makeup - Maybelline Foundation.jpg">Makeup</a></div>
                </button>
            </form>
        </div>
    </div>

    <!-- ------Display the product------ -->
    <div class="categories-container">
        <div class="grid-product">
            <form action="product-details.php" method="post">
                <?php

                if (empty($_SESSION["type"])) {
                    $type = $_SESSION["type_cat"];
                } else {
                    $type = $_SESSION["type"];
                    $_SESSION["type"] = "";
                }
                $view_prod = "SELECT product_id, product_name, product_pic, price FROM product WHERE type = '$type'";
                $rs = mysqli_query($conn, $view_prod);

                if ($rs->num_rows > 0) {

                    while ($row = $rs->fetch_assoc()) {

                        $prodId = $row["product_id"];
                        $prodName = $row["product_name"];
                        // $type = $row["type"];
                        // $brand = $row["brand"];
                        $pic = base64_encode($row["product_pic"]);
                        $price = $row["price"];

                        echo '<button name="id" value="' . $prodId . '"><div class="cat"><a><img src="data:image/jpg;charset=utf8;base64,' . $pic . '">' . $prodName . '<br></a><g>RM ' . $price . '</g></div></button>';
                    }
                } else {

                    // echo '<div class="cat"><a><img src="images/Blouse - Plain Edition Green.webp">'.$type.'<br></a><p>RM </p></div>';
                    $view_prod_all = "SELECT product_id, product_name, product_pic, price FROM product ORDER BY product_id ASC";
                    $rs = mysqli_query($conn, $view_prod_all);
                    $count = 0;

                    while ($row = $rs->fetch_assoc()) {

                        $count++;
                        if ($count > 10) {
                            break;
                        }
                        $prodId = $row["product_id"];
                        $prodName = $row["product_name"];
                        // $type = $row["type"];
                        // $brand = $row["brand"];
                        $pic = base64_encode($row["product_pic"]);
                        $price = $row["price"];

                        echo '<button name="id" value="' . $prodId . '"><div class="cat"><a><img src="data:image/jpg;charset=utf8;base64,' . $pic . '">' . $prodName . '<br></a><g>RM ' . $price . '</g></div>';
                    }
                }

                ?>
            </form>
        </div>
    </div>

    <!-- ------Log Out Button------ -->
    <div class="row row-btn-customer">
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

    <!-- ------JavaScripts function for logout button------ -->
    <script>

        function logOut() {

            document.location.href = "logout.php"
        }

    </script>

</body>

</html>