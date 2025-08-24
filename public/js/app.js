// App.js - Traditional JavaScript for Glowlin Earthy Bloom

// Utility functions
function showAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    
    // Insert at the top of the page
    const container = document.querySelector('main') || document.body;
    container.insertBefore(alertDiv, container.firstChild);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// Form validation
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('border-red-500');
            isValid = false;
        } else {
            input.classList.remove('border-red-500');
        }
    });
    
    return isValid;
}

// Cart functionality
function addToCart(productId, quantity = 1) {
    const button = event.target;
    const originalText = button.textContent;
    
    button.textContent = 'Adding...';
    button.disabled = true;

    // Get the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Make AJAX request to add to cart
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: new URLSearchParams({
            '_token': csrfToken,
            'product_id': productId,
            'quantity': quantity
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            showAlert(data.error, 'error');
            button.textContent = originalText;
            button.disabled = false;
        } else {
            // Show success message
            button.textContent = 'Added!';
            showAlert('Product added to cart successfully!', 'success');
            
            // Update cart count in the UI immediately
            updateCartCountUI(data.cart_count);
            
            // Try to refresh Livewire components if available
            if (window.Livewire) {
                window.Livewire.dispatch('cart-updated');
            }
            
            // Reset button after delay
            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        showAlert('Error adding product to cart. Please try again.', 'error');
        button.textContent = originalText;
        button.disabled = false;
    });
}

// Function to update cart count in the UI
function updateCartCountUI(count) {
    // Update all cart count elements with the cart-count class
    const cartCountElements = document.querySelectorAll('.cart-count');
    
    cartCountElements.forEach((element, index) => {
        element.textContent = count;
        element.style.display = count > 0 ? 'flex' : 'none';
    });
    
    // Also update any span elements that contain only numbers (likely cart counts)
    const allSpans = document.querySelectorAll('span');
    allSpans.forEach(element => {
        const text = element.textContent.trim();
        if (text && /^\d+$/.test(text) && element.classList.contains('bg-primary')) {
            // This looks like a cart count badge
            element.textContent = count;
            element.style.display = count > 0 ? 'flex' : 'none';
        }
    });
    
    // Update any elements with cart-related classes
    const cartElements = document.querySelectorAll('[class*="cart"]');
    cartElements.forEach(element => {
        const text = element.textContent.trim();
        if (text && /^\d+$/.test(text)) {
            element.textContent = count;
        }
    });
}

// Function to update cart count from the page
function updateCartCountFromPage() {
    // Try to refresh Livewire components if available
    if (window.Livewire) {
        window.Livewire.dispatch('cart-updated');
    }
    
    // Update cart count elements
    const cartCountElements = document.querySelectorAll('.cart-count');
    cartCountElements.forEach(element => {
        // Try to get the count from the element or increment it
        const currentCount = parseInt(element.textContent) || 0;
        element.textContent = currentCount + 1;
        element.style.display = 'flex';
    });
}


// User menu toggle
function toggleUserMenu() {
    const menu = document.getElementById('user-menu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}

// Mobile menu toggle
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}

// Search functionality
function searchProducts(query) {
    // This will be handled by Livewire search
}

// Quantity controls
function updateQuantity(input, change) {
    const currentValue = parseInt(input.value) || 0;
    const newValue = Math.max(1, currentValue + change);
    input.value = newValue;
    
    // Trigger change event for Livewire
    input.dispatchEvent(new Event('change'));
}

// Image preview for file uploads
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Smooth scrolling for anchor links
function smoothScrollTo(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Initialize tooltips
function initTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.position = 'absolute';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.zIndex = '1000';
        });
        
        element.addEventListener('mouseleave', function() {
            const tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    initTooltips();
    
    // Add event listeners for user menu
    const userMenuButton = document.getElementById('user-menu-button');
    if (userMenuButton) {
        userMenuButton.addEventListener('click', toggleUserMenu);
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('user-menu');
        const button = document.getElementById('user-menu-button');
        
        if (menu && !menu.contains(event.target) && !button.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
    
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', toggleMobileMenu);
    }
    
    // Form validation
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                showAlert('Please fill in all required fields.', 'error');
            }
        });
    });
    
    // Quantity controls
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        const minusBtn = input.parentNode.querySelector('.quantity-minus');
        const plusBtn = input.parentNode.querySelector('.quantity-plus');
        
        if (minusBtn) {
            minusBtn.addEventListener('click', () => updateQuantity(input, -1));
        }
        if (plusBtn) {
            plusBtn.addEventListener('click', () => updateQuantity(input, 1));
        }
    });
    
    // Image preview
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', () => previewImage(input));
    });
    
    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            smoothScrollTo(targetId);
        });
    });
});

// Export functions for global use
window.App = {
    showAlert,
    validateForm,
    addToCart,
    toggleUserMenu,
    toggleMobileMenu,
    searchProducts,
    updateQuantity,
    previewImage,
    smoothScrollTo
}; 