<?php

// Start the session and database connection
session_start();
include "config.php";

// Define the session variables
$_SESSION["status"] = "";
$_SESSION["error"] = "";

// User submit the add product form
if (isset($_POST["btnAddProd"])) {

    $prodName = $_POST["prodName"];
    $prodType = $_POST["prodType"];
    $prodBrand = $_POST["prodBrand"];

    $id = rand(1111, 9999);

    $sql_select = "SELECT * FROM product";
    $res = mysqli_query($conn, $sql_select);
    $total_row = mysqli_num_rows($res);
    $count = 0;

    // Avoid product from having the same id
    while ($count <= $total_row) {

        $prodId = "P" . $id . "T";
        $id_check_sql = "SELECT * FROM product WHERE product_id = '$prodId'";
        $rs = mysqli_query($conn, $id_check_sql);

        if ($rs->num_rows > 0) {

            $id = rand(1111, 9999);
        } else {

            break;
        }
    }

    // Validate the picture upload from the user
    if (!empty($_FILES["image"]["name"])) {

        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowType = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        if (in_array($fileType, $allowType)) {
            $pic = $_FILES["image"]["tmp_name"];
            $picCont = addslashes(file_get_contents($pic));

            $add_product_sql = "INSERT INTO product(product_name, product_id, type, brand, product_pic) VALUES ('$prodName', '$prodId', '$prodType', '$prodBrand', '$picCont')";

            if (mysqli_query($conn, $add_product_sql)) {

                $_SESSION["status"] = "Product has been successfully added";
            } else {

                $_SESSION["error"] = "Failed to add product. Please try again." . $add_product_sql . mysqli_error($conn);

            }
        } else {

            $_SESSION["error"] = "Sorry, only JPG, PNG, JPEG, GIF & WEBP files are allowed.";
        }
    }

}

// User enter the product's id that need to be update
if (isset($_POST["btnUpdate"])) {

    $prodId = $_POST["prodId"];

    $sql_check = "SELECT * FROM product WHERE product_id = '$prodId'";
    $res = mysqli_query($conn, $sql_check);

    if ($res->num_rows > 0) {

        $_SESSION["prodId"] = $prodId;
        header("Location: update-product.php");
        exit();
    } else {

        $_SESSION["status"] = "No product is found with ID " . $prodId;
    }
}

// User submit the new updated form
if (isset($_POST["btnUpdateProd"])) {

    $prodId = $_POST["prodId"];
    $prodName = $_POST["prodName"];
    $type = $_POST["prodType"];
    $brand = $_POST["prodBrand"];

    $updateProd_sql = "UPDATE product SET product_name = '$prodName', type = '$type', brand = '$brand' WHERE product_id = '$prodId'";

    if (mysqli_query($conn, $updateProd_sql)) {

        $_SESSION["status"] = "Product has been successfully updated";
    } else {

        $_SESSION["status"] = "Failed to update";
    }

}

// User enter the id for the product
if (isset($_POST["btnDelete"])) {

    $prodId = $_POST["prodId"];

    $sql_check = "SELECT * FROM product WHERE product_id = '$prodId'";
    $res = mysqli_query($conn, $sql_check);

    if ($res->num_rows > 0) {

        $_SESSION["prodId"] = $prodId;
        header("Location: delete-product.php");
        exit();
    } else {

        $_SESSION["status"] = "No product is found with ID " . $prodId;
    }


}

// User confirm to delete the product
if (isset($_POST["btnDeleteProd"]) && $_POST["btnDeleteProd"] == "true") {

    $prodId = $_POST["prodId"];

    $delete_product = "DELETE FROM product WHERE product_id = '$prodId'";

    if (mysqli_query($conn, $delete_product)) {

        $_SESSION["status"] = "Product successfully deleted.";
    } else {

        $_SESSION["status"] = "Failed to delete product";
    }

}


?>