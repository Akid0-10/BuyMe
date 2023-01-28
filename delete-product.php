<?php
// Process the product
require_once "product.php";

// User must login first to access the page
if (!isset($_SESSION["username"])) {

    header("Location: index.php");
    die();
}

// Assign product id to a variable
$prodId = $_SESSION["prodId"];

// Fetch the row data based on product id
$sql = "SELECT product_name, product_id, type, brand FROM product WHERE product_id = '$prodId'";
$res = mysqli_query($conn, $sql);

if ($res->num_rows > 0) {

    while ($row = $res->fetch_assoc()) {

        $prodName = $row["product_name"];
        $prodId = $row["product_id"];
        $type = $row["type"];
        $brand = $row["brand"];
    }
} else {

    $prodId = "";
    $prodName = "";
    $prodId = "";
    $type = "";
    $brand = "";
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <title>Delete Product</title>

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
                    <li><a href=""><i class="fa-solid fa-user"></i> Profile</a></li>
                    <li><a href=""><i class="fa-solid fa-gear"></i> Settings</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- ------Display the product based on Id and delete button------ -->
    <div class="index-container">
        <div class="row">
            <div class="col">
                <div class="form-container-updateProd">
                    <div class="form-tab">
                        <span>Delete Product</span>
                        <hr id="ProductLine">
                    </div>
                    <form id="addProdForm" action="delete-product.php" method="post">
                        <input type="text" name="prodId" id="prodId" value="<?php echo $prodId; ?>" readonly>
                        <input type="text" name="prodName" id="prodName" value="<?php echo $prodName; ?>" readonly>
                        <input type="text" name="prodType" id="prodType" value="<?php echo $type; ?>" readonly>
                        <input type="text" name="prodBrand" id="prodBrand" value="<?php echo $brand; ?>" readonly>
                        <button type="submit" id="btnDeleteProd" name="btnDeleteProd" class="btn"
                            onclick="del()">Delete</button>
                        <p>
                            <?php echo $_SESSION["status"]; ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
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

    <!-- ------JavaScripts Function for buttons and confirm the product delete------ -->
    <script>

        function back() {

            document.location.href = "delete.php";
        }

        function logOut() {

            document.location.href = "logout.php"
        }

        function del() {

            var res = confirm("Are you sure want to delete this product?");
            document.getElementById("btnDeleteProd").value = res;
        }

    </script>

</body>

</html>