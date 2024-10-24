<?php
include_once '../includes/conn.php'; 
include_once '../controllers/productController.php';

class Product extends DBConnection {
    private $db;

    public function __construct() {
        $this->db = $this->connect(); 
    }

    public function getCategories() {
        $query = "SELECT * FROM categories"; 
        $stmt = $this->db->query($query);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function getProducts() {
        $query = "SELECT * FROM products"; 
        $stmt = $this->db->query($query); 
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : []; 
    }
}
