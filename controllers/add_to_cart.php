<?php
require_once '../includes/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $cartController = new CartController();
    $response = $cartController->addToCart($productId, $quantity);

    // Send the response back to AJAX as JSON
    echo json_encode($response);
}
