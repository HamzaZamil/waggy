<?php
require_once '../includes/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['couponSelect'])) {
        $selectedCoupon = $_POST['couponSelect'];
        $controller1 = new CartController();
        $totalAfterCoupon = $controller1->calculateTotalAfterCoupon($selectedCoupon);

        // Redirect to cart.php with total as a query parameter
        header("Location: ../views/cart.php?total=" . urlencode($totalAfterCoupon));
        exit();
    } else {
        echo "No item selected.";
    }
}
