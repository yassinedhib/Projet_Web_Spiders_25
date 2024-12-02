<?php
require_once 'model/ProductModel.php';
require_once 'db_connection.php';

$productModel = new ProductModel($db);

// Get the product ID from the query string
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = $productModel->getProductById($productId);
} else {
    // If no ID is provided, redirect to the product list page
    header("Location: admin_product_list.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $destination = $_POST['destination'];

    // Update product details
    $productModel->updateProduct($productId, $name, $description, $price, $destination);
    
    // Redirect to the product list page
    header("Location: admin_product_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <script src="public/product.js" defer></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>"></label>
        <span class="error" id="nameError"></span><br>

        <label>Description: <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea></label><br>

        <label>Price: <input type="number" step="1" name="price" value="<?= htmlspecialchars($product['price']) ?>"></label>
        <span class="error" id="priceError"></span><br>

        <label>Destination: <input type="text" name="destination" value="<?= htmlspecialchars($product['destination']) ?>"></label>
        <span class="error" id="destinationError"></span><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
