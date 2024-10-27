<?php
require_once 'model/Coupon.php';

$couponModel = new Coupon();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add_coupon') {
        // Adding a new coupon
        $discount = $_POST['coupon_discount'];
        $expiry_date = $_POST['coupon_expiry_date'];
        $status = $_POST['coupon_status'];

        $success = $couponModel->addCoupon($discount, $expiry_date, $status);

        if ($success) {
            header("Location: coupon.php"); // Redirect to the main coupon page
            exit();
        } else {
            echo "Failed to add coupon.";
        }
    } elseif ($_POST['action'] === 'edit_coupon') {
        // Editing an existing coupon
        $id = $_POST['coupon_id'];
        $discount = $_POST['coupon_discount'];
        $expiry_date = $_POST['coupon_expiry_date'];
        $status = $_POST['coupon_status'];

        $success = $couponModel->updateCoupon($id, $discount, $expiry_date, $status);

        if ($success) {
            header("Location: coupon.php"); // Redirect to the main coupon page
            exit();
        } else {
            echo "Failed to update coupon.";
        }
    } elseif ($_POST['action'] === 'delete_coupon') {
        // Deleting a coupon (soft delete)
        $id = $_POST['coupon_id'];
        
        $success = $couponModel->deleteCoupon($id);
        
        if ($success) {
            header("Location: coupon.php"); // Redirect to the main coupon page
            exit();
        } else {
            echo "Failed to delete coupon.";
        }
    }
}


?>