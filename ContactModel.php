<?php
require_once __DIR__ . '/../config/config.php';

class ContactModel {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion();
    }

    public function create($data) {
        $sql = "INSERT INTO contacts (name, email, type, message) VALUES (:name, :email, :type, :message)";
        $query = $this->db->prepare($sql);
        return $query->execute($data);
    }

    public function getAll() {
        $sql = "SELECT * FROM contacts";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM contacts WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $sql = "UPDATE contacts SET name = :name, email = :email, type = :type, message = :message WHERE id = :id";
        $query = $this->db->prepare($sql);
        $data['id'] = $id;
        return $query->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $query = $this->db->prepare($sql);
        return $query->execute(['id' => $id]);
    }
}
?>