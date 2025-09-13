// Mobile Menu Toggle
// Handles the toggle functionality for the mobile navigation menu
document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
    const mainNav = document.getElementById('main-nav');
    if (mainNav) mainNav.classList.toggle('active');
});

// Smooth Scroll for Nav Links
// Adds smooth scrolling behavior to anchor links starting with '#'
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
            const mainNav = document.getElementById('main-nav');
            if (mainNav?.classList.contains('active')) {
                mainNav.classList.remove('active');
            }
        }
    });
});


// Newsletter Form Validation
// Validates and handles submission of the newsletter form
const newsletterForm = document.getElementById('newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('newsletter-email')?.value.trim();
        if (email && /^\S+@\S+\.\S+$/.test(email)) {
            fetch('index.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=subscribe&email=${encodeURIComponent(email)}`
            })
            .then(res => res.json())
            .then(data => {
                showNotification(data.status, data.message || (data.status === 'success' ? 'Thank you for subscribing!' : 'Failed to subscribe.'));
                if (data.status === 'success') this.reset();
            })
            .catch(err => {
                console.error('Newsletter subscription error:', err);
                showNotification('error', 'Failed to subscribe.');
            });
        } else {
            showNotification('error', 'Please enter a valid email address.');
        }
    });
}


// Review Form Validation
// Validates and handles submission of the review form
const reviewForm = document.getElementById('review-form');
if (reviewForm) {
    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const reviewText = document.getElementById('review-text')?.value.trim();
        const rating = document.querySelector('input[name="rating"]:checked');
        if (!rating) {
            showNotification('error', 'Please select a rating.');
            return;
        }
        if (!reviewText || reviewText.length < 10) {
            showNotification('error', 'Please write a review with at least 10 characters.');
            return;
        }
        fetch('index.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=submit_review&rating=${rating.value}&comment=${encodeURIComponent(reviewText)}`
        })
        .then(res => res.json())
        .then(data => {
            showNotification(data.status, data.message || (data.status === 'success' ? 'Thanks for your review!' : 'Failed to submit review.'));
            if (data.status === 'success') this.reset();
        })
        .catch(err => {
            console.error('Review submission error:', err);
            showNotification('error', 'Failed to submit review.');
        });
    });
}
// Notification System
// Displays temporary notifications with specified type and message
function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <span>${message}</span>
        <button class="notification-close">&times;</button>
    `;
    document.body.appendChild(notification);
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
    notification.querySelector('.notification-close')?.addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => notification.remove(), 300);
    });
}

// Lazy Load Images
// Implements lazy loading for images with data-src attribute
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[data-src]');
    if (images.length > 0 && 'IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        }, { threshold: 0, rootMargin: '50px 0px' });
        images.forEach(img => imageObserver.observe(img));
    } else {
        images.forEach(img => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }
});

// Swiper Initialization (for home page)
// Initializes the Swiper slider if the container exists
document.addEventListener('DOMContentLoaded', function() {
    const swiperContainer = document.querySelector('.mySwiper');
    if (swiperContainer && typeof Swiper !== 'undefined') {
        new Swiper('.mySwiper', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            loop: true,
            centeredSlides: true,
            speed: 800,
            autoplay: { delay: 3000, disableOnInteraction: false },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            pagination: { el: '.swiper-pagination', clickable: true, dynamicBullets: true },
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 40 }
            }
        });
    }
});

// Timeline Animation on Scroll (for about page)
// Animates timeline items when they enter the viewport
document.addEventListener('DOMContentLoaded', () => {
    const timelineItems = document.querySelectorAll('.timeline-item');
    if (timelineItems.length > 0) {
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
        timelineItems.forEach(item => observer.observe(item));
    }
});

// Auth Forms Validation (for login/register pages)
// Validates login and registration forms
document.addEventListener('DOMContentLoaded', () => {
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');

    // Handle Facebook login button click
    const fbBtn = document.getElementById('fb-btn');
    if (fbBtn) {
        fbBtn.addEventListener('click', handleFacebookSignIn);
    }

    if (signInForm) {
        signInForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('userEmail')?.value.trim();
            const password = document.getElementById('userPass')?.value.trim();
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showNotification('error', 'Please enter a valid email address.');
                return;
            }
            if (!password || password.length < 6) {
                showNotification('error', 'Password must be at least 6 characters long.');
                return;
            }
            
            // Submit the form via AJAX to preserve form data on error
            const formData = new FormData(signInForm);
            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Check if response contains error
                if (data.includes('error')) {
                    // Replace the form section with the response to show errors
                    const formSection = data.match(/<div class="form-section">([\s\S]*?)<\/div>/);
                    if (formSection) {
                        document.querySelector('.form-section').innerHTML = formSection[0];
                    }
                    // Re-attach event listeners
                    attachAuthListeners();
                } else {
                    // Successful login, redirect
                    window.location.href = 'index.php';
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                showNotification('error', 'An error occurred during login.');
            });
        });
    }

    if (signUpForm) {
        signUpForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const firstName = document.getElementById('firstName')?.value.trim();
            const lastName = document.getElementById('lastName')?.value.trim();
            const email = document.getElementById('regEmail')?.value.trim();
            const password = document.getElementById('regPass')?.value.trim();
            const confirmPassword = document.getElementById('confirmPass')?.value.trim();
            const terms = document.querySelector('input[name="terms"]');
            
            // Validate form
            let isValid = true;
            let errorMessage = '';
            
            if (!firstName || firstName.length < 2 || !lastName || lastName.length < 2) {
                isValid = false;
                errorMessage = 'Names must be at least 2 characters long.';
            } else if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
            } else if (!password || password.length < 6) {
                isValid = false;
                errorMessage = 'Password must be at least 6 characters long.';
            } else if (password !== confirmPassword) {
                isValid = false;
                errorMessage = 'Passwords do not match.';
                // Focus on password fields and clear them
                document.getElementById('regPass').focus();
                document.getElementById('regPass').value = '';
                document.getElementById('confirmPass').value = '';
            } else if (!terms?.checked) {
                isValid = false;
                errorMessage = 'Please agree to the Terms of Service and Privacy Policy.';
            }
            
            if (!isValid) {
                showNotification('error', errorMessage);
                return;
            }
            
            // Submit the form via AJAX to preserve form data on error
            const formData = new FormData(signUpForm);
            fetch('register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Check if response contains error
                if (data.includes('error')) {
                    // Replace the form section with the response to show errors
                    const formSection = data.match(/<div class="form-section">([\s\S]*?)<\/div>/);
                    if (formSection) {
                        document.querySelector('.form-section').innerHTML = formSection[0];
                    }
                    // Re-attach event listeners
                    attachAuthListeners();
                } else {
                    // Successful registration, redirect
                    window.location.href = 'index.php';
                }
            })
            .catch(error => {
                console.error('Registration error:', error);
                showNotification('error', 'An error occurred during registration.');
            });
        });
    }
});

// [Previous content remains the same until handleGoogleSignIn]

// Handle Google Sign-In
function handleGoogleSignIn(response) {
    fetch('social_login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            provider: 'google',
            credential: response.credential
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = 'profile.php'; // Redirect to profile page
        } else {
            showNotification('error', data.message || 'Google sign-in failed.');
        }
    })
    .catch(error => {
        console.error('Google sign-in error:', error);
        showNotification('error', 'Google sign-in failed.');
    });
}

// Handle Facebook Sign-In
function handleFacebookSignIn() {
    if (typeof FB !== 'undefined') {
        FB.login(function(response) {
            if (response.authResponse) {
                const accessToken = response.authResponse.accessToken;
                fetch('social_login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        provider: 'facebook',
                        access_token: accessToken
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = 'profile.php'; // Redirect to profile page
                    } else {
                        showNotification('error', data.message || 'Facebook sign-in failed.');
                    }
                })
                .catch(error => {
                    console.error('Facebook sign-in error:', error);
                    showNotification('error', 'Facebook sign-in failed.');
                });
            } else {
                showNotification('error', 'Facebook sign-in was cancelled.');
            }
        }, {scope: 'email,public_profile'});
    } else {
        showNotification('error', 'Facebook SDK not loaded.');
    }
}




// Re-attach event listeners after form replacement
function attachAuthListeners() {
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');
    
    if (signInForm) {
        // Re-attach login submit handler
        signInForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('userEmail')?.value.trim();
            const password = document.getElementById('userPass')?.value.trim();
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showNotification('error', 'Please enter a valid email address.');
                return;
            }
            if (!password || password.length < 6) {
                showNotification('error', 'Password must be at least 6 characters long.');
                return;
            }
            const formData = new FormData(signInForm);
            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('error')) {
                    const formSection = data.match(/<div class="form-section">([\s\S]*?)<\/div>/);
                    if (formSection) {
                        document.querySelector('.form-section').innerHTML = formSection[0];
                    }
                    attachAuthListeners();
                } else {
                    window.location.href = 'index.php';
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                showNotification('error', 'An error occurred during login.');
            });
        });
    }
    
    if (signUpForm) {
        // Re-attach registration submit handler
        signUpForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const firstName = document.getElementById('firstName')?.value.trim();
            const lastName = document.getElementById('lastName')?.value.trim();
            const email = document.getElementById('regEmail')?.value.trim();
            const password = document.getElementById('regPass')?.value.trim();
            const confirmPassword = document.getElementById('confirmPass')?.value.trim();
            const terms = document.querySelector('input[name="terms"]');
            
            let isValid = true;
            let errorMessage = '';
            
            if (!firstName || firstName.length < 2 || !lastName || lastName.length < 2) {
                isValid = false;
                errorMessage = 'Names must be at least 2 characters long.';
            } else if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
            } else if (!password || password.length < 6) {
                isValid = false;
                errorMessage = 'Password must be at least 6 characters long.';
            } else if (password !== confirmPassword) {
                isValid = false;
                errorMessage = 'Passwords do not match.';
                document.getElementById('regPass').focus();
                document.getElementById('regPass').value = '';
                document.getElementById('confirmPass').value = '';
            } else if (!terms?.checked) {
                isValid = false;
                errorMessage = 'Please agree to the Terms of Service and Privacy Policy.';
            }
            
            if (!isValid) {
                showNotification('error', errorMessage);
                return;
            }
            
            const formData = new FormData(signUpForm);
            fetch('register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('error')) {
                    const formSection = data.match(/<div class="form-section">([\s\S]*?)<\/div>/);
                    if (formSection) {
                        document.querySelector('.form-section').innerHTML = formSection[0];
                    }
                    attachAuthListeners();
                } else {
                    window.location.href = 'index.php';
                }
            })
            .catch(error => {
                console.error('Registration error:', error);
                showNotification('error', 'An error occurred during registration.');
            });
        });
    }
    
    // Re-attach FB button
    const fbBtn = document.getElementById('fb-btn');
    if (fbBtn) {
        fbBtn.addEventListener('click', handleFacebookSignIn);
    }
}

// Utility Function to Update Badge Counts
// Updates or removes badge elements based on count
function updateBadge(elementId, count) {
    let badge = document.querySelector(`#${elementId} .count-badge`);
    if (count > 0) {
        if (!badge) {
            badge = document.createElement('span');
            badge.className = 'count-badge';
            document.querySelector(`#${elementId}`).appendChild(badge);
        }
        badge.textContent = count;
    } else if (badge) {
        badge.remove();
    }
}

