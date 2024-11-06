<?php
    // Start the session and enable error reporting
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Database connection parameters
    $host = 'localhost';
    $dbName = 'waggy_shop';
    $username = 'root';
    $password = '';

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted via AJAX
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and retrieve form inputs
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

        try {
            // Prepare and execute the SQL statement to save data
            $stmt = $pdo->prepare("INSERT INTO feedback (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message
            ]);

            // Return success response to show a toast notification
            echo json_encode(['status' => 'success', 'message' => 'Your message has been saved!']);
            exit();

        } catch (PDOException $e) {
            // Catch specific database errors and output them
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            exit();
        }
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()]);
    exit();
}
?>

<?php include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Waggy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<style>
  

    #contact {
        background: linear-gradient(to right, #faf4ed);
    }
    #contact h2 {
        color: #343a40;
        margin-bottom: 30px;
    }

    #contactForm {
        border: 2px solid #007bff; /* Light blue border */
        transition: border-color 0.3s ease;
        background: url('../images/background-img.png') no-repeat;

    }

    #contactForm:hover {
        border-color: #0056b3; /* Darker blue on hover */
    }


    .form-control {
        border-radius: 0.5rem; /* Rounded corners for inputs */
        border: 1px solid #ced4da; /* Default border color */
        transition: border-color 0.3s ease; /* Smooth border color transition */
    }

    .form-control:focus {
        border-color: #faf4ed; /* Change border color on focus */
        box-shadow: 0 0 5px #faf4ed; /* Add shadow on focus */
    }

    /* Enhance the submit button */
    .btn-dark {
        border-radius: 0.5rem; 
        font-weight: bold; 
        padding: 12px; 
        background-color: #1a1a1a;
        color: #ced4da;
    }
        
    

</style>
<body>

<section id="contact" class="my-5 pt-5">
    <div class="container">
        <h2 class="text-center display-5 fw-normal">Contact Us</h2>
        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <form id="contactForm" class="p-4 border rounded-2 shadow-lg bg-light">
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="fullName" name="name" placeholder="Your Name" required>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email_id" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email_id" name="email" placeholder="Your Email" required>
                    </div>

                    <!-- Message Input -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-dark btn-lg text-uppercase fs-6 rounded-1 w-100">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>


    <!-- Toast Notification -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;">
        <div class="toast" id="toast" style="position:fixed; top: 150px; right: 100px; display: none;">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small class="text-muted" id="toast-time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script type="text/javascript">
        (function() {
            emailjs.init({
                publicKey: "6di0i5U_8Za29EmBj",
            });
        })();
    </script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Collect form data
            const formData = new FormData(this);

            // Check for empty fields before submission
            const name = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email_id').value.trim();
            const message = document.getElementById('message').value.trim();

            if (!name || !email || !message) {
                showToast("Please fill in all fields.", 'error');
                return; // Exit the function if fields are empty
            }

            try {
                // Send form data to server
                const response = await fetch('../controllers/contactController.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                // Display toast notification based on response status
                if (result.status === 'success') {
                    
                    
                    
        const params ={from_name:name,email_id : email,message:message};
        emailjs.send("service_42l0n3f", "template_48gya0r", params)
        .then(function(res) {
        console.log("hg");
           
        })
        .catch(function(error) {
             console.log("hssg");
        });
        

                    showToast(result.message, 'success');
                    this.reset(); // Clear the form on success
                } else {
                    console.error(result.message); // Log error in the console
                    showToast(result.message, 'error');
                }
            } catch (error) {
                console.error("Request failed: ", error);
                showToast("Failed to submit form. Please try again later.", 'error');
            }
        });

        function showToast(message, type) {
            const toastBody = document.getElementById("toast-body");
            const toast = document.getElementById("toast");
            const toastTime = document.getElementById("toast-time");

            // Update toast content
            toastBody.innerText = message;
            toastTime.innerText = new Date().toLocaleTimeString();

            // Display toast with Bootstrap's Toast component
            toast.style.display = 'block';
            const bsToast = new bootstrap.Toast(toast, {
                autohide: true,
                delay: 3000
            });
            bsToast.show();
        }
    </script>



</body>

</html>
<?php include './footer.php'; ?>