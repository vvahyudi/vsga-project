<?php
session_start();

require_once 'config_db.php';

// Check if the product ID is provided in the query string
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Remove the product from the database
    $sql = "DELETE FROM db_vsga.tb_produk WHERE id_produk = '$productID'";
    $result = mysqli_query($db_connect, $sql);

    if ($result) {
        // Redirect back to the product list page
        header("Location: list_produk.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($db_connect);
    }
} else {
    echo "Product ID not provided.";
}