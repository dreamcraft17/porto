<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dozer Napitu - Full Stack Developer')</title>
    
    <!-- Meta tags for SEO and professionalism -->
    <meta name="description" content="Professional portfolio of Dozer Napitu - Full Stack Developer specializing in .NET, Laravel, and Flutter">
    <meta name="keywords" content="full stack developer, .NET developer, Laravel, Flutter, web development">
    <meta name="author" content="Dozer Napitu">
    
    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:title" content="Dozer Napitu - Full Stack Developer">
    <meta property="og:description" content="Professional portfolio showcasing projects and skills in web and mobile development">
    <meta property="og:type" content="website">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Devicon for Technology Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&family=Source+Code+Pro:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #7c3aed;
            --dark-color: #0f172a;
            --dark-light: #1e293b;
            --light-color: #f8fafc;
            --gray-color: #64748b;
            --gray-light: #e2e8f0;
            --success-color: #10b981;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            color: var(--dark-color);
            line-height: 1.7;
            background-color: var(--light-color);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            line-height: 1.3;
        }
        
        .mono-font {
            font-family: 'Source Code Pro', monospace;
        }
        
        /* Navigation */
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            transition: var(--transition);
        }
        
        .navbar.scrolled {
            padding: 0.7rem 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
        
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color) !important;
        }
        
        .navbar-brand span {
            color: var(--primary-color);
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 0.3rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(37, 99, 235, 0.05);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--dark-color) 0%, var(--dark-light) 100%);
            color: white;
            padding: 160px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--gray-light);
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        .highlight {
            color: var(--primary-color);
            position: relative;
        }
        
        .highlight::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background-color: rgba(37, 99, 235, 0.2);
            z-index: -1;
        }
        
        /* Section Styling */
        section {
            padding: 100px 0;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 50px;
            font-size: 2.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 70px;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }
        
        .text-center .section-title:after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .section-subtitle {
            color: var(--gray-color);
            font-size: 1.1rem;
            max-width: 700px;
            margin-bottom: 3rem;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            background-color: white;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow);
        }
        
        /* Skill Bars */
        .skill-item {
            margin-bottom: 1.5rem;
        }
        
        .skill-name {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .skill-bar {
            height: 10px;
            background-color: var(--gray-light);
            border-radius: 5px;
            overflow: hidden;
        }
        
        .skill-level {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 5px;
            width: 0;
            transition: width 1.5s cubic-bezier(0.22, 0.61, 0.36, 1);
        }
        
        /* Project Cards */
        .project-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            background-color: white;
        }
        
        .project-img-container {
            height: 220px;
            overflow: hidden;
            position: relative;
        }
        
        .project-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .project-card:hover .project-img {
            transform: scale(1.05);
        }
        
        .project-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }
        
        .project-card:hover .project-overlay {
            opacity: 1;
        }
        
        .badge-tech {
            background-color: var(--gray-light);
            color: var(--dark-color);
            font-weight: 500;
            padding: 0.4rem 0.8rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: var(--gray-light);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 2px;
        }
        
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }
        
        .timeline-item:nth-child(odd) {
            left: 0;
        }
        
        .timeline-item:nth-child(even) {
            left: 50%;
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: white;
            border: 4px solid var(--primary-color);
            border-radius: 50%;
            top: 15px;
            z-index: 1;
        }
        
        .timeline-item:nth-child(odd)::after {
            right: -10px;
        }
        
        .timeline-item:nth-child(even)::after {
            left: -10px;
        }
        
        .timeline-content {
            padding: 20px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
        }
        
        /* Footer */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 80px 0 40px;
        }
        
        .footer-title {
            color: white;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
        }
        
        .footer-links a {
            color: var(--gray-light);
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
            margin-bottom: 0.8rem;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 44px;
            margin-right: 12px;
            color: white;
            transition: var(--transition);
        }
        
        .social-icons a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            color: var(--gray-color);
            font-size: 0.9rem;
            padding-top: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            section {
                padding: 70px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .timeline::after {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item:nth-child(even) {
                left: 0;
            }
            
            .timeline-item::after {
                left: 21px;
            }
            
            .timeline-item:nth-child(even)::after {
                left: 21px;
            }
        }
        
        /* Animation classes */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Utility classes */
        .rounded-lg {
            border-radius: var(--border-radius);
        }
        
        .shadow-sm {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .text-gradient {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span>Dozer</span> Napitupulu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#certifications">Certifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#experience">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/projects') }}">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ url('/') }}#contact" class="btn btn-primary">Get In Touch</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="footer-title">Dozer Napitu</h4>
                    <p class="text-white-50 mb-4">Full Stack Developer specializing in modern web and mobile technologies, creating efficient and scalable digital solutions.</p>
                    <div class="social-icons">
                        <a href="https://github.com/dozernapitupulu" target="_blank" aria-label="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://twitter.com/dozernapitupulu" target="_blank" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="mailto:dozernapitupulu@gmail.com" aria-label="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <h4 class="footer-title">Navigation</h4>
                    <div class="footer-links">
                        <a href="{{ url('/') }}#home">Home</a>
                        <a href="{{ url('/') }}#about">About</a>
                        <a href="{{ url('/') }}#skills">Skills</a>
                        <a href="{{ url('/') }}#projects">Projects</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <h4 class="footer-title">Resources</h4>
                    <div class="footer-links">
                        <a href="{{ url('/') }}#experience">Experience</a>
                        <a href="{{ url('/projects') }}">Portfolio</a>
                        <a href="{{ url('/') }}#contact">Contact</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4 class="footer-title">Get In Touch</h4>
                    <p class="text-white-50 mb-3">Interested in collaborating on a project? Feel free to reach out.</p>
                    <a href="mailto:dozernapitupulu@gmail.com" class="btn btn-outline-light">dozernapitupulu@gmail.com</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="copyright text-center">
                        <p class="mb-0">&copy; {{ date('Y') }} Dozer Napitu. All rights reserved. | Built with <i class="fas fa-heart text-danger mx-1"></i> and modern web technologies</p>
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
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    // Update active nav link
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // Scroll to target
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Animate skill bars on scroll
        function animateSkillBars() {
            const skillBars = document.querySelectorAll('.skill-level');
            skillBars.forEach(bar => {
                const width = bar.getAttribute('data-width');
                bar.style.width = width + '%';
            });
        }
        
        // Scroll animation for elements
        function animateOnScroll() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    element.classList.add('visible');
                }
            });
        }
        
        // Initialize animations
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', () => {
            animateOnScroll();
            animateSkillBars();
        });
        
        // Set current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
    
    @yield('scripts')
</body>
</html>