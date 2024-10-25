<?php
if (!class_exists('DBConnection')) {
    include '../includes/conn.php';
}

class Wishlist
{
    private $db;

    public function __construct()
    {
        $this->db = new DBConnection(); // Assuming you have a DBConnection class for database connection
    }

    public function addItemToWishlist($productId, $userId)
    {
        // SQL to add the product to the wishlist
        try {
            $stmt = $this->db->connect()->prepare("INSERT INTO wishlist_items (user_id, product_id) VALUES (:user_id, :product_id)");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
        }
    }

    public function getWishlistItems($userId)
    {
        // Fetch wishlist items for a logged-in user
        try {
            $stmt = $this->db->connect()->prepare("SELECT product_id FROM wishlist_items WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return [];
        }
    }

    public function removeItemFromWishlist($productId, $userId)
    {
        // Remove a product from the wishlist
        try {
            $stmt = $this->db->connect()->prepare("DELETE FROM wishlist_items WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
        }
    }

    public function getProductById($productId)
    {
        $stmt = $this->db->connect()->prepare('SELECT * FROM products WHERE product_id = :product_id');
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Function to check if a product is in the user's wishlist
    public function isInWishlist($userId, $productId)
    {
        try {
            $stmt = $this->db->connect()->prepare("SELECT COUNT(*) FROM wishlist_items WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            return $stmt->fetchColumn() > 0; // Returns true if the product is in the wishlist
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false; // Return false on error
        }
    }
}