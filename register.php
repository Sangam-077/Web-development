<?php
// register.php
session_start();
include 'db_connect.php';

$sticky_first = '';
$sticky_last = '';
$sticky_email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Sticky values
    $sticky_first = $firstName ?? '';
    $sticky_last = $lastName ?? '';
    $sticky_email = $email ?? '';

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
        // Clear passwords on mismatch to prompt re-entry
        unset($_POST['password']);
        unset($_POST['confirmPassword']);
    } elseif ($firstName && $lastName && $email && $password) {
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id;
                header("Location: index.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    } else {
        $error = "Please fill all fields.";
    }
}
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
    <!-- Google Sign-In API -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
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
            <?php if ($error) echo "<p class='error'>$error</p>"; ?>
            <form id="signUpForm" method="POST" action="#">
                <div class="input-field">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($sticky_first); ?>" placeholder="Your first name" required>
                </div>
                <div class="input-field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($sticky_last); ?>" placeholder="Your last name" required>
                </div>
                <div class="input-field">
                    <label for="regEmail">Email</label>
                    <input type="email" id="regEmail" name="email" value="<?php echo htmlspecialchars($sticky_email); ?>" placeholder="your.email@example.com" required>
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
                    <input type="checkbox" name="terms" <?php echo (isset($_POST['terms']) ? 'checked' : ''); ?> required> I agree to the Terms of Service & Privacy Policy
                </label>
                <button type="submit" class="signup-btn">Create Account</button>
                <p class="login-text">Already have an account? <a href="login.php">Sign In</a></p>
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php'"><i class="fas fa-times"></i></button>
            </form>
        </div>
    </div>
    <!-- Facebook SDK -->
    <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : 'YOUR_FACEBOOK_APP_ID',
            cookie     : true,
            xfbml      : true,
            version    : 'v18.0'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <script src="script.js"></script>
</body>
</html>