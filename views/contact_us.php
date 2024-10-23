<?php include 'header.php'; ?>

<section id="contact" class="my-5">
    <div class="container">
        <h2 class="text-center display-3 fw-normal">Contact Us</h2>
        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <form action="contact_process.php" method="POST" class="p-4 border rounded-2">
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                    </div>

                    <!-- Message Input -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>