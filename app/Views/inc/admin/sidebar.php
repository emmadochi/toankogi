<aside class="sidebar">
    <div class="sidebar-header">
        <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" class="sidebar-logo">
        <h1 class="sidebar-title">TOAN <span>KOGI</span></h1>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/index" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'dashboard') ? 'active' : ''; ?>">
                <i>📊</i> <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/payment" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'payment') ? 'active' : ''; ?>">
                <i>💳</i> <span>Process Payment</span>
            </a>
        </li>
        <?php if ($_SESSION['user_role'] != 'agent') : ?>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/registration" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'registration') ? 'active' : ''; ?>">
                <i>📝</i> <span>Registration</span>
            </a>
        </li>
        <?php endif; ?>

        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/verification" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'verification') ? 'active' : ''; ?>">
                <i>🔍</i> <span>Verification</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/members" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'members') ? 'active' : ''; ?>">
                <i>👥</i> <span>Members</span>
            </a>
        </li>
        <?php if ($_SESSION['user_role'] == 'superadmin' || $_SESSION['user_role'] == 'lga_admin') : ?>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/lgas" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'lgas') ? 'active' : ''; ?>">
                <i>📍</i> <span>Regional Setup</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/units" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'units') ? 'active' : ''; ?>">
                <i>🏢</i> <span>Collection Units</span>
            </a>
        </li>
        <?php endif; ?>

        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/revenue" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'revenue') ? 'active' : ''; ?>">
                <i>💰</i> <span>Revenue Logs</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/reports" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'reports') ? 'active' : ''; ?>">
                <i>📈</i> <span>Reports</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/complaints" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'complaints') ? 'active' : ''; ?>">
                <i>💡</i> <span>Complaints</span>
            </a>
        </li>
        <?php if ($_SESSION['user_role'] == 'superadmin' || $_SESSION['user_role'] == 'lga_admin') : ?>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/users" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'users') ? 'active' : ''; ?>">
                <i>🛡️</i> <span>User Roles</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if ($_SESSION['user_role'] == 'superadmin') : ?>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/audit" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'audit') ? 'active' : ''; ?>">
                <i>📋</i> <span>Audit Logs</span>
            </a>
        </li>
        <?php endif; ?>
        <li class="menu-item" style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
            <a href="<?php echo URLROOT; ?>/admin/settings" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'settings') ? 'active' : ''; ?>">
                <i>⚙️</i> <span>Settings</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/admin/logout" class="menu-link" 
               data-confirm="Are you sure you want to log out of the administrative portal?" 
               data-confirm-title="Confirm Logout"
               style="color: #ef4444;">
                <i>🚪</i> <span>Logout</span>
            </a>

        </li>
    </ul>
</aside>
