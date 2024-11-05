<?php
session_start();

require_once 'header.php';
require_once '../controllers/UserProfileController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit();
}

$userId = $_SESSION['user_id'];
$profileController = new UserProfileController();
$user = $profileController->showProfile($userId);
$orderController = new OrderController();
$orders = $orderController->showUserOrders($userId);

?>

<div class="container py-5">
    <div class="row">
        <!-- Left Column: Avatar and User Details -->
        <div class="col-md-4">
            <div class="card text-center p-3 border border-secondary shadow" style="background-color: #fafafa">
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
                    <div id="passwordFields" class="input-group input-group-sm mb-3"
                        style="display: none; margin-top: 15px;">
                        <form method="POST" action="../controllers/UserProfileController.php?action=changePassword"
                            onsubmit="return validatePasswordForm()">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control form-control-sm" name="new_password"
                                    placeholder=" New Password:" required>
                                <span id="newPasswordError" style="display: none; color: #FF0000;"></span>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control form-control-sm" name="confirm_password"
                                    placeholder=" Confirm Password:" required>
                                <span id="confirmPasswordError" style="display: none; color: #FF0000;"></span>
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-1 p-2">Save New Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Order Information -->
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Order Information</h6>
                </div>
                <div class="card-body">
                    <?php if ($orders && count($orders) > 0): ?>
                    <?php foreach ($orders as $order): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="../images/<?php echo !empty($order['item_image']) ? htmlspecialchars($order['item_image']) : 'box_image.jpg'; ?>"
                                    class="img-fluid rounded-start" alt="Item Image" style="height:100px; padding-top:10px">
                                   
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <!-- <h3>Order ID: <?= htmlspecialchars($order['order_id']) ?></h3> -->
                                    <p>Order Date: <?= htmlspecialchars($order['order_date']) ?></p>
                                    <p>Order Total: $<?= htmlspecialchars($order['order_total']) ?></p>
                                    <p>Order Status: <?= htmlspecialchars($order['order_status']) ?></p>
                                    <p>Product Name: <?= htmlspecialchars($order['product_name']) ?></p>
                                    <p>Description: <?= htmlspecialchars($order['product_description']) ?></p>
                                    <p>Price: $<?= htmlspecialchars($order['product_price']) ?></p>
                                    <p>Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                    <hr>

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
        <div class="modal-content" style="background-color: #fafafa">
            <form method="POST" action="../controllers/UserProfileController.php?action=updateProfile"
                onsubmit="return validateEditProfileForm()">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body p-2">
                    <div class="mb-2">
                        <label for="user_first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control form-control-sm" id="user_first_name"
                            name="user_first_name" value="<?php echo htmlspecialchars($user['user_first_name']); ?>"
                            required>
                    </div>
                    <div class="mb-2">

                        <label for="user_last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control form-control-sm" id="user_last_name"
                            name="user_last_name" value="<?php echo htmlspecialchars($user['user_last_name']); ?>"
                            required>
                    </div>
                    <div class="mb-2">

                        <label for="user_email" class="form-label">Email:</label>
                        <input type="email" class="form-control form-control-sm" id="user_email" name="user_email"
                            value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
                        <span id="emailError" style="display: none;color: #FF0000;"></span>
                    </div>
                    <div class="mb-2">
                        <!-- Reduce margin bottom here -->
                        <label for="user_phone_number" class="form-label">Phone:</label>
                        <input type="text" class="form-control form-control-sm" id="user_phone_number"
                            name="user_phone_number" value="<?php echo htmlspecialchars($user['user_phone_number']); ?>"
                            required>
                        <span id="phoneError" style="display: none;color: #FF0000;"></span>
                    </div>
                    <div class="mb-2">
                        <!-- Reduce margin bottom here -->
                        <label for="user_address" class="form-label">Address:</label>
                        <input type="text" class="form-control form-control-sm" id="user_address" name="user_address"
                            value="<?php echo htmlspecialchars($user['user_address_line_one']); ?>" required>
                    </div>
                </div>
                <div class="modal-footer gap-2 d-md-flex ">

                    <button type="submit" class="btn btn-outline-primary  w-100 h-25">Save Changes</button>
                    <button type="button" class="btn btn-outline-secondary  w-100 h-25"
                        data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>




<script>
// Validate password change form
function validatePasswordForm() {
    const newPassword = document.querySelector('input[name="new_password"]').value;
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const newPasswordError = document.getElementById("newPasswordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    newPasswordError.style.display = "none";
    confirmPasswordError.style.display = "none";

    let isValid = true;

    if (!passwordRegex.test(newPassword)) {
        newPasswordError.textContent =
            "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        newPasswordError.style.display = "block";
        isValid = false;
    }
    if (newPassword !== confirmPassword) {
        confirmPasswordError.textContent = "Passwords do not match.";
        confirmPasswordError.style.display = "block";
        isValid = false;
    }
    return isValid;
}

// Validate edit profile form
function validateEditProfileForm() {
    const phoneNumber = document.getElementById('user_phone_number').value;
    const email = document.getElementById('user_email').value;

    const phoneRegex = /^(07\d{1}[789]\d{8}|07\d{8}|(\+?254)?\d{10})$/; // 10 or 14 digits
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email validation

    let valid = true;

    if (!phoneRegex.test(phoneNumber)) {
        document.getElementById('phoneError').textContent = "Invalid phone number format.";
        document.getElementById('phoneError').style.display = "block";
        valid = false;
    } else {
        document.getElementById('phoneError').style.display = "none";
    }

    if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = "Invalid email format.";
        document.getElementById('emailError').style.display = "block";
        valid = false;
    } else {
        document.getElementById('emailError').style.display = "none";
    }

    return valid;
}

function togglePasswordFields() {
    const passwordFields = document.getElementById("passwordFields");
    passwordFields.style.display = passwordFields.style.display === "none" ? "block" : "none";
}
</script>

<?php require_once 'footer.php'; ?>