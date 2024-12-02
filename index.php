<?php
require_once 'model/ProductModel.php';
require_once 'db_connection.php'; // Connexion PDO

$productModel = new ProductModel($db);
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>product list</title>
</head>
<body>
    <h1>product list</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <a href="product_detail.php?id=<?= $product['id'] ?>">
                    <?= htmlspecialchars($product['name']) ?> - <?= htmlspecialchars($product['price']) ?> €
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
