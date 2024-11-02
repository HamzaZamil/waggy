document.getElementById("registerBtn").addEventListener("click", function (event) {
    validateRegisterForm();
    if (!isFormValid()) {
        event.preventDefault();
    }
});

function isFormValid() {
    let inputContainers = document.getElementById("reg_form").querySelectorAll('.mb-3');
    let result = true;
    inputContainers.forEach(container => {
        if (container.classList.contains('error')) {
            result = false;
        }
    });
    return result;
}

function validateRegisterForm() {
    // Validate First Name
    validateText("register-fname", /^[A-Za-z0-9\s.,-]{2,}$/, "First Name is required", "errorFName");

    // Validate Last Name
    validateText("register-lname", /^[A-Za-z0-9\s.,-]{2,}$/, "Last Name is required", "errorLName");

    // Validate Email
    validateText("register-email", /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        "Invalid email address", "errorEmail");

    // Validate Mobile Number
    validateText("register-mobile", /^(07[789]\d{7}|00962\d{9})$/,
        "Mobile number can be either 10 or 14 digits.", "errorMobile");

    // Validate Password
    validateText("register-password", /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/,
        "Password must be at least 8 characters with uppercase, lowercase, number, and special character.",
        "errorPassword");

    // Confirm Password Match
    let password = document.getElementById("register-password").value;
    let confirmPassword = document.getElementById("confirm-password").value;
    if (confirmPassword === "") {
        setError("confirm-password", "Password confirmation is required", "errorCheckPassword");
    } else if (password !== confirmPassword) {
        setError("confirm-password", "Passwords do not match", "errorCheckPassword");
    } else {
        setSuccess("confirm-password", "errorCheckPassword");
    }

    // Validate DOB
    validateDOB();

    // Validate address
    validateText("register-address", /^[A-Za-z0-9\s.,-]{3,}$/, "Address is required", "errorAddress");
}

function validateText(id, regex, errorMsg, errorSpanId) {
    const input = document.getElementById(id);
    if (!input.value.match(regex)) {
        setError(id, errorMsg, errorSpanId);
    } else {
        setSuccess(id, errorSpanId);
    }
}

function validateDOB() {
    const dob = document.getElementById("DOB");
    const dobDate = new Date(dob.value);
    const today = new Date();
    const age = today.getFullYear() - dobDate.getFullYear();
    if (dob.value === "") {
        setError("DOB", "Date of birth is required", "errorDOB");
    } else if (age < 16) {
        setError("DOB", "You must be at least 16 years old", "errorDOB");
    } else {
        setSuccess("DOB", "errorDOB");
    }
}



function setError(inputId, message, errorSpanId) {
    const inputElement = document.getElementById(inputId);
    inputElement.classList.add("error");
    inputElement.classList.remove("success");
    document.getElementById(errorSpanId).textContent = message;
}

function setSuccess(inputId, errorSpanId) {
    const inputElement = document.getElementById(inputId);
    inputElement.classList.remove("error");
    inputElement.classList.add("success");
    document.getElementById(errorSpanId).textContent = "";
}
