<?php
session_start();
include("includes/header.php");
include "model/Orders.php";
$orders=new Order();
$allOrders=$orders->getAllOrders();

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>
html {
    overflow: hidden !important;
}

.cart-wrap {
    padding: 40px 0;
    font-family: 'Open Sans', sans-serif;
}

label {
    margin-left: 10px;
    margin-right: 10px;
}

.main-heading {
    font-size: 19px;
    margin-bottom: 20px;
}

.table-wishlist table {
    width: 100%;
}

.table-wishlist thead {
    border-bottom: 1px solid #e5e5e5;
    margin-bottom: 5px;
}

.table-wishlist thead tr th {
    padding: 8px 0 18px;
    color: #484848;
    font-size: 15px;
    font-weight: 400;
}

.table-wishlist tr td {
    padding: 25px 0;
    vertical-align: middle;
}

.table-wishlist tr td .img-product {
    width: 72px;
    float: left;
    margin-left: 8px;
    margin-right: 31px;
    line-height: 63px;
}

.table-wishlist tr td .img-product img {
    width: 100%;
}

.table-wishlist tr td .name-product {
    font-size: 15px;
    color: #484848;
    padding-top: 8px;
    line-height: 24px;
    width: 50%;
}

.table-wishlist tr td.price {
    font-weight: 600;
}

.table-wishlist tr td .quanlity {
    position: relative;
}

.total {
    font-size: 24px;
    font-weight: 600;
    color: #8660e9;
}

.display-flex {
    display: flex;
}

.align-center {
    align-items: center;
}

.round-black-btn {
    border-radius: 25px;
    background: #212529;
    color: #fff;
    padding: 5px 20px;
    display: inline-block;
    border: solid 2px #212529;
    transition: all 0.5s ease-in-out 0s;
    cursor: pointer;
    font-size: 14px;
}

.round-black-btn:hover,
.round-black-btn:focus {
    background: transparent;
    color: #212529;
    text-decoration: none;
}

.mb-10 {
    margin-bottom: 10px !important;
}

.mt-30 {
    margin-top: 30px !important;
}

.d-block {
    display: block;
}

.custom-form label {
    font-size: 14px;
    line-height: 14px;
}

.pretty.p-default {
    margin-bottom: 15px;
}

.pretty input:checked~.state.p-primary-o label:before,
.pretty.p-toggle .state.p-primary-o label:before {
    border-color: #8660e9;
}

.pretty.p-default:not(.p-fill) input:checked~.state.p-primary-o label:after {
    background-color: #8660e9 !important;
}

.main-heading.border-b {
    border-bottom: solid 1px #ededed;
    padding-bottom: 15px;
    margin-bottom: 20px !important;
}

.custom-form .pretty .state label {
    padding-left: 6px;
}

.custom-form .pretty .state label:before {
    top: 1px;
}

.custom-form .pretty .state label:after {
    top: 1px;
}

.custom-form .form-control {
    font-size: 14px;
    height: 38px;
}

.custom-form .form-control:focus {
    box-shadow: none;
}

.custom-form textarea.form-control {
    height: auto;
}

.mt-40 {
    margin-top: 40px !important;
}

.in-stock-box {
    background: #ff0000;
    font-size: 12px;
    text-align: center;
    border-radius: 25px;
    padding: 4px 15px;
    display: inline-block;
    color: #fff;
}

.trash-icon {
    font-size: 20px;
    color: #212529;
}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Orders dashboard</h1>

    <div class="row">
        <!-- <div class="pt-5 pb-3">
            <h2>Orders Table</h2>
        </div> -->
        <table class="responsive-table" id="myTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Order Date</th>
                    <th>order total</th>
                    <th>order coupon</th>
                    <th>Discount</th>
                    <th>Order Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if $allOrders is defined and not empty
                if (!empty($allOrders)) {
                    foreach ($allOrders as $order) {
                        echo "<tr id='order-row-{$order['order_id']}'>
                                <td data-label='order ID'>{$order['order_id']}</td>
                                <td data-label='order user_name'>{$order['user_name']}</td>
                                <td data-label='order first Name'>{$order['order_date']}</td>
                                <td data-label='order total'>{$order['order_total']}</td>
                                <td data-label='order coupon'>{$order['order_coupon']}</td>
                                <td data-label='order discount'>{$order['order_discount']} %</td>
                                <td data-label='order status'>{$order['order_status']}</td>
                                <td>
                                    <button class='edit-btn' style = 'style=background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;' onclick='openOrderModal(
                                        \"{$order['order_id']}\",
                                        \"{$order['user_name']}\",
                                        \"{$order['order_date']}\",
                                        \"{$order['order_total']}\",
                                        \"{$order['order_status']}\",
                                        \"{$order['order_discount']}\"
                                    )'>View order</button>
                                    
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal"
        style="display: none; justify-content: center; align-items: center; overflow: scroll;   ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="modal-content col-md-6 mx-auto mt-4"
                    style="text-align: center; overflow-y: auto; max-height: 90vh;">
                    <button class="close-btn" style="background:#db4f4f;" onclick="closeEditModal()">X</button>
                    <h3>Order Details</h3>
                    <?php
                        // Fetch order details for the given order ID
                        // Replace with the actual $orderId you are using
                        $orderDetails =$orders->viewOrderDetails($order['order_id']);
                        if ($orderDetails !== false && count($orderDetails) > 0) {
                            $grandTotal = 0;  // Initialize grand total for the order
                            ?>

                    <!-- Dynamic Order Items Table -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Items from Order #<?php echo $order ['order_id']; ?></h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                        // Loop through each order item and display it
                        foreach ($orderDetails as $item) {
                            // Calculate total for each item (price * quantity)
                            $itemTotal = $item['price'] * $item['product_quantity'];
                            $grandTotal += $itemTotal;  // Add item total to grand total
                            ?>
                                            <tr>
                                                <td><?php echo $item['product_name']; ?></td>
                                                <td><?php echo $item['product_quantity']; ?></td>
                                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                                <td>$<?php echo number_format($itemTotal, 2); ?></td>
                                            </tr>
                                            <?php
                        }
                        ?>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Order Summary Table -->


                    <?php
} else {
    echo "<p>No items found for this order.</p>";
}
?>

                </div>
            </div>

            <!-- End of Content Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="js/modal.js"></script>
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/sb-admin-2.min.js"></script>
            <script src="js/modal.js"></script>

            <script>
            function closeEditModal() {
                document.getElementById('viewModal').style.display = "none";
            }

            function openOrderModal() {
                // document.getElementById('orderId').value = orderId;
                // document.getElementById('userName').value = userName;
                // document.getElementById('orderDate').value = orderDate;
                // document.getElementById('orderPrice').value = orderPrice;
                // document.getElementById('orderStatus').value = orderStatus;
                // document.getElementById('discount').value = discount;
                document.getElementById('viewModal').style.display = "block";
            }
            </script>
            </script>
            <!-- Bootstrap core JavaScript-->
            <script src="https://code.jquery.com/jquery-3.7.1.js"
                integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
            <script>
            let table = new DataTable('#myTable', {
                // options
            });
            </script>

            </body>

            </html>