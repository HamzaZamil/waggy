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
      html 
    {
        overflow: hidden !important;
        
        overflow: scroll !important;
    
    
    }


/* ========================================================================
 * MESSAGES
 * ======================================================================== */
.message form {
  padding: 6px 15px;
  background-color: #FAFAFA;
  border-bottom: 1px solid #E6EBED;
}
.message form .has-icon .form-control-icon {
  position: absolute;
  z-index: 5;
  top: 0;
  right: 0;
  width: 34px;
  line-height: 33px;
  text-align: center;
  color: #777;
}
.message > a {
  position: relative;
}
.message .indicator {
  text-align: center;
}
.message .indicator .spinner {
  left: 26%;
  width: 200px;
  font-size: 13px;
  line-height: 17px;
  color: #999;
}

.message-wrapper {
  position: relative;
  padding: 0px;
  background-color: #ffffff;
  margin: 0px;
}
.message-wrapper .message-sideleft {
  vertical-align: top !important;
}
.message-wrapper .message-sideleft[class*="col-"] {
  padding-right: 0px;
  padding-left: 0px;
}
.message-wrapper .message-sideright {
  background-color: #f8f8f8;
}
.message-wrapper .message-sideright[class*="col-"] {
  padding: 30px;
}
.message-wrapper .message-sideright .panel {
  border-top: 1px dotted #DDD;
  padding-top: 20px;
}
.message-wrapper .message-sideright .panel:first-child {
  border-top: none;
  padding-top: 0px;
}
.message-wrapper .message-sideright .panel .panel-heading {
  border-bottom: none;
}
.message-wrapper .panel {
  background-color: transparent !important;
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
}
.message-wrapper .panel .panel-heading, .message-wrapper .panel .panel-body {
  background-color: transparent !important;
}
.message-wrapper .media .media-body {
  font-weight: 300;
}
.message-wrapper .media .media-heading {
  margin-bottom: 0px;
}
.message-wrapper .media small {
  color: #999999;
  font-weight: 400;
}

.list-message .list-group-item {
  padding: 15px;
  color: #999999 !important;
  border-right: 3px solid #8CC152 !important;
}
.list-message .list-group-item.active {
  background-color: #EEEEEE;
  border-bottom: 1px solid #DDD !important;
}
.list-message .list-group-item.active p {
  color: #999999 !important;
}
.list-message .list-group-item.active:hover, .list-message .list-group-item.active:focus, .list-message .list-group-item.active:active {
  background-color: #EEEEEE;
}
.list-message .list-group-item small {
  font-size: 12px;
}
.list-message .list-group-item .list-group-item-heading {
  color: #999999 !important;
}
.list-message .list-group-item .list-group-item-text {
  margin-bottom: 10px;
}
.list-message .list-group-item:last-child {
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
  border-bottom: 1px solid #DDD !important;
}
.avatar{
    width:50px;
    height:50px;
}
.modal {
    display: none; /* Hidden by default, will be shown with JavaScript */
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    width: 90%; /* Responsive width */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}
</style>


<h1 class="h3 mb-4 text-gray-800 ">Contact Form</h1>
<div class="container-fluid">

    <div class="row justify-content-center w-100">
        <table class="table" id="myTable">
            <thead>
            <tr>
                <th>Message Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($allOrders)) {
                    foreach ($allOrders as $order) {
                        echo "<tr id='order-row-{$order['order_id']}'>
                                <td data-label='order ID'>{$order['order_id']}</td>
                                <td data-label='order user_name'>{$order['user_name']}</td>
                                <td data-label='order first Name'>{$order['order_date']}</td>
                                <td>
                                    <button class='edit-btn' onclick='openOrderModal(
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
                    echo "<tr><td colspan='4'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
<div class="modal" id="viewModal">
    <div class="modal-content">
        <button class="close-btn" onclick="closeEditModal()">X</button>
        <h4>Rebecca Cabean</h4>
        <p>Email:</p>
        <hr>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <br>
        <p>Thanks! <br>Rebecca.</p>
    </div>
</div>


<!-- End of Content Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
             <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
            <script>
            let table = new DataTable('#myTable', {
    // options
});
</script>
<script>

function closeEditModal() {
    document.getElementById('viewModal').style.display = "none";
}

function openOrderModal() {
    document.getElementById('viewModal').style.display = "flex";
}


</script>

</body>

</html>
