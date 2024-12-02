<?php
require_once 'model/ProductModel.php';
require_once 'db_connection.php';

$productModel = new ProductModel($db);

// Get the product ID from the query string
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Call the delete method
    $productModel->deleteProduct($productId);

    // Redirect to the product list page
    header("Location: admin_product_list.php");
    exit;
} else {
    // If no ID is provided, redirect to the product list page
    header("Location: admin_product_list.php");
    exit;
}
?>
