<?php
// User registration process
require_once "register.php";
?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>BuyMe Online Shopping - Welcome</title>

</head>

<body>

    <!-- ------Main Container------ -->
    <div class="index-container">
        <div class="row">
            <div class="col">
                <div class="app-img">
                    <img src="images/Logo.png">
                </div>
                <h2>WELCOME TO<br>BUYME<br>ONLINE SHOPPING PORTAL</h2>
            </div>
            <div class="col">

                <!-- ------Register and login form------ -->
                <div class="form-container">
                    <div class="form-tab">
                        <span onclick="login()">Login/Sign In</span>
                        <span onclick="register()">First Time User</span>
                        <hr id="Line">
                    </div>

                    <form id="LoginForm" action="login.php" method="post">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <button type="submit" name="login" id="login" class="btn">Login</button>
                        <a href="reset.html" class="reset">Forgot password?</a>
                        <!-- <p id="error"><?php echo $_SESSION["error"]; ?></p> -->
                    </form>

                    <form id="RegForm" action="index.php" method="post">
                        <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                        <div class="gender">
                            <g>Gender : </g>
                            <input type="radio" name="gender" id="gender" value="M" required>
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="gender" value="F" required>
                            <label for="female">Female</label>
                        </div>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <input type="text" name="username" id="username" placeholder="Username" required>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <input type="tel" name="phone" id="phone" placeholder="Phone Number" required>
                        <button type="submit" name="register" id="register" class="btn">Register</button>
                        <p id="status"><?php echo $_SESSION["status"]; ?></p>
                        <p id="error">
                            <?php echo $_SESSION["error"]; ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
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


    <!-- ------JavaScripts for Switching Tab of Login and Register------ -->
    <script>

        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Line = document.getElementById("Line");
        var Form = document.getElementsByClassName("form-container");

        function register() {
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Line.style.transform = "translateX(150px)";
        }

        function login() {
            RegForm.style.transform = "translateX(400px)";
            LoginForm.style.transform = "translateX(400px)";
            Line.style.transform = "translateX(0px)";

        }
    </script>

</body>

</html>