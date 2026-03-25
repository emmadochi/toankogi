document.addEventListener('DOMContentLoaded', () => {
    // Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Hero Slider Logic
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    let currentSlide = 0;

    const showSlide = (n) => {
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    };

    if (nextBtn) {
        nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));
        prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showSlide(index));
        });

        // Auto play
        setInterval(() => showSlide(currentSlide + 1), 7000);
    }

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            faqItems.forEach(i => i.classList.remove('active'));
            if (!isActive) item.classList.add('active');
        });
    });

    // Animate Counters (Updated to include scroll trigger for stat section)
    const animateValue = (id, start, end, duration, prefix = '', suffix = '') => {
        const obj = document.getElementById(id);
        if (!obj) return;
        
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            obj.innerHTML = prefix + value.toLocaleString() + suffix;
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('stat-item')) {
                    const h3 = entry.target.querySelector('h3');
                    if (h3.id === 'stat-lga') animateValue('stat-lga', 0, 21, 1500);
                    if (h3.id === 'stat-keke') animateValue('stat-keke', 0, 15420, 2000, '', '+');
                }
                
                if (entry.target.classList.contains('reveal')) {
                    entry.target.classList.add('active');
                }
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Elements to reveal on scroll
    const reveals = document.querySelectorAll('.feature-card, .step, .gallery-item, .blog-card, .stat-item, .about-image, .about-text');
    reveals.forEach(el => {
        el.classList.add('reveal');
        observer.observe(el);
    });

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Unit Tracker Logic
    const unitData = [
        { lga: 'Lokoja', unit: 'Unit 01 - Post Office', admin: 'Musa Ibrahim', phone: '0803XXXXXXX', location: 'Opposite Old Post Office, Lokoja' },
        { lga: 'Kogi', unit: 'Unit 01 - Koton Karfe', admin: 'Ibrahim Bala', phone: '0805XXXXXXX', location: 'Near Koton Karfe Market' },
        { lga: 'Okene', unit: 'Unit 01 - Checkpoint', admin: 'Yusuf Ahmed', phone: '0706XXXXXXX', location: 'Okene Depot, Beside Police Station' },
        { lga: 'Idah', unit: 'Unit 01 - Market Square', admin: 'Oche Peter', phone: '0808XXXXXXX', location: 'Main Market, Idah' },
        { lga: 'Ankpa', unit: 'Unit 01 - Hospital Rd', admin: 'Usman Danjuma', phone: '0802XXXXXXX', location: 'General Hospital Road, Ankpa' },
        { lga: 'Dekina', unit: 'Unit 01 - Anyigba Hub', admin: 'Sadiq Mohammed', phone: '0813XXXXXXX', location: 'Anyigba Market Square' },
        { lga: 'Ajaokuta', unit: 'Unit 01 - Steel Complex', admin: 'Olawale Segun', phone: '0809XXXXXXX', location: 'Ajaokuta Steel Gate' },
        { lga: 'Kabba/Bunu', unit: 'Unit 01 - Town Hall', admin: 'Adeyemi Kayode', phone: '0803XXXXXXX', location: 'Kabba Town Hall Area' }
    ];

    const lgaSelect = document.getElementById('lga-select');
    const unitResults = document.getElementById('unit-results');

    if (lgaSelect) {
        lgaSelect.addEventListener('change', (e) => {
            const selectedLga = e.target.value;
            unitResults.innerHTML = '';

            if (selectedLga === '') {
                unitResults.innerHTML = '<div id="no-results"><p>Select an LGA above to view registration units in your area.</p></div>';
                return;
            }

            const filteredUnits = unitData.filter(u => u.lga === selectedLga);

            if (filteredUnits.length > 0) {
                filteredUnits.forEach(unit => {
                    const card = document.createElement('div');
                    card.className = 'unit-card reveal active';
                    card.innerHTML = `
                        <div class="unit-badge">ACTIVE</div>
                        <h4>${unit.unit}</h4>
                        <span class="lga-name">${unit.lga} LGA</span>
                        <div class="unit-details">
                            <div class="unit-detail-item">
                                <span>Admin:</span>
                                <span>${unit.admin}</span>
                            </div>
                            <div class="unit-detail-item">
                                <span>Location:</span>
                                <span>${unit.location}</span>
                            </div>
                        </div>
                        <div class="unit-actions">
                            <a href="tel:${unit.phone}" class="btn btn-primary btn-small">Call Admin</a>
                        </div>
                    `;
                    unitResults.appendChild(card);
                });
            } else {
                unitResults.innerHTML = `<div id="no-results"><p>No registration units currently listed for <strong>${selectedLga}</strong> LGA. Please contact the State Secretariat for support.</p></div>`;
            }
        });
    }
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });

        // Close menu when clicking a link
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                menuToggle.classList.remove('active');
            });
        });
    }
});
