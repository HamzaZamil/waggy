<?php
require_once '../includes/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['coupon'])) {
        $selectedCoupon = strtoupper(htmlspecialchars($_POST['coupon'], ENT_QUOTES, 'UTF-8'));
        $controller1 = new CartController();
        $checkCoupon = $controller1->checkCoupon($selectedCoupon);

        if ($checkCoupon) {
            $couponDiscount = $controller1->calculateDiscount($checkCoupon);

            header("Content-Type: application/json");
            echo json_encode(['success' => true, 'discount' => $couponDiscount]);
            exit(); 
        } else {
            header("Content-Type: application/json");
            echo json_encode(['success' => false, 'message' => 'Coupon not valid']);
        }
    } else {
        echo "No item selected.";
    }
}
