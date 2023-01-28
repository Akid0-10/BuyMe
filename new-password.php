<?php
require_once "reset.php";
?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>BuyMe Online Shopping</title>

</head>

<body>

    <!-- ------Main Container------ -->
    <div class="index-container">
        <div class="row">
            <div class="col">

                <!-- ------User new password form------ -->
                <div class="form-container-password">
                    <div class="form-tab">
                        <span>Reset Password</span>
                        <hr id="ResetLine">
                    </div>
                    <form id="ResetForm" action="new-password.php" method="post">
                        <input type="password" name="password" id="password" placeholder="New Password" required>
                        <input type="password" name="password2" id="password2" placeholder="Confirm Password" required>
                        <button type="submit" name="btnNewPassword" class="btn"
                            onclick="matchPassword()">Submit</button>
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
</body>

</html>