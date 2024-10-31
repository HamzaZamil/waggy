<?php include 'header.php'; ?>

<section id="auth" class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center display-3 fw-normal mb-4">Account</h2>

                <!-- Tabs to toggle between login and register -->
                <ul class="nav nav-pills mb-3 justify-content-center" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login" type="button" role="tab">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register" type="button" role="tab">Register</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="authTabContent">

                    <!-- Login Form -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <!-- Display error message if login fails -->
                        <?php if (isset($_SESSION['login_error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['login_error']; ?>
                            </div>
                            <?php unset($_SESSION['login_error']); ?>
                        <?php endif; ?>

                        <!-- edit the action of the form -->
                        <form action="./processes/login_process.php" method="POST" class="p-4 border rounded-2">
                            <div class="mb-3">
                                <label for="login-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="login-email" name="email" placeholder="Your Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="login-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="login-password" name="password" placeholder="Your Password" required>
                            </div>

                            <button type="submit" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
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
                        <form action="register_process.php" method="POST" class="p-4 border rounded-2">
                            <!-- Name Input -->
                            <div class="mb-3">
                                <label for="register-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="register-name" name="name" placeholder="Your Name" required>
                            </div>

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="register-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="register-email" name="email" placeholder="Your Email" required>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="register-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="register-password" name="password" placeholder="Your Password" required>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>

                            <!-- Address Input -->
                            <div class="mb-3">
                                <label for="register-address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="register-address" name="address" placeholder="Your Address" required>
                            </div>

                            <!-- Mobile Input -->
                            <div class="mb-3">
                                <label for="register-mobile" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="register-mobile" name="mobile" placeholder="Your Mobile Number" required>
                            </div>

                            <button type="submit" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                                Register
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
