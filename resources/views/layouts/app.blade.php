<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dozer Napitupulu — Fullstack Engineer')</title>
    
    <!-- Meta tags for SEO and professionalism -->
    <meta name="description" content="Dozer Napitupulu builds Laravel, ASP.NET, and Flutter systems for operations teams—POS, banking modules, dashboards, and integrations.">
    <meta name="keywords" content="Dozer Napitupulu, fullstack engineer, Laravel developer, ASP.NET, Flutter, Indonesia">
    <meta name="author" content="Dozer Napitupulu">
    
    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:title" content="Dozer Napitupulu — Fullstack Engineer">
    <meta property="og:description" content="Selected work and contact for Dozer Napitupulu — business web apps, mobile workflows, and API integration.">
    <meta property="og:type" content="website">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (trim($__env->yieldContent('layout')) === 'portfolio')
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @endif

    @if (trim($__env->yieldContent('layout')) !== 'portfolio')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
        @vite(['resources/css/legacy-layout.css'])
    @endif

    
    @yield('styles')
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to main content</a>
    <!-- Bold Distinctive Navigation -->
    <nav class="navbar-bold">
        <div class="container">
            <div class="navbar-container">
                <!-- Brand Logo - Choose one of these bold options -->
                
                <!-- Option 1: Geometric Badge Style (Recommended for Bold Look) -->
                <a href="{{ url('/') }}" class="brand-badge">
                    <div class="brand-icon-badge">DN</div>
                    <div class="brand-text-badge">
                        <div class="brand-name-badge">Dozer Napitupulu</div>
                        <div class="brand-title-badge">Fullstack Engineer</div>
                    </div>
                </a>
                
                <!-- Option 2: Brutalist/Bold Text Style 
                <a href="{{ url('/') }}" class="brand-brutalist">
                    <div class="brand-brutalist-text" data-text="DOZER">DOZER</div>
                    <div class="brand-brutalist-subtitle">// Fullstack Engineer</div>
                </a>
                -->
                
                <!-- Option 3: Terminal/Hacker Style 
                <a href="{{ url('/') }}" class="brand-terminal">
                    <span class="terminal-prompt">$</span>
                    <span>dozer.napitupulu</span>
                    <span class="terminal-cursor"></span>
                </a>
                -->

                <!-- Mobile Toggle -->
                <div class="mobile-toggle-bold" onclick="toggleMenu()">
                    <span class="toggle-line"></span>
                    <span class="toggle-line"></span>
                    <span class="toggle-line"></span>
                </div>

                <!-- Navigation Menu -->
                <ul class="nav-menu-bold" id="navMenu">
                    <li class="nav-item-bold">
                        <a href="{{ url('/') }}#home" class="nav-link-bold active">Home</a>
                    </li>
                    <li class="nav-item-bold">
                        <a href="{{ url('/') }}#about" class="nav-link-bold">About</a>
                    </li>
                    <li class="nav-item-bold">
                        <a href="{{ url('/') }}#projects" class="nav-link-bold">Projects</a>
                    </li>
                    <li class="nav-item-bold">
                        <a href="{{ url('/') }}#experience" class="nav-link-bold">Experience</a>
                    </li>
                    <li class="nav-item-bold">
                        <a href="{{ url('/') }}#certifications" class="nav-link-bold">Certifications</a>
                    </li>
                    <li class="nav-item-bold">
                        <a href="{{ url('/') }}#contact" class="nav-link-bold nav-cta-bold">Let's Connect</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main id="main-content" style="padding-top: 74px;">
        @yield('content')
    </main>

    <!-- Bold Distinctive Footer -->
    <footer class="footer-bold">
        <div class="container">
            <div class="footer-content-bold">
                <div class="row">
                    <!-- Brand & Social -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="footer-brand-bold">
                            <div class="footer-logo-bold">
                                <div class="footer-logo-icon">DN</div>
                                <div class="footer-logo-text">
                                    <div class="footer-logo-name">Dozer Napitupulu</div>
                                    <div class="footer-logo-tagline-bold">Fullstack Engineer</div>
                                </div>
                            </div>
                            <p class="footer-description-bold">
                                Crafting scalable digital experiences with modern web and mobile technologies. 
                                Passionate about clean code and innovative solutions.
                            </p>
                            <div class="footer-social-bold">
                                <a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer" class="social-link-bold" aria-label="GitHub">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer" class="social-link-bold" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="{{ config('app.social.twitter') }}" target="_blank" rel="noopener noreferrer" class="social-link-bold" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="mailto:{{ config('app.social.email') }}" class="social-link-bold" aria-label="Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6 mb-5">
                        <div class="footer-section-bold">
                            <h5 class="footer-title-bold">Navigate</h5>
                            <ul class="footer-links-bold">
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/') }}#home" class="footer-link-bold">Home</a>
                                </li>
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/') }}#about" class="footer-link-bold">About</a>
                                </li>
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/') }}#projects" class="footer-link-bold">Projects</a>
                                </li>
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/') }}#experience" class="footer-link-bold">Experience</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Resources -->
                    <div class="col-lg-2 col-md-6 mb-5">
                        <div class="footer-section-bold">
                            <h5 class="footer-title-bold">Resources</h5>
                            <ul class="footer-links-bold">
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/') }}#certifications" class="footer-link-bold">Certifications</a>
                                </li>
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/projects') }}" class="footer-link-bold">Portfolio</a>
                                </li>
                                <li class="footer-link-item-bold">
                                    <a href="{{ url('/') }}#contact" class="footer-link-bold">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- CTA Box -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="footer-cta-box">
                            <div class="cta-box-content">
                                <h5 class="cta-box-title">Let's Build Something Great</h5>
                                <p class="cta-box-text">Have a project in mind? Let's turn your ideas into reality.</p>
                                <a href="{{ url('/') }}#contact" class="cta-box-button">
                                    <i class="fas fa-paper-plane"></i>
                                    Start a Project
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom-bold">
                <div class="footer-credits">
                    <div class="footer-copyright-bold">
                        © {{ date('Y') }} <a href="{{ url('/') }}">Dozer Napitupulu</a>.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-bold');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Mobile menu toggle
        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('show');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navMenu = document.getElementById('navMenu');
            const toggler = document.querySelector('.mobile-toggle-bold');
            
            if (!navMenu.contains(event.target) && !toggler.contains(event.target)) {
                navMenu.classList.remove('show');
            }
        });

        // Active nav link on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link-bold');
            
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current) && current !== '') {
                    link.classList.add('active');
                }
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    // Close mobile menu if open
                    document.getElementById('navMenu').classList.remove('show');
                    
                    // Scroll to target
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
