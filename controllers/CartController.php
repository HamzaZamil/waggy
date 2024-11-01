<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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


    public function getCartItems()
    {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }

        $userId = $_SESSION['user_id'];
        return $this->cart->getCartItems($userId);
    }

    
    public function getCartItemsCount() {
        try {
            
            $cartItems = $this->getCartItems();
            if (!empty($cartItems)) {
                return count($cartItems);
            } else {
                return 0;
            }

        } catch (PDOException $e) {
            return 0;
        }
    }

    // Handle AJAX requests for quantity update
    public function updateCartQuantity()
    {
        $userId = $_SESSION['user_id'];
        $data = json_decode(file_get_contents("php://input"), true); // Get the JSON input

        $productId = $data['productId']; // This comes from the AJAX request
        $quantity = $data['quantity']; // This comes from the AJAX request

        if ($this->cart->updateQuantity($userId, $productId, $quantity)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
        }
    }

    public function clearCart()
    {
        $userId = $_SESSION['user_id'];
        $items = $this->cart->clearCart($userId);
    }
}

// // Create an instance of CartController
// $cartController = new CartController();

// // Routing logic (simple example)
// if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getCartItems') {
//     $cartController->getCartItems();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'updateCartQuantity') {
//     $cartController->updateCartQuantity();
// }
