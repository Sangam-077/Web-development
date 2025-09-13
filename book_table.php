<?php
// Database connection
include 'db_connect.php'; // Adjust if your connection file is named differently

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $guests = intval($_POST['guests']);
    $requests = htmlspecialchars(trim($_POST['special_requests']));

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time) || $guests < 1) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (strtotime($date) < strtotime('today')) {
        $error = "Reservation date must be in the future.";
    } else {
        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO reservations (name, email, reservation_date, reservation_time, party_size, special_requests) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $date);
        $stmt->bindParam(4, $time);
        $stmt->bindParam(5, $guests);
        $stmt->bindParam(6, $requests);
        
        if ($stmt->execute()) {
            $success = "Your table has been reserved successfully! We'll confirm via email shortly.";
        } else {
            $error = "An error occurred. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book a Table - Ravenhill Coffee House</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
 
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Include Header -->
  <header id="main-header">
    <div id="header-container">
      <div id="nav-content">
        <div id="logo-group">
          <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png" alt="Ravenhill Coffee Logo" id="logo-image">
          <span id="logo-text">Ravenhill Coffee House</span>
        </div>
        <button id="mobile-menu-btn">
          <i class="fas fa-bars" id="menu-icon"></i>
        </button>
        <nav id="main-nav">
          <a href="index.php" class="nav-item">Home</a>
          <a href="menu.php" class="nav-item">Menu</a>
          <a href="about.php" class="nav-item">About Us</a>
          <a href="contact.php" class="nav-item">Contact</a>
        </nav>
        <div id="nav-actions">
          <a href="#" class="icon-link"><i class="fas fa-search"></i></a>
          <a href="#" class="icon-link"><i class="far fa-heart"></i></a>
          <a href="#" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
          <div class="account-dropdown">
            <button id="account-btn" class="account-btn">Account <i class="fas fa-caret-down"></i></button>
            <div id="account-menu">
              <a href="login.php" class="account-link">Login</a>
              <a href="register.php" class="account-link">Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Reservation Section -->
  <section id="reservation-section">
    <div id="reservation-container">
      <div id="reservation-form-container">
        <h1 id="reservation-title">Reserve Your Table</h1>
        <p id="reservation-subtitle">Experience the culinary excellence of Ravenhill. Book your table today for an unforgettable dining experience.</p>
        
        <?php if (isset($success)): ?>
          <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (isset($error)): ?>
          <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form id="reservation-form" method="POST" action="book_table.php">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
          </div>
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
          </div>
          <div class="form-group">
            <label for="time">Time</label>
            <select id="time" name="time" required>
              <option value="">Select Time</option>
              <?php
                $times = [
                    '9:00' => '9:00 AM',
                    '10:00' => '10:00 AM',
                    '11:00' => '11:00 AM',
                    '11:30' => '11:30 AM',
                     '12:00' => '12:00 PM',
                    '12:30' => '12:30 PM',
                    '13:00' => '1:00 PM',
                    '13:30' => '1:30 PM',
                    '14:00' => '2:00 PM',
                    '14:30' => '2:30 PM',
                    '15:00' => '3:00 PM',
                    '15:30' => '3:30 PM',
                    '16:00' => '4:00 PM',
                    '16:30' => '4:30 PM',
                    '17:00' => '5:00 PM',
                    '17:30' => '5:30 PM',
                    '18:00' => '6:00 PM',
                    '18:30' => '6:30 PM',
                    '19:00' => '7:00 PM',
                    '19:30' => '7:30 PM',
                    '20:00' => '8:00 PM'
                ];
                foreach ($times as $value => $label) {
                    echo "<option value='$value'>$label</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="guests">Number of Guests</label>
            <select id="guests" name="guests" required>
              <option value="">Select guests</option>
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?> <?php echo $i === 1 ? 'Guest' : 'Guests'; ?></option>
              <?php endfor; ?>
              <option value="11">11+ Guests (Contact Us)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="special_requests">Special Requests</label>
            <textarea id="special_requests" name="special_requests" placeholder="Any special requests? (e.g., Window seat, Birthday celebration)"></textarea>
          </div>
          <button type="submit" id="reserve-btn">Reserve Now</button>
        </form>
      </div>

      <div id="reservation-info">
        <h2 id="info-title">Something Similar to Us</h2>
        <p id="info-text">Our restaurant offers an intimate experience with seasonal menus crafted from locally sourced ingredients.</p>
        <div class="info-item">
          <i class="fas fa-clock"></i>
          <span>Mon-Fri 7:00 AM - 8:00 PM, Sat-Sun 7:00 AM - 6:00 PM</span>
        </div>
        <div class="info-item">
          <i class="fas fa-map-marker-alt"></i>
          <span>Prahran Market, Melbourne</span>
        </div>
        <div class="info-item">
          <i class="fas fa-phone-alt"></i>
          <span>(231) 456-7890</span>
        </div>
        <div class="info-item">
          <i class="fas fa-envelope"></i>
          <span>reservations@ravenhillcoffee.com</span>
        </div>

        <div id="popular-slots">
          <h3 id="slots-title">Popular Time Slots</h3>
          <div class="slot-buttons">
            <button class="slot-btn">11:00 AM</button>
            <button class="slot-btn">12:00 PM</button>
            <button class="slot-btn">2:00 PM</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Include Footer -->
  <footer id="footer-section">
    <div id="footer-container">
      <div id="footer-grid">
        <div id="footer-about">
          <div id="footer-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png" alt="Ravenhill Coffee Logo" id="footer-logo-image">
            <span id="footer-logo-text">Ravenhill</span>
          </div>
          <p id="footer-about-text">Crafting exceptional coffee since 2009 with ethically sourced beans.</p>
          <div id="footer-social">
            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
        <div id="footer-links">
          <h3 id="footer-links-title">Quick Links</h3>
          <ul id="footer-links-list">
            <li><a href="#hero-section" class="footer-link">Home</a></li>
            <li><a href="#featured-section" class="footer-link">Menu</a></li>
            <li><a href="about.php" class="footer-link">About Us</a></li>
            <li><a href="#contact-section" class="footer-link">Contact</a></li>
          </ul>
        </div>
        <div id="footer-contact">
          <h3 id="footer-contact-title">Contact Us</h3>
          <ul id="footer-contact-list">
            <li class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <span>Prahran Market, Melbourne</span>
            </li>
            <li class="class-item">
              <i class="fas fa-phone-alt"></i>
              <span>(02) 123-4567</span>
            </li>
            <li class="contact-item">
              <i class="fas fa-envelope"></i>
              <span>hello@ravenhillcoffee.com</span>
            </li>
          </ul>
        </div>
        <div id="footer-hours">
          <h3 id="footer-hours-title">Opening Hours</h3>
          <ul id="footer-hours-list">
            <li class="hours-item">
              <span>Monday - Friday</span>
              <span>7:00 AM - 8:00 PM</span>
            </li>
            <li class="hours-item">
              <span>Saturday</span>
              <span>8:00 AM - 6:00 PM</span>
            </li>
            <li class="hours-item">
              <span>Sunday</span>
              <span>8:00 AM - 6:00 PM</span>
            </li>
          </ul>
        </div>
      </div>
      <div id="footer-bottom">
        <p>&copy; 2025 Ravenhill Coffee House. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
  
</body>
</html>