// Placeholder for showNotification (implement this function)
function showNotification(type, message) {
    // Example implementation (replace with your notification system)
    console.log(`[${type}] ${message}`);
    // You might want to use a library like Toastify or a custom alert
}

// Notification System
// Displays temporary notifications with specified type and message
function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <span>${message}</span>
        <button class="notification-close">&times;</button>
    `;
    document.body.appendChild(notification);
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
    notification.querySelector('.notification-close')?.addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => notification.remove(), 300);
    });
}

// Utility Function to Update Badge Counts
// Updates or removes badge elements based on count
function updateBadge(elementId, count) {
    let badge = document.querySelector(`#${elementId} .count-badge`);
    if (count > 0) {
        if (!badge) {
            badge = document.createElement('span');
            badge.className = 'count-badge';
            document.querySelector(`#${elementId}`).appendChild(badge);
        }
        badge.textContent = count;
    } else if (badge) {
        badge.remove();
    }
}

// Menu Page Specific Functionality
// Handles menu filtering and scroll spy behavior
document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.menu-page')) return;

    const filterButtons = document.querySelectorAll('.filter-btn');
    const categorySections = document.querySelectorAll('.category-section');
    let isAllSelected = true;
    let observer = null;

    function getHeaderOffset() {
        const header = document.querySelector('header');
        return header ? header.offsetHeight + 12 : 0;
    }

    function smoothScrollToEl(el) {
        const y = el.getBoundingClientRect().top + window.pageYOffset - getHeaderOffset();
        window.scrollTo({ top: y, behavior: 'smooth' });
    }

    const headerOffset = getHeaderOffset();
    categorySections.forEach(sec => (sec.style.scrollMarginTop = headerOffset + 'px'));

    function filterByCategory(targetCategory) {
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

        if (isAllSelected) {
            initScrollSpy();
        } else if (observer) {
            categorySections.forEach(section => observer.unobserve(section));
        }
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterByCategory(btn.getAttribute('data-category'));
            if (btn.getAttribute('data-category') !== 'All') {
                const section = document.querySelector(`.category-section[data-category="${btn.getAttribute('data-category')}"]`);
                if (section) smoothScrollToEl(section);
            }
        });
    });

    function initScrollSpy() {
        if ('IntersectionObserver' in window) {
            observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && isAllSelected) {
                        const category = entry.target.getAttribute('data-category');
                        filterButtons.forEach(btn => {
                            btn.classList.toggle('active', btn.getAttribute('data-category') === category);
                        });
                        const allBtn = document.querySelector('.filter-btn[data-category="All"]');
                        if (allBtn) allBtn.classList.remove('active');
                    }
                });
            }, { threshold: 0.3, rootMargin: `-${headerOffset}px 0px` });
            categorySections.forEach(section => observer.observe(section));
        }
    }

    filterByCategory('All');
    initScrollSpy();
});

// Cart and Wishlist Functionality
// Manages cart and wishlist interactions
document.addEventListener('DOMContentLoaded', function() {
    // Load Cart
    // Fetches and displays cart content
    async function loadCart() {
        const cartModal = document.getElementById('cart-modal');
        const cartModalContent = cartModal?.querySelector('.modal-content');
        if (!cartModalContent) return;

        cartModalContent.innerHTML = '<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i><p>Loading...</p></div>';

        try {
            const response = await fetch('cart_page.php?action=get_cart_html');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            cartModalContent.innerHTML = await response.text();
            attachCartListeners();
        } catch (error) {
            console.error('Error loading cart:', error);
            cartModalContent.innerHTML = '<p>Error loading cart. <button onclick="loadCart()">Retry</button></p>';
            showNotification('error', 'Failed to load cart.');
        }
    }

    // Attach Cart Listeners
    // Adds event listeners for cart item actions
    function attachCartListeners() {
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                const container = btn.closest('.qty-control');
                const input = container?.querySelector('.qty-input');
                const index = btn.closest('.cart-item-modal')?.dataset.index;
                if (!input || !index) return;
                let qty = parseInt(input.value) || 1;
                qty += (btn.textContent === '+' ? 1 : -1);
                qty = Math.max(1, qty);
                input.value = qty;

                try {
                    const response = await fetch('cart_page.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `action=update&index=${index}&quantity=${qty}`
                    });
                    const result = await response.json();
                    if (result.status === 'success') {
                        updateBadge('cart-btn', result.cartCount);
                        loadCart();
                    } else {
                        showNotification('error', result.message || 'Failed to update quantity.');
                    }
                } catch (error) {
                    console.error('Error updating quantity:', error);
                    showNotification('error', 'Failed to update quantity.');
                }
            });
        });

        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                const index = btn.closest('.cart-item-modal')?.dataset.index;
                if (!index) return;

                try {
                    const response = await fetch('cart_page.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `action=remove&index=${index}`
                    });
                    const result = await response.json();
                    if (result.status === 'success') {
                        updateBadge('cart-btn', result.cartCount);
                        loadCart();
                    } else {
                        showNotification('error', result.message || 'Failed to remove item.');
                    }
                } catch (error) {
                    console.error('Error removing item:', error);
                    showNotification('error', 'Failed to remove item.');
                }
            });
        });

        const promoBtn = document.querySelector('.apply-promo-btn');
        const promoInput = document.querySelector('.promo-input');
        if (promoBtn && promoInput) {
            promoBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                const code = promoInput.value.trim();
                if (!code) {
                    showNotification('error', 'Please enter a promo code.');
                    return;
                }
                try {
                    const response = await fetch('cart_page.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `action=apply_promo&code=${encodeURIComponent(code)}`
                    });
                    const result = await response.json();
                    showNotification(result.status === 'success' ? 'success' : 'error', result.message);
                    if (result.status === 'success') loadCart();
                } catch (error) {
                    console.error('Error applying promo:', error);
                    showNotification('error', 'Failed to apply promo code.');
                }
            });
        }

        const shippingSelect = document.querySelector('.shipping-select');
        if (shippingSelect) {
            shippingSelect.addEventListener('change', async (e) => {
                try {
                    const response = await fetch('cart_page.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `action=update_shipping&value=${shippingSelect.value}`
                    });
                    const result = await response.json();
                    if (result.status === 'success') loadCart();
                    else showNotification('error', 'Failed to update shipping.');
                } catch (error) {
                    console.error('Error updating shipping:', error);
                    showNotification('error', 'Failed to update shipping.');
                }
            });
        }
    }

    // Load Wishlist
    // Fetches and displays wishlist content
    async function loadWishlist() {
        const wishlistModal = document.getElementById('wishlist-modal');
        const wishlistContent = wishlistModal?.querySelector('.modal-content');
        if (!wishlistContent) return;

        wishlistContent.innerHTML = '<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i><p>Loading...</p></div>';

        try {
            const response = await fetch('cart_page.php?action=get_wishlist_html');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            wishlistContent.innerHTML = await response.text();
            attachWishlistListeners();
        } catch (error) {
            console.error('Error loading wishlist:', error);
            wishlistContent.innerHTML = '<p>Error loading wishlist. <button onclick="loadWishlist()">Retry</button></p>';
            showNotification('error', 'Failed to load wishlist.');
        }
    }

    // Attach Wishlist Listeners
    // Adds event listeners for wishlist item actions
    function attachWishlistListeners() {
        document.querySelectorAll('.remove-wish-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                const index = btn.closest('.wishlist-item')?.dataset.index;
                if (!index) return;
                try {
                    const response = await fetch('cart_page.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `action=remove_wish&index=${index}`
                    });
                    const result = await response.json();
                    if (result.status === 'success') {
                        loadWishlist();
                        updateBadge('wishlist-btn', result.wishlistCount);
                    } else {
                        showNotification('error', result.message || 'Failed to remove item.');
                    }
                } catch (error) {
                    console.error('Error removing wishlist item:', error);
                    showNotification('error', 'Failed to remove item.');
                }
            });
        });
    }

    // Allergy Modal and Add to Cart
    // Manages allergy modal and cart addition process
    const addButtons = document.querySelectorAll('.add-btn');
    const allergyModal = document.getElementById('allergy-modal');
    const modalClose = document.querySelector('#allergy-modal .modal-close');
    const confirmAdd = document.getElementById('confirm-add');
    const modalItemName = document.getElementById('modal-item-name');
    const modalInherent = document.getElementById('modal-inherent');
    const specialNotes = document.getElementById('special-notes');
    const itemQty = document.getElementById('item-qty');
    const qtyButtons = document.querySelectorAll('#allergy-modal .qty-btn');
    const chipInputs = document.querySelectorAll('#allergy-modal .chip input[type="checkbox"]');

    addButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            if (button.disabled) return;
            const product = {
                id: button.dataset.id,
                name: button.dataset.name,
                price: parseFloat(button.dataset.price || 0),
                allergens: button.dataset.allergy || 'None'
            };
            if (!product.id || !product.name) {
                console.error('Invalid product data:', button.dataset);
                showNotification('error', 'Invalid item selected.');
                return;
            }
            window.currentProduct = product; // Set global product for confirmation
            modalItemName.textContent = `Customize ${product.name}`;
            modalInherent.innerHTML = product.allergens !== 'None' ? `<i class="fas fa-exclamation-triangle"></i> Contains: ${product.allergens}` : '';
            specialNotes.value = '';
            itemQty.value = 1;
            chipInputs.forEach(input => input.checked = false);
            allergyModal.classList.add('show');
            allergyModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            console.log('Opening allergy modal for product:', product);
        });
    });

    if (modalClose) {
        modalClose.addEventListener('click', () => {
            allergyModal.classList.remove('show');
            allergyModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            delete window.currentProduct; // Clean up on close
        });
    }

    qtyButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            let qty = parseInt(itemQty.value) || 1;
            const step = parseInt(btn.dataset.step);
            qty = Math.max(1, qty + step);
            itemQty.value = qty;
        });
    });

    if (confirmAdd) {
        confirmAdd.addEventListener('click', async (e) => {
            e.preventDefault();
            const button = confirmAdd;
            if (button.disabled) return;

            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

            const currentProduct = window.currentProduct;
            if (!currentProduct) {
                showNotification('error', 'No item selected.');
                console.error('No current product set.');
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-check"></i> Add to Cart';
                return;
            }

            const allergensToAvoid = Array.from(chipInputs)
                .filter(input => input.checked)
                .map(input => input.value);
            const data = {
                action: 'add',
                item_id: currentProduct.id,
                quantity: parseInt(itemQty.value) || 1,
                allergens_to_avoid: allergensToAvoid,
                notes: specialNotes.value.trim()
            };
            console.log('Sending add to cart request with data:', data);

            try {
                const response = await fetch('cart_page.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const result = await response.json();
                console.log('Received response from cart_page.php:', result);
                if (result.status === 'success') {
                    showNotification('success', result.message || 'Item added to cart!');
                    updateBadge('cart-btn', result.cartCount);
                    allergyModal.classList.remove('show');
                    allergyModal.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                    itemQty.value = 1;
                    specialNotes.value = '';
                    chipInputs.forEach(input => input.checked = false);
                    delete window.currentProduct;
                    if (document.getElementById('cart-modal')?.classList.contains('show')) {
                        loadCart();
                    }
                } else {
                    showNotification('error', result.message || 'Failed to add item to cart.');
                }
            } catch (error) {
                console.error('Error adding to cart:', error);
                showNotification('error', `Failed to add item to cart. Error: ${error.message}`);
            } finally {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-check"></i> Add to Cart';
            }
        });
    }

    // Cart Modal
    const cartIcon = document.getElementById('cart-btn');
    const cartModal = document.getElementById('cart-modal');
    const closeCartModal = document.querySelector('#cart-modal .close-modal');

    if (cartIcon) {
        cartIcon.addEventListener('click', (e) => {
            e.preventDefault();
            loadCart();
            cartModal.classList.add('show');
            cartModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeCartModal) {
        closeCartModal.addEventListener('click', () => {
            cartModal.classList.remove('show');
            cartModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        });
    }

    if (cartModal) {
        cartModal.addEventListener('click', (e) => {
            if (e.target === cartModal) {
                cartModal.classList.remove('show');
                cartModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && cartModal?.classList.contains('show')) {
            cartModal.classList.remove('show');
            cartModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    });

    // Wishlist Modal
    const wishlistIcon = document.getElementById('wishlist-btn');
    const wishlistModal = document.getElementById('wishlist-modal');
    const closeWishlistModal = document.querySelector('#wishlist-modal .close-modal');

    if (wishlistIcon) {
        wishlistIcon.addEventListener('click', (e) => {
            e.preventDefault();
            loadWishlist();
            wishlistModal.classList.add('show');
            wishlistModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeWishlistModal) {
        closeWishlistModal.addEventListener('click', () => {
            wishlistModal.classList.remove('show');
            wishlistModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        });
    }

    if (wishlistModal) {
        wishlistModal.addEventListener('click', (e) => {
            if (e.target === wishlistModal) {
                wishlistModal.classList.remove('show');
                wishlistModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && wishlistModal?.classList.contains('show')) {
            wishlistModal.classList.remove('show');
            wishlistModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    });

    // Wishlist Heart Buttons
    document.querySelectorAll('.wishlist-heart').forEach(heart => {
        heart.addEventListener('click', async (e) => {
            e.preventDefault();
            const button = heart;
            if (button.disabled) return;

            button.disabled = true;
            button.classList.add('loading');

            const id = button.dataset.id;
            const isActive = button.classList.contains('active');
            const action = isActive ? 'remove_wish' : 'add_wish';

            try {
                const response = await fetch('cart_page.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `action=${action}&item_id=${id}`
                });
                const result = await response.json();
                if (result.status === 'success') {
                    button.classList.toggle('active');
                    button.querySelector('i').classList.toggle('far');
                    button.querySelector('i').classList.toggle('fas');
                    updateBadge('wishlist-btn', result.wishlistCount);
                    showNotification('success', result.message);
                    if (wishlistModal.classList.contains('show')) {
                        loadWishlist();
                    }
                } else {
                    showNotification('error', result.message);
                }
            } catch (error) {
                console.error('Error updating wishlist:', error);
                showNotification('error', 'Failed to update wishlist.');
            } finally {
                button.disabled = false;
                button.classList.remove('loading');
            }
        });
    });

    // Search Functionality
    // Search Functionality
// Handles search input and redirection
document.querySelectorAll('.icon-link i.fa-search').forEach(icon => {
    icon.closest('a')?.addEventListener('click', (e) => {
        e.preventDefault();
        const searchTerm = prompt('Enter search term:');
        if (searchTerm) {
            window.location.href = `menu.php?search=${encodeURIComponent(searchTerm)}`;
        }
    });
});
});
