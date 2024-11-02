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
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $userId = $this->loginUser($email, $password);

        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header("Location: ../views/userProfile.php");
            exit();
        } else {
            $_SESSION['login_error'] = 'Invalid email or password.';
            header("Location: ../views/login.php");
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

        // Password match validation
        if ($password !== $confPassword) {
            $_SESSION['registration_error'] = 'Passwords do not match.';
            header("Location: ../views/register.php");
            exit();
        }

        // Email existence validation
        if ($this->emailExists($email)) {
            $_SESSION['registration_error'] = 'Email already exists. Please choose a different email.';
            header("Location: ../views/register.php?register=1"); 
            exit();
        }

        // Age validation
        $dobDate = new DateTime($DOB);
        $today = new DateTime();
        
        // Check if the selected date is today or in the future
        if ($dobDate > $today) {
            $_SESSION['registration_error'] = 'Date of birth cannot be today or in the future.';
            header("Location: ../views/register.php");
            exit();
        }

        // Calculate age
        $age = $today->diff($dobDate)->y;

        // Validate age
        if ($age < 16) {
            $_SESSION['registration_error'] = 'You must be at least 16 years old to register.';
            header("Location: ../views/register.php");
            exit();
        }

        // Registration logic
        if ($this->registerUser($firstName, $lastName, $email, $password, $gender, $DOB, $mobile, $address)) { 
            $_SESSION['registration_success'] = 'You have registered successfully!';
            header("Location: ../views/login.php");
            exit();
        } else {
            // Registration failed
            $_SESSION['registration_error'] = 'Registration failed. Please try again.';
            header("Location: ../views/register.php");
            exit();   
        }
        
    }
}

$controller = new UserController();
$controller->handleRequest();
