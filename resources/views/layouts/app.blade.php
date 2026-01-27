<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dozer Napitupulu — Full Stack Developer')</title>
    
    <!-- Meta tags for SEO and professionalism -->
    <meta name="description" content="Professional portfolio of Dozer Napitupulu - Full Stack Developer specializing in .NET, Laravel, and Flutter">
    <meta name="keywords" content="full stack developer, .NET developer, Laravel, Flutter, web development">
    <meta name="author" content="Dozer Napitupulu">
    
    <!-- Open Graph meta tags for social sharing -->
    <meta property="og:title" content="Dozer Napitupulu — Full Stack Developer">
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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Syne:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --secondary-color: #8b5cf6;
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
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            color: var(--dark-color);
            line-height: 1.7;
            background-color: var(--light-color);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }

        /* ============================================
           BOLD DISTINCTIVE NAVIGATION
        ============================================ */
        
        .navbar-bold {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1.25rem 0;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-bold.scrolled {
            padding: 1rem 0;
            background: rgba(15, 23, 42, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border-bottom-color: rgba(59, 130, 246, 0.2);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        /* Brand Logo Options - Bold & Distinctive */
        
        /* Option 1: Geometric Badge Style */
        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            position: relative;
        }

        .brand-icon-badge {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .brand-icon-badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
        }

        .brand-badge:hover .brand-icon-badge::before {
            left: 100%;
        }

        .brand-icon-badge::after {
            content: '';
            position: absolute;
            top: 4px;
            right: 4px;
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse-status 2s ease-in-out infinite;
        }

        @keyframes pulse-status {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        .brand-text-badge {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .brand-name-badge {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.125rem;
            color: white;
            letter-spacing: -0.02em;
        }

        .brand-title-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.7rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 2px;
        }

        /* Option 2: Brutalist/Bold Text */
        .brand-brutalist {
            text-decoration: none;
            position: relative;
            display: inline-block;
        }

        .brand-brutalist-text {
            font-family: 'Syne', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: -0.03em;
            position: relative;
            display: inline-block;
        }

        .brand-brutalist-text::before {
            content: attr(data-text);
            position: absolute;
            top: 3px;
            left: 3px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            z-index: -1;
        }

        .brand-brutalist-subtitle {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-top: -4px;
        }

        /* Option 3: Terminal/Hacker Style */
        .brand-terminal {
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 600;
            font-size: 1rem;
            color: #10b981;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.05);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid rgba(16, 185, 129, 0.2);
            position: relative;
        }

        .terminal-prompt {
            color: #3b82f6;
            font-weight: 700;
        }

        .terminal-cursor {
            display: inline-block;
            width: 8px;
            height: 18px;
            background: #10b981;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            50% { opacity: 0; }
        }

        /* Navigation Menu - Bold Style */
        .nav-menu-bold {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item-bold {
            position: relative;
        }

        .nav-link-bold {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            display: block;
        }

        .nav-link-bold::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 8px;
            width: 4px;
            height: 4px;
            background: #3b82f6;
            border-radius: 50%;
            opacity: 0;
            transform: translateY(-50%) scale(0);
            transition: all 0.3s ease;
        }

        .nav-link-bold:hover,
        .nav-link-bold.active {
            color: white;
            background: rgba(59, 130, 246, 0.15);
        }

        .nav-link-bold.active::before {
            opacity: 1;
            transform: translateY(-50%) scale(1);
        }

        /* CTA Button - Bold Design */
        .nav-cta-bold {
            padding: 0.75rem 1.75rem !important;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white !important;
            border-radius: 10px;
            font-weight: 700;
            margin-left: 1rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .nav-cta-bold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-cta-bold:hover::before {
            left: 100%;
        }

        .nav-cta-bold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
        }

        /* Mobile Menu Toggle */
        .mobile-toggle-bold {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid rgba(59, 130, 246, 0.3);
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-toggle-bold:hover {
            background: rgba(59, 130, 246, 0.2);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .toggle-line {
            width: 24px;
            height: 3px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* ============================================
           BOLD DISTINCTIVE FOOTER
        ============================================ */
        
        .footer-bold {
            background: linear-gradient(180deg, #0a0f1e 0%, #050810 100%);
            color: #cbd5e1;
            padding: 100px 0 0;
            position: relative;
            overflow: hidden;
        }

        .footer-bold::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, #8b5cf6, transparent);
        }

        .footer-bold::after {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.03) 0%, transparent 70%);
            pointer-events: none;
        }

        .footer-content-bold {
            position: relative;
            z-index: 1;
        }

        /* Footer Brand - Bold Style */
        .footer-brand-bold {
            margin-bottom: 3rem;
        }

        .footer-logo-bold {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .footer-logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 900;
            font-size: 1.75rem;
            color: white;
            position: relative;
        }

        .footer-logo-icon::after {
            content: '';
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            border: 2px solid #0a0f1e;
        }

        .footer-logo-text {
            display: flex;
            flex-direction: column;
        }

        .footer-logo-name {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            color: white;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .footer-logo-tagline-bold {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.75rem;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-top: 4px;
        }

        .footer-description-bold {
            color: #94a3b8;
            font-size: 1.05rem;
            line-height: 1.8;
            max-width: 400px;
            margin-bottom: 2rem;
        }

        /* Social Links - Bold Design */
        .footer-social-bold {
            display: flex;
            gap: 1rem;
        }

        .social-link-bold {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(59, 130, 246, 0.08);
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.25rem;
            position: relative;
            overflow: hidden;
        }

        .social-link-bold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            transition: left 0.3s ease;
        }

        .social-link-bold:hover::before {
            left: 0;
        }

        .social-link-bold i {
            position: relative;
            z-index: 1;
        }

        .social-link-bold:hover {
            border-color: #3b82f6;
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        }

        /* Footer Sections - Bold Typography */
        .footer-section-bold {
            margin-bottom: 2rem;
        }

        .footer-title-bold {
            font-family: 'Syne', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            position: relative;
            display: inline-block;
        }

        .footer-title-bold::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50%;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            border-radius: 2px;
        }

        .footer-links-bold {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link-item-bold {
            margin-bottom: 1rem;
        }

        .footer-link-bold {
            color: #94a3b8;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
        }

        .footer-link-bold::before {
            content: '▸';
            color: #3b82f6;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .footer-link-bold:hover {
            color: white;
            transform: translateX(8px);
        }

        .footer-link-bold:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        /* Newsletter/CTA Box */
        .footer-cta-box {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 16px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .footer-cta-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .cta-box-content {
            position: relative;
            z-index: 1;
        }

        .cta-box-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.75rem;
        }

        .cta-box-text {
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .cta-box-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .cta-box-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
            color: white;
        }

        /* Footer Bottom - Bold */
        .footer-bottom-bold {
            margin-top: 5rem;
            padding: 2.5rem 0;
            border-top: 2px solid rgba(59, 130, 246, 0.1);
            position: relative;
        }

        .footer-credits {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-copyright-bold {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.9rem;
            color: #64748b;
        }

        .footer-copyright-bold a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-copyright-bold a:hover {
            color: #8b5cf6;
        }

        .footer-tech-stack {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .tech-badge-footer {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 8px;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .tech-badge-footer:hover {
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.4);
            color: #cbd5e1;
            transform: translateY(-2px);
        }

        .made-with-love {
            font-size: 0.9rem;
            color: #64748b;
        }

        .love-icon {
            color: #ef4444;
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.2); }
            50% { transform: scale(1); }
        }

        /* Responsive */
        @media (max-width: 991px) {
            .mobile-toggle-bold {
                display: flex;
            }

            .nav-menu-bold {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(15, 23, 42, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 2rem;
                margin-top: 1rem;
                border-radius: 16px;
                border: 2px solid rgba(59, 130, 246, 0.2);
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            }

            .nav-menu-bold.show {
                display: flex;
            }

            .nav-cta-bold {
                margin-left: 0;
                margin-top: 1rem;
                text-align: center;
            }

            .footer-credits {
                flex-direction: column;
                text-align: center;
            }

            .footer-tech-stack {
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            .brand-text-badge,
            .brand-brutalist-subtitle,
            .brand-title-badge {
                display: none;
            }

            .footer-bold {
                padding: 60px 0 0;
            }

            .footer-logo-bold {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Utility classes */
        .rounded-lg {
            border-radius: var(--border-radius);
        }
        
        .shadow-sm {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
    
    @yield('styles')
</head>
<body>
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
                        <div class="brand-title-badge">Full Stack Dev</div>
                    </div>
                </a>
                
                <!-- Option 2: Brutalist/Bold Text Style 
                <a href="{{ url('/') }}" class="brand-brutalist">
                    <div class="brand-brutalist-text" data-text="DOZER">DOZER</div>
                    <div class="brand-brutalist-subtitle">// Full Stack Developer</div>
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

    <main style="padding-top: 100px;">
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
                                    <div class="footer-logo-tagline-bold">Full Stack Developer</div>
                                </div>
                            </div>
                            <p class="footer-description-bold">
                                Crafting scalable digital experiences with modern web and mobile technologies. 
                                Passionate about clean code and innovative solutions.
                            </p>
                            <div class="footer-social-bold">
                                <a href="https://github.com/dozernapitupulu" target="_blank" class="social-link-bold" aria-label="GitHub">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank" class="social-link-bold" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://twitter.com/dozernapitupulu" target="_blank" class="social-link-bold" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="mailto:dozernapitupulu@gmail.com" class="social-link-bold" aria-label="Email">
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
                        © {{ date('Y') }} <a href="{{ url('/') }}">Dozer Napitupulu</a>. All rights reserved.
                        <span class="made-with-love d-block d-md-inline ms-md-2 mt-2 mt-md-0">
                            Built with <span class="love-icon">♥</span> using modern tech
                        </span>
                    </div>
                    <div class="footer-tech-stack">
                        <span class="tech-badge-footer">
                            <i class="fab fa-laravel"></i> Laravel
                        </span>
                        <span class="tech-badge-footer">
                            <i class="fab fa-bootstrap"></i> Bootstrap
                        </span>
                        <span class="tech-badge-footer">
                            <i class="fab fa-js"></i> JavaScript
                        </span>
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