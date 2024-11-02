<?php
session_start();
require_once '../controllers/cartController.php';

$cartController = new CartController();

// Ensure user is logged in
if (isset($_SESSION['user_id'])) {
    $orderPlaced = $cartController->placeOrder();

    if ($orderPlaced) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
}
