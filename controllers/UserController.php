<?php

session_start();
require_once '../model/UserModel.php';

class UserController extends UserModel { 


    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['login'])) {
                $this->login();
            } elseif (isset($_POST['register'])) {
                $this->register();
            }
        }
    }



    private function login() {
        session_start(); // Start session at the beginning of the login method
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $userId = $this->loginUser($email, $password);
    
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header("Location: ../views/userProfile.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Invalid email or password.';
            header("Location: ../views/login_register.php");
            exit();
        }
    }
    

    private function register() {
        $firstName = trim($_POST['fname']);
        $lastName = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confPassword = trim($_POST['confirm_password']);
        $gender = trim($_POST['gender']);
        $DOB = trim($_POST['DOB']);
        $mobile = trim($_POST['mobile']);
        $address = trim($_POST['address']);

        // Validate 
        if ($password !== $confPassword) {
            $_SESSION['register_error'] = 'Passwords do not match.';
            header("Location: ../views/login_register.php");
            exit();
        }

        if ($this->registerUser($firstName, $lastName, $email, $password, $gender, $DOB, $mobile, $address)) { 
            // Registration successful
            header("Location: ../views/login_register.php"); 
            exit();
        } else {
            $_SESSION['register_error'] = 'Registration failed. Please try again.';
            header("Location: ../views/login_register.php"); 
            exit();
        }
    }
}

$controller = new UserController();
$controller->handleRequest();