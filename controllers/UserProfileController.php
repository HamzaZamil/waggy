<?php
require_once '../model/UserProfileModel.php';

class UserProfileController extends UserProfileModel {

    public function showProfile($userId) {
        return $this->getUserProfile($userId);
    }

    public function updateProfile($data) {
        return $this->updateUserProfile($data);
    }

    public function changePassword($userId, $newPassword) {
        return $this->updatePassword($userId, $newPassword);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    session_start();
    $userId = $_SESSION['user_id'];
    $controller = new UserProfileController();

    if ($_GET['action'] === 'updateProfile') {
        $data = [
            'user_id' => $userId,
            'user_first_name' => $_POST['user_first_name'],
            'user_last_name' => $_POST['user_last_name'],
            'user_email' => $_POST['user_email'],
            'user_phone_number' => $_POST['user_phone_number'],
            'user_address_line_one' => $_POST['user_address_line_one'],
        ];


        $success = $controller->updateProfile($data);
        header("Location: ../views/userProfile.php");
        
    } elseif ($_GET['action'] === 'changePassword') {
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        if ($newPassword === $confirmPassword) {
            $controller->changePassword($userId, $newPassword);
            header("Location: ../views/userProfile.php");
        } else {
            header("Location: ../views/userProfile.php?error=PasswordMismatch");
        }
    }
}

