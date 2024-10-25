<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About-Us | Waggy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   
   
</head>
<body>
    
    <section id="contact" class="my-5">
        <div class="container">
            <h2 class="text-center display-3 fw-normal">Contact Us</h2>
            <div class="row justify-content-center my-5">
                <div class="col-md-8">
                    <form action="contact_us.php" method="POST" class="p-4 border rounded-2">
                        <!-- Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" placeholder="Your Name" required>
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email_id" name="email" placeholder="Your Email" required>
                        </div>

                        <!-- Message Input -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button onclick="sendMail(event)" type="submit" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Toast Notification -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;">
        <div class="toast" id="toast" style="position:fixed
; top: 150px; right: 100px; display: none;">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small class="text-muted" id="toast-time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    
    <?php include 'footer.php'; ?>

    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script type="text/javascript">
    (function(){
        emailjs.init({
            publicKey: "6di0i5U_8Za29EmBj",
        });
    })();
    </script>
     <script>
        function validateForm() {
            // Get form inputs
            var name = document.getElementById("fullName").value.trim();
            var email = document.getElementById("email_id").value.trim();
            var message = document.getElementById("message").value.trim();

            // Regular expression for validating email
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Validate name
            if (name === "") {
                showToast("Please enter your name.", "error");
                return false;
            }

            // Validate email
            if (email === "") {
                showToast("Please enter your email address.", "error");
                return false;
            } else if (!emailPattern.test(email)) {
                showToast("Please enter a valid email address.", "error");
                return false;
            }

            // Validate message
            if (message === "") {
                showToast("Please enter your message.", "error");
                return false;
            }

            return true; // Validation passed
        }

        function sendMail(event) {
            event.preventDefault(); // Prevent the default form submission

            // Validate the form
            if (!validateForm()) {
                return; // Stop if validation fails
            }

            var params = {
                from_name: document.getElementById("fullName").value,
                email_id: document.getElementById("email_id").value,
                message: document.getElementById("message").value
            };

            emailjs.send("service_42l0n3f", "template_48gya0r", params)
                .then(function(res) {
                    showToast("Success! Your message has been sent.", "success");
                })
                .catch(function(error) {
                    showToast("Failed to send email. " + error, "error");
                });
        }

        function showToast(message, type) {
            const toastBody = document.getElementById("toast-body");
            const toast = document.getElementById("toast");
            const toastTime = document.getElementById("toast-time");

            // Set the message
            toastBody.innerText = message;

            // Set the current time
            const now = new Date();
            toastTime.innerText = now.toLocaleTimeString();

            // Show the toast
            toast.style.display = 'block';
            const bsToast = new bootstrap.Toast(toast, { autohide: true, delay: 1500 });
            bsToast.show();
        }
    </script>

</body>
</html>
