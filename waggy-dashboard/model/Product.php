<?php
// File: model/Product.php
// File: model/Product.php
require_once 'Database.php';

class Product {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Updated getAllProducts method with pagination support
    public function getAllProducts($limit = 10, $offset = 0) {
        $query = "
            SELECT p.*, c.category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.category_id 
            WHERE p.deleted_at IS NULL
            LIMIT :limit OFFSET :offset"; // Limit and offset for pagination
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get the total number of products
    public function getTotalProducts() {
        $query = "SELECT COUNT(*) as total FROM products WHERE deleted_at IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function createProduct($name, $description, $image, $categoryId, $quantity, $price, $status) {
        $sql = "INSERT INTO products (product_name, product_description, product_img, category_id, product_quantity, product_price, state) 
                VALUES (:name, :description, :image, :categoryId, :quantity, :price, :status)";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $image, $categoryId, $quantity, $price, $status) {
        $sql = "UPDATE products SET 
                product_name = :name, 
                product_description = :description, 
                product_img = :image, 
                category_id = :categoryId, 
                product_quantity = :quantity, 
                product_price = :price, 
                state = :status 
                WHERE product_id = :id";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function softDeleteProduct($productId) {
        $query = "UPDATE products SET deleted_at = NOW() WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getProductById($productId) {
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>