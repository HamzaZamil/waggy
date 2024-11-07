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

        case 'updateAddress':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->updateAddress($data['address']); // Method to update the address
            break;

        case 'getTotalCartValue':
            $controller->totalCart(true); // Method to get total cart value
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
            return ['success' => true];
        } else {
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

    public function totalCart($outputJson = false)
    {
        if (!isset($_SESSION['user_id'])) {
            $total = 0;
            return $total;
        }
        $user_id = $_SESSION['user_id'];
        $cart = $this->getCartItems();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['product_price'];
        }

        $total = number_format($total, 2);

        if ($outputJson) {
            // If this is an AJAX request, output JSON
            echo json_encode(['total' => $total]);
        } else {
            // Otherwise, return the total value for direct PHP usage
            return $total;
        }
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

    public function updateAddress($address)
    {
        $user_id = $_SESSION['user_id'];
        $success = $this->cart->updateAddressInDatabase($user_id, $address);
        echo json_encode(['success' => $success]);
    }

    public function checkCoupon($coupon_name)
    {
        $coupons = $this->getCoupons();
        foreach ($coupons as $coupon) {
            if ($coupon['coupon_name'] == $coupon_name) {
                return [
                    'coupon_name' => $coupon['coupon_name'],
                    'coupon_id' => $coupon['coupon_id'],
                    'coupon_discount' => $coupon['coupon_discount']
                ];
            }
        }
        return false;
    }


    public function getCoupons()
    {
        if (!isset($_SESSION['user_id'])) {
            return [];
        }
        $userId = $_SESSION['user_id'];
        return $this->cart->availableCoupons($userId);
    }

    public function calculateDiscount($coupon)
    {
        $user_id = $_SESSION['user_id'];
        $couponDiscount = $coupon['coupon_discount'];
        $couponId = $coupon['coupon_id'];

        // Get cart items and calculate total
        $cart = $this->getCartItems();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['product_price'];
        }

        $this->cart->updateCoupon($user_id, $couponId);
        $discount = $total * ($couponDiscount / 100);
        $total -= $discount;


        // Add a delivery fee
        $total += 5;
        return number_format($discount, 2);
    }

    public function placeOrder()
    {
        $total = $_SESSION['total_price'];
        $user_id = $_SESSION['user_id'];
        $update = $this->cart->updateTotal($user_id, $total);
        return $this->cart->placeOrder($user_id);
    }
}
