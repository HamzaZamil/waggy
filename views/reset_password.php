<?php include 'header.php'; ?>

<section id="auth" class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h6 class="text-center display-6 fw-normal mb-4">Reset Password</h6>
                <!-- Tab Content -->
                <div class="tab-content" id="authTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <!-- edit the action of the form -->
                        <form action="" method="POST" class="p-4 border rounded-2">
                            <div class="mb-3">
                                <label for="login-email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="login-email" name="email" placeholder="Your Email" required>
                            </div>
                            <button type="submit" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                                Submit
                            </button>
                        </form>   
                    </div>     
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
