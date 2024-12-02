<?php
class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addProduct($name, $description, $price, $destination) {
        $query = "INSERT INTO products (name, description, price, destination) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $description, $price, $destination]);
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $name, $description, $price, $destination) {
        $query = "UPDATE products SET name = ?, description = ?, price = ?, destination = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$name, $description, $price, $destination, $id]);
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
}

?>
