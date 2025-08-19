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
          <a href="index.php" class="nav-item active">Home</a>
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

  <!-- Hero Section -->
  <section id="hero-section">
    <div id="hero-container">
      <div id="hero-content">
        <h1 id="hero-title">Best Coffee, <span id="hero-highlight">Make Your Day Great</span></h1>
        <p id="hero-text">Welcome to our coffee paradise, where every bean tells a story and every cup sparks joy.</p>
        <div id="hero-buttons">
          <a id="order-now-btn" href="#">Order Now</a>
          <a id="book-table-btn" href="#">Book Table</a>
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
          <p class="featured-description">A soothing blend of espresso and honey lavender syrup.</p>
          <button class="menu-add-btn" data-item="Honey Lavender Latte">Add to Cart</button>
        </div>
        <div class="featured-item">
          <img src="Images/es.jpeg" alt="Artisan Espresso" class="featured-image">
          <h3 class="featured-name">Artisan Espresso</h3>
          <p class="featured-price">$4.00</p>
          <p class="featured-description">Rich, bold single-origin espresso.</p>
          <button class="menu-add-btn" data-item="Artisan Espresso">Add to Cart</button>
        </div>
        <div class="featured-item">
          <img src="Images/cross.jpeg" alt="Butter Croissant" class="featured-image">
          <h3 class="featured-name">Butter Croissant</h3>
          <p class="featured-price">$3.50</p>
          <p class="featured-description">Flaky, buttery croissant baked fresh.</p>
          <button class="menu-add-btn" data-item="Butter Croissant">Add to Cart</button>
        </div>
      </div>
      <a href="menu.php" class="view-menu-btn">View Full Menu</a>
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

  <!-- Footer Section -->
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
