document.addEventListener("DOMContentLoaded", function () {
    
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
        } else {
            emailField.classList.remove("is-invalid");
        }
    }
// pass validation
    function validatePassword() {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
        if (!passwordRegex.test(passwordField.value)) {
            passwordField.classList.add("is-invalid");
        } else {
            passwordField.classList.remove("is-invalid");
        }
    }
// conf-pass validation
    function validateConfirmPassword() {
        if (confirmPasswordField.value !== passwordField.value) {
            confirmPasswordField.classList.add("is-invalid");
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
