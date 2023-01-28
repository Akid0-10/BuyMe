<?php
// Require to use the reset.php content only once
require_once "reset.php";
$_SESSION["status"] = "";
?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Reset Password</title>

</head>

<body>

    <!-- ------Main Container------ -->
    <div class="index-container">
        <div class="row">
            <div class="col">

                <!-- ------Form to verify the code from the user------ -->
                <div class="form-container-reset">
                    <div class="form-tab">
                        <span>Reset Password</span>
                        <hr id="ResetLine">
                    </div>
                    <form id="ResetForm" action="verify-code.php" method="post" autocomplete="off">
                        <!-- <p><?php echo $_SESSION["status"]; ?></p> -->
                        <input type="number" name="otp" id="otp" placeholder="Password OTP">
                        <button type="submit" id="btnVerify" name="btnVerify" class="btn">Continue</button>
                        <p id="error"> <?php echo $_SESSION["error"]; ?></p>
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