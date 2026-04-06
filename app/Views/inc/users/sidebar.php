<aside class="sidebar">
    <div class="sidebar-header">
        <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" class="sidebar-logo">
        <h1 class="sidebar-title">TOAN <span>MEMBER</span></h1>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/index" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'dashboard') ? 'active' : ''; ?>">
                <i>📊</i> <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/pay" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'pay') ? 'active' : ''; ?>">
                <i>💳</i> <span>Pay My Tax</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/payments" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'payments') ? 'active' : ''; ?>">
                <i>📜</i> <span>Tax History</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/id_card" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'id_card') ? 'active' : ''; ?>">
                <i>🆔</i> <span>Digital ID Card</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/profile" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'profile') ? 'active' : ''; ?>">
                <i>👤</i> <span>My Profile</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/notifications" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'notifications') ? 'active' : ''; ?>">
                <i>🔔</i> <span>Notices</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo URLROOT; ?>/users/complaints" class="menu-link <?php echo (isset($data['active_page']) && $data['active_page'] == 'complaints') ? 'active' : ''; ?>">
                <i>📣</i> <span>Complaints</span>
            </a>
        </li>
        
        <li class="menu-item" style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
            <a href="<?php echo URLROOT; ?>/auth/logout" class="menu-link" style="color: #ef4444;">
                <i>🚪</i> <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
