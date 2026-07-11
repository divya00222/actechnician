// Main JavaScript for Maithil Thal

document.addEventListener('DOMContentLoaded', () => {
    loadMenu();
    setupReservationForm();
    setupScrollAnimations();
    setupDarkMode();
    setupLangSwitch();
    handleLoadingScreen();
});

function handleLoadingScreen() {
    const loader = document.getElementById('loading-screen');
    if (loader) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 800);
            }, 500);
        });
    }
}

// Load Menu items from API
async function loadMenu() {
    const menuContainer = document.getElementById('menu-container');
    if (!menuContainer) return;

    try {
        const response = await fetch('/api/menu');
        const menuItems = await response.json();

        menuContainer.innerHTML = menuItems.map(item => `
            <div class="premium-card" data-aos="fade-up">
                <div style="position: relative; margin: -30px -30px 20px; border-radius: 24px 24px 0 0; overflow: hidden; height: 200px;">
                    <img src="${item.image}" alt="${item.name}" style="width: 100%; height: 100%; object-fit: cover;">
                    ${item.popular ? '<span style="position: absolute; top: 10px; right: 10px; background: var(--mustard-gold); color: var(--deep-maroon); padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">Popular</span>' : ''}
                    ${item.chefSpecial ? '<span style="position: absolute; top: 10px; left: 10px; background: var(--terracotta); color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">Chef Choice</span>' : ''}
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                    <h3 style="font-size: 1.2rem;">${item.name}</h3>
                    <span style="color: var(--deep-maroon); font-weight: 800; font-size: 1.1rem;">Rs.${item.price}</span>
                </div>
                <p style="font-size: 0.9rem; color: #666; margin-bottom: 15px;">${item.description}</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 12px; padding: 4px 10px; border-radius: 4px; background: ${item.veg ? '#e6f4ea' : '#fce8e6'}; color: ${item.veg ? '#1e8e3e' : '#d93025'}; font-weight: bold;">
                        ${item.veg ? 'VEG' : 'NON-VEG'}
                    </span>
                    <button class="btn btn-primary" style="padding: 6px 15px; font-size: 12px;">Add to Cart</button>
                </div>
            </div>
        `).join('');
    } catch (error) {
        console.error('Error loading menu:', error);
        menuContainer.innerHTML = '<p>Failed to load menu. Please try again later.</p>';
    }
}

// Reservation Form Handling
function setupReservationForm() {
    const form = document.getElementById('reservation-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('/api/reserve', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                alert('Success! Your reservation has been received. We will contact you shortly.');
                form.reset();
            }
        } catch (error) {
            console.error('Error submitting reservation:', error);
            alert('Something went wrong. Please try calling us instead.');
        }
    });
}

// Simple Scroll Animations
function setupScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
                if (entry.target.getAttribute('data-aos-once') === 'true') {
                    observer.unobserve(entry.target);
                }
            }
        });
    }, observerOptions);

    document.querySelectorAll('[data-aos]').forEach(el => {
        const delay = el.getAttribute('data-aos-delay') || 0;
        const duration = el.getAttribute('data-aos-duration') || 800;
        el.style.transitionDelay = `${delay}ms`;
        el.style.transitionDuration = `${duration}ms`;
        observer.observe(el);
    });
}

// Dark Mode Toggle
function setupDarkMode() {
    const toggle = document.getElementById('theme-toggle');
    if (!toggle) return;

    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        const icon = toggle.querySelector('i');
        if (document.body.classList.contains('dark-mode')) {
            icon.setAttribute('data-lucide', 'sun');
            localStorage.setItem('theme', 'dark');
        } else {
            icon.setAttribute('data-lucide', 'moon');
            localStorage.setItem('theme', 'light');
        }
        lucide.createIcons();
    });

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }
}

// Language Switch (Mock)
function setupLangSwitch() {
    const sw = document.getElementById('lang-switch');
    if (!sw) return;
    sw.addEventListener('change', (e) => {
        alert('Language switching to ' + e.target.value.toUpperCase() + '... (Requires Content Translations)');
    });
}
