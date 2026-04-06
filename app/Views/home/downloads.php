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
<body>

    <!-- Navbar -->
    <nav class="navbar scrolled">
        <div class="container">
            <div class="logo">
                <a href="<?php echo URLROOT; ?>" style="text-decoration: none; display: flex; align-items: center;">
                    <img src="<?php echo URLROOT; ?>/images/logo.jpeg" alt="TOAN Logo" class="nav-logo-img">
                    <span class="logo-text">TOAN <span class="state">KOGI</span></span>
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="<?php echo URLROOT; ?>">Home</a></li>
                <li><a href="<?php echo URLROOT; ?>/home/about">About TOAN</a></li>
                <li><a href="<?php echo URLROOT; ?>/home/downloads" class="active">Downloads</a></li>
                <li><a href="<?php echo URLROOT; ?>/#why-tax">Why Pay Tax?</a></li>
                <li><a href="<?php echo URLROOT; ?>/home/contact">Contact Us</a></li>
                <li><a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-primary">Login</a></li>
            </ul>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Subpage Hero -->
    <header class="subpage-hero" style="border-top: 4px solid var(--accent-red);">
        <div class="subpage-hero-bg" style="background-image: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)), url('<?php echo URLROOT; ?>/images/look.jpeg');"></div>
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo URLROOT; ?>">Home</a> / <span>Downloads</span>
            </div>
            <h1>Member <span class="highlight-yellow">Resources</span></h1>
            <p style="color: white; opacity: 0.8; max-width: 600px; margin-top: 1.5rem;">Access official association documents, guidelines, and informative materials to stay updated with TOAN Kogi State Chapter.</p>
        </div>
    </header>

    <!-- Documents Section -->
    <section class="page-section">
        <div class="container">
            <div class="resources-badges">
                <span class="res-badge badge active">All Documents</span>
                <span class="res-badge badge">Constitution</span>
                <span class="res-badge badge">Registration Guides</span>
                <span class="res-badge badge">Member Welfare</span>
                <span class="res-badge badge">Policy Updates</span>
            </div>

            <div class="download-grid">
                <!-- Document 1 -->
                <div class="download-card glass">
                    <div class="card-top">
                        <span class="badge badge-red" style="margin-bottom: 1rem;">Mandatory</span>
                        <span class="file-icon">📜</span>
                        <h3>TOAN Kogi State Constitution</h3>
                        <p>The principal governing document outlining the rules, rights, and responsibilities of every member within the association.</p>
                    </div>
                    <div class="file-meta">
                        <span class="file-info">PDF • 1.2 MB</span>
                        <a href="#" class="btn btn-primary btn-download">Download</a>
                    </div>
                </div>

                <!-- Document 2 -->
                <div class="download-card glass">
                    <div class="card-top">
                        <span class="file-icon">📋</span>
                        <h3>Member Code of Conduct</h3>
                        <p>Essential guidelines for professional behavior, safety standards, and community engagement for all tricycle operators.</p>
                    </div>
                    <div class="file-meta">
                        <span class="file-info">PDF • 850 KB</span>
                        <a href="#" class="btn btn-primary btn-download">Download</a>
                    </div>
                </div>

                <!-- Document 3 -->
                <div class="download-card glass">
                    <div class="card-top">
                        <span class="file-icon">🛡️</span>
                        <h3>Tax Compliance Handbook</h3>
                        <p>A comprehensive guide on how the TTRTS system works, how to pay your taxes, and how to verify your registration status.</p>
                    </div>
                    <div class="file-meta">
                        <span class="file-info">PDF • 2.4 MB</span>
                        <a href="#" class="btn btn-primary btn-download">Download</a>
                    </div>
                </div>

                <!-- Document 4 -->
                <div class="download-card glass">
                    <div class="card-top">
                        <span class="file-icon">🤝</span>
                        <h3>Welfare Benefits Guide</h3>
                        <p>Learn about the insurance, micro-loans, and emergency support services available to fully registered and tax-compliant members.</p>
                    </div>
                    <div class="file-meta">
                        <span class="file-info">PDF • 1.1 MB</span>
                        <a href="#" class="btn btn-primary btn-download">Download</a>
                    </div>
                </div>

                <!-- Document 5 -->
                <div class="download-card glass">
                    <div class="card-top">
                        <span class="file-icon">🚦</span>
                        <h3>2026 Operational Guidelines</h3>
                        <p>Updated traffic regulations, approved routes, and operational hours for tricycles within Kogi State urban centers.</p>
                    </div>
                    <div class="file-meta">
                        <span class="file-info">PDF • 920 KB</span>
                        <a href="#" class="btn btn-primary btn-download">Download</a>
                    </div>
                </div>

                <!-- Document 6 -->
                <div class="download-card glass">
                    <div class="card-top">
                        <span class="file-icon">📱</span>
                        <h3>Portal Usage Tutorial</h3>
                        <p>A step-by-step manual on how to use the member login portal, download receipts, and update your profile information.</p>
                    </div>
                    <div class="file-meta">
                        <span class="file-info">PDF • 3.2 MB</span>
                        <a href="#" class="btn btn-primary btn-download">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Banner -->
    <section class="page-section" style="background: var(--dark); color: white; text-align: center; margin-bottom: 0;">
        <div class="container">
            <h2 style="color: white; margin-bottom: 1.5rem;">Can't find what you're looking for?</h2>
            <p style="opacity: 0.7; margin-bottom: 3rem; max-width: 700px; margin-inline: auto;">If you need a specific document that isn't listed here, please contact the State Secretariat or your LGA Admin for assistance.</p>
            <a href="<?php echo URLROOT; ?>/home/contact" class="btn btn-secondary">Contact Support</a>
        </div>
    </section>

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
