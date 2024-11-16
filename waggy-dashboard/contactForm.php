<?php
session_start();
include("includes/header.php");
include "model/contactUsClass.php";  // Include the messages model
$messages = new messages();
$allmessages = $messages->getAllMessages();
?>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

<style>
    .modal-content {
        width: 50%;
    }
</style>
</head>

<div class="page-wrapper">
  
    <div class="container-fluid">
        <!-- Start Page Content -->
        <h2 class="h2">Messages Dashboard</h2>
        <div >
            <table class="table tb table-hover" id="contactTable">
                <thead class="t-head">
                    <tr>
                        <th>Message ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($allmessages)): ?>
                        <?php foreach ($allmessages as $message): ?>
                            <tr id="message-row-<?php echo htmlspecialchars($message['id'] ?? ''); ?>">
                                <td data-label="Message ID"><?php echo htmlspecialchars($message['id'] ?? ''); ?></td>
                                <td data-label="User Name"><?php echo htmlspecialchars($message['name'] ?? ''); ?></td>
                                <td data-label="Email"><?php echo htmlspecialchars($message['email'] ?? ''); ?></td>
                               <td>
                                    <button class="edit-btn" 
                                            onclick="openMessageModal(
                                                '<?php echo htmlspecialchars($message['id'] ?? ''); ?>',
                                                '<?php echo htmlspecialchars($message['name'] ?? ''); ?>',
                                                '<?php echo htmlspecialchars($message['email'] ?? ''); ?>',
                                               
                                                '<?php echo htmlspecialchars($message['message'] ?? ''); ?>'
                                            )">
                                       <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No messages found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeMessageModal()">X</button>
            <h3>Message Details</h3>
            <div id="messageDetailsContainer">
                <p><strong>Sender:</strong> <span id="modalSender"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <!-- <p><strong>Subject:</strong> <span id="modalSubject"></span></p>
                <p><strong>Message:</strong><br> <span id="modalMessage"></span></p> -->
            </div>
            <button class="close-btn" onclick="closeMessageModal()">Close</button>
        </div>
    </div>

    <script>
        function openMessageModal(contactUsId, sender, email, subject, message) {
            // Show the modal
            document.getElementById('viewModal').style.display = 'flex';

            // Populate modal fields with message details
            document.getElementById("modalSender").textContent = sender ?? '';
            document.getElementById("modalEmail").textContent = email ?? '';
            document.getElementById("modalSubject").textContent = subject ?? '';
            document.getElementById("modalMessage").textContent = message ?? '';
        }

        function closeMessageModal() {
            document.getElementById('viewModal').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('viewModal');
            if (event.target === modal) {
                closeMessageModal();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contactTable').DataTable();
    });
</script>
    <script src="js/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

</div>    


