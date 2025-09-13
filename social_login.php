<?php
// Start session
session_start();

// Autoload dependencies (Composer)
require_once __DIR__ . '/vendor/autoload.php';
require_once 'db_connect.php';

// Always return JSON
header('Content-Type: application/json');
header('Cross-Origin-Opener-Policy: same-origin-allow-popups');

// Disable display of PHP errors (log instead)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Default response
$response = ['status' => 'error', 'message' => 'Invalid login attempt'];

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
    exit;
}

// Get raw input and merge with $_POST fallback
$raw_input = file_get_contents('php://input');
$input = json_decode($raw_input, true) ?? [];
$post_data = $_POST;

$provider     = $input['provider'] ?? $post_data['provider'] ?? '';
$credential   = $input['credential'] ?? $post_data['credential'] ?? '';
$access_token = $input['access_token'] ?? $post_data['access_token'] ?? '';

// Validate provider
if (empty($provider) || !in_array($provider, ['google', 'facebook'])) {
    $response['message'] = 'Invalid or missing provider';
    echo json_encode($response);
    exit;
}

// Check database connection
if (!$conn) {
    $response['message'] = 'Database connection failed';
    echo json_encode($response);
    exit;
}

try {
    if ($provider === 'google') {
        // ✅ Google Login
        $client = new Google_Client(['client_id' => '385621142047-5n6k3du4el4000aj6qcuhpk8c64836i9.apps.googleusercontent.com']);
        $payload = $client->verifyIdToken($credential);

        if ($payload && isset($payload['email'])) {
            $email = $payload['email'];
            $name = $payload['name'] ?? trim(($payload['given_name'] ?? '') . ' ' . ($payload['family_name'] ?? ''));

            // Check if user exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
            } else {
                $stmt = $conn->prepare("INSERT INTO users (email, name) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $name);
                $stmt->execute();
                $_SESSION['user_id'] = $conn->insert_id;
            }
            $stmt->close();

            $response = ['status' => 'success', 'provider' => 'google', 'email' => $email, 'name' => $name];
        } else {
            $response['message'] = 'Invalid Google token or missing email';
        }
    }

    if ($provider === 'facebook') {
        // ✅ Facebook Login
        if (empty($access_token)) {
            $response['message'] = 'Missing Facebook access token';
            echo json_encode($response);
            exit;
        }

        // Call Facebook Graph API
        $fb_url = 'https://graph.facebook.com/me?fields=id,name,email&access_token=' . urlencode($access_token);
        $fb_response = file_get_contents($fb_url);
        $fb_data = json_decode($fb_response, true);

        if (isset($fb_data['email'])) {
            $email = $fb_data['email'];
            $name = $fb_data['name'];

            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
            } else {
                $stmt = $conn->prepare("INSERT INTO users (email, name) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $name);
                $stmt->execute();
                $_SESSION['user_id'] = $conn->insert_id;
            }
            $stmt->close();

            $response = ['status' => 'success', 'provider' => 'facebook', 'email' => $email, 'name' => $name];
        } else {
            $response['message'] = 'Failed to get Facebook user data';
        }
    }
} catch (Exception $e) {
    $response['message'] = 'Server error: ' . $e->getMessage();
}

// Final output (always valid JSON)
echo json_encode($response);
exit;
