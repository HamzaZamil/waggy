<?php
if (!class_exists('DBConnection')) {
    include '../includes/conn.php';
}

class Contact extends DBConnection
{
    public function saveContactInfo($name, $email, $message)
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("INSERT INTO feedback (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message
            ]);
            return ['status' => 'success', 'message' => 'Your message has been sent succesfully!'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        }
    }
}


        ?>