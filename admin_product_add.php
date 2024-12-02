<?php
require_once 'model/ProductModel.php';
require_once 'db_connection.php';

$productModel = new ProductModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['destination'];

    $productModel->addProduct($name, $description, $price, $stock);
    header("Location: admin_product_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Produit</title>
    <script src="public/product.js" defer></script>
</head>
<body>
    <h1>add product</h1>
    <form method="POST">
        <label>Nom: <input type="text" name="name"></label>
        <span class="error" id="nameError"></span><br>

        <label>Description: <textarea name="description"></textarea></label><br>

        <label>Prix: <input type="number" step="0.01" name="price"></label>
        <span class="error" id="priceError"></span><br>

        <label>Destination: <input type="text" name="destination"></label>
        <span class="error" id="destinationError"></span><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>