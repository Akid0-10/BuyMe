<?php
// Database connection
include "config.php";
require_once "product.php";

// Page is not accessible without login first
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>Products Information's</title>

</head>

<body>

    <!-- ------Top Navigation Bar------ -->
    <div class="container">
        <div class="navbar">
            <div class="nav-logo">
                <a href="admin.php">
                    <img src="images/Logo.png">
                </a>
            </div>
            <div class="name">
                <a href="admin.php">
                    <h1>BUYME ONLINE SHOPPING</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href=""><i class="fa-solid fa-magnifying-glass"></i> Search</a></li>
                    <li><a href=""><i class="fa-solid fa-user"></i>
                            <?php echo $_SESSION["username"]; ?>
                        </a></li>
                    <li><a href=""><i class="fa-solid fa-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Fetch all data from product's table and display it -->
    <div class="view-container">
        <?php

        $display_all_sql = "SELECT * FROM product ORDER BY product_id ASC";
        $res = mysqli_query($conn, $display_all_sql);

        while ($row = $res->fetch_assoc()) {

            $prodName = $row["product_name"];
            $prodId = $row["product_id"];
            $prodType = $row["type"];
            $prodBrand = $row["brand"];
            $cust_review = $row["customer_review"];
            $pic = base64_encode($row["product_pic"]);

            echo "<div><br><h3>&nbsp;&nbsp;Product ID : " . $prodId . "&nbsp;&nbsp;</h3><br><hr id='ViewLine'><br>";
            echo "<p>&nbsp;&nbsp;<img src='data:image/jpg;charset=utf8;base64," . $pic . "'>&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Product Name : " . $prodName . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Type : " . $prodType . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Brand : " . $prodBrand . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Customer Review : " . $cust_review . "&nbsp;&nbsp;</p><br></div>";
        }

        $res->free();

        ?>

    </div>

    <!-- ------Back Button and Log Out Button------ -->
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

    <!-- ------JavaScripts Function for the logout and back button------ -->
    <script>

        function back() {

            document.location.href = "register-product.php";
        }

        function logOut() {

            document.location.href = "logout.php"
        }

    </script>

</body>

</html>