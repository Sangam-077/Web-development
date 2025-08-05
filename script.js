// Mobile menu toggle
document.getElementById('mobile-menu-btn').addEventListener('click', function() {
  const menu = document.getElementById('mobile-nav');
  menu.classList.toggle('active');
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector(this.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
    // Close mobile menu if open
    const mobileNav = document.getElementById('mobile-nav');
    if (mobileNav.classList.contains('active')) {
      mobileNav.classList.remove('active');
    }
  });
});

// Navigation scroll effect
window.addEventListener('scroll', function() {
  const header = document.getElementById('main-header');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

// Shopping Cart Functionality
let cart = [];
document.querySelectorAll('.menu-add-btn').forEach(button => {
  button.addEventListener('click', function() {
    const itemElement = this.closest('.featured-item');
    const itemName = itemElement.querySelector('.featured-name').textContent;
    const itemPrice = parseFloat(itemElement.querySelector('.featured-price').textContent.replace('$', ''));
    cart.push({ name: itemName, price: itemPrice });
    updateCart();
  });
});

function updateCart() {
  const cartItems = document.getElementById('cart-items') || document.createElement('div');
  cartItems.id = 'cart-items';
  cartItems.innerHTML = '';
  let total = 0;
  cart.forEach(item => {
    const itemDiv = document.createElement('div');
    itemDiv.textContent = `${item.name} - $${item.price.toFixed(2)}`;
    cartItems.appendChild(itemDiv);
    total += item.price;
  });
  const cartTotal = document.getElementById('cart-total') || document.createElement('div');
  cartTotal.id = 'cart-total';
  cartTotal.textContent = `Total: $${total.toFixed(2)}`;
  if (!document.getElementById('cart-items')) {
    document.body.appendChild(cartItems);
    document.body.appendChild(cartTotal);
  }
}

// Animate featured items on load
document.addEventListener('DOMContentLoaded', () => {
  const featuredItems = document.querySelectorAll('.featured-item');

  // Set initial state
  featuredItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(20px)';
    item.style.transition = 'all 0.6s ease-out';
  });

  // Animate with staggered delay
  featuredItems.forEach((item, index) => {
    setTimeout(() => {
      item.style.opacity = '1';
      item.style.transform = 'translateY(0)';
    }, 200 * index);
  });
});

// Form submission handling
document.getElementById('review-form')?.addEventListener('submit', function(e) {
  e.preventDefault();
  alert('Thank you for your review!');
  this.reset();
});

document.getElementById('newsletter-form')?.addEventListener('submit', function(e) {
  e.preventDefault();
  alert('Thank you for subscribing!');
  this.reset();
});
