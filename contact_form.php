<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="public/style.css">
    <script src="public/contact.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p>Please fill in the form below to send us your message.</p>
        
        <form id="contactForm" action="?action=create" method="POST">
            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name </label>
                <input type="text" id="name" name="name" placeholder="Your Full Name" >
                <span class="error" id="nameError"></span>
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email </label>
                <input type="email" id="email" name="email" placeholder="Your Email Address" >
                <span class="error" id="emailError"></span>
            </div>

            <!-- Type Field -->
            <div class="form-group">
                <label for="type">Type of Inquiry</label>
                <select id="type" name="type">
                    <option value="Feedback">Feedback</option>
                    <option value="Support">Support</option>
                    <option value="General Inquiry">General Inquiry</option>
                </select>
            </div>

            <!-- Message Field -->
            <div class="form-group">
                <label for="message">Message </label>
                <textarea id="message" name="message" rows="5" placeholder="Write your message here..."></textarea>
                <span class="error" id="messageError"></span>
            </div>

            <!-- Submit Button -->
            <button type="submit">Send Message</button>
            <span class="success" id="formSuccess"></span>
        </form>
    </div>
</body>
</html>