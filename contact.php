<?php
// PHP can be added here for dynamic content if needed
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
          <a href="index.php" class="nav-item">Home</a>
          <a href="menu.php" class="nav-item">Menu</a>
          <a href="about.php" class="nav-item">About Us</a>
          <a href="contact.php" class="nav-item active">Contact</a>
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


  <!-- Contact Hero Section -->
  <section id="contact-hero-section">
    <div id="contact-hero-container">
      <div id="contact-hero-content">
        <h1 id="contact-hero-title">Get in Touch with <span id="contact-hero-highlight">Ravenhill</span></h1>
        <p id="contact-hero-text">We’re here to connect with our coffee-loving community. Reach out to share your thoughts or visit us at our Prahran Market or Melbourne CBD cafés!</p>
        <a href="#connect-section" id="contact-us-btn">Contact Us</a>
      </div>
    </div>
  </section>

  <!-- Connect with Us Section -->
  <section id="connect-section">
    <div id="connect-container">
      <div id="connect-content">
        <h2 id="connect-title">Connect with Ravenhill Coffee House</h2>
        <p class="connect-text">Our passion for exceptional coffee extends to our commitment to community. Whether you have a question, feedback, or want to learn more about our sustainable practices, we’d love to hear from you.</p>
        <ul id="connect-info">
          <li class="connect-item">
            <i class="fas fa-map-marker-alt"></i>
            <a href="geo:-37.8182,144.9594?q=163+Commercial+Rd,+South+Yarra+VIC+3141" class="connect-link">Prahran Market, 163 Commercial Rd, South Yarra VIC 3141</a>
          </li>
          <li class="connect-item">
            <i class="fas fa-phone-alt"></i>
            <a href="tel:+61312345678" class="connect-link">(03) 1234-5678</a>
          </li>
          <li class="connect-item">
            <i class="fas fa-envelope"></i>
            <span>hello@ravenhillcoffee.com</span>
          </li>
        </ul>
      </div>
      <div id="connect-image-container">
        <img src="Images/cafe.jpeg" alt="Ravenhill Coffee House counter" id="connect-image">
      </div>
    </div>
  </section>

  <!-- Contact Form Section -->
  <section id="contact-form-section">
    <div id="contact-form-container">
      <h2 id="contact-form-title">Send Us a Message</h2>
      <p id="contact-form-text">Have a question or feedback? Fill out the form below, and we’ll get back to you as soon as possible.</p>
      <form id="contact-form">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Your Name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Your Email" required>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" placeholder="Subject" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Your Message" rows="5" required></textarea>
        </div>
        <button type="submit" id="submit-btn">Send Message</button>
      </form>
    </div>
  </section>

  <!-- CTA Section -->
  <section id="cta-section">
    <div class="cta-container">
      <div class="coffee-bean">
        <i class="fas fa-coffee"></i>
      </div>
      <h2 class="cta-title">Join Our Coffee Journey</h2>
      <p class="cta-subtitle">Visit us at Prahran Market or Melbourne CBD to experience coffee crafted with care.</p>
      <div class="cta-buttons">
        <a href="menu.php" class="cta-button">Explore Menu</a>
        <a href="about.php" class="cta-button">Learn About Us</a>
      </div>
    </div>
  </section>

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
              <span>Prahran Market, Melbourne</span>
            </li>
            <li class="contact-item">
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
</body>
</html>