<?php
// db_connect.php - Database connection handler

// Enable error reporting for debugging (DISABLE IN PRODUCTION!)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection configuration
$host = 'localhost';
$dbname = 'ravenhill_final';
$username = 'root';
$password = ''; // Change this to your MySQL password if set

// Create MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $error_msg = "Database connection failed: " . $conn->connect_error;
    error_log($error_msg);
    die($error_msg . ". Please check your database credentials and ensure the 'ravenhill_final' database exists.");
}

// Verify connection is active
if ($conn->ping() === false) {
    $error_msg = "Database connection inactive: " . $conn->error;
    error_log($error_msg);
    die($error_msg);
}

// Set charset to utf8mb4
if (!$conn->set_charset("utf8mb4")) {
    error_log("Error setting charset: " . $conn->error);
    // Proceed with default charset, but log the issue
}

// Check if users table exists (critical for social_login.php)
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result) {
    if ($result->num_rows === 0) {
        error_log("Warning: 'users' table does not exist in database 'ravenhill_final'. Please create it.");
    }
    $result->free();
} else {
    error_log("Error checking for 'users' table: " . $conn->error);
}

// Optional: Check product table (for your app's context)
$result = $conn->query("SELECT COUNT(*) as count FROM product");
if ($result) {
    $row = $result->fetch_assoc();
    if ($row['count'] === 0) {
        error_log("Warning: No products found in database.");
    }
    $result->free();
} else {
    error_log("Error querying product count: " . $conn->error);
}

// Log successful connection
error_log("Database connection successful to '$dbname'");

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart and wishlist if they don't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}
?>
