<?php

// Connect to database
session_start();
include "config.php";

$_SESSION["status"] = "";
$_SESSION["error"] = "";


// If the register button is click/submitted
if (isset($_POST['register'])) {

    // Set and assign variabels from register form
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    // $fname = mysqli_real_escape_string($conn, $_POST['firstName']);
    // $lname = mysqli_real_escape_string($conn, $_POST["lastName"]);
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // Generate random number to create user ID
    // $id = rand(1,99999);
    // $userId = "AQ".$id; 

    // // Validate user ID from having duplicate ID's
    // $sql_check = "SELECT user_id FROM login WHERE user_id='$userId'";
    // $res = $conn->query($sql_check);
    // if($res->num_rows > 0){

    //     $id = rand(1,99999);
    //     $userId = "AQ".$id;
    // }

    $password_crypt = password_hash($password, PASSWORD_DEFAULT);

    $sql_check = "SELECT a.username AS ausername, c.username AS cusername FROM admin AS a, customer AS c WHERE a.username " .
        "= '$username' OR c.username = '$username'";
    $res = $conn->query($sql_check);

    // if(!$res){
    //     trigger_error('Invalid query: ' . $conn->error);
    // }

    if ($res->num_rows > 0) {

        $_SESSION["error"] = "Username already exist!";
    }

    // Insert the data from registration from into the table in database
    else {


        $sql = "INSERT INTO register(first_name, last_name, username, gender, email, password, numberphone)  VALUES ('$fName', '$lName', '$username', '$gender', '$email', '$password_crypt', '$phone')";
        if (mysqli_query($conn, $sql)) {

            $sql2 = "INSERT INTO customer VALUES ('$username', '$password_crypt', '$email')";
            mysqli_query($conn, $sql2);
            $_SESSION["status"] = "Successfully registered";

        }

        // If the data could not be inserted
        else {
            // echo "Failed" . $sql . "<br>" . mysqli_error($conn);
            $_SESSION["error"] = "Failed to register!";
        }
    }
}

?>