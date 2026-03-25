<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | TOAN Kogi State</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar scrolled">
        <div class="container">
            <div class="logo">
                <a href="index.php" style="text-decoration: none; display: flex; align-items: center;">
                    <img src="images/logo.jpeg" alt="TOAN Logo" class="nav-logo-img">
                    <span class="logo-text">TOAN <span class="state">KOGI</span></span>
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About TOAN</a></li>
                <li><a href="downloads.html">Downloads</a></li>
                <li><a href="index.php#why-tax">Why Pay Tax?</a></li>
                <li><a href="index.php#roadmap">How to Register</a></li>
                <li><a href="contact.php" class="active">Contact Us</a></li>
                <li><a href="login.php" class="btn btn-primary">Login</a></li>
            </ul>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Subpage Hero -->
    <header class="subpage-hero">
        <div class="subpage-hero-bg" style="background-image: url('images/outreach2.jpeg');"></div>
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Home</a> / <span>Contact Us</span>
            </div>
            <h1>Contact <span class="highlight-yellow">& Support</span></h1>
        </div>
    </header>

    <!-- Unit Tracker Section -->
    <section class="unit-tracker">
        <div class="container">
            <div class="section-header">
                <div class="badge">Find Your Unit</div>
                <h2>Locate Your <span class="highlight">Registration Hub</span></h2>
                <p>Select your Local Government Area (LGA) to find the nearest TOAN Unit Administrator.</p>
            </div>

            <div class="lga-filter-box">
                <select id="lga-select" class="lga-select">
                    <option value="">-- Select Your LGA --</option>
                    <option value="Adavi">Adavi</option>
                    <option value="Ajaokuta">Ajaokuta</option>
                    <option value="Ankpa">Ankpa</option>
                    <option value="Bassa">Bassa</option>
                    <option value="Dekina">Dekina</option>
                    <option value="Ibaji">Ibaji</option>
                    <option value="Idah">Idah</option>
                    <option value="Igalamela-Odolu">Igalamela-Odolu</option>
                    <option value="Ijumu">Ijumu</option>
                    <option value="Kabba/Bunu">Kabba/Bunu</option>
                    <option value="Kogi">Kogi</option>
                    <option value="Lokoja">Lokoja</option>
                    <option value="Mopa-Muro">Mopa-Muro</option>
                    <option value="Ofu">Ofu</option>
                    <option value="Ogori/Magongo">Ogori/Magongo</option>
                    <option value="Okehi">Okehi</option>
                    <option value="Okene">Okene</option>
                    <option value="Olomaboro">Olomaboro</option>
                    <option value="Omala">Omala</option>
                    <option value="Yagba East">Yagba East</option>
                    <option value="Yagba West">Yagba West</option>
                </select>
            </div>

            <div id="unit-results" class="unit-results-grid">
                <!-- Results will be injected by JavaScript -->
                <div id="no-results">
                    <p>Select an LGA above to view registration units in your area.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Page Section -->
    <section class="page-section">
        <div class="container">
            <div class="contact-dept-grid">
                <div class="dept-card glass">
                    <h5>General Inquiries</h5>
                    <p>For basic information about TOAN Kogi or our association events.</p>
                    <p style="margin-top: 1rem; font-weight: 600;">info@toankogi.org.ng</p>
                </div>
                <div class="dept-card glass">
                    <h5>Tax & Registration Support</h5>
                    <p>Questions about your Unique ID, digital receipts, or payment cycles.</p>
                    <p style="margin-top: 1rem; font-weight: 600;">registrar@toankogi.org.ng</p>
                </div>
                <div class="dept-card glass">
                    <h5>Emergency Support</h5>
                    <p>Report illegal enforcement, tricycle theft, or roadway disputes instantly.</p>
                    <p style="margin-top: 1rem; font-weight: 600;">helpdesk@toankogi.org.ng</p>
                </div>
            </div>

            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Reach Our <span class="highlight">State Secretariat</span></h2>
                    <p>Our dedicated team is available Monday to Friday, 8:00 AM to 5:00 PM to assist all registered members.</p>
                    <div class="contact-details">
                        <p>📍 TOAN State Secretariat, Near KGIRS HQ, Lokoja, Kogi State</p>
                        <p>📞 +234 800 TOAN KOGI (0800 8626 5644)</p>
                        <p>✉️ secretary@toankogi.org.ng</p>
                    </div>

                    <div class="contact-map">
                        <p>📍 Interactive Map Placeholder (Lokoja City Center)</p>
                    </div>
                </div>
                <div class="contact-form glass">
                    <form id="landing-contact">
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Full Name</label>
                            <input type="text" placeholder="e.g. Samuel Adebayo" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Plate Number / Unique ID</label>
                            <input type="text" placeholder="e.g. KOG-123-AB" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Inquiry Type</label>
                            <select class="form-group" style="width: 100%; padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border); background: var(--bg-alt);">
                                <option>Registration Support</option>
                                <option>Payment Dispute</option>
                                <option>Member Welfare</option>
                                <option>General Feedback</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Your Message</label>
                            <textarea placeholder="Describe how we can help you..." rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Case Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <img src="images/logo.jpeg" alt="TOAN Logo" class="footer-logo-img">
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
                        <li><a href="index.php">Home Portal</a></li>
                        <li><a href="about.php">About Association</a></li>
                        <li><a href="downloads.html">Member Downloads</a></li>
                        <li><a href="contact.php">Contact & Support</a></li>
                        <li><a href="index.php#why-tax">Tax Education</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Member Area</h4>
                    <ul>
                        <li><a href="login.php">Member Login</a></li>
                        <li><a href="index.php#roadmap">Registration Guide</a></li>
                        <li><a href="contact.php">Find Your Unit</a></li>
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

    <script src="assets/js/main.js"></script>
</body>
</html>
