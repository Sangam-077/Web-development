// Mobile Menu Toggle
document.getElementById('mobile-menu-btn').addEventListener('click', function() {
    const mainNav = document.getElementById('main-nav');
    mainNav.classList.toggle('active');
});

// Smooth Scroll for Nav Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Newsletter Form Validation
const newsletterForm = document.getElementById('newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('newsletter-email').value.trim();
        if (/^\S+@\S+\.\S+$/.test(email)) {
            alert('Thank you for subscribing!');
            this.reset();
        } else {
            alert('Please enter a valid email address.');
        }
    });
}

// Review Form Validation
const reviewForm = document.getElementById('review-form');
if (reviewForm) {
    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const reviewText = document.getElementById('review-text').value.trim();
        const rating = document.querySelector('input[name="rating"]:checked');
        
        if (!rating) {
            alert('Please select a rating.');
            return;
        }
        if (reviewText.length < 10) {
            alert('Please write a review with at least 10 characters.');
            return;
        }
        
        alert('Thank you for your review!');
        this.reset();
    });
}

// Lazy Load Images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[data-src]');
    if (images.length > 0) {
        const imageOptions = {
            threshold: 0,
            rootMargin: "50px 0px"
        };

        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        }, imageOptions);

        images.forEach(img => imageObserver.observe(img));
    }
});

// Swiper Initialization (for home page)
document.addEventListener('DOMContentLoaded', function() {
    const swiperContainer = document.querySelector('.mySwiper');
    if (swiperContainer && typeof Swiper !== 'undefined') {
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            loop: true,
            centeredSlides: true,
            speed: 800,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40
                }
            }
        });
    }
});

// Timeline animation on scroll (for about page)
document.addEventListener('DOMContentLoaded', () => {
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    if (timelineItems.length > 0) {
        // Fallback: Make items visible if IntersectionObserver is unsupported
        if (!('IntersectionObserver' in window)) {
            timelineItems.forEach(item => item.classList.add('visible'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        timelineItems.forEach(item => {
            observer.observe(item);
        });
    }
});

// Auth forms validation (for login/register pages)
document.addEventListener('DOMContentLoaded', () => {
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');

    if (signInForm) {
        signInForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('userEmail').value.trim();
            const password = document.getElementById('userPass').value.trim();

            if (!validateEmail(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            if (password.length < 6) {
                alert('Password must be at least 6 characters long.');
                return;
            }

            alert('Login successful! Redirecting to your dashboard...');
            // In production: window.location.href = 'dashboard.php';
        });
    }

    if (signUpForm) {
        signUpForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('regEmail').value.trim();
            const password = document.getElementById('regPass').value.trim();
            const confirmPassword = document.getElementById('confirmPass').value.trim();
            const terms = document.querySelector('input[name="terms"]');

            if (firstName.length < 2 || lastName.length < 2) {
                alert('Names must be at least 2 characters long.');
                return;
            }
            if (!validateEmail(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            if (password.length < 6) {
                alert('Password must be at least 6 characters long.');
                return;
            }
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return;
            }
            if (!terms || !terms.checked) {
                alert('Please agree to the Terms of Service and Privacy Policy.');
                return;
            }

            alert('Registration successful! Check your email for verification.');
            // In production: window.location.href = 'login.php';
        });
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});

// Menu Page Specific Functionality
document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.menu-page')) return;
    
    console.log('Menu page detected - initializing menu functionality...');
    
    const filterButtons = document.querySelectorAll('.filter-btn');
    const categorySections = document.querySelectorAll('.category-section');
    
    console.log('Found filter buttons:', filterButtons.length);
    console.log('Found category sections:', categorySections.length);
    
    let isAllSelected = true;
    let observer = null;
    
    // Function to filter category sections
    function filterByCategory(targetCategory) {
        console.log('Filtering by category:', targetCategory);
        
        isAllSelected = (targetCategory === 'All');
        
        let visibleCount = 0;
        
        categorySections.forEach(section => {
            const sectionCategory = section.getAttribute('data-category');
            
            if (targetCategory === 'All' || sectionCategory === targetCategory) {
                section.style.display = 'block';
                section.style.opacity = '0';
                setTimeout(() => {
                    section.style.transition = 'opacity 0.5s ease';
                    section.style.opacity = '1';
                }, 50);
                visibleCount++;
            } else {
                section.style.display = 'none';
                section.style.opacity = '0';
            }
        });
        
        console.log(`Filtered to ${visibleCount} visible sections`);
        
        // Toggle scroll observer based on filter
        if (isAllSelected) {
            initScrollSpy();
        } else {
            if (observer) {
                categorySections.forEach(section => observer.unobserve(section));
            }
        }
    }
    
    // Add click event listeners to filter buttons
    
    // Initialize scroll-spy observer
    function initScrollSpy() {
        if ('IntersectionObserver' in window) {
            observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && isAllSelected) {
                        const category = entry.target.getAttribute('data-category');
                        filterButtons.forEach(btn => {
                            btn.classList.toggle('active', btn.getAttribute('data-category') === category);
                        });
                        // Remove active from "All" when a specific section is in view
                        const allBtn = document.querySelector('.filter-btn[data-category="All"]');
                        if (allBtn) allBtn.classList.remove('active');
                    }
                });
            }, {
                threshold: 0.3, // Activate when 30% of section is in view
                rootMargin: '-150px 0px -150px 0px' // Adjust for header and better detection
            });
            
            categorySections.forEach(section => observer.observe(section));
        } else {
            console.warn('IntersectionObserver not supported - scroll-spy disabled');
        }
    }
    
    // Initialize with 'All' filter active
    if (filterButtons.length > 0) {
        filterByCategory('All');
        console.log('Menu filtering and scroll-spy initialized successfully');
    }
});

// Menu Modal (Add to Cart) Functionality
document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.menu-page')) {
        return;
    }
    
    console.log('Initializing menu modal functionality...');
    
    const modal = document.getElementById('allergy-modal');
    const closeBtn = document.querySelector('.modal-close');
    const addButtons = document.querySelectorAll('.add-btn');
    const modalTitle = document.getElementById('modal-item-name');
    const inherentAllergy = document.getElementById('modal-inherent');
    const notesInput = document.getElementById('special-notes');
    const qtyInput = document.getElementById('item-qty');
    const confirmBtn = document.getElementById('confirm-add');
    const allergenChips = document.querySelectorAll('.chip input');
    
    if (!modal || !closeBtn || addButtons.length === 0) {
        console.warn('Modal elements not found - modal functionality disabled');
        return;
    }
    
    let currentItem = null;
    
    // Add to cart button click handlers
    addButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.disabled) {
                console.log('Button is disabled - item out of stock');
                alert('Sorry, this item is currently out of stock.');
                return;
            }
            
            currentItem = {
                id: this.getAttribute('data-id'),
                name: this.getAttribute('data-name'),
                allergy: this.getAttribute('data-allergy') || 'None'
            };
            
            console.log('Opening modal for item:', currentItem);
            
            // Populate modal with item data
            if (modalTitle) modalTitle.textContent = currentItem.name;
            if (inherentAllergy) {
                inherentAllergy.textContent = currentItem.allergy !== 'None' && currentItem.allergy !== '' 
                    ? `Contains: ${currentItem.allergy}` 
                    : 'No known allergens.';
            }
            
            // Reset form
            allergenChips.forEach(chip => chip.checked = false);
            if (notesInput) notesInput.value = '';
            if (qtyInput) qtyInput.value = 1;
            
            // Show modal
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
        });
    });
    
    // Close modal handlers
    closeBtn.addEventListener('click', () => {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        console.log('Modal closed via close button');
    });
    
    // Close modal when clicking outside
    modal.addEventListener('click', e => {
        if (e.target === modal) {
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            console.log('Modal closed via outside click');
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            console.log('Modal closed via Escape key');
        }
    });
    
    // Quantity control buttons
    const qtyButtons = document.querySelectorAll('.qty-btn');
    qtyButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!qtyInput) return;
            
            let qty = parseInt(qtyInput.value) || 1;
            const step = parseInt(this.getAttribute('data-step')) || 0;
            qty += step;
            qtyInput.value = Math.max(1, qty);
            
            console.log('Quantity updated to:', qty);
        });
    });
    
    // Confirm add to cart
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if (!currentItem) {
                console.error('No current item selected');
                return;
            }
            
            const selectedAllergens = Array.from(allergenChips)
                .filter(chip => chip.checked)
                .map(chip => chip.value);
            
            const orderData = {
                item_id: currentItem.id,
                item_name: currentItem.name,
                quantity: qtyInput ? qtyInput.value : 1,
                notes: notesInput ? notesInput.value : '',
                allergens_to_avoid: selectedAllergens
            };
            
            console.log('Adding to cart:', orderData);
            
            // Show success message
            const qtyText = qtyInput ? qtyInput.value : 1;
            let message = `Added ${qtyText}x ${currentItem.name} to cart!`;
            if (selectedAllergens.length > 0) {
                message += `\nAllergens to avoid: ${selectedAllergens.join(', ')}`;
            }
            if (notesInput && notesInput.value.trim()) {
                message += `\nSpecial notes: ${notesInput.value.trim()}`;
            }
            
            alert(message);
            
            // Close modal
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            
            // In a real application, you would send this data to your server
            // Example: 
            // fetch('add_to_cart.php', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify(orderData)
            // });
        });
    }
    
    console.log('Menu modal functionality initialized successfully');
});
// Menu Page Specific Functionality
document.addEventListener('DOMContentLoaded', function () {
  if (!document.querySelector('.menu-page')) return;

  const filterButtons = document.querySelectorAll('.filter-btn');
  const categorySections = document.querySelectorAll('.category-section');

  // --- helpers ---
  function getHeaderOffset() {
    // pick your site header selector here if you have a specific one
    const header = document.querySelector('header, .site-header, .main-header, .navbar, .topbar');
    return header ? header.offsetHeight + 12 : 0; // +12px breathing room
  }
  function smoothScrollToEl(el) {
    const y = el.getBoundingClientRect().top + window.pageYOffset - getHeaderOffset();
    window.scrollTo({ top: y, behavior: 'smooth' });
  }
  // Give sections a CSS scroll-margin-top too (works with scrollIntoView if used anywhere else)
  const headerOffset = getHeaderOffset();
  categorySections.forEach(sec => (sec.style.scrollMarginTop = headerOffset + 'px'));

  function filterByCategory(targetCategory) {
    categorySections.forEach(section => {
      const sectionCategory = section.getAttribute('data-category');
      const show = targetCategory === 'All' || sectionCategory === targetCategory;
      section.style.display = show ? 'block' : 'none';
      section.style.opacity = show ? '1' : '0';
    });
  }

  // click handlers
  filterButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const targetCategory = this.getAttribute('data-category');

      // active state
      filterButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');

      // filter
      filterByCategory(targetCategory);

      // wait for layout -> then scroll to the category title
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          if (targetCategory === 'All') {
            const first = document.querySelector('.category-section'); // Breakfast
            if (first) smoothScrollToEl(first);
          } else {
            const section = document.querySelector(`.category-section[data-category="${targetCategory}"]`);
            if (section) smoothScrollToEl(section);
          }
        });
      });
    });
  });

  // Initial state: show all, but start from Breakfast text (not the big page title)
  filterByCategory('All');
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      const first = document.querySelector('.category-section');
      if (first) smoothScrollToEl(first);
    });
  });
});

