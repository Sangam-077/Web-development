<?php
// register.php
// Placeholder for server-side registration logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Ravenhill Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="visual-section" style="background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');">
            <div class="overlay-text">
                <h1>Ravenhill Coffee House</h1>
                <p>Join Our Vibrant Community</p>
            </div>
        </div>
        <div class="form-section">
            <h2>Create Account</h2>
            <p>Become part of our coffee community</p>
            <form id="signUpForm" method="POST" action="#">
                <div class="input-field">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Your first name" required>
                </div>
                <div class="input-field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Your last name" required>
                </div>
                <div class="input-field">
                    <label for="regEmail">Email</label>
                    <input type="email" id="regEmail" name="email" placeholder="your.email@example.com" required>
                </div>
                <div class="input-field">
                    <label for="regPass">Password</label>
                    <input type="password" id="regPass" name="password" placeholder="Create a password" required>
                </div>
                <div class="input-field">
                    <label for="confirmPass">Confirm Password</label>
                    <input type="password" id="confirmPass" name="confirmPassword" placeholder="Confirm your password" required>
                </div>
                <label class="terms-check">
                    <input type="checkbox" name="terms" required> I agree to the Terms of Service & Privacy Policy
                </label>
                <button type="submit" class="signup-btn">Create Account</button>
                <p class="login-text">Already have an account? <a href="login.php">Sign In</a></p>
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php'"><i class="fas fa-times"></i></button>
            </form>
        </div>
    </div>
    <script src="auth-script.js"></script>
</body>
</html>