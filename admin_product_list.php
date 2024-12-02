<?php
require_once 'model/ProductModel.php';
require_once 'db_connection.php';

$productModel = new ProductModel($db);
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Liste des Produits</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>products</h1>
    <a href="admin_product_add.php">Add product</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>destination</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?> TND</td>
                    <td><?= htmlspecialchars($product['destination']) ?></td>
                    <td>
                        <a href="admin_product_edit.php?id=<?= $product['id'] ?>">edit</a>
                        <a href="admin_product_delete.php?id=<?= $product['id'] ?>" onclick="return confirm('are you sure ?')">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
