<?php
session_start();
require_once 'model/User.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User(); // Create a new User object

    // Check for create user action
    if (isset($_POST['newEmail'])) {
        // First, check if the email already exists
        if ($user->emailExists($_POST['newEmail'])) {
            $_SESSION['sweetalert'] = [
                "type" => "warning",
                "message" => "This email is already in use."
            ];
            header("Location: users.php");
            exit; // Stop further processing
        }

        // Prepare data for user creation
        $data = [
            'first_name' => $_POST['newFirstName'],
            'last_name' => $_POST['newLastName'],
            'email' => $_POST['newEmail'],
            'password' => $_POST['newPassword'], // Consider hashing this password
            'gender' => $_POST['newGender'],
            'birth_date' => $_POST['newBirthDate'],
            'phone' => $_POST['newPhone'],
            'address' => $_POST['newAddress'],
            'state' => $_POST['newState'],
            // Ensure we check for newRole and assign it
            'role' => isset($_POST['newRole']) ? $_POST['newRole'] : null // Update this line
        ];

        // Check if the role is set
        if (empty($data['role'])) {
            $_SESSION['sweetalert'] = [
                "type" => "error",
                "message" => "Role is required."
            ];
            header("Location: users.php");
            exit();
        }

        // Attempt to create a new user
        if ($user->createUser($data)) {
            $_SESSION['sweetalert'] = [
                "type" => "success",
                "message" => "User created successfully!"
            ];
        } else {
            $_SESSION['sweetalert'] = [
                "type" => "error",
                "message" => "Failed to create user."
            ];
        }
        header("Location: users.php");
        exit();
    }

    // Check for delete user action
    if (isset($_POST['deleteUserId'])) {
        $user_id = $_POST['deleteUserId'];

        // Attempt to soft delete the user
        if ($user->softDeleteUser($user_id)) {
            $_SESSION['sweetalert'] = [
                "type" => "success",
                "message" => "User deleted successfully!"
            ];
        } else {
            $_SESSION['sweetalert'] = [
                "type" => "error",
                "message" => "Failed to delete user."
            ];
        }
        header("Location: users.php");
        exit();
    }

    
   // Check for edit user action
// Check for edit user action
if (isset($_POST['editUserId'])) {
    $userId = $_POST['editUserId'];

    // Prepare the data for update
    $data = [
        'user_id' => $userId,
        'first_name' => $_POST['editFirstName'],
        'last_name' => $_POST['editLastName'],
        'email' => $_POST['editEmail'],
        'gender' => $_POST['editGender'],
        'birth_date' => $_POST['editBirthDate'],
        'phone' => $_POST['editPhone'],
        'address' => $_POST['editAddress'],
        'state' => $_POST['editState'],
        'role' => isset($_POST['editRole']) ? $_POST['editRole'] : null // Ensure to use 'editRole'
    ];

    // Check if the role is set
    if (empty($data['role'])) {
        $_SESSION['sweetalert'] = [
            "type" => "error",
            "message" => "Role is required."
        ];
        header("Location: users.php");
        exit();
    }

    // Attempt to update the user
    if ($user->updateUser($data)) {
        $_SESSION['sweetalert'] = [
            "type" => "success",
            "message" => "User updated successfully!"
        ];
    } else {
        $_SESSION['sweetalert'] = [
            "type" => "error",
            "message" => "Failed to update user."
        ];
    }
    header("Location: users.php");
    exit();
}


}
