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
    public function getAllUsers($limit = 10, $offset = 0) {
        $query = "
            SELECT * 
            FROM users 
            WHERE is_deleted = 0
            LIMIT :limit OFFSET :offset"; // Limit and offset for pagination

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalUsers() {
        $query = "SELECT COUNT(*) as total FROM users WHERE is_deleted = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn(); // Fetch a single column value
    }

    // Function to soft delete a user
    public function softDeleteUser($user_id) {
        $query = "UPDATE " . $this->table_name . " SET is_deleted = 1 WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Other existing methods...

    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE user_email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Return true if email exists
    }

    public function createUser($data) {
        $query = "INSERT INTO " . $this->table_name . " (user_first_name, user_last_name, user_email, user_password, user_gender, user_birth_of_date, user_phone_number, user_address_line_one, user_state, user_role) VALUES (:first_name, :last_name, :email, :password, :gender, :birth_date, :phone, :address, :state, :role)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT)); // Hashing password
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
        // Prepare the SQL statement
        $query = "SELECT * FROM users WHERE user_email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        // Check if user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Verify the password
            if (password_verify($password, $user['user_password'])) {
                return $user; // Return user data if login is successful
            } else {
                echo "Password does not match.";
            }
        } else {
            echo "User not found.";
        }
        return false; // Return false if login fails
    }
    
    
    
}
?>
