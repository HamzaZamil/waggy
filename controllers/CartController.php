<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!class_exists('Cart')) {
    include '../model/cart.class.php';
}


if (isset($_GET['action'])) {
    $controller = new CartController();

    switch ($_GET['action']) {
        case 'updateQuantityIncrease':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->updateQuantity($data['productId'], $data['quantity']);
            break;

        case 'updateQuantity':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->updateQuantity($data['productId'], $data['quantity']);
            break;

        case 'deleteItem':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->deleteItem($data['productId']);
            break;

            // case 'updateAddress':
            //     $data = json_decode(file_get_contents("php://input"), true);
            //     $controller->updateAddress($data['address']); // Method to update the address
            //     break;

        case 'getTotalCartValue':
            $controller->totalCart(); // Method to get total cart value
            break;

        // case 'calculateTotalAfterCoupon':
        //     $data = json_decode(file_get_contents("php://input"), true);
        //     $controller->calculateTotalAfterCoupon($data['coupon']); // Method to calculate total with coupon
        //     break;

        case 'saveTotal':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->saveTotal($data['total']); // Method to save the total
            break;
    }
    exit;
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


    public function getCartItemsCount()
    {
        try {
            $count = 0;
            $cartItems = $this->getCartItems();
            if (!empty($cartItems)) {
                foreach ($cartItems as $cartItem) {
                    $count += $cartItem['quantity'];
                }
                return $count;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return 0;
        }
    }

    // Handle AJAX requests for quantity update
    public function updateQuantity($productId, $quantity)
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            return;
        }

        $userId = $_SESSION['user_id'];
        if ($this->cart->updateQuantity($userId, $productId, $quantity)) {
            echo json_encode(['success' => true, 'newQuantity' => $quantity]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
        }
    }

    // Delete item from cart via AJAX
    public function deleteItem($productId)
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            return;
        }

        $userId = $_SESSION['user_id'];
        if ($this->cart->deleteFromCart($userId, $productId)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete item']);
        }
    }

    // public function totalCart()
    // {
    //     $cart = $this->getCartItems();
    //     $total = 0;
    //     foreach ($cart as $item) {
    //         $total += $item['quantity'] * $item['product_price'];
    //     }
    //     return $total;
    // }
    public function totalCart()
    {
        $cart = $this->getCartItems();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['product_price'];
        }

        // Echo the total as JSON response
        echo json_encode(['total' => $total]);
    }


    public function getAddress()
    {
        if (!isset($_SESSION['user_id'])) {
            return "No Address";
        }
        $userId = $_SESSION['user_id'];
        $address = $this->cart->getUserAddress($userId);
        if ($address !== null) {
            return $address;
        } else {
            return 'No Address';
        }
    }

    // public function updateAddress($address)
    // {
    //     $user_id = $_SESSION['user_id'];
    //     $success = $this->cart->updateAddressInDatabase($user_id, $address);
    //     echo json_encode(['success' => $success]);
    // }


    public function getCoupons()
    {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }
        $userId = $_SESSION['user_id'];
        return $this->cart->availableCoupons($userId);
    }

    // public function calculateTotalAfterCoupon($coupon)
    // {
    //     $total = $this->totalCart();

    //     if ($coupon) {
    //         $discount = $total * ($coupon / 100);
    //         $total -= $discount;
    //     }

    //     // total + shipping fee
    //     $total += 10;
    //     echo json_encode(['success' => true, 'newTotal' => $total]);
    // }
    

    public function saveTotal($total)
    {
        $user_id = $_SESSION['user_id'];
        $success = $this->cart->saveTotalInDatabase($user_id, $total);
        echo json_encode(['success' => $success]);
    }
}
