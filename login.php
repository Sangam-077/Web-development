<?php
// login.php
session_start();
include 'db_connect.php';
header('Cross-Origin-Opener-Policy: unsafe-none');

$sticky_email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Invalid email or password.";
            $sticky_email = $email; // Sticky email on error
        }
    } else {
        $error = "Please fill all fields.";
        if (isset($_POST['email'])) $sticky_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php header('Cross-Origin-Opener-Policy: same-origin-allow-popups'); ?>
    <meta http-equiv="Cross-Origin-Opener-Policy" content="same-origin-allow-popups"> <!-- Fallback meta tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Ravenhill Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Google Sign-In API -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <!-- Facebook SDK -->
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
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
            <?php if ($error) echo "<p class='error'>$error</p>"; ?>
            <form id="signInForm" method="POST" action="">
                <div class="input-field">
                    <label for="userEmail">Email</label>
                    <input type="email" id="userEmail" name="email" value="<?php echo htmlspecialchars($sticky_email); ?>" placeholder="your.email@example.com" required autocomplete="email">
                </div>
                <div class="input-field">
                    <label for="userPass">Password</label>
                    <input type="password" id="userPass" name="password" placeholder="Your secure password" required autocomplete="current-password">
                </div>
                <a href="forgot-pass.php" class="reset-link">Forgot Password?</a>
                <button type="submit" class="login-btn">Log In</button>
                <div class="social-options">
                    <!-- Google Sign-In Button -->
                    <div id="g_id_onload"
                         data-client_id="385621142047-5n6k3du4el4000aj6qcuhpk8c64836i9.apps.googleusercontent.com"
                         data-callback="handleGoogleSignIn"
                         data-auto_prompt="false">
                    </div>
                    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left"></div>
                    <!-- Facebook Sign-In Button -->
                    <div id="fb-root"></div>
                    <button class="social-btn fb-btn" id="fb-btn"><i class="fab fa-facebook-f"></i> Facebook</button>
                </div>
                <p class="signup-text">New here? <a href="register.php">Create an Account</a></p>
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php'"><i class="fas fa-times"></i></button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>