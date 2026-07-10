/**
 * Orchid Cafe - Frontend JavaScript
 * Vanilla JS for lightweight interactions
 */

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initStickyHeader();
    initFAQAccordions();
    initMenuFiltering();
    initGalleryLightbox();
});

/**
 * Mobile Menu Toggle
 */
function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeBtn = document.getElementById('close-menu-btn');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.remove('translate-x-full');
            document.body.style.overflow = 'hidden';
        });

        const closeMenu = () => {
            mobileMenu.classList.add('translate-x-full');
            document.body.style.overflow = '';
        };

        if (closeBtn) closeBtn.addEventListener('click', closeMenu);
        
        // Close on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    }
}

/**
 * Sticky Header on Scroll
 */
function initStickyHeader() {
    const header = document.querySelector('header');
    if (!header) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-md', 'py-3');
            header.classList.remove('bg-transparent', 'py-6');
        } else {
            header.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-md', 'py-3');
            header.classList.add('bg-transparent', 'py-6');
        }
    });
}

/**
 * FAQ Accordion Toggle
 */
function initFAQAccordions() {
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.faq-icon');

        if (question && answer) {
            question.addEventListener('click', () => {
                const isOpen = !answer.classList.contains('hidden');
                
                // Close all others
                faqItems.forEach(other => {
                    other.querySelector('.faq-answer').classList.add('hidden');
                    other.querySelector('.faq-icon')?.classList.remove('rotate-180');
                });

                // Toggle current
                if (!isOpen) {
                    answer.classList.remove('hidden');
                    icon?.classList.add('rotate-180');
                }
            });
        }
    });
}

/**
 * Menu Category Filtering (Client-side)
 */
function initMenuFiltering() {
    const filterBtns = document.querySelectorAll('.menu-filter-btn');
    const menuItems = document.querySelectorAll('.menu-item-card');

    if (filterBtns.length === 0) return;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.getAttribute('data-category');

            // Update UI
            filterBtns.forEach(b => b.classList.remove('bg-purple-600', 'text-white'));
            btn.classList.add('bg-purple-600', 'text-white');

            // Filter items
            menuItems.forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                    setTimeout(() => item.style.opacity = '1', 10);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        });
    });
}

/**
 * Simple Gallery Lightbox
 */
function initGalleryLightbox() {
    const galleryImages = document.querySelectorAll('.gallery-thumb');
    if (galleryImages.length === 0) return;

    // Create lightbox elements
    const lightbox = document.createElement('div');
    lightbox.id = 'lightbox';
    lightbox.className = 'fixed inset-0 bg-black/90 z-[100] hidden flex items-center justify-center p-4 backdrop-blur-sm cursor-zoom-out';
    lightbox.innerHTML = `
        <img src="" class="max-w-full max-h-[90vh] rounded-2xl shadow-2xl transition-transform duration-300" id="lightbox-img">
        <button class="absolute top-8 right-8 text-white/50 hover:text-white transition"><i data-lucide="x" class="w-8 h-8"></i></button>
    `;
    document.body.appendChild(lightbox);

    const lightboxImg = lightbox.querySelector('#lightbox-img');

    galleryImages.forEach(img => {
        img.addEventListener('click', (e) => {
            e.preventDefault();
            const fullSrc = img.getAttribute('src');
            lightboxImg.src = fullSrc;
            lightbox.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        });
    });

    lightbox.addEventListener('click', () => {
        lightbox.classList.add('hidden');
        document.body.style.overflow = '';
    });
}
