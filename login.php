<?php
// login.php
ob_start();
ob_clean();

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/php/logs/php_error.log');
error_reporting(E_ALL);

session_start();
include 'db_connect.php';

// Set headers for Google Sign-In
header('Content-Type: text/html; charset=UTF-8');
header('Cross-Origin-Opener-Policy: same-origin-allow-popups');
header('Cross-Origin-Embedder-Policy: require-corp');
header('Cross-Origin-Resource-Policy: same-origin');

if (headers_sent($file, $line)) {
    $error_msg = "Headers already sent in $file on line $line";
    error_log($error_msg);
    die("<pre>ERROR: $error_msg\nCheck for output before headers.</pre>");
}

$sticky_email = '';
$error = '';

$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $redirect = $_POST['redirect'] ?? $_GET['redirect'] ?? 'index.php';

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
        if ($stmt === false) {
            $error = "Failed to prepare SELECT statement: " . $conn->error;
            error_log($error);
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                if ($is_ajax) {
                    echo json_encode(['status' => 'success', 'redirect' => $redirect]);
                    exit();
                } else {
                    header("Location: $redirect");
                    exit();
                }
            } else {
                $error = "Invalid email or password.";
                $sticky_email = $email;
            }
            $stmt->close();
        }
    } else {
        $error = "Please fill all fields.";
        if (isset($_POST['email'])) $sticky_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    if ($is_ajax) {
        echo json_encode(['status' => 'error', 'message' => $error]);
        exit();
    }
}
ob_end_flush();
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
    <script src="https://accounts.google.com/gsi/client" async defer></script>
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
                    <div id="g_id_onload"
                         data-client_id="385621142047-2ne0bkjjbb63630bej536ce25lkl24lm.apps.googleusercontent.com"
                         data-callback="handleGoogleSignIn"
                         data-auto_prompt="false">
                    </div>
                    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left"></div>
                    <button class="social-btn fb-btn" id="fb-btn"><i class="fab fa-facebook-f"></i> Facebook</button>
                </div>
                <p class="signup-text">New here? <a href="register.php?redirect=<?= urlencode($_GET['redirect'] ?? $_SERVER['REQUEST_URI']) ?>">Create an Account</a></p>
                <button type="button" class="cancel-btn" onclick="window.location.href='<?= isset($_GET['redirect']) ? urldecode($_GET['redirect']) : 'index.php' ?>'"><i class="fas fa-times"></i></button>
            </form>
        </div>
    </div>
    <script>
        window.onload = function() {
            google.accounts.id.initialize({
                client_id: "385621142047-2ne0bkjjbb63630bej536ce25lkl24lm.apps.googleusercontent.com",
                callback: handleGoogleSignIn
            });
            google.accounts.id.renderButton(
                document.querySelector(".g_id_signin"),
                { theme: "outline", size: "large" }
            );
        };
        window.fbAsyncInit = function() {
            FB.init({
                appId: 'your-facebook-app-id',
                cookie: true,
                xfbml: true,
                version: 'v19.0'
            });
        };
    </script>
    <script src="script.js"></script>
</body>
</html>
