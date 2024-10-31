<?php
session_start();

include 'header.php';
require_once '../controllers/UserProfileController.php';



if (isset($_SESSION['user_id'])) {
  
    $userId = $_SESSION['user_id'];
    $profileController = new UserProfileController();
     $user = $profileController->showProfile($userId);  
}else{

    // echo "<p>You are not logged in.</p>";
}

    

?>

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
                            }
                            ?>
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
                        <form action="../controllers/UserController.php" method="POST" class="p-4 border rounded-2">
                            <div class="mb-3">
                                <label for="register-fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="register-fname" name="fname"
                                    placeholder="First Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="register-lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="register-lname" name="lname"
                                    placeholder="Last Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="register-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="register-email" name="email"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="register-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="register-password" name="password"
                                    placeholder="Your Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Your Gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="DOB" class="form-label">Your Birth Date</label>
                                <input type="date" class="form-control" id="DOB" name="DOB"
                                    placeholder="Your Birth Date" required>
                            </div>
                            <div class="mb-3">
                                <label for="register-mobile" class="form-label">Mobile</label>
                                <input type="tel" class="form-control" id="register-mobile" name="mobile"
                                    placeholder="Your Mobile Number" required>
                            </div>
                            <div class="mb-3">
                                <label for="register-address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="register-address" name="address"
                                    placeholder="Your Address" required>
                            </div>
                            <button type="submit" name="register"
                                class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                                Register
                            </button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function() {

<<<<<<< HEAD
<?php include 'footer.php'; ?>
=======
    const emailField = document.getElementById("register-email");
    const passwordField = document.getElementById("register-password");
    const confirmPasswordField = document.getElementById("confirm-password");
    const dobField = document.getElementById("DOB");
    const phoneField = document.getElementById("register-mobile");

    // email validation
    function validateEmail() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            emailField.classList.add("is-invalid");
            echo "Invalid Email";
        } else {
            emailField.classList.remove("is-invalid");
        }
    }
    // pass validation
    function validatePassword() {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
        if (!passwordRegex.test(passwordField.value)) {
            passwordField.classList.add("is-invalid");
            echo "Invalid Password";
        } else {
            passwordField.classList.remove("is-invalid");
        }
    }
    // conf-pass validation
    function validateConfirmPassword() {
        if (confirmPasswordField.value !== passwordField.value) {
            confirmPasswordField.classList.add("is-invalid");
            echo "Passwords Dont Match";
        } else {
            confirmPasswordField.classList.remove("is-invalid");
        }
    }
    // dob validation
    function validateDOB() {
        const selectedDate = new Date(dobField.value);
        const today = new Date();
        if (selectedDate >= today) {
            dobField.classList.add("is-invalid");

        } else {
            dobField.classList.remove("is-invalid");
        }
    }
    // phone validation
    function validatePhone() {
        const phoneRegex = /^07[7-9]\d{7}$/;
        if (!phoneRegex.test(phoneField.value)) {
            phoneField.classList.add("is-invalid");
            echo "Invalid Phone number";
        } else {
            phoneField.classList.remove("is-invalid");
        }
    }


    emailField.addEventListener("change", validateEmail);
    passwordField.addEventListener("change", validatePassword);
    confirmPasswordField.addEventListener("change", validateConfirmPassword);
    dobField.addEventListener("change", validateDOB);
    phoneField.addEventListener("change", validatePhone);
});
</script>
<?php include 'footer.php'; ?>
>>>>>>> 1ccd80a5513857c29818a397e01d43a0b8207236
