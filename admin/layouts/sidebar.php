<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="header-logo-group">
            <img src="../images/logo.jpeg" alt="TOAN Logo" class="sidebar-logo">
            <h1 class="sidebar-title">TOAN <span>KOGI</span></h1>
        </div>
        <button id="closeSidebar" class="close-sidebar-btn" aria-label="Close Sidebar">✕</button>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="index.php" class="menu-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                <i>📊</i> <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="payment.php" class="menu-link <?php echo ($current_page == 'payment.php') ? 'active' : ''; ?>">
                <i>💳</i> <span>Process Payment</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="registration.php" class="menu-link <?php echo ($current_page == 'registration.php') ? 'active' : ''; ?>">
                <i>📝</i> <span>Registration</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="verification.php" class="menu-link <?php echo ($current_page == 'verification.php') ? 'active' : ''; ?>">
                <i>🔍</i> <span>Verification</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="members.php" class="menu-link <?php echo ($current_page == 'members.php') ? 'active' : ''; ?>">
                <i>👥</i> <span>Members</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="lgas.php" class="menu-link <?php echo ($current_page == 'lgas.php' || $current_page == 'units.php') ? 'active' : ''; ?>">
                <i>📍</i> <span>Regional Setup</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="revenue.php" class="menu-link <?php echo ($current_page == 'revenue.php') ? 'active' : ''; ?>">
                <i>💰</i> <span>Revenue Logs</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="reports.php" class="menu-link <?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>">
                <i>📈</i> <span>Reports</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="complaints.php" class="menu-link <?php echo ($current_page == 'complaints.php') ? 'active' : ''; ?>">
                <i>💡</i> <span>Complaints</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="users.php" class="menu-link <?php echo ($current_page == 'users.php') ? 'active' : ''; ?>">
                <i>🛡️</i> <span>User Roles</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="audit.php" class="menu-link <?php echo ($current_page == 'audit.php') ? 'active' : ''; ?>">
                <i>📋</i> <span>Audit Logs</span>
            </a>
        </li>
        <li class="menu-item" style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
            <a href="settings.php" class="menu-link <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
                <i>⚙️</i> <span>Settings</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="../login.html" class="menu-link" style="color: var(--accent-red);">
                <i>🚪</i> <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
