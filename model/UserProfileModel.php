<?php
require_once '../includes/conn.php';

class UserProfileModel extends DBConnection {
    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function getUserProfile($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserProfile($data) {
        $stmt = $this->db->prepare("UPDATE users SET user_first_name = ?, user_last_name = ?, user_email = ?, user_phone_number = ?, user_address_line_one = ? WHERE user_id = ?");
        return $stmt->execute([
            $data['user_first_name'],
            $data['user_last_name'],
            $data['user_email'],
            $data['user_phone_number'],
            $data['user_address_line_one'],
            $data['user_id']
        ]);
    }

    public function updatePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET user_password = ? WHERE user_id = ?");
        return $stmt->execute([$hashedPassword, $userId]);
    }
    
}


class OrderModel extends DBConnection {
    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function getUserOrders($userId) {
 
        $sql= 
           "SELECT 
                p.product_img, 
                p.product_name,
                p.product_description,
                p.product_price,
                oi.quantity,
                o.order_date,
                o.coupon_id,
                o.order_total,
                o.order_status 
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.orders_id
            JOIN products p ON oi.product_id = p.product_id
            WHERE o.user_id = :userId";


        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return []; 
        }
    }


}    


?>