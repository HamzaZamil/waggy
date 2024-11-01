<?php
session_start();

include 'header.php';
require_once '../controllers/UserProfileController.php';

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $profileController = new UserProfileController();
    $user = $profileController->showProfile($userId);  
}
?>

<!-- Add SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<section id="auth" class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center display-3 fw-normal mb-4">Account</h2>

                <ul class="nav nav-pills mb-3 justify-content-center" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login"
                            type="button" role="tab">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register"
                            type="button" role="tab">Register</button>
                    </li>
                </ul>

                <div class="tab-content" id="authTabContent">
                    <!-- Login Form -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <?php if (isset($_SESSION['userid'])) {
                            header("Location: userProfile.php");
                            exit();
                        } ?>
                        <?php if (isset($_SESSION['login_error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['login_error']; ?>
                        </div>
                        <?php unset($_SESSION['login_error']); ?>
                        <?php endif; ?>

                        <form action="../controllers/UserController.php" method="POST" class="p-4 border rounded-2">
                            <div class="mb-3">
                                <label for="login-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="login-email" name="email"
                                    placeholder="Your Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="login-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="login-password" name="password"
                                    placeholder="Your Password" required>
                            </div>

                            <button type="submit" name="login"
                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                                Login
                            </button>
                        </form>

                        <!-- Reset Password Link -->
                        <div class="mt-1 text-center">
                            <a href="reset_password.php" class="text-decoration-none" style="color: green;"> Forgot your password? </a>
                        </div>
                    </div>
                    <!-- Register Form -->
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        <form action="../controllers/UserController.php" method="POST" id="reg_form"
                            class="p-4 border rounded-2 testimonial-card">
                            <!-- First Name and Last Name side-by-side -->
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 me-2 w-50">
                                    <label for="register-fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="register-fname" name="fname"
                                        placeholder="First Name" required>
                                    <span id="errorFName" class="error"></span>
                                </div>
                                <div class="mb-3 ms-2 w-50">
                                    <label for="register-lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="register-lname" name="lname"
                                        placeholder="Last Name" required>
                                    <span id="errorLName" class="error"></span>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="register-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="register-email" name="email"
                                    placeholder="Your Email" required>
                                <span id="errorEmail" class="error"></span>
                            </div>

                            <!-- Password and Confirm Password -->
                            <div class="mb-3">
                                <label for="register-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="register-password" name="password"
                                    placeholder="Your Password" required>
                                <span id="errorPassword" class="error"></span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    name="confirm_password" placeholder="Confirm Password" required>
                                <span id="errorCheckPassword" class="error"></span>
                            </div>

                            <!-- Gender and DOB side-by-side -->
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 me-2 w-50">
                                    <label for="gender" class="form-label">Your Gender</label>
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="mb-3 ms-2 w-50">
                                    <label for="DOB" class="form-label">Your Birth Date</label>
                                    <input type="date" class="form-control" id="DOB" name="DOB" required>
                                    <span id="errorDOB" class="error"></span>
                                </div>
                            </div>

                            <!-- Mobile and Address -->
                            <div class="mb-3">
                                <label for="register-mobile" class="form-label">Mobile</label>
                                <input type="tel" class="form-control" id="register-mobile" name="mobile"
                                    placeholder="Your Mobile Number" required>
                                <span id="errorMobile" class="error"></span>
                            </div>
                            <div class="mb-3">
                                <label for="register-address" class="form-label">Your Address</label>
                                <input type="text" class="form-control" id="register-address" name="address" required>
                                <span id="errorAddress" class="error"></span>
                            </div>

                            <!-- Register Button -->
                            <button type="submit" id="registerBtn"  name="register"
                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">Register</button>
                        </form>
                    </div>

<style>
    /* Testimonial theme styling */
    .testimonial-card {
        background-color: #f8f9fa;
        /* Replace with testimonial background color */
        max-width: 900px;
        /* Increased width for the form */
        margin: auto;
    }

    /* Form adjustments */
    .error {
        color: #CC0000;
        /* Match the color with the first and last name label */
        font-size: 12px;
    }

    .d-flex>.mb-3 {
        flex: 1;
    }
</style>

<?php
// Check for registration success
if (isset($_SESSION['registration_success'])) {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "' . $_SESSION['registration_success'] . '",
            confirmButtonText: "OK"
        });
    </script>';
    unset($_SESSION['registration_success']); 
}

// Check for registration error
if (isset($_SESSION['registration_error'])) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: "' . $_SESSION['registration_error'] . '",
            confirmButtonText: "OK"
        });
    </script>';
    unset($_SESSION['registration_error']); 
}
?>
                </div>
            </div>
        </div>
</section>

<script src="../js/formValidation.js"></script>
<?php include 'footer.php'; ?>
