<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo URLROOT; ?>/images/logo.jpeg">
    <!-- Main Style -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/style.css">
</head>
<body class="login-page">

    <div class="login-card" style="border-top: 5px solid var(--accent-red);">
        <div class="login-header">
            <a href="<?php echo URLROOT; ?>" style="text-decoration: none;">
                <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" class="login-logo-img">
                <span class="logo-text">TOAN <span class="state">KOGI</span></span>
            </a>
            <h2>Member Login</h2>
            <p>Access your TTRTS dashboard and view your revenue contributions.</p>
        </div>

        <form action="<?php echo URLROOT; ?>/auth/login" method="POST" id="login-form">
            <?php if(!empty($data['password_err'])) : ?>
                <div class="alert alert-danger" style="margin-bottom: 1.5rem;"><?php echo $data['password_err']; ?></div>
            <?php endif; ?>
            <?php if(!empty($data['identifier_err'])) : ?>
                <div class="alert alert-danger" style="margin-bottom: 1.5rem;"><?php echo $data['identifier_err']; ?></div>
            <?php endif; ?>
            <?php flash('member_login_success'); ?>
            <?php flash('member_login_error'); ?>
            
            <div class="form-group" style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600; font-size: 0.9rem; color: var(--dark);">Unique ID / Plate Number</label>
                <input type="text" name="identifier" value="<?php echo isset($data['identifier']) ? $data['identifier'] : ''; ?>" placeholder="e.g. KOG-123-AB" required style="padding: 1.2rem 1.5rem;">
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600; font-size: 0.9rem; color: var(--dark);">Secret Password</label>
                <input type="password" name="password" placeholder="••••••••" required style="padding: 1.2rem 1.5rem;">
            </div>

            <div style="display: flex; justify-content: flex-end; margin-bottom: 2.5rem;">
                <a href="#" style="font-size: 0.85rem; color: var(--text-muted); text-decoration: none;">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.2rem;">Sign In to Dashboard</button>
        </form>

        <div class="login-divider"></div>

        <div class="login-footer">
            <p>Don't have an account? <a href="<?php echo URLROOT; ?>/home/contact">Visit Registration Hub</a></p>
            <p style="margin-top: 1rem; opacity: 0.6; font-size: 0.8rem;">Protected by Kogi State Revenue Security (TTRTS)</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" class="footer-logo-img">
                    <span class="logo-text">TOAN <span class="state">KOGI</span></span>
                    <p>Dedicated to the welfare, education, and economic empowerment of tricycle owners and operators across Kogi State. Partnering for a sustainable revenue future.</p>
                    <div class="social-links">
                        <a href="#" class="social-icon">FB</a>
                        <a href="#" class="social-icon">TW</a>
                        <a href="#" class="social-icon">IG</a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo URLROOT; ?>">Home Portal</a></li>
                        <li><a href="<?php echo URLROOT; ?>/home/about">About Association</a></li>
                        <li><a href="<?php echo URLROOT; ?>/home/downloads">Member Downloads</a></li>
                        <li><a href="<?php echo URLROOT; ?>/home/contact">Contact & Support</a></li>
                        <li><a href="<?php echo URLROOT; ?>/#why-tax">Tax Education</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Member Area</h4>
                    <ul>
                        <li><a href="<?php echo URLROOT; ?>/auth/login">Member Login</a></li>
                        <li><a href="<?php echo URLROOT; ?>/#roadmap">Registration Guide</a></li>
                        <li><a href="<?php echo URLROOT; ?>/home/contact">Find Your Unit</a></li>
                        <li><a href="#">Verify Receipt</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Official Contact</h4>
                    <div class="footer-contact-item">
                        <span>📍</span>
                        <span>State Secretariat, Near KGIRS HQ, Lokoja, Kogi State</span>
                    </div>
                    <div class="footer-contact-item">
                        <span>📞</span>
                        <span>0800 8626 5644</span>
                    </div>
                    <div class="footer-contact-item">
                        <span>✉️</span>
                        <span>support@toankogi.org.ng</span>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-grid">
                    <div class="footer-copy">
                        &copy; 2026 TOAN Kogi State Chapter. All Rights Reserved.
                    </div>
                    <div class="footer-legal">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                    </div>
                </div>
                <div class="footer-partnership">
                    Official Partner: <strong>Kogi State Government</strong> | <strong>KGIRS</strong>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php echo URLROOT; ?>/assets/js/main.js"></script>
</body>
</html>
