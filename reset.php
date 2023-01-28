<?php

// Start session and connect to database
session_start();
include "config.php";

// Initialize the status's session
$_SESSION["status"] = "";
$_SESSION["error"] = "";

// When user click forgot password
if (isset($_POST['btnReset'])) {

    // Checking if the email registered to the website
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $email_check = "SELECT * FROM register WHERE email = '$email' LIMIT 1";
    $email_validate = mysqli_query($conn, $email_check);

    if (mysqli_num_rows($email_validate) > 0) {

        // Generate token for the password reset and sent it via email
        $token = rand(999999, 111111);
        $sql = "UPDATE register SET password_token = '$token' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            $subject = "Password Reset OTP";
            $message = "Your password reset OTP is $token";
            $sender = "From: n.akid89@gmail.com";

            if (mail($email, $subject, $message)) {

                $status = "The OTP for the password reset has been sent to '$email'";
                $_SESSION['status'] = $status;
                $_SESSION['email'] = $email;
                header("Location: verify-code.php");
                exit();
            } else {

                echo "Failed";
            }
        } else {

            echo "Unable to update password token.";
        }
    } else {

        $_SESSION["status"] = "This email address is not registered in the system!";
        header("Location: reset.html");
        exit(0);
    }
}

// When to user click continue to verify the token
if (isset($_POST["btnVerify"])) {

    $email = $_SESSION["email"];
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    $sql = "SELECT * FROM register WHERE email = '$email'";
    $res = mysqli_query($conn, $sql);
    $field = mysqli_fetch_assoc($res);
    $obj = $field["password_token"];

    if ($obj == $otp) {

        header("Location: new-password.php");
        exit();
    } else {

        $_SESSION["status"] = "";
        $_SESSION["error"] = "Invalid OTP";
    }
}

// User submit the new password
if (isset($_POST["btnNewPassword"])) {

    $email = $_SESSION["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    // Make sure the password entered by user match in both field
    if ($password == $password2) {

        // Update password
        $update_pass = "UPDATE register SET password = '$password' WHERE email = '$email'";

        if (mysqli_query($conn, $update_pass)) {

            $data_check = "SELECT * FROM admin WHERE email = '$email'";

            if (mysqli_query($conn, $data_check)) {

                $pass_admin = "UPDATE admin SET password = '$password' WHERE email='$email'";
                mysqli_query($conn, $pass_admin);

                header("Location: index.php");
                exit();
            } else {

                $pass_cus = "UPDATE customer SET password = '$password' WHERE email = '$email'";
                mysqli_query($conn, $pass_cus);

                header("Location: index.php");
                exit();
            }
        } else {

            $_SESSION["error"] = "Failed to change password!" . $sql . mysqli_error($conn);
        }
    } else {

        $_SESSION["error"] = "Password did not match";
    }
}

?>