<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOAN Admin | Kogi State Revenue</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome placeholder (icons will use fallback text/emojis for now) -->
    <link rel="stylesheet" href="assets/css/admin.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php include 'layouts/sidebar.php'; ?>
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

            <span class="role-badge">Super Admin</span>
            <div class="user-profile">
                <div class="user-avatar">SA</div>
                <div class="user-info">
                    <p style="font-weight: 600; font-size: 0.9rem;">State Admin</p>
                    <p style="font-size: 0.75rem; color: var(--text-muted);">Kogi HQ</p>
                </div>
            </div>
        </div>
    </header>
    <main class="page-content">
