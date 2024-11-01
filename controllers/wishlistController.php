<?php
if (!class_exists('Wishlist')) {
    include_once '../model/wishlist.class.php';
}

class WishlistController
{
    private $wishlistModel;

    public function __construct()
    {
        $this->wishlistModel = new Wishlist(); // Instantiate the Wishlist model
    }

    public function handleWishlist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $productId = $_POST['product_id'];
            switch ($_POST['action']) {
                case 'add':
                    $this->addToWishlist($productId);
                    break;
                case 'remove':
                    $this->removeFromWishlist($productId);
                    break;
            }
        }
    }

    private function addToWishlist($productId)
    {
        if (isset($_SESSION['user_id'])) {
            $this->wishlistModel->addItemToWishlist($productId, $_SESSION['user_id']);
            // Redirect back to the referring page after processing the request
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $this->addToCookies($productId);
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    private function removeFromWishlist($productId)
    {
        if (isset($_SESSION['user_id'])) {
            $this->wishlistModel->removeItemFromWishlist($productId, $_SESSION['user_id']);
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $this->removeFromCookies($productId);
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    private function addToCookies($productId)
    {
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], true) : [];
        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            setcookie('wishlist', json_encode($wishlist), time() + (86400 * 30), "/"); // 30 days expiration
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    private function removeFromCookies($productId)
    {
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], true) : [];
        if (($key = array_search($productId, $wishlist)) !== false) {
            unset($wishlist[$key]);
            setcookie('wishlist', json_encode($wishlist), time() + (86400 * 30), "/"); // Update cookie
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function getWishlistItemsForDisplay()
    {
        if (isset($_SESSION['user_id'])) {
            return $this->wishlistModel->getWishlistItems($_SESSION['user_id']); // Fetch from DB if logged in
        } else {
            $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], true) : [];
            return $this->getItemsFromCookie($wishlist);
        }
    }

    private function getItemsFromCookie($wishlist)
    {
        if (!empty($wishlist)) {
            $items = [];
            foreach ($wishlist as $productId) {
                $items[] = $this->wishlistModel->getProductById($productId);
            }
            return $items;
        }
        return [];
    }

    public function isInWishlist($productId)
    {
        if (isset($_SESSION['user_id'])) {
            return $this->wishlistModel->isInWishlist($_SESSION['user_id'], $productId); // Check in DB
        } else {
            // If user is not logged in, check in cookies
            $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], true) : [];
            return in_array($productId, $wishlist); // Returns true if product is found in the cookie
        }
    }
}

// Create an instance of WishlistController and handle the request
$wishlistController = new WishlistController();
$wishlistController->handleWishlist();