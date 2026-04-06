<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $data['title']; ?> | Field Agent</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Admin Style (Reusing for consistency) -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/admin/css/admin.css">
    <style>
        :root {
            --safe-area-inset-bottom: env(safe-area-inset-bottom);
        }
        body {
            padding-bottom: calc(85px + var(--safe-area-inset-bottom));
            background: var(--bg-alt);
            overflow-x: hidden;
        }
        .agent-header {
            padding: 0.8rem 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: calc(75px + var(--safe-area-inset-bottom));
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding-bottom: var(--safe-area-inset-bottom);
            z-index: 1000;
            border-radius: 24px 24px 0 0;
            box-shadow: 0 -5px 25px rgba(0,0,0,0.1);
        }
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.65rem;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 20%;
        }
        .nav-item.active {
            color: var(--accent-primary);
        }
        .nav-item.active .nav-icon {
            transform: translateY(-2px);
            filter: drop-shadow(0 0 8px rgba(0, 161, 255, 0.4));
        }
        .nav-icon {
            font-size: 1.4rem;
            margin-bottom: 4px;
        }
        .fab-collect {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.6rem;
            box-shadow: 0 8px 20px rgba(0, 161, 255, 0.3);
            margin-top: -45px;
            border: 4px solid var(--bg-alt);
            transition: transform 0.2s ease;
        }
        .fab-collect:active {
            transform: scale(0.9);
        }
        .card-mobile {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-sm);
        }
        .btn-mobile {
            width: 100%;
            padding: 1rem;
            border-radius: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-primary-mobile {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
        }
        .btn-primary-mobile:active {
            transform: scale(0.98);
            opacity: 0.9;
        }
        .status-pill-mobile {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-active { background: rgba(0, 200, 83, 0.15); color: #00c853; }
        .status-pending { background: rgba(255, 171, 0, 0.15); color: #ffab00; }
        
        /* Verification Pulse */
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        .verify-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #00c853;
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <header class="agent-header">
        <div class="agent-brand">
            <span style="font-weight: 800; color: var(--accent-primary); letter-spacing: -1px; font-size: 1.2rem;">KGS</span>
            <span style="font-weight: 400; font-size: 1.1rem; color: var(--text-main);">REV</span>
        </div>
        <div class="agent-profile" style="display: flex; align-items: center; gap: 12px;">
            <div style="text-align: right;">
                <p style="font-size: 0.85rem; font-weight: 600; margin: 0; color: var(--text-main);"><?php echo explode(' ', $_SESSION['user_fullname'])[0]; ?></p>
                <p style="font-size: 0.65rem; color: var(--text-muted); margin: 0; opacity: 0.8;"><?php echo $_SESSION['user_unit_name'] ?? 'Field Operations'; ?></p>
            </div>
            <div class="user-avatar" style="width: 38px; height: 38px; font-size: 0.9rem; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border: none; box-shadow: 0 4px 10px rgba(0,161,255,0.2);">
                <?php echo substr($_SESSION['user_fullname'], 0, 1); ?>
            </div>
        </div>
    </header>
    <div style="padding: 1rem; max-width: 600px; margin: 0 auto;">
