<?php
require_once 'model/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User(); // Create a new User object

    // Check for create user action
    if (isset($_POST['newEmail'])) {
        // First, check if the email already exists
        if ($user->emailExists($_POST['newEmail'])) {
            echo "Error: This email is already in use.";
            // Optionally, you can redirect back to the form with an error message
            // header("Location: add_user.php?error=email_exists");
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
            'role' => $_POST['newRole']
        ];

        // Attempt to create a new user
        if ($user->createUser($data)) {
            header("Location: users.php");
            exit;
        } else {
            echo "Error: Unable to create user.";
        }
    }

    // Check for delete user action
    if (isset($_POST['deleteUserId'])) {
        $user_id = $_POST['deleteUserId'];

        // Attempt to soft delete the user
        if ($user->softDeleteUser($user_id)) {
            header("Location: users.php");
            exit;
        }
    }

    // Check for edit user action
    if (isset($_POST['editUserId'])) {
        $data = [
            'user_id' => $_POST['editUserId'],
            'first_name' => $_POST['editFirstName'],
            'last_name' => $_POST['editLastName'],
            'email' => $_POST['editEmail'],
            'gender' => $_POST['editGender'],
            'birth_date' => $_POST['editBirthDate'],
            'phone' => $_POST['editPhone'],
            'address' => $_POST['editAddress'],
            'state' => $_POST['editState'],
            'role' => $_POST['editRole']
        ];

        // Attempt to update the user
        if ($user->updateUser($data)) {
            header("Location: users.php"); // Redirect back to users page
            exit;
        } else {
            echo "Error: Unable to update user.";
        }
    }
}
