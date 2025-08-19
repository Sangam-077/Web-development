<?php
// login.php
// Placeholder for server-side authentication logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Ravenhill Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="visual-section" style="background-image: url('https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80');">
            <div class="overlay-text">
                <h1>Ravenhill Coffee House</h1>
                <p>Savour the moment with every sip.</p>
            </div>
        </div>
        <div class="form-section">
            <h2>Welcome Back</h2>
            <p>Enter your details to access your account</p>
            <form id="signInForm" method="POST" action="#">
                <div class="input-field">
                    <label for="userEmail">Email</label>
                    <input type="email" id="userEmail" name="email" placeholder="your.email@example.com" required>
                </div>
                <div class="input-field">
                    <label for="userPass">Password</label>
                    <input type="password" id="userPass" name="password" placeholder="Your secure password" required>
                </div>
                <a href="forgot-pass.php" class="reset-link">Forgot Password?</a>
                <button type="submit" class="login-btn">Log In</button>
                <div class="social-options">
                    <button class="social-btn google-btn">Google</button>
                    <button class="social-btn fb-btn">Facebook</button>
                </div>
                <p class="signup-text">New here? <a href="register.php">Create an Account</a></p>
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php'"><i class="fas fa-times"></i></button>
            </form>
        </div>
    </div>
    <script src="auth-script.js"></script>
</body>
</html>