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

    public function getRelatedProducts($category_id, $current_product_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM products WHERE category_id = :category_id AND product_id != :current_product_id
            ORDER BY RAND() LIMIT 4");
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':current_product_id', $current_product_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategory($product_id) {
        $stmt = $this->db->prepare("SELECT category_id FROM products WHERE product_id = :product_id LIMIT 1");
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['category_id'] : null;
    }
}
