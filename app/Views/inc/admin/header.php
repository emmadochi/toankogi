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
    <!-- Admin Style -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/admin/css/admin.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php require APPROOT . '/Views/inc/admin/sidebar.php'; ?>
<div class="main-layout">
    <header class="topbar">
        <div class="search-bar">
            <span>🔍</span>
            <input type="text" placeholder="Search by Plate No or ID...">
        </div>
        <div class="user-nav">
            <!-- View Switcher (Demo Only) -->
            <div class="role-switcher" style="margin-right: 1rem;">
                <select onchange="window.location.href=this.value" style="padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid var(--glass-border); font-family: inherit; font-size: 0.75rem; background: var(--bg-alt); cursor: pointer;">
                    <option value="#">Switch View: Super Admin</option>
                    <option value="#">Switch View: LGA Admin</option>
                    <option value="#">Switch View: Unit Admin</option>
                    <option value="#">Switch View: Field Agent</option>
                </select>
            </div>
            
            <!-- Notifications -->
            <div class="notifications-bell" style="position: relative; cursor: pointer; font-size: 1.25rem; margin-right: 1rem;" onclick="alert('Digital Verification Alert: New registration pending in Lokoja Central Unit 1.')">
                <span>🔔</span>
                <span style="position: absolute; top: -5px; right: -5px; background: var(--accent-red); color: white; border-radius: 50%; width: 15px; height: 15px; font-size: 0.6rem; display: flex; align-items: center; justify-content: center; font-weight: 700;">2</span>
            </div>

            <span class="role-badge"><?php echo str_replace('_', ' ', strtoupper($_SESSION['user_role'])); ?></span>
            <div class="user-profile">
                <div class="user-avatar">
                    <?php 
                        $names = explode(' ', $_SESSION['user_name']);
                        $initials = '';
                        foreach($names as $n) $initials .= substr($n, 0, 1);
                        echo strtoupper($initials);
                    ?>
                </div>
                <div class="user-info">
                    <p style="font-weight: 600; font-size: 0.9rem;"><?php echo $_SESSION['user_name']; ?></p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">
                        <?php 
                            if($_SESSION['user_role'] == 'superadmin') echo 'Kogi State HQ';
                            elseif($_SESSION['user_role'] == 'lga_admin') echo ($_SESSION['user_lga_name'] ?? 'Division HQ');
                            else echo ($_SESSION['user_lga_name'] ?? 'N/A') . ' / ' . ($_SESSION['user_unit_name'] ?? 'General');
                        ?>
                    </p>
                </div>

            </div>
        </div>
    </header>
    <main class="page-content">
