<?php
session_start();
include 'header.php';
require_once '../controllers/UserProfileController.php';

// Check if user is logged in
// if (isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

?>

<!-- Add SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<section id="auth" class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center display-3 fw-normal mb-4">Login</h2>

                <?php if (isset($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                    </div>
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
                <p style="font-weight: bolder; margin-top:20px">Don't have an account? <a href="register.php" style="color:#AB886D; text-decoration: underline;">Signup</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../js/formValidation.js"></script>
<?php include 'footer.php'; ?>
