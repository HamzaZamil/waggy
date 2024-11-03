<?php

require_once '../includes/conn.php';

class UserModel extends DBConnection {
    protected $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0; // Returns true if the email exists
    }

    public function registerUser($firstName, $lastName, $email, $password, $gender, $DOB, $mobile, $address) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (user_first_name, user_last_name, user_email, user_password, user_gender, user_birth_of_date, user_phone_number, user_address_line_one, user_state, user_role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Active', 'User')");
        return $stmt->execute([$firstName, $lastName, $email, $hashedPassword, $gender, $DOB, $mobile, $address]);
    }

    public function loginUser($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $user['user_password'])) {
                return $user['user_id'];
            }
        }
        return false;
    }
}
