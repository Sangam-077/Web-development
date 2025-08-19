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
          <a href="about.php" class="nav-item active">About Us</a>
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


  <!-- About Hero Section -->
  <section id="about-hero-section">
    <div id="about-hero-container">
      <div id="about-hero-content">
        <h1 id="about-hero-title">Our Story, <span id="about-hero-highlight">Crafted with Passion</span></h1>
        <p id="about-hero-text">Since 2009, Ravenhill Coffee House has crafted exceptional coffee with a focus on quality, sustainability, and community.</p>
        <a href="#welcome-section" id="explore-story-btn">Discover Our Journey</a>
      </div>
    </div>
  </section>

  <!-- Welcome to Ravenhill Coffee House Section -->
  <section id="welcome-section">
    <div id="welcome-container">
      <div id="welcome-content">
        <h2 id="welcome-title">Welcome to Ravenhill Coffee House</h2>
        <p class="welcome-text">Founded in 2009 by Fleur Studd and Jason Scheltus, Ravenhill Coffee House began at Prahran Market with a mission to redefine specialty coffee in Melbourne.</p>
        <p class="welcome-text">We source traceable, high-quality beans through direct trade partnerships, ensuring sustainability and fairness in every cup we serve.</p>
        <p class="welcome-text">Now in Melbourne CBD, our cozy cafés are community hubs where coffee lovers enjoy workshops, tastings, and exceptional brews.</p>
      </div>
      <div id="welcome-image-container">
        <img src="Images/interior.png" id="welcome-image">
      </div>
    </div>
  </section>

  <!-- Timeline Section -->
  <section id="timeline-section">
    <div id="timeline-container">
      <h2 id="timeline-title">Our Journey Through Time</h2>
      <div class="timeline">
        <div class="timeline-line"></div>
        <div class="timeline-item" data-year="2009">
          <div>
            <h3>Founded Ravenhill</h3>
            <p>Fleur Studd and Jason Scheltus founded Ravenhill Coffee House in Melbourne, with a mission to bring fresh, traceable, high-quality coffee to the city.</p>
          </div>
        </div>
        <div class="timeline-item" data-year="2010">
          <div>
            <h3>Prahran Market Opens</h3>
            <p>Opened our first shop and roastery at the vibrant Prahran Market, connecting with a community passionate about quality and sustainability.</p>
          </div>
        </div>
        <div class="timeline-item" data-year="2015">
          <div>
            <h3>Direct Farmer Partnerships</h3>
            <p>Established direct trade relationships with coffee farmers worldwide, ensuring fair practices and exceptional beans.</p>
          </div>
        </div>
        <div class="timeline-item" data-year="2020">
          <div>
            <h3>Sustainability Commitment</h3>
            <p>Launched initiatives for eco-friendly packaging and zero-waste roasting processes, reinforcing our commitment to sustainability.</p>
          </div>
        </div>
        <div class="timeline-item" data-year="2023">
          <div>
            <h3>Melbourne CBD Expansion</h3>
            <p>Opened our second location in Melbourne CBD, introducing our custom POS system to streamline operations.</p>
          </div>
        </div>
        <div class="timeline-item" data-year="2025">
          <div>
            <h3>Community Hub</h3>
            <p>Became a beloved community hub, hosting coffee workshops, tastings, and events to share our passion for specialty coffee.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section id="team-section">
    <div class="team-container">
      <h2 class="team-title">Meet Our Team</h2>
      <div class="team-grid">
        <div class="team-card">
          <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Fleur Studd">
          <div>
            <h3>Fleur Studd</h3>
            <p>Co-Founder & Head Roaster</p>
            <p>Passionate about sourcing the finest beans and crafting unique roasts.</p>
          </div>
        </div>
        <div class="team-card">
          <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Jason Scheltus">
          <div>
            <h3>Jason Scheltus</h3>
            <p>Co-Founder & Operations Manager</p>
            <p>Drives our commitment to sustainability and community engagement.</p>
          </div>
        </div>
        <div class="team-card">
          <img src="https://randomuser.me/api/portraits/women/67.jpg" alt="Emma Brown">
          <div>
            <h3>Emma Brown</h3>
            <p>Head Barista</p>
            <p>Creates unforgettable coffee experiences with her expertise and flair.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section id="values-section">
    <div class="values-container">
      <h2 class="values-title">Our Core Values</h2>
      <div class="values-grid">
        <div class="value-card">
          <i class="fas fa-leaf value-icon"></i>
          <h3>Sustainability</h3>
          <p>Committed to eco-friendly practices and ethical sourcing for a better planet.</p>
        </div>
        <div class="value-card">
          <i class="fas fa-coffee value-icon"></i>
          <h3>Quality</h3>
          <p>Delivering exceptional coffee through meticulous roasting and brewing.</p>
        </div>
        <div class="value-card">
          <i class="fas fa-users value-icon"></i>
          <h3>Community</h3>
          <p>Building connections through shared love for coffee and local engagement.</p>
        </div>
      </div>
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
        <a href="contact.php" class="cta-button">Get in Touch</a>
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