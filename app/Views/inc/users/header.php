<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/users/css/user.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php require APPROOT . '/Views/inc/users/sidebar.php'; ?>
<div class="main-layout">
    <header class="topbar">
        <div class="mobile-logo">
            <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo">
        </div>
        <div class="search-bar">
            <span>🔍</span>
            <input type="text" placeholder="Search my payments...">
        </div>
        <div class="user-nav">
            <!-- Account Status Badge -->
            <div style="margin-right: 1rem;">
                <span class="status-check paid" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.8rem; font-weight: 700;">
                    ✓ ACTIVE STATUS
                </span>
            </div>
            
            <!-- Notifications -->
            <div class="notifications-bell" style="position: relative; cursor: pointer; font-size: 1.25rem; margin-right: 1rem;" onclick="alert('Notification: Association membership renewal is due next month.')">
                <span>🔔</span>
                <span style="position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; border-radius: 50%; width: 15px; height: 15px; font-size: 0.6rem; display: flex; align-items: center; justify-content: center; font-weight: 700;">1</span>
            </div>

            <span class="role-badge" style="background: rgba(15, 23, 42, 0.05); color: var(--dark);">Member</span>
            <div class="user-profile">
                <?php 
                $names = explode(' ', $_SESSION['member_fullname'] ?? 'User');
                $init = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                ?>
                <div class="user-avatar" style="background: var(--primary);"><?php echo $init; ?></div>
                <div class="user-info">
                    <p style="font-weight: 600; font-size: 0.9rem;"><?php echo $_SESSION['member_fullname'] ?? 'User'; ?></p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);"><?php echo $_SESSION['member_unit_name'] ?? 'Unit'; ?></p>
                </div>
            </div>
        </div>
    </header>
    <?php if (isset($_SESSION['force_password_change']) && $_SESSION['force_password_change'] === true): ?>
    <style>
        .force-pwd-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(5px); }
        .force-pwd-box { background: white; padding: 2.5rem; border-radius: 20px; width: 90%; max-width: 400px; text-align: center; }
    </style>
    <div class="force-pwd-overlay">
        <div class="force-pwd-box">
            <h3 style="color: #ef4444; margin-bottom: 1rem;">⚠️ Action Required</h3>
            <p style="margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--text-muted);">For your security, you must change your default password before accessing your dashboard.</p>
            
            <?php if(!empty($_SESSION['pwd_error'])): ?>
                <div style="color: #ef4444; font-size: 0.85rem; margin-bottom: 1rem; background: #fee2e2; padding: 0.5rem; border-radius: 5px;">
                    <?php echo $_SESSION['pwd_error']; unset($_SESSION['pwd_error']); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/users/force_change_password" method="POST">
                <div class="form-group" style="text-align: left; margin-bottom: 1rem;">
                    <label style="font-size: 0.8rem; font-weight: 600;">New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Minimum 6 characters" required minlength="6">
                </div>
                <div class="form-group" style="text-align: left; margin-bottom: 1.5rem;">
                    <label style="font-size: 0.8rem; font-weight: 600;">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Repeat new password" required minlength="6">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Set Secure Password</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <main class="page-content">
