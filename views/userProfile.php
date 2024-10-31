<?php

session_start(); // Start session at the very beginning

require_once 'header.php';
require_once '../controllers/UserProfileController.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login_register.php");
    exit();
}

$userId = $_SESSION['user_id'];
$profileController = new UserProfileController();
$user = $profileController->showProfile($userId);
?>





<div class="container py-5">
    <div class="row">
        <!-- Left Column: Avatar and User Details -->
        <div class="col-md-4">
            <div class="card text-center p-3">
                <div class="card-body">
                    <img src="<?php echo $user['user_gender'] === 'Male' ? '../images/male.png' : '../images/female.png'; ?>"
                        class="img-fluid rounded-circle avatar mb-3" alt="User-Profile-Avatar" style="width: 120px;">
                    <h5 class="card-title">
                        <?php echo htmlspecialchars($user['user_first_name'] . ' ' . $user['user_last_name']); ?>
                    </h5>
                    <h5 class="card-title text-muted">
                        <?php echo htmlspecialchars($user['user_email']); ?>
                    </h5>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="button" class="btn btn-outline-primary mt-1 p-2" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                        </button>

                        <button type="button" class="btn btn-outline-primary mt-1 p-2" onclick="togglePasswordFields()">
                            Edit Password
                        </button>
                    </div>
                    <div id="passwordFields" style="display: none; margin-top: 15px;">
                        <form method="POST" action="../controllers/UserProfileController.php?action=changePassword">
                            <div class="mb-3">
                                <label for="new_password" class="input-group-text">New Password:</label>
                                <input type="password" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="input-group-text">Confirm Password:</label>
                                <input type="password" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save New Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Profile Details -->
        <div class="col-md-8">
            <!-- User Information -->
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Order Information</h6>
                </div>
                <div class="card-body">
                    <?php if ($orders): ?>
                    <?php foreach ($orders as $order): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="<?php echo htmlspecialchars($order['item_image']); ?>"
                                    class="img-fluid rounded-start" alt="Item Image">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($order['item_name']); ?></h5>
                                    <p class="card-text">Order Date:
                                        <?php echo htmlspecialchars($order['order_date']); ?></p>
                                    <p class="card-text">Coupon Count:
                                        <?php echo htmlspecialchars($order['coupon_id']); ?></p>
                                    <p class="card-text">Order Total:
                                        <?php echo htmlspecialchars($order['order_total']); ?></p>
                                    <p class="card-text">Status: <?php echo htmlspecialchars($order['order_status']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="text-muted">No orders found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="../controllers/UserProfileController.php?action=updateProfile">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="user_first_name" name="user_first_name"
                            value="<?php echo htmlspecialchars($user['user_first_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="user_last_name" name="user_last_name"
                            value="<?php echo htmlspecialchars($user['user_last_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="user_email" name="user_email"
                            value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_phone_number" class="form-label">Phone:</label>
                        <input type="text" class="form-control" id="user_phone_number" name="user_phone_number"
                            value="<?php echo htmlspecialchars($user['user_phone_number']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="user_address" name="user_address"
                            value="<?php echo htmlspecialchars($user['user_address_line_one']); ?>" required>
                    </div>
                </div>
                <div class=" d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-secondary me-md-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary me-md-2">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>