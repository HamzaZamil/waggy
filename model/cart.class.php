<?php
if (!class_exists('DBConnection')) {
    include '../includes/conn.php';
}

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = (new DBConnection())->connect();
    }

    // Add item to cart
    public function addToCart($userId, $productId, $quantity = 1)
    {
        try {
            // Check for an existing order in progress
            $orderQuery = "SELECT * FROM orders WHERE user_id = :user_id AND order_status = 'in_cart'";
            $orderStmt = $this->db->prepare($orderQuery);
            $orderStmt->execute(['user_id' => $userId]);
            $order = $orderStmt->fetch(PDO::FETCH_ASSOC);

            // If no order exists, create a new one
            if (!$order) {
                $insertOrderQuery = "INSERT INTO orders (user_id, order_status) VALUES (:user_id, 'in_cart')";
                $insertOrderStmt = $this->db->prepare($insertOrderQuery);
                $insertOrderStmt->execute(['user_id' => $userId]);
                $orderId = $this->db->lastInsertId();
            } else {
                $orderId = $order['order_id'];
            }

            // Check if item already exists in order_items
            $checkQuery = "SELECT * FROM order_items WHERE user_id = :user_id AND product_id = :product_id AND orders_id = :orders_id";
            $checkStmt = $this->db->prepare($checkQuery);
            $checkStmt->execute(['user_id' => $userId, 'product_id' => $productId, 'orders_id' => $orderId]);
            $existingItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingItem) {
                // If item exists, update the quantity
                $newQuantity = $existingItem['quantity'] + $quantity;
                $updateQuery = "UPDATE order_items SET quantity = :quantity WHERE id = :id";
                $updateStmt = $this->db->prepare($updateQuery);
                $updateStmt->execute(['quantity' => $newQuantity, 'id' => $existingItem['id']]);
            } else {
                // If item does not exist, insert a new record in order_items
                $insertQuery = "INSERT INTO order_items (user_id, product_id, orders_id, quantity, in_cart) VALUES (:user_id, :product_id, :orders_id, :quantity, 1)";
                $insertStmt = $this->db->prepare($insertQuery);
                $insertStmt->execute(['user_id' => $userId, 'product_id' => $productId, 'orders_id' => $orderId, 'quantity' => $quantity]);
            }

            return true;
        } catch (PDOException $e) {
            // Handle error (log it, etc.)
            return false;
        }
    }


    // Delete item from cart
    public function deleteFromCart($userId, $productId)
    {
        try {
            $deleteQuery = "DELETE FROM order_items WHERE user_id = :user_id AND product_id = :product_id AND in_cart = 1";
            $deleteStmt = $this->db->prepare($deleteQuery);
            $deleteStmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Get all items in the cart for a user
    public function getCartItems($userId)
    {
        try {
            $query = "SELECT oi.*, p.product_name, p.product_img, p.product_quantity, p.product_price 
                      FROM order_items oi 
                      JOIN products p ON oi.product_id = p.product_id 
                      WHERE oi.user_id = :user_id AND oi.in_cart = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updateQuantity($userId, $productId, $quantity)
    {
        $sql = "UPDATE order_items SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id AND in_cart = 1";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':user_id' => $userId, ':product_id' => $productId, ':quantity' =>       $quantity]);
    }

    public function clearCart($userId)
    {
        try {
            $clearQuery = "UPDATE order_items SET in_cart = 0 WHERE user_id = :user_id AND in_cart = 1";
            $clearStmt = $this->db->prepare($clearQuery);
            $clearStmt->execute(['user_id' => $userId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}