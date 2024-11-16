<?php
session_start();
include 'header.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $profileController = new UserProfileController();
    $user = $profileController->showProfile($userId);  
}
?>

<!-- Add SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<section id="auth" class="my-5 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center display-3 fw-normal mb-4">Register</h2>

                <form action="../controllers/UserController.php" method="POST" id="reg_form"
                    class="p-4 border rounded-2 testimonial-card">
                    <!-- First Name and Last Name side-by-side -->
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 me-2 w-50">
                            <label for="register-fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="register-fname" name="fname"
                                placeholder="First Name" required>
                        </div>
                        <div class="mb-3 ms-2 w-50">
                            <label for="register-lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="register-lname" name="lname"
                                placeholder="Last Name" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="register-email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="register-email" name="email"
                            placeholder="Your Email" required>
                    </div>

                    <!-- Password and Confirm Password -->
                    <div class="mb-3">
                        <label for="register-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="register-password" name="password"
                            placeholder="Your Password" required oninput="validatePassword()">
                        <span id="password-error" class="error-message"></span> <!-- Error message will display here -->
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password"
                            placeholder="Confirm Password" required oninput="checkPasswordMatch()">
                        <span id="confirm-password-error" class="error-message"></span>
                        <!-- Error message will display here -->
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
                            <input type="date" class="form-control" id="DOB" name="DOB" oninput="validateDOB()"
                                required>
                            <span id="errorDOB" class="error-message" style="color: red;"></span>
                        </div>
                    </div>

                    <!-- Mobile and Address -->
                    <div class="mb-3">
                        <label for="register-mobile" class="form-label">Mobile</label>
                        <input type="tel" class="form-control" id="register-mobile" name="mobile"
                            placeholder="Your Mobile Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-address" class="form-label">Your Address</label>
                        <input type="text" class="form-control" id="register-address" name="address"
                            placeholder="Your Address" required>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" id="registerBtn" name="register"
                        class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">Register</button>

                </form>
                <div class="mt-1 text-center">
                    <p style="font-weight: bolder; margin-top:20px">Already have an account? <a href="login.php"
                            style="color:#AB886D; text-decoration: underline;">Login</a></p>
                </div>

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

<script>
function validateDOB() {
    const dobInput = document.getElementById("DOB");
    const dobError = document.getElementById("errorDOB");
    const dobValue = dobInput.value;

    // Clear any previous error messages
    dobError.innerText = "";

    // Check if the date of birth field is empty
    if (dobValue === "") {
        dobError.innerText = "Date of birth is required.";
        dobError.style.color = "red";
        dobInput.classList.add('is-invalid');
        dobInput.focus();
        return false;
    }

    // Get the date selected by the user and the current date
    const dobDate = new Date(dobValue);
    const today = new Date();

    // Check if the selected date is today or in the future
    if (dobDate > today) {
        dobError.innerText = "Date of birth cannot be today or in the future.";
        dobError.style.color = "red";
        dobInput.classList.add('is-invalid');
        dobInput.focus();
        return false;
    }

    // Calculate age
    const age = today.getFullYear() - dobDate.getFullYear();
    const monthDifference = today.getMonth() - dobDate.getMonth();

    // Adjust age calculation if the birthday hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
        age--;
    }

    // Validate age
    if (age < 16) {
        dobError.innerText = "You must be at least 16 years old.";
        dobError.style.color = "red";
        dobInput.classList.add('is-invalid');
        dobInput.focus();
        return false;
    }

    // Remove invalid class if valid
    dobInput.classList.remove('is-invalid');
    dobError.innerText = "Date of birth is valid.";
    dobError.style.color = "green";
    return true;
}

function validatePassword() {
    const password = document.getElementById('register-password').value;
    const passwordError = document.getElementById('password-error');
    const passwordInput = document.getElementById('register-password');

    // Individual conditions for the password
    const lengthCondition = /.{8,}/;  // At least 8 characters
    const uppercaseCondition = /[A-Z]/;  // At least one uppercase letter
    const lowercaseCondition = /[a-z]/;  // At least one lowercase letter
    const numberCondition = /\d/;  // At least one number
    const specialCharCondition = /[@$!%*?&]/;  // At least one special character

    let message = '';
    let valid = true;

    // Check each condition and provide feedback if it’s not met
    if (!lengthCondition.test(password)) {
        message += 'Password must be at least 8 characters long.\n';
        valid = false;
    }
    if (!uppercaseCondition.test(password)) {
        message += 'Password must contain at least one uppercase letter.\n';
        valid = false;
    }
    if (!lowercaseCondition.test(password)) {
        message += 'Password must contain at least one lowercase letter.\n';
        valid = false;
    }
    if (!numberCondition.test(password)) {
        message += 'Password must contain at least one number.\n';
        valid = false;
    }
    if (!specialCharCondition.test(password)) {
        message += 'Password must contain at least one special character (e.g., @$!%*?&).\n';
        valid = false;
    }

    // Show the error message if the password is invalid
    if (!valid) {
        passwordError.innerText = message;
        passwordError.style.color = 'red';
        passwordInput.classList.add('is-invalid');
        passwordInput.focus();
    } else {
        passwordError.innerText = "Password is valid.";
        passwordError.style.color = 'green';
        passwordInput.classList.remove('is-invalid');
    }

    return valid;
}

function checkPasswordMatch() {
    const password = document.getElementById('register-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const confirmPasswordError = document.getElementById('confirm-password-error');
    const confirmPasswordInput = document.getElementById('confirm-password');

    // Clear any previous error messages
    confirmPasswordError.innerText = "";

    // Check if passwords match
    if (password !== confirmPassword) {
        confirmPasswordError.innerText = "Passwords do not match.";
        confirmPasswordError.style.color = 'red';
        confirmPasswordInput.classList.add('is-invalid');
        confirmPasswordInput.focus();
        return false;
    }

    confirmPasswordInput.classList.remove('is-invalid');
    confirmPasswordError.innerText = "Passwords match.";
    confirmPasswordError.style.color = 'green';
    return true;
}
</script>

<?php
include 'footer.php';
?>
