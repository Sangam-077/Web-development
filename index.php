<?php
// index.php with added POST handlers for review and subscribe
session_start();
include 'db_connect.php';

// Handle POST requests for review and subscribe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $action = $_POST['action'] ?? '';

    if ($action === 'submit_review') {
        $rating = (int)($_POST['rating'] ?? 0);
        $comment = trim($_POST['comment'] ?? '');

        if ($rating < 1 || $rating > 5 || empty($comment)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid review data']);
            exit;
        }

        try {
            // Assuming guest user if not logged in; in production, use real customer_id
            $customer_id = $_SESSION['customer_id'] ?? 'guest_' . uniqid();
            $review_id = uniqid('rev_');
            $stmt = $pdo->prepare("INSERT INTO review (review_id, customer_id, rating, comment, review_time) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$review_id, $customer_id, $rating, $comment]);
            echo json_encode(['status' => 'success', 'message' => 'Review submitted successfully']);
        } catch (PDOException $e) {
            error_log("Review submission error: " . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Failed to submit review']);
        }
        exit;
    }

    if ($action === 'subscribe') {
        $email = trim($_POST['email'] ?? '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
            exit;
        }

        // No subscribers table; in production, add one. For now, log or success
        error_log("Subscribed: " . $email);
        echo json_encode(['status' => 'success', 'message' => 'Subscribed successfully']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ravenhill Coffee House</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navigation Bar -->
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
          <a href="index.php" class="nav-item active">Home</a>
          <a href="menu.php" class="nav-item">Menu</a>
          <a href="about.php" class="nav-item">About Us</a>
          <a href="contact.php" class="nav-item">Contact</a>
        </nav>
        <div id="nav-actions">
          <a href="#" class="icon-link search-icon"><i class="fas fa-search"></i></a>
          <a href="#" id="wishlist-btn" class="icon-link"><i class="far fa-heart"></i></a>
          <a href="#" id="cart-btn" class="icon-link"><i class="fas fa-shopping-cart"></i> <span class="cart-count"><?= count($_SESSION['cart'] ?? []) ?></span></a>
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

  <!-- Hero Section -->
  <section id="hero-section">
    <div id="hero-container">
      <div id="hero-content">
        <h1 id="hero-title">Best Coffee, <span id="hero-highlight">Make Your Day Great</span></h1>
        <p id="hero-text">Welcome to our coffee paradise, where every bean tells a story and every cup sparks joy.</p>
        <div id="hero-buttons">
          <a id="order-now-btn" href="menu.php">Order Now</a>
          <a id="book-table-btn" href="book_table.php">Book Table</a>
        </div>
      </div>
      <div id="hero-image-container">
        <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Coffee pouring scene" id="hero-image">
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about-us">
    <div id="about-us-container">
      <div id="about-us-image">
        <img src="Images/landing.jpeg" alt="Coffee beans" id="about-us-img">
      </div>
      <div id="about-us-content">
        <h2 id="about-us-title">Our Story</h2>
        <p id="about-us-text">Ravenhill Coffee House was founded in 2009 with a simple vision: to create the perfect cup of coffee that brings people together. From our humble beginnings in Melbourne's Prahran Market, we've grown into a beloved destination for coffee lovers. We source our beans from ethical farms around the world, ensuring every sip supports sustainable practices. Our expert roasters craft each batch with precision, blending tradition with innovation to deliver flavors that delight and inspire. At Ravenhill, it's not just about coffee—it's about creating moments that last.</p>
        <a href="about.php" id="about-us-link">More About Us</a>
      </div>
    </div>
  </section>

  <!-- Menu Jumbotron Section -->
  <section style="padding: 80px 0; background: var(--background-cream);">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 20px;">
      <div style="text-align: center; margin-bottom: 50px;">
        <span style="color: var(--accent-gold); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">OUR MENU</span>
        <h2 style="font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: var(--text-dark);">Discover Our Delights</h2>
      </div>
      <div style="position: relative; height: 500px; overflow: hidden; border-radius: 15px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);">
        <img src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80&utm_source=chatgpt.com" alt="Coffee and Pastries" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
          <a href="menu.php" style="background: var(--accent-gold); color: var(--text-dark); padding: 20px 40px; text-decoration: none; border-radius: 30px; font-size: 24px; font-weight: 600; transition: transform 0.3s ease, background 0.3s ease; display: inline-block;">View Full Menu</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials-section">
    <div id="testimonials-container">
      <div id="testimonials-header">
        <p id="testimonials-subtitle">What Our Customers Say</p>
        <h2 id="testimonials-title">Testimonials</h2>
      </div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide testimonial-item">
            <div class="testimonial-content">
              <img class="testimonial-image" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Asmita">
              <h3 class="testimonial-name">Asmita</h3>
              <div class="testimonial-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <p class="testimonial-text">"Amazing coffee and cozy atmosphere! The staff is always so welcoming, and the Honey Lavender Latte is my go-to."</p>
            </div>
          </div>
          <div class="swiper-slide testimonial-item">
            <div class="testimonial-content">
              <img class="testimonial-image" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mehedi">
              <h3 class="testimonial-name">Mehedi</h3>
              <div class="testimonial-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
              <p class="testimonial-text">"Best cappuccino in town! The quality of the beans really shines through in every sip."</p>
            </div>
          </div>
          <div class="swiper-slide testimonial-item">
            <div class="testimonial-content">
              <img class="testimonial-image" src="https://randomuser.me/api/portraits/women/65.jpg" alt="Aakriti">
              <h3 class="testimonial-name">Aakriti</h3>
              <div class="testimonial-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <p class="testimonial-text">"Friendly staff and delicious snacks. The croissants are to die for, and the ambiance is perfect for relaxing."</p>
            </div>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <!-- Review Section -->
  <section id="review-section">
    <div id="review-container">
      <h3 id="review-title">Share Your Feedback</h3>
      <form id="review-form">
        <div class="rating-container">
          <label for="rating">Your Rating:</label>
          <div class="star-rating">
            <input type="radio" name="rating" id="star5" value="5"><label for="star5"><i class="fas fa-star"></i></label>
            <input type="radio" name="rating" id="star4" value="4"><label for="star4"><i class="fas fa-star"></i></label>
            <input type="radio" name="rating" id="star3" value="3"><label for="star3"><i class="fas fa-star"></i></label>
            <input type="radio" name="rating" id="star2" value="2"><label for="star2"><i class="fas fa-star"></i></label>
            <input type="radio" name="rating" id="star1" value="1"><label for="star1"><i class="fas fa-star"></i></label>
          </div>
        </div>
        <textarea id="review-text" placeholder="Write your review here..." required></textarea>
        <button type="submit" id="submit-review-btn">Submit Review</button>
      </form>
    </div>
  </section>

  <!-- Newsletter Section -->
  <section id="newsletter-section">
    <div id="newsletter-container">
      <h2 id="newsletter-title">Join Our Coffee Community</h2>
      <p id="newsletter-text">Subscribe for new blends, events, and offers.</p>
      <form id="newsletter-form">
        <input type="email" id="newsletter-email" placeholder="Your email address" required>
        <button type="submit" id="subscribe-btn">Subscribe</button>
      </form>
    </div>
  </section>
  
  <!-- cart modal -->
   <div id="cart-modal" class="modal">
    <div class="modal-content">
        <!-- Cart content will be loaded dynamically via JS -->
    </div>
</div>

<!-- wishlist modal -->
<div id="wishlist-modal" class="modal">
    <div class="modal-content">
        <!-- Wishlist content will be loaded dynamically via JS -->
    </div>
</div>

  <!-- Footer Section -->
  <!-- Footer Section -->
  <footer id="footer-section">
    <div id="footer-container">
      <div id="footer-grid">
        <div id="footer-about">
          <div id="footer-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png" alt="Ravenhill Coffee Logo" id="footer-logo-image">
            <span id="footer-logo-text">Ravenhill</span>
          </div>
          <p id="footer-about-text">Crafting exceptional coffee experiences since 2009. Ethically sourced, expertly roasted.</p>
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
            <li><a href="#about-section" class="footer-link">About Us</a></li>
            <li><a href="#contact-section" class="footer-link">Contact</a></li>
          </ul>
        </div>
        <div id="footer-contact">
          <h3 id="footer-contact-title">Contact Us</h3>
          <ul id="footer-contact-list">
            <li class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <a href="https://www.google.com/maps/search/?api=1&query=-37.8182,144.9594" class="footer-link" target="_blank">Prahran Market, Melbourne</a>
            </li>
            <li class="contact-item">
              <i class="fas fa-phone-alt"></i>
              <a href="tel:+6121234567" class="footer-link">(02) 123-4567</a>
            </li>
            <li class="contact-item">
              <i class="fas fa-envelope"></i>
              <a href="mailto:hello@ravenhillcoffee.com" class="footer-link">hello@ravenhillcoffee.com</a>
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
              <span>8:00 AM - 9:00 PM</span>
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
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68c53396f7ec01191ca3d73d/1j51531s8';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>