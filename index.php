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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navigation Bar -->
  <header id="main-header">
    <div id="header-container">
      <div id="nav-content">
        <div id="logo-group">
          <img src="Images/logo.webp" alt="Ravenhill Coffee Logo" id="logo-image">
          <span id="logo-text">Ravenhill Coffee House</span>
        </div>
        <button id="mobile-menu-btn">
          <i class="fas fa-bars" id="menu-icon"></i>
        </button>
        <nav id="main-nav">
          <a href="#hero-section" class="nav-item">Home</a>
          <div class="nav-item dropdown">
            Menu
            <div class="dropdown-menu">
              <a href="#featured-section" class="dropdown-item">Featured Items</a>
              <a href="#" class="dropdown-item">Coffee</a>
              <a href="#" class="dropdown-item">Pastries</a>
              <a href="#" class="dropdown-item">Specials</a>
            </div>
          </div>
          <a href="#about-section" class="nav-item">About</a>
          <a href="#contact-section" class="nav-item">Contact</a>
        </nav>
        <div id="nav-actions">
          <a href="#" class="icon-link"><i class="fas fa-search"></i></a>
          <a href="#" class="icon-link"><i class="far fa-heart"></i></a>
          <a href="#" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
          <a href="#" id="login-link">Login</a>
          <a href="#" id="register-link">Register</a>
        </div>
      </div>
      <nav id="mobile-nav">
        <div id="mobile-nav-content">
          <a href="#hero-section" class="mobile-nav-item">Home</a>
          <a href="#featured-section" class="mobile-nav-item">Menu</a>
          <a href="#about-section" class="mobile-nav-item">About</a>
          <a href="#contact-section" class="mobile-nav-item">Contact</a>
          <div id="mobile-nav-actions">
            <a href="#" class="mobile-icon-link"><i class="fas fa-search"></i></a>
            <a href="#" class="mobile-icon-link"><i class="far fa-heart"></i></a>
            <a href="#" class="mobile-icon-link"><i class="fas fa-shopping-cart"></i></a>
            <a href="#" class="mobile-login-link">Login</a>
            <a href="#" class="mobile-register-link">Register</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="hero-section">
    <div id="hero-container">
      <div id="hero-content">
        <h1 id="hero-title">Crafted Coffee, <span id="hero-highlight">Perfect Moments</span></h1>
        <p id="hero-text">Experience the finest specialty coffee, handcrafted with passion and served with care in the heart of the city.</p>
        <div id="hero-buttons">
          <a id="order-now-btn" href="#">Order Now</a>
          <a id="book-table-btn" href="#">Book a Table</a>
        </div>
      </div>
      <div id="hero-image-container">
        <img src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Coffee scene" id="hero-image">
      </div>
    </div>
  </section>

  <!-- Featured Section -->
  <section id="featured-section">
    <div id="featured-container">
      <div id="featured-header">
        <span id="featured-subtitle">OUR SPECIALTY</span>
        <h2 id="featured-title">Signature Coffee & Treats</h2>
      </div>
      <div id="featured-grid">
        <div class="featured-item">
          <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Honey Lavender Latte" class="featured-image">
          <h3 class="featured-name">Honey Lavender Latte</h3>
          <p class="featured-price">$6.50</p>
          <p class="featured-description">A soothing blend of espresso, steamed milk, and house-made honey lavender syrup.</p>
          <button class="menu-add-btn">Add to Cart</button>
        </div>
        <div class="featured-item">
          <img src="Images/es.jpeg" alt="Artisan Espresso" class="featured-image">
          <h3 class="featured-name">Artisan Espresso</h3>
          <p class="featured-price">$4.00</p>
          <p class="featured-description">Single-origin espresso with rich, bold flavors and a smooth finish.</p>
          <button class="menu-add-btn">Add to Cart</button>
        </div>
        <div class="featured-item">
          <img src="Images/cross.jpeg" alt="Croissant" class="featured-image">
          <h3 class="featured-name">Butter Croissant</h3>
          <p class="featured-price">$3.50</p>
          <p class="featured-description">Flaky, buttery croissant baked fresh daily in our kitchen.</p>
          <button class="menu-add-btn">Add to Cart</button>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about-section">
    <div id="about-container">
      <div id="about-content">
        <div id="about-image-container">
          <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&auto=format&fit=crop&w=1887&q=80" alt="Coffee shop interior" id="about-image">
        </div>
        <div id="about-text">
          <span id="about-subtitle">OUR STORY</span>
          <h2 id="about-title">More Than Just a Coffee House</h2>
          <p id="about-paragraph-1">Founded in 2009 by Fleur Studd and Jason Scheletus, Ravenhill Coffee House began as a passion project to bring fresh, in-season, traceable, high-quality coffee to Melbourne. Based in the vibrant Prahran Market, we engage with a community that values quality produce, seasonality, and provenance.</p>
          <p id="about-paragraph-2">We are dedicated to sourcing, roasting, and sharing exceptional coffee in a sustainable, respectful, and responsible way. By partnering directly with farmers worldwide, we ensure fair trade practices and the highest quality beans, making every cup a story of craftsmanship and care.</p>
          <a href="#" id="about-link">Learn More About Us</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials-section">
    <div id="testimonials-container">
      <div id="testimonials-header">
        <span id="testimonials-subtitle">WHAT OUR CUSTOMERS SAY</span>
        <h2 id="testimonials-title">Coffee That Brings People Together</h2>
      </div>
      <div id="testimonials-grid">
        <div class="testimonial-item">
          <div class="testimonial-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="testimonial-text">"The honey lavender latte is life-changing! I come here every Saturday morning for my weekly treat."</p>
          <div class="testimonial-author">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah J." class="testimonial-image">
            <div>
              <h4 class="testimonial-name">Sarah J.</h4>
              <p class="testimonial-role">Regular Customer</p>
            </div>
          </div>
        </div>
        <div class="testimonial-item">
          <div class="testimonial-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <p class="testimonial-text">"As a coffee connoisseur, I can confidently say Ravenhill serves some of the best espresso in the city."</p>
          <div class="testimonial-author">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael T." class="testimonial-image">
            <div>
              <h4 class="testimonial-name">Michael T.</h4>
              <p class="testimonial-role">Coffee Blogger</p>
            </div>
          </div>
        </div>
        <div class="testimonial-item">
          <div class="testimonial-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <p class="testimonial-text">"The atmosphere is perfect for working remotely. Great coffee, fast WiFi, and comfortable seating."</p>
          <div class="testimonial-author">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Jessica L." class="testimonial-image">
            <div>
              <h4 class="testimonial-name">Jessica L.</h4>
              <p class="testimonial-role">Digital Nomad</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Review Section -->
  <section id="review-section">
    <div id="review-container">
      <h3 id="review-title">Share Your Feedback</h3>
      <form id="review-form">
        <label for="review-text">Your Review:</label>
        <textarea id="review-text" placeholder="Write your review here" required></textarea>
        <button type="submit" id="submit-review-btn">Submit Review</button>
      </form>
    </div>
  </section>

  <!-- Newsletter Section -->
  <section id="newsletter-section">
    <div id="newsletter-container">
      <h2 id="newsletter-title">Join Our Coffee Community</h2>
      <p id="newsletter-text">Subscribe to our newsletter and be the first to know about new blends, special events, and exclusive offers.</p>
      <form id="newsletter-form">
        <input type="email" id="newsletter-email" placeholder="Your email address" required>
        <button type="submit" id="subscribe-btn">Subscribe</button>
      </form>
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
