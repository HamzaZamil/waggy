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

            // If no order exists, create a new one with user address
            if (!$order) {
                // Retrieve the user's address
                $userAddressQuery = "SELECT user_address_line_one FROM users WHERE user_id = :user_id";
                $userAddressStmt = $this->db->prepare($userAddressQuery);
                $userAddressStmt->execute(['user_id' => $userId]);
                $userAddress = $userAddressStmt->fetch(PDO::FETCH_ASSOC);

                if ($userAddress) {
                    // Insert a new order, including user_address_line_one
                    $insertOrderQuery = "INSERT INTO orders (user_id, user_address_line_one, order_status) VALUES (:user_id, :user_address_line_one, 'in_cart')";
                    $insertOrderStmt = $this->db->prepare($insertOrderQuery);
                    $insertOrderStmt->execute([
                        'user_id' => $userId,
                        'user_address_line_one' => $userAddress['user_address_line_one']
                    ]);
                    $orderId = $this->db->lastInsertId();
                } else {
                    throw new Exception("User address not found.");
                }
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
            error_log("Database error: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
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

    public function updateTotal($userId, $total)
    {
        $sql = "UPDATE orders SET order_total = :total WHERE user_id = :user_id AND order_status = 'in_cart'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':total' => $total, ':user_id' => $userId]);
    }

    public function updateCoupon($user_id, $coupon_id)
    {
        $sql = "UPDATE orders SET coupon_id = :coupon_id WHERE user_id = :user_id AND order_status = 'in_cart'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':coupon_id' => $coupon_id, ':user_id' => $user_id]);
    }

    public function availableCoupons($userId)
    {
        try {
            // Fetch all valid coupons
            $couponQuery = "SELECT * FROM coupons WHERE coupon_expiry_date > CURDATE() AND coupon_status = 'Valid'";
            $couponStmt = $this->db->prepare($couponQuery);
            $couponStmt->execute();
            $coupons = $couponStmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if the user has ordered before
            $orderQuery = "SELECT order_id FROM orders WHERE user_id = :user_id AND (order_status = 'Cancelled' OR order_status = 'Pending' OR order_status = 'Delivered')";
            $orderStmt = $this->db->prepare($orderQuery);
            $orderStmt->execute(["user_id" => $userId]);

            // If the user has previous orders, filter out the "FIRSTPURCH20" coupon
            if ($orderStmt->rowCount() > 0) {
                $coupons = array_filter($coupons, function ($coupon) {
                    return $coupon['coupon_name'] !== "FIRSTPURCH20";
                });

                // Re-index the array
                $coupons = array_values($coupons);
            }
            return $coupons;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getUserAddress($userId)
    {
        try {
            $addressStmt = $this->db->prepare("SELECT user_address_line_one FROM users WHERE user_id = :user_id");
            $addressStmt->execute(["user_id" => $userId]);
            $address = $addressStmt->fetch(PDO::FETCH_ASSOC);
            return $address["user_address_line_one"];
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateAddressInDatabase($user_id, $address)
    {
        $updateQuery = "UPDATE users SET user_address_line_one = :user_address WHERE user_id = :user_id";
        $updateStmt = $this->db->prepare($updateQuery);
        if ($updateStmt->execute(["user_id" => $user_id, "user_address" => $address])) {
            return true;
        } else {
            return false;
        }
    }

    public function placeOrder($user_id)
    {
        $updateQuery = "UPDATE orders SET 
                            order_date = CURDATE(), 
                            order_status = 'Pending' 
                        WHERE 
                            user_id = :user_id 
                            AND order_status = 'in_cart'";

        $updateStmt = $this->db->prepare($updateQuery);
        if ($updateStmt->execute(['user_id' => $user_id])) {
            $deleteCart = $this->clearCart($user_id);
            if ($deleteCart) {
                return true;
            }
        } else {
            return false;
        }
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
