// Global Modal Helpers
window.openModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.add('active');
        }, 10);
        document.body.style.overflow = 'hidden';
    }
};

window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
        document.body.style.overflow = 'auto';
    }
};

// Global Confirm Action Helper
window.confirmAction = function(options = {}) {
    const defaults = {
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        confirmButtonText: 'Yes, proceed',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#0061f2',
        cancelButtonColor: '#64748b'
    };
    const config = { ...defaults, ...options };

    return Swal.fire({
        ...config,
        showCancelButton: true,
        background: 'var(--light)',
        color: 'var(--dark)',
        customClass: {
            popup: 'glass-swal',
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline'
        }
    });
};

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar / Drawer Toggle for Mobile
    const sidebar = document.querySelector('.sidebar');
    const toggle = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('closeSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    if (sidebar && toggle) {
        const openDrawer = () => {
            sidebar.classList.add('active');
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeDrawer = () => {
            sidebar.classList.remove('active');
            backdrop.classList.remove('active');
            document.body.style.overflow = 'auto';
        };

        toggle.addEventListener('click', openDrawer);
        if(closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if(backdrop) backdrop.addEventListener('click', closeDrawer);
    }

    // SweetAlert Flash Messages
    const flashMessages = document.querySelectorAll('.swal-flash');
    flashMessages.forEach(flash => {
        const message = flash.getAttribute('data-message');
        const icon = flash.getAttribute('data-icon') || 'success';
        
        Swal.fire({
            title: icon.charAt(0).toUpperCase() + icon.slice(1),
            text: message,
            icon: icon,
            background: 'var(--light)',
            color: 'var(--dark)',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            backdrop: `rgba(0,0,0,0.4)`
        });
        flash.remove(); // Clean up
    });

    // Automatic Form & Link Confirmations
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.hasAttribute('data-confirm')) {
            e.preventDefault();
            const message = form.getAttribute('data-confirm') || "Do you really want to perform this action?";
            const title = form.getAttribute('data-confirm-title') || "Are you sure?";
            
            confirmAction({
                title: title,
                text: message
            }).then((result) => {
                if (result.isConfirmed) {
                    form.removeAttribute('data-confirm'); // Remove attribute to allow submission
                    form.submit();
                }
            });
        }
    });

    document.addEventListener('click', function(e) {
        const target = e.target.closest('a[data-confirm]');
        if (target) {
            e.preventDefault();
            const message = target.getAttribute('data-confirm');
            const title = target.getAttribute('data-confirm-title');
            const href = target.getAttribute('href');

            confirmAction({
                title: title,
                text: message
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        }
    });


    // Dummy Chart Interaction (Visual only)
    const charts = document.querySelectorAll('.dummy-chart-bar');
    charts.forEach(bar => {
        const height = bar.getAttribute('data-height');
        setTimeout(() => {
            bar.style.height = height + '%';
        }, 300);
    });
});
