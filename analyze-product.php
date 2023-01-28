<?php
// Database connection and current user's username
require "login.php";
include "config.php";

// User must login first to access the page
if (!isset($_SESSION["username"])) {

    header("Location: index.php");
    die();
}

// Declare and initialize the variables for rating
$rate5 = 0;
$rate4 = 0;
$rate3 = 0;
$rate2 = 0;
$rate1 = 0;

// Get the rating from table in ascending order
$get_rating = "SELECT rating FROM product_ranking ORDER BY ranking_id ASC";
$res = mysqli_query($conn, $get_rating);

if ($res->num_rows > 0) {

    while ($row = mysqli_fetch_assoc($res)) {
        $rate = $row["rating"];

        if ($rate == 5) {
            $rate5++;
        } else if ($rate == 4) {
            $rate4++;
        } else if ($rate == 3) {
            $rate3++;
        } else if ($rate == 2) {
            $rate2++;
        } else if ($rate == 1) {
            $rate1++;
        }
    }
}

// $top_rate_id = "SELECT product_id FROM product_ranking "

?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>Product Analysis</title>

    <!-- ------Pie Chart for the product rating based on number of stars------ -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Rating Specification', 'Stars'],
                ['5 Stars', <?php echo $rate5; ?>],
            ['4 Stars', <?php echo $rate4; ?>],
                ['3 Stars', <?php echo $rate3; ?>],
                ['2 Stars', <?php echo $rate2; ?>],
                ['1 Star', <?php echo $rate1; ?>]
            ]);

            var options = {
                title: 'Overview',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>

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
                    <li><a href=""><i class="fa-solid fa-user"></i>
                            <?php echo $_SESSION["username"]; ?>
                        </a></li>
                    <li><a href=""><i class="fa-solid fa-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- ------The chart for user review for all the product in the website------ -->
    <div class="chart-container">
        <div id="donutchart"></div>
        <p></p>
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

    <!-- ------JavaScipts function for logout and back button------ -->
    <script>

        function back() {

            document.location.href = "admin.php";
        }

        function logOut() {

            document.location.href = "logout.php"
        }

    </script>

</body>

</html>