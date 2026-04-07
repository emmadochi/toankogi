    </main>
    
    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-nav">
        <a href="index.php" class="mobile-nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
            <i>📊</i>
            <span>Dash</span>
        </a>
        <a href="payment.php" class="mobile-nav-link <?php echo ($current_page == 'payment.php') ? 'active' : ''; ?>">
            <i>💳</i>
            <span>Pay</span>
        </a>
        <a href="verification.php" class="mobile-nav-link <?php echo ($current_page == 'verification.php') ? 'active' : ''; ?>">
            <i>🔍</i>
            <span>Verify</span>
        </a>
        <a href="registration.php" class="mobile-nav-link <?php echo ($current_page == 'registration.php') ? 'active' : ''; ?>">
            <i>📝</i>
            <span>Reg</span>
        </a>
        <a href="settings.php" class="mobile-nav-link <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
            <i>⚙️</i>
            <span>Sets</span>
        </a>
    </nav>

    <!-- Sidebar Backdrop -->
    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>
</div>

<script src="assets/js/admin.js"></script>
</body>
</html>
