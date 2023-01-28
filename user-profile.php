<?php
// Use the login once for the username
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

    <title>
        <?php echo $_SESSION["username"]; ?>'s Profile
    </title>

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
                    <li><a href=""><i class="fa-solid fa-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- ------View the user's information------ -->
    <div class="profile-container">

        <h3>&nbsp;&nbsp;<?php echo $_SESSION["username"]; ?>'s Profile</h3>

        <?php

        $username = $_SESSION["username"];

        $display_all_sql = "SELECT * FROM register WHERE username = '$username'";
        $res = mysqli_query($conn, $display_all_sql);

        while ($row = $res->fetch_assoc()) {

            $fname = $row["first_name"];
            $lname = $row["last_name"];
            $username = $row["username"];
            $gender = $row["gender"];
            $email = $row["email"];
            $phone = $row["numberphone"];

            echo "<br><p>&nbsp;&nbsp;First Name : " . $fname . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Last Name : " . $lname . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Username : " . $username . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Gender : " . $gender . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Email : " . $email . "&nbsp;&nbsp;</p><br>";
            echo "<p>&nbsp;&nbsp;Phone Number : +60" . $phone . "&nbsp;&nbsp;</p><br><br>";
        }

        $res->free();

        ?>



    </div>

    <button class="edit-btn" onclick="edit()">Edit</button>
    <!-- ------Log Out Button------ -->
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

    <!-- ------JavaScripts function for logout, back, and edit profile button------ -->
    <script>

        function back() {

            document.location.href = "customer.php";
        }

        function logOut() {

            document.location.href = "logout.php";
        }

        function edit() {

            document.location.href = "edit-user-profile.php";
        }

    </script>

</body>

</html>