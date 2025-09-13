<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT email, name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Ravenhill Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
        <div class="profile-section">
            <div class="profile-icon">
                <!-- Placeholder for profile icon (e.g., Gravatar or uploaded image) -->
                <img src="https://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user['email']))); ?>?s=200" alt="Profile Icon" class="profile-img">
                <a href="upload_profile.php" class="edit-icon"><i class="fas fa-camera"></i></a>
            </div>
            <div class="profile-info">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <a href="change_password.php" class="profile-link">Change Password</a>
            </div>
        </div>
        <div class="order-history">
            <h3>Order History</h3>
            <?php
            $stmt = $conn->prepare("SELECT order_id, total, order_date FROM orders WHERE user_id = ? ORDER BY order_date DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($order = $result->fetch_assoc()) {
                    echo "<p>Order #{$order['order_id']} - $" . number_format($order['total'], 2) . " on " . date('Y-m-d', strtotime($order['order_date'])) . "</p>";
                }
            } else {
                echo "<p>No orders yet.</p>";
            }
            ?>
            <a href="view_orders.php" class="profile-link">View All Orders</a>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <script src="script.js"></script>
</body>
</html>