<?php
// Get current user username
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>BuyMe Online Shopping - Admin</title>

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
                    <li><a href="user-profile-admin.php"><i class="fa-solid fa-user"></i>
                            <?php echo $_SESSION["username"]; ?>
                        </a></li>
                    <li><a href=""><i class="fa-solid fa-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </div>
    </div>



    <!-- ------Container for admin features------ -->
    <div class="admin-container">
        <div class="row">
            <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
        </div>
        <div class="row">
            <div class="col">
                <a href="register-product.php"><i class="fa-solid fa-file-circle-plus"></i><br><br>Register Product</a>

            </div>
            <div class="col2">
                <a href="analyze-product.php"><i class="fa-solid fa-chart-line"></i><br><br>Analyze Product</a>
            </div>
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

    <!-- ------JavaScripts Function for logout------ -->
    <script>

        function logOut() {

            document.location.href = "logout.php";

        }

    </script>

</body>

</html>