<?php
// Use the login once for the username
require_once "login.php";

// User must login first to access the page
if (!isset($_SESSION["username"])) {

    header("Location: index.php");
    die();
}

// Display user information to edit
$username = $_SESSION["username"];

$get_user = "SELECT * FROM register WHERE username = '$username'";
$res = mysqli_query($conn, $get_user);

if ($res->num_rows > 0) {

    while ($row = mysqli_fetch_assoc($res)) {

        $fname = $row["first_name"];
        $lname = $row["last_name"];
        $gender = $row["gender"];
        $email = $row["email"];
        $password = $row["password"];
        $phone = $row["numberphone"];

    }
}

// Update user's information
if (isset($_POST["btnUpdateUser"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    $password_crypt = password_hash($password, PASSWORD_DEFAULT);

    $update_user = "UPDATE register SET first_name = '$fname', last_name = '$lname', gender = '$gender', email = '$email', password = '$password_crypt', numberphone = '$phone' WHERE username = '$username'";
    $update_customer = "UPDATE customer SET password = '$password_crypt' WHERE username = '$username'";
    mysqli_query($conn, $update_user);
    mysqli_query($conn, $update_customer);
    header("Location: user-profile.php");
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

    <!-- ------Edit user profile------ -->
    <div class="profile-container">

        <h3>&nbsp;&nbsp;<?php echo $_SESSION["username"]; ?>'s Profile</h3>

        <form action="edit-user-profile.php" method="post">

            <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>">
            <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>">
            <div class="gender">
                <g>Gender: </g>
                <input type="radio" name="gender" id="gender" value="m" <?php if ($gender == "m") {
                    echo "checked=checked";
                } ?>>
                <label>Male</label>
                <input type="radio" name="gender" id="gender" value="f" <?php if ($gender == "f") {
                    echo "checked=checked";
                } ?>>
                <label>Female</label>
            </div>
            <input type="email" name="email" id="fname" value="<?php echo $email; ?>">
            <input type="password" name="password" id="password" value="<?php echo $password; ?>">
            <input type="tel" name="phone" id="phone" value="0<?php echo $phone; ?>">

            <button type="submit" id="btnUpdateUser" name="btnUpdateUser" class="btn">Update</button>
        </form>

    </div>

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

    <!-- ------JavaScripts function for logout and back button------ -->
    <script>

        function back() {

            document.location.href = "user-profile.php";
        }

        function logOut() {

            document.location.href = "logout.php";
        }

    </script>

</body>

</html>