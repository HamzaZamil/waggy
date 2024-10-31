<?php
session_start(); // Start the session

if (!class_exists('Cart')) {
    include '../model/cart.class.php';
}

class CartController
{
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    // Handle "Add to Cart" action
    public function addToCart($productId, $quantity = 1)
    {
        if (!isset($_SESSION['user_id'])) {
            return ['success' => false, 'message' => 'User not logged in'];
        }

        $userId = $_SESSION['user_id'];

        if ($this->cart->addToCart($userId, $productId, $quantity)) {
            $_SESSION['added_item'] = true;
            return ['success' => true];
        } else {
            $_SESSION['added_item'] = false;
            return ['success' => false, 'message' => 'Failed to add item to cart'];
        }
    }


    // Handle AJAX requests for quantity update
    // public function updateCartQuantity($userId, $productId, $quantity)
    // {
    //     if ($this->cart->updateQuantity($userId, $productId, $quantity)) {
    //         echo json_encode(["success" => "Quantity updated."]);
    //     } else {
    //         echo json_encode(["error" => "Failed to update quantity."]);
    //     }
    //     exit();
    // }
}

// Handling requests
// $controller = new CartController();

// if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
//     $action = $_GET['action'];
//     $userId = $_SESSION['user_id'];
//     $productId = $_GET['product_id'];

//     $quantity = $_GET['quantity'] ?? 1; // Default quantity is 1

//     if ($action === 'add') {
//         $controller->addToCart($userId, $productId, $quantity);
//     } elseif ($action === 'update') {
//         $controller->updateCartQuantity($userId, $productId, $quantity);
//     }
// }