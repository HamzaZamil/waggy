<?php
require_once 'Database.php';


class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Function to get all users
    public function getAllUsers() {
        $query = "
             SELECT * 
             FROM users 
             WHERE is_deleted = 0 AND user_role IN ('Admin', 'User')
             ;
             "; 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Function to soft delete a user
  
    public function softDeleteUser($userId) {
        $query = "UPDATE users SET is_deleted = 1 WHERE user_id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        return $stmt->execute();
    }
    // Other existing methods...

    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE user_email = :email AND is_deleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if user exists
    }

    public function createUser($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_first_name, user_last_name, user_email, user_password, user_gender, user_birth_of_date, user_phone_number, user_address_line_one, user_state, user_role) 
                  VALUES (:first_name, :last_name, :email, :password, :gender, :birth_date, :phone, :address, :state, :role)";
    
        $stmt = $this->conn->prepare($query);
    
        // Hash the password before storing it
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
        // Bind parameters
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashedPassword); // Use the hashed password
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':birth_date', $data['birth_date']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':state', $data['state']);
        $stmt->bindParam(':role', $data['role']);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function updateUser($data) {
        $query = "UPDATE " . $this->table_name . " SET 
                  user_first_name = :first_name, 
                  user_last_name = :last_name, 
                  user_email = :email, 
                  user_gender = :gender, 
                  user_birth_of_date = :birth_date, 
                  user_phone_number = :phone, 
                  user_address_line_one = :address, 
                  user_state = :state, 
                  user_role = :role 
                  WHERE user_id = :user_id";
    
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':birth_date', $data['birth_date']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':state', $data['state']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':user_id', $data['user_id']); // Bind user_id for the WHERE clause
    
        return $stmt->execute(); // Execute and return true/false
    }

    public function login($email, $password) {
        
        $userData = $this->getUserByEmail($email); 
    
        if ($userData) {
            
            if (password_verify($password, $userData['user_password'])) {
                
                if (!($userData['user_role'] === 'Admin' || $userData['user_role'] === 'Superadmin')) {
                    return "Unauthorized access: You do not have permission to log in.";
                } else {
                    return "success login"; 
                }
            } else {
                return "Invalid password."; 
            }
        } else {
            return "User not found."; 
        }
    }
    

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = :user_id AND is_deleted = 0");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countActiveUsers() {
        $query = "
            SELECT COUNT(*) 
            FROM users 
            WHERE user_state = 'Active' 
            AND is_deleted = 0 
            AND user_role = 'User'
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    
}
?>