<?php
// Process products features
require_once "product.php";

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>Add Product</title>

</head>

<body>

    <!-- ------Top Navigation Bar------ -->
    <div class="container">
        <div class="navbar">
            <<div class="nav-logo">
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

    <!-- ------Form for adding a product------ -->
    <div class="index-container">
        <div class="row">
            <div class="col">
                <div class="form-container-add">
                    <div class="form-tab">
                        <span>Add Product Form</span>
                        <hr id="ProductLine">
                    </div>
                    <form id="addProdForm" action="add.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="prodName" id="prodName" placeholder="Product Name" required>
                        <input type="text" name="prodType" id="prodType" placeholder="Product Type" required>
                        <input type="text" name="prodBrand" id="prodBrand" placeholder="Product Brand">
                        <input type="file" name="image" id="image" class="input-image" required>
                        <button type="submit" id="btnAddProd" name="btnAddProd" class="btn">Add</button>
                        <p>
                            <?php echo $_SESSION["status"]; ?>
                        </p>
                        <p id="error">
                            <?php echo $_SESSION["error"]; ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
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

    <!-- ------JavaScripts function for logout and back button------ -->
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