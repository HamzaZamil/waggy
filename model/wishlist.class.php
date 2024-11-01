<?php
if (!class_exists('DBConnection')) {
    include '../includes/conn.php';
}

class Wishlist
{
    private $db;

    public function __construct()
    {
        $this->db = (new DBConnection())->connect();
    }

    private function wishListExist($userId)
    {
        $wishlistQuery = "SELECT * FROM wish_list WHERE user_id = :user_id";
        $wishlistStmt = $this->db->prepare($wishlistQuery);
        $wishlistStmt->execute(['user_id' => $userId]);
        return $wishlistStmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addItemToWishlist($productId, $userId)
    {
        // SQL to add the product to the wishlist
        try {
            $wishlist = $this->wishListExist($userId);

            // If no wishlist exists, create a new one
            if (!$wishlist) {
                $insertWishQuery = "INSERT INTO wish_list (user_id) VALUES (:user_id)";
                $insertWishStmt = $this->db->prepare($insertWishQuery);
                $insertWishStmt->execute(['user_id' => $userId]);
                $wishlistId = $this->db->lastInsertId();
            } else {
                $wishlistId = $wishlist['wish_list_id'];
            }

            // Check if item already exists in wishlist_items
            $checkQuery = "SELECT * FROM wishlist_items WHERE user_id = :user_id AND product_id = :product_id";
            $checkStmt = $this->db->prepare($checkQuery);
            $checkStmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            $existingItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingItem) {
                exit();
            } else {
                // If item does not exist, insert a new record in wishlist_items
                $insertQuery = "INSERT INTO wishlist_items (user_id,product_id, wishlist_id) VALUES (:user_id, :product_id, :wishlist_id)";
                $insertStmt = $this->db->prepare($insertQuery);
                $insertStmt->execute(['user_id' => $userId, 'product_id' => $productId, 'wishlist_id' => $wishlistId]);
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
        }
    }

    public function getWishlistItems($userId)
    {
        try {
            // Check if a wishlist exists for the user
            $wishlist = $this->wishListExist($userId);

            if ($wishlist) {
                // Fetch product details including product_id, product_img, product_name, product_price, and product_description
                $stmt = $this->db->prepare("
                SELECT p.product_id, p.product_img, p.product_name, p.product_price, p.product_description
                FROM wishlist_items wi
                JOIN products p ON wi.product_id = p.product_id
                WHERE wi.user_id = :user_id
            ");
                $stmt->execute(['user_id' => $userId]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return [];
        }
    }




    public function removeItemFromWishlist($productId, $userId)
    {
        // Remove a product from the wishlist
        try {
            $stmt = $this->db->prepare("DELETE FROM wishlist_items WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
        }
    }

    public function getProductById($productId)
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE product_id = :product_id');
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Function to check if a product is in the user's wishlist
    public function isInWishlist($userId, $productId)
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM wishlist_items WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            return $stmt->fetchColumn() > 0; // Returns true if the product is in the wishlist
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false; // Return false on error
        }
    }
}
