<?php

// Start session and connect to database
session_start();
include "config.php";

$_SESSION["type_cat"] = "";

// When both username and password field have been inputed
if (isset($_POST['username']) && isset($_POST['password'])) {

    // Validate the string from both username and password
    function validate($data)
    {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // if(empty($username)){
    //     // header("Location: index.php?error=Username is required");
    //     // exit();
    // }

    // else if(empty($password)){
    //     // header("Location: index.php?error=Password is required");
    //     // exit();
    // }

    // Authenticate the credentials with the database for user login 
    // else{

    $sql = "SELECT password FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $pass = $row["password"];
    $pass_verify = password_verify($password, $pass);

    if ($pass_verify) {

        $_SESSION["username"] = $username;
        header("Location: admin.php");
        exit();

    } else {

        $sql2 = "SELECT password FROM customer WHERE username='$username'";
        $result = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result);
        $pass = $row["password"];
        $pass_verify = password_verify($password, $pass);

        if ($pass_verify) {

            $_SESSION["username"] = $username;
            header("Location: customer.php");
            exit();

        } else {

            $_SESSION["error"] = "Invalid!";
            header("Location: index.php?error");
            exit();
        }
    }
    // }
}

// Display product according to the based on the categories from user selection
if (isset($_POST["wallet"])) {
    $_SESSION["type_cat"] = "Wallet";
} else if (isset($_POST["handbag"])) {
    $_SESSION["type_cat"] = "Handbag";
} else if (isset($_POST["tshirt"])) {
    $_SESSION["type_cat"] = "T-Shirt";
} else if (isset($_POST["skincare"])) {
    $_SESSION["type_cat"] = "Skin Care";
} else if (isset($_POST["blouse"])) {
    $_SESSION["type_cat"] = "Blouse";
} else if (isset($_POST["hijab"])) {
    $_SESSION["type_cat"] = "Hijab";
} else if (isset($_POST["makeup"])) {
    $_SESSION["type_cat"] = "Makeup";
}

?>