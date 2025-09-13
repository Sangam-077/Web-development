<?php
// db_connect.php - Database connection handler
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection configuration
$host = 'localhost';
$dbname = 'ravenhill_final';
$username = 'root';
$password = ''; // Change this to your MySQL password if set

try {
    // Create PDO connection with UTF-8 charset
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    // Check if database exists and has data (log, don't echo)
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM product");
    $result = $stmt->fetch();
    if ($result['count'] === 0) {
        error_log("Warning: No products found in database.");
    }
    
    // Log success instead of echoing (prevents JSON pollution)
    error_log("Database connection successful");
    
} catch (PDOException $e) {
    // Show detailed error message for debugging
    error_log("Database connection failed: " . $e->getMessage()); // Log only
    die("Database connection failed: " . $e->getMessage() . 
        ". Please check your database credentials and ensure the 'ravenhill_final' database exists.");
}

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