/**
 * Orchid Cafe - Admin JavaScript
 * Interactions for the management dashboard
 */

document.addEventListener('DOMContentLoaded', () => {
    initAdminSidebar();
    initImagePreviews();
    initDeleteConfirmations();
    initFlashAutoClose();
});

/**
 * Admin Sidebar Toggle (Mobile)
 */
function initAdminSidebar() {
    const toggleBtn = document.getElementById('admin-sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('admin-sidebar-overlay');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            if (overlay) overlay.classList.toggle('hidden');
        });

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    }
}

/**
 * Image Upload Previews
 */
function initImagePreviews() {
    const imageInputs = document.querySelectorAll('.image-preview-input');
    
    imageInputs.forEach(input => {
        const previewId = input.getAttribute('data-preview');
        const previewImg = document.getElementById(previewId);

        if (previewImg) {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
}

/**
 * Global Delete Confirmations
 */
function initDeleteConfirmations() {
    const deleteButtons = document.querySelectorAll('.confirm-delete');
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const message = btn.getAttribute('data-confirm-message') || 'Are you sure you want to delete this item? This action cannot be undone.';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Auto-close flash messages after 5 seconds
 */
function initFlashAutoClose() {
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-20px)';
            setTimeout(() => msg.remove(), 500);
        }, 5000);
    });
}

/**
 * Helper to open Modals (Used by reservations.php, events.php etc)
 */
window.openAdminModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
};

window.closeAdminModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
};
