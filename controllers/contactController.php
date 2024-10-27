<?php
require_once '../model/contactus.class.php';

class ContactController
{
    private $contact;

    public function __construct()
    {
        $this->contact = new Contact();
    }

    public function handleContactForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = (trim($_POST['name']));
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);
            return $this->contact->saveContactInfo($name, $email, $message);
        }
    }
}

// Handle form submission and send response as JSON
$contactController = new ContactController();
$response = $contactController->handleContactForm();
if ($response) {
    echo json_encode($response);
    exit();
}
