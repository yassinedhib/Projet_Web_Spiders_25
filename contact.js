document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");

    // Form fields and error messages
    const nameField = document.getElementById("name");
    const emailField = document.getElementById("email");
    const messageField = document.getElementById("message");
    const nameError = document.getElementById("nameError");
    const emailError = document.getElementById("emailError");
    const messageError = document.getElementById("messageError");

    // Regular expression for email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Real-time validation for the name field
    nameField.addEventListener("input", () => {
        if (!nameField.value.trim()) {
            nameError.textContent = "Name is required.";
            nameError.style.display = "block";
        } else if (nameField.value.length > 20) {
            nameError.textContent = "Name cannot exceed 20 characters.";
            nameError.style.display = "block";
        } else {
            nameError.style.display = "none";
        }
    });

    // Real-time validation for the email field
    emailField.addEventListener("input", () => {
        if (!emailField.value.trim()) {
            emailError.textContent = "Email is required.";
            emailError.style.display = "block";
        } else if (!emailRegex.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            emailError.style.display = "block";
        } else {
            emailError.style.display = "none";
        }
    });

    // Real-time validation for the message field
    messageField.addEventListener("input", () => {
        if (!messageField.value.trim()) {
            messageError.textContent = "Message is required.";
            messageError.style.display = "block";
        } else {
            messageError.style.display = "none";
        }
    });

    // Final validation on form submission
    form.addEventListener("submit", (e) => {
        let isValid = true;

        // Validate name field
        if (!nameField.value.trim()) {
            nameError.textContent = "Name is required.";
            nameError.style.color = "red";
            nameError.style.display = "block";
            isValid = false;
        } else if (nameField.value.length > 20) {
            nameError.textContent = "Name cannot exceed 20 characters.";
            nameError.style.color = "red";
            nameError.style.display = "block";
            isValid = false;
        }

        // Validate email field
        if (!emailField.value.trim()) {
            emailError.textContent = "Email is required.";
            emailError.style.color = "red";
            emailError.style.display = "block";
            isValid = false;
        } else if (!emailRegex.test(emailField.value)) {
            emailError.textContent = "Please enter a valid email address.";
            emailError.style.color = "red";
            emailError.style.display = "block";
            isValid = false;
        }

        // Validate message field
        if (!messageField.value.trim()) {
            messageError.textContent = "Message is required.";
            messageError.style.color = "red";
            messageError.style.display = "block";
            isValid = false;
        }

        // Prevent form submission if invalid
        if (!isValid) {
            e.preventDefault();
        }
    });
});
