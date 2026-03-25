document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle for Mobile
    const sidebar = document.querySelector('.sidebar');
    const toggle = document.createElement('button');
    toggle.className = 'menu-toggle-admin';
    toggle.innerHTML = '☰';
    toggle.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--primary);
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        z-index: 1000;
        cursor: pointer;
        display: none;
    `;
    
    // Media query check for showing toggle
    if (window.innerWidth <= 1024) {
        toggle.style.display = 'block';
        document.body.appendChild(toggle);
    }

    toggle.addEventListener('click', () => {
        const isClosed = sidebar.style.transform === 'translateX(-100%)' || !sidebar.style.transform;
        sidebar.style.transform = isClosed ? 'translateX(0)' : 'translateX(-100%)';
    });

    // Dummy Chart Interaction (Visual only)
    const charts = document.querySelectorAll('.dummy-chart-bar');
    charts.forEach(bar => {
        const height = bar.getAttribute('data-height');
        setTimeout(() => {
            bar.style.height = height + '%';
        }, 300);
    });

    // Dropdown/Profile dummy interaction
    const profile = document.querySelector('.user-profile');
    if (profile) {
        profile.addEventListener('click', () => {
            console.log('Profile clicked - Open settings/logout');
        });
    }

    // Modal dummy logic
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    };
});
