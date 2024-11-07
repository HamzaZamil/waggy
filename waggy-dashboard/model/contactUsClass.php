<?php
require_once 'Database.php';

class messages {
    private $conn;



    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    // Fetch all messages
    public function getAllMessages() {
        $query = "
            SELECT 
                id,
                name,
                email,
                created_at
            FROM 
                feedback
            ORDER BY 
                created_at DESC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch message details by ID
    public function getMessageDetails($id) {
        $query = "
            SELECT 
                id,
                name,
                email,
                message,
                created_at
            FROM 
                feedback
            WHERE 
                id = :id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
