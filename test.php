<?php
// db_test.php - Test database connection and data
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Database Connection Test</h2>";

// Database connection
$host = 'localhost';
$db = 'ravenhill_final';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "<p style='color: green;'>✓ Database connection successful</p>";
} catch (PDOException $e) {
    die("<p style='color: red;'>✗ DB Connection failed: " . $e->getMessage() . "</p>");
}

// Test tables exist
echo "<h3>Testing Tables:</h3>";

// Test category table
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'category'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✓ Category table exists</p>";
        
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM category");
        $result = $stmt->fetch();
        echo "<p>Categories count: " . $result['count'] . "</p>";
        
        if ($result['count'] > 0) {
            $stmt = $pdo->query("SELECT * FROM category LIMIT 5");
            $categories = $stmt->fetchAll();
            echo "<h4>Sample Categories:</h4><ul>";
            foreach ($categories as $cat) {
                echo "<li>ID: {$cat['category_id']}, Name: {$cat['name']}</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<p style='color: red;'>✗ Category table does not exist</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Error checking category table: " . $e->getMessage() . "</p>";
}

// Test product table
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'product'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✓ Product table exists</p>";
        
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM product");
        $result = $stmt->fetch();
        echo "<p>Products count: " . $result['count'] . "</p>";
        
        if ($result['count'] > 0) {
            $stmt = $pdo->query("SELECT * FROM product LIMIT 5");
            $products = $stmt->fetchAll();
            echo "<h4>Sample Products:</h4><ul>";
            foreach ($products as $product) {
                echo "<li>ID: {$product['product_id']}, Name: {$product['name']}, Category ID: {$product['category_id']}</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<p style='color: red;'>✗ Product table does not exist</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Error checking product table: " . $e->getMessage() . "</p>";
}

// Test inventory table
try {
    $stmt = $pdo->query("SHOW TABLES LIKE 'inventory'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✓ Inventory table exists</p>";
        
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM inventory");
        $result = $stmt->fetch();
        echo "<p>Inventory records count: " . $result['count'] . "</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Inventory table does not exist (optional)</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: orange;'>⚠ Inventory table issue: " . $e->getMessage() . "</p>";
}

// Test the exact query from menu.php
echo "<h3>Testing Menu Query:</h3>";
try {
    $stmt = $pdo->query("
        SELECT p.*, c.name as category_name, COALESCE(i.stock_level, 0) as stock
        FROM product p 
        JOIN category c ON p.category_id = c.category_id 
        LEFT JOIN inventory i ON p.product_id = i.product_id
        ORDER BY c.name, p.name
        LIMIT 10
    ");
    $items = $stmt->fetchAll();
    
    if (count($items) > 0) {
        echo "<p style='color: green;'>✓ Menu query successful, found " . count($items) . " items</p>";
        echo "<h4>Sample Menu Items:</h4>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th></tr>";
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>{$item['product_id']}</td>";
            echo "<td>{$item['name']}</td>";
            echo "<td>{$item['category_name']}</td>";
            echo "<td>\${$item['price']}</td>";
            echo "<td>{$item['stock']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>✗ Menu query returned no results</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Menu query failed: " . $e->getMessage() . "</p>";
}

echo "<hr><p><strong>If you see errors above, please check:</strong></p>";
echo "<ul>";
echo "<li>Database 'ravenhill_final' exists</li>";
echo "<li>Tables 'category' and 'product' exist with proper structure</li>";
echo "<li>Tables have data</li>";
echo "<li>Foreign key relationships are correct (product.category_id matches category.category_id)</li>";
echo "</ul>";
?>