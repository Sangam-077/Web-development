// Mobile menu toggle
document.getElementById('mobile-menu-btn').addEventListener('click', function() {
  const menu = document.getElementById('mobile-nav');
  menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});

// Shopping Cart Functionality
let cart = [];
document.querySelectorAll('.menu-add-btn').forEach(button => {
  button.addEventListener('click', function() {
    const itemElement = this.closest('.menu-item');
    const itemName = itemElement.querySelector('.menu-title').textContent;
    const itemPrice = parseFloat(itemElement.querySelector('.menu-price').textContent.replace('$', ''));
    const size = itemElement.querySelector('.menu-option:nth-child(1)').value;
    const milk = itemElement.querySelector('.menu-option:nth-child(2)')?.value || 'none';
    cart.push({ name: itemName, price: itemPrice, size: size, milk: milk });
    updateCart();
  });
});

function updateCart() {
  const cartItems = document.getElementById('cart-items');
  cartItems.innerHTML = '';
  let total = 0;
  cart.forEach(item => {
    const itemDiv = document.createElement('div');
    itemDiv.textContent = `${item.name} (${item.size}, ${item.milk}) - $${item.price.toFixed(2)}`;
    cartItems.appendChild(itemDiv);
    total += item.price;
  });
  document.getElementById('cart-total').textContent = `Total: $${total.toFixed(2)}`;
}

// Animate menu items on load
document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item');

  // Set initial state
  menuItems.forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(20px)';
    item.style.transition = 'all 0.6s ease-out';
  });

  // Animate with staggered delay
  menuItems.forEach((item, index) => {
    setTimeout(() => {
      item.classList.add('visible');
      item.style.opacity = '1';
      item.style.transform = 'translateY(0)';
    }, 200 * index);
  });
});