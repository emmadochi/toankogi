    </div><!-- main content padding -->

    <nav class="bottom-nav">
        <a href="<?php echo URLROOT; ?>/agent/index" class="nav-item <?php echo ($data['title'] == 'Agent Dashboard') ? 'active' : ''; ?>">
            <span class="nav-icon">🏠</span>
            <span>Home</span>
        </a>
        <a href="<?php echo URLROOT; ?>/agent/verify" class="nav-item <?php echo ($data['title'] == 'Verify Operator' || $data['title'] == 'Collect Payment') ? 'active' : ''; ?>">
            <span class="nav-icon">🔍</span>
            <span>Verify</span>
        </a>
        <a href="<?php echo URLROOT; ?>/agent/verify" class="nav-item">
            <div class="fab-collect">➕</div>
        </a>
        <a href="<?php echo URLROOT; ?>/agent/history" class="nav-item <?php echo ($data['title'] == 'Collection History') ? 'active' : ''; ?>">
            <span class="nav-icon">📜</span>
            <span>History</span>
        </a>
        <a href="<?php echo URLROOT; ?>/users/logout" class="nav-item">
            <span class="nav-icon">🚪</span>
            <span>Logout</span>
        </a>
    </nav>

    <!-- Mobile-First Modal/Toast Container -->
    <div id="agent-toast" style="position: fixed; top: 1.5rem; left: 1.5rem; right: 1.5rem; z-index: 9999; pointer-events: none;">
        <?php flash('agent_message'); ?>
    </div>

    <script>
        // Handle Flash Messages with mobile-friendly animation
        window.addEventListener('load', () => {
            const toast = document.querySelector('#agent-toast .alert');
            if (toast) {
                toast.style.boxShadow = '0 10px 30px rgba(0,0,0,0.2)';
                toast.style.borderRadius = '15px';
                toast.style.border = 'none';
                toast.style.backdropFilter = 'blur(10px)';
                
                // Entrance animation
                toast.animate([
                    { transform: 'translateY(-20px)', opacity: 0 },
                    { transform: 'translateY(0)', opacity: 1 }
                ], { duration: 300, easing: 'ease-out' });

                // Auto-hide
                setTimeout(() => {
                    toast.animate([
                        { transform: 'translateY(0)', opacity: 1 },
                        { transform: 'translateY(-20px)', opacity: 0 }
                    ], { duration: 300, easing: 'ease-in' }).onfinish = () => toast.remove();
                }, 4000);
            }
        });
    </script>
</body>
</html>
