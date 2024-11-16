<?php
session_start();
include("includes/header.php");
include "model/Orders.php";
$orders = new Order();
$allOrders = $orders->getAllOrders();
?>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<style>
  .save-btn-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .modal-content {
    width: 30%;
  }
</style>
</head>

    
    <!-- Container fluid  -->
    <div class="container-fluid">
        <h2 class="h2">Orders Dashboard</h2>
        <div class="row">
            <table class="table table-hover" id="ordersTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Order Date</th>
                        <th>Order Total</th>
                        <th>Order Coupon</th>
                        <th>Discount</th>
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($allOrders)): ?>
                        <?php foreach ($allOrders as $order): ?>
                            <tr id="order-row-<?php echo htmlspecialchars($order['order_id']); ?>">
                                <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_total']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_coupon']); ?></td>
                                <td><?php echo htmlspecialchars($order['order_discount']); ?>%</td>
                                <td id="status-<?php echo htmlspecialchars($order['order_id']); ?>">
                                    <?php echo htmlspecialchars($order['order_status']); ?>
                                </td>
                                <td>
                                    <button class="btn btn-dark" style="background:#000;" onclick="openOrderModal(
                                        '<?php echo htmlspecialchars($order['order_id']); ?>',
                                        '<?php echo htmlspecialchars($order['user_name']); ?>',
                                        '<?php echo htmlspecialchars($order['order_date']); ?>',
                                        '<?php echo htmlspecialchars($order['order_total']); ?>',
                                        '<?php echo htmlspecialchars($order['order_status']); ?>',
                                        '<?php echo htmlspecialchars($order['order_discount']); ?>'
                                    )">View</button>
                                    <button class="btn btn-danger" onclick="openEditStatusModal(
                                        '<?php echo htmlspecialchars($order['order_id']); ?>',
                                        '<?php echo htmlspecialchars($order['order_status']); ?>'
                                    )">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeEditModal()">X</button>
            <h3>Order Details</h3>
            <div>
                <p><strong>Order ID:</strong> <span id="modalOrderId"></span></p>
                <p><strong>User Name:</strong> <span id="modalUserName"></span></p>
                <p><strong>Order Date:</strong> <span id="modalOrderDate"></span></p>
                <p><strong>Order Total:</strong> <span id="modalOrderTotal"></span></p>
                <p><strong>Order Status:</strong> <span id="modalOrderStatus"></span></p>
                <p><strong>Order Discount:</strong> <span id="modalOrderDiscount"></span></p>
            </div>
            <button class="close-btn" onclick="closeEditModal()">Close</button>
        </div>
    </div>

    <!-- Edit Status Modal -->
    <div class="modal" id="editStatusModal" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeEditStatusModal()">X</button>
            <h3>Edit Order Status</h3>
            <form id="editStatusForm">
                <input type="hidden" id="editOrderId" name="order_id">
                <label for="orderStatus">Order Status:</label>
                <select id="editOrderStatus" name="order_status">
                    <option value="Pending">Pending</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Delivered">Delivered</option>
                </select>
                <div class="save-btn-container">
                    <button type="submit" class="btn btn-primary" style="background:#000;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openOrderModal(orderId, userName, orderDate, orderTotal, orderStatus, orderDiscount) {
        document.getElementById("modalOrderId").textContent = orderId;
        document.getElementById("modalUserName").textContent = userName;
        document.getElementById("modalOrderDate").textContent = orderDate;
        document.getElementById("modalOrderTotal").textContent = "$" + orderTotal;
        document.getElementById("modalOrderStatus").textContent = orderStatus;
        document.getElementById("modalOrderDiscount").textContent = orderDiscount + "%";
        document.getElementById("viewModal").style.display = 'flex';
    }

    function openEditStatusModal(orderId, currentStatus) {
        document.getElementById('editOrderId').value = orderId;
        document.getElementById('editOrderStatus').value = currentStatus;
        document.getElementById('editStatusModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('viewModal').style.display = 'none';
    }

    function closeEditStatusModal() {
        document.getElementById('editStatusModal').style.display = 'none';
    }

    document.getElementById('editStatusForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch('update_order_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const orderId = formData.get('order_id');
            const newStatus = formData.get('order_status');
            closeEditStatusModal();

            if (data.success) {
                document.getElementById('status-' + orderId).textContent = newStatus;
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Order status updated successfully.',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to update order status.',
                    confirmButtonText: 'Try Again'
                });
            }
        })
        .catch(error => {
            closeEditStatusModal();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while updating order status.',
                confirmButtonText: 'OK'
            });
        });
    });
</script>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable();
    });
</script>
<script src="js/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
