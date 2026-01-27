@extends('layouts.app')

@section('title', 'Portfolio - Home')

@section('styles')
<style>
    /* Enhanced Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }

    /* ============================================
       PROFESSIONAL HERO SECTION STYLES
    ============================================ */
    
    /* Hero Section - Professional Design */
    .hero-section {
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(58, 134, 255, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(138, 43, 226, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #10b981;
        letter-spacing: 0.02em;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { 
            opacity: 1;
            transform: scale(1);
        }
        50% { 
            opacity: 0.5;
            transform: scale(1.1);
        }
    }

    /* Main Title */
    .hero-main-title {
        font-size: clamp(2.5rem, 6vw, 5rem);
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.1;
        letter-spacing: -0.02em;
        margin-bottom: 1.5rem;
    }

    /* Role Container */
    .hero-role-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .hero-role-label {
        font-family: 'Source Code Pro', monospace;
        font-size: 1.5rem;
        color: #3b82f6;
        font-weight: 500;
    }

    .hero-role-text {
        font-size: clamp(1.5rem, 3vw, 2.5rem);
        font-weight: 600;
        color: #94a3b8;
        margin: 0;
        line-height: 1.2;
    }

    #typed-role {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Description */
    .hero-description {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #cbd5e1;
        max-width: 600px;
    }

    /* Tech Stack Container */
    .tech-stack-container {
        margin-top: 2rem;
    }

    .tech-stack-label {
        font-family: 'Source Code Pro', monospace;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #64748b;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .tech-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .tech-pill {
        padding: 8px 16px;
        background: rgba(51, 65, 85, 0.5);
        border: 1px solid rgba(148, 163, 184, 0.2);
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #e2e8f0;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .tech-pill:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.5);
        color: #60a5fa;
        transform: translateY(-2px);
    }

    /* CTA Buttons */
    .hero-cta-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-hero-primary {
        padding: 14px 32px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
        color: white;
    }

    .btn-hero-secondary {
        padding: 14px 32px;
        background: transparent;
        color: #e2e8f0;
        border: 2px solid rgba(226, 232, 240, 0.2);
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .btn-hero-secondary:hover {
        background: rgba(226, 232, 240, 0.05);
        border-color: rgba(226, 232, 240, 0.4);
        color: white;
        transform: translateY(-3px);
    }

    /* Social Links */
    .hero-social-container {
        margin-top: 2rem;
    }

    .social-links-grid {
        display: flex;
        gap: 1rem;
    }

    .social-link-modern {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(51, 65, 85, 0.5);
        border: 1px solid rgba(148, 163, 184, 0.2);
        border-radius: 10px;
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.1rem;
    }

    .social-link-modern:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.5);
        color: #60a5fa;
        transform: translateY(-3px);
    }

    /* Visual Container */
    .hero-visual-container {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        height: 600px;
    }

    /* Profile Card */
    .profile-card-modern {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .profile-image-container {
        position: relative;
        width: 400px;
        height: 400px;
        margin: 0 auto;
    }

    .profile-image-modern {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        position: relative;
        z-index: 1;
    }

    .profile-image-border {
        position: absolute;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
        border: 2px solid rgba(59, 130, 246, 0.3);
        border-radius: 24px;
        z-index: 0;
    }

    .profile-image-border::before {
        content: '';
        position: absolute;
        top: -20px;
        left: -20px;
        right: -20px;
        bottom: -20px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
        border-radius: 30px;
        filter: blur(30px);
        z-index: -1;
    }

    /* Floating Stat Cards */
    .floating-stat-card {
        position: absolute;
        background: rgba(15, 23, 42, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(148, 163, 184, 0.2);
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        z-index: 3;
    }

    .floating-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        border-color: rgba(59, 130, 246, 0.5);
    }

    .stat-card-1 {
        top: 50px;
        right: -20px;
        animation: float 6s ease-in-out infinite;
    }

    .stat-card-2 {
        top: 200px;
        left: -40px;
        animation: float 6s ease-in-out infinite;
        animation-delay: 1s;
    }

    .stat-card-3 {
        bottom: 80px;
        right: -30px;
        animation: float 6s ease-in-out infinite;
        animation-delay: 2s;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2));
        border-radius: 12px;
        color: #60a5fa;
        font-size: 1.25rem;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #f8fafc;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    .stat-label-only {
        font-size: 0.875rem;
        color: #f8fafc;
        font-weight: 600;
    }

    /* Background Elements */
    .hero-bg-element {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.3;
        z-index: 0;
    }

    .element-1 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        top: -100px;
        right: -50px;
        animation: pulse-bg 8s ease-in-out infinite;
    }

    .element-2 {
        width: 250px;
        height: 250px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        bottom: -50px;
        left: -80px;
        animation: pulse-bg 10s ease-in-out infinite;
        animation-delay: 2s;
    }

    @keyframes pulse-bg {
        0%, 100% { 
            opacity: 0.2;
            transform: scale(1);
        }
        50% { 
            opacity: 0.4;
            transform: scale(1.1);
        }
    }

    /* Hero Section Responsive */
    @media (max-width: 991px) {
        .hero-section {
            padding: 100px 0 80px;
        }

        .hero-visual-container {
            height: 500px;
            margin-top: 4rem;
        }

        .profile-image-container {
            width: 320px;
            height: 320px;
        }

        .stat-card-1,
        .stat-card-2,
        .stat-card-3 {
            padding: 1rem;
        }

        .stat-card-2 {
            left: -20px;
        }
    }

    @media (max-width: 767px) {
        .hero-main-title {
            font-size: 2.5rem;
        }

        .hero-role-text {
            font-size: 1.5rem;
        }

        .tech-pills {
            gap: 0.5rem;
        }

        .tech-pill {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .hero-cta-container {
            flex-direction: column;
        }

        .btn-hero-primary,
        .btn-hero-secondary {
            width: 100%;
            justify-content: center;
        }

        .profile-image-container {
            width: 280px;
            height: 280px;
        }

        .floating-stat-card {
            padding: 0.875rem;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }

        .stat-number {
            font-size: 1.25rem;
        }
    }

    /* ============================================
       OTHER SECTIONS STYLES
    ============================================ */

    /* Button Enhancements */
    .btn-primary, .btn-outline-light {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        border-radius: 50px;
        font-weight: 600;
    }

    .btn-primary::before, .btn-outline-light::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-primary:hover::before, .btn-outline-light:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(58, 134, 255, 0.4);
    }

    .btn-outline-light:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.1);
    }

    /* Section Title Enhancement */
    .section-title {
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
        margin-bottom: 40px;
        font-weight: 700;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }

    /* Project Card Enhancement */
    .project-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        background: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .project-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .project-img {
        height: 200px;
        object-fit: cover;
        transition: all 0.4s ease;
    }

    .project-card:hover .project-img {
        transform: scale(1.1);
        filter: brightness(1.1);
    }

    .project-card .card-body {
        position: relative;
        z-index: 1;
        padding: 1.5rem;
    }

    /* Technology Badge with Images */
    .tech-badge {
        display: inline-flex;
        align-items: center;
        background: #f8f9fa;
        color: #333;
        padding: 6px 12px;
        border-radius: 20px;
        margin-right: 8px;
        margin-bottom: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .tech-badge:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(58, 134, 255, 0.2);
    }

    .tech-badge i {
        margin-right: 6px;
        font-size: 1.1rem;
    }

    /* Technology Icon Colors */
    .tech-dotnet { color: #512BD4; }
    .tech-aspnet { color: #512BD4; }
    .tech-csharp { color: #239120; }
    .tech-sqlserver { color: #CC2927; }
    .tech-mysql { color: #00758F; }
    .tech-laravel { color: #FF2D20; }
    .tech-php { color: #777BB4; }
    .tech-flutter { color: #02569B; }
    .tech-restapi { color: #6DB33F; }
    .tech-javascript { color: #F7DF1E; }

    /* Timeline Enhancement */
    .timeline-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-left: 3px solid var(--primary-color);
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -9px;
        top: 0;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(58, 134, 255, 0.2);
        transition: all 0.3s ease;
    }

    .timeline-item:hover::before {
        transform: scale(1.5);
        box-shadow: 0 0 0 8px rgba(58, 134, 255, 0.3);
    }

    .timeline-item:last-child {
        border-left-color: transparent;
    }

    /* Education Card Enhancement */
    .education-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }

    .education-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
    }

    .education-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    /* Contact Form Enhancement */
    .form-control {
        border-radius: 10px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
        color: white;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--primary-color);
        color: white;
        box-shadow: 0 0 0 0.2rem rgba(58, 134, 255, 0.25);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Scroll Animation */
    .scroll-animate {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease-out;
    }

    .scroll-animate.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Stats Cards */
    .stat-card {
        padding: 30px;
        border-radius: 15px;
        background: white;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .stat-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .stat-card .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Projects Section Header */
    .projects-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .projects-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Skills by Category Styles */
    .skills-category-container {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .skill-category-item {
        margin-bottom: 30px;
    }

    .category-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid rgba(58, 134, 255, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-title i {
        font-size: 1.2rem;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .skill-badge {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, rgba(58, 134, 255, 0.1), rgba(138, 43, 226, 0.1));
        color: var(--primary-color);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid rgba(58, 134, 255, 0.2);
    }

    .skill-badge:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(58, 134, 255, 0.2);
        border-color: var(--primary-color);
    }

    .skill-badge i {
        margin-right: 8px;
        font-size: 1rem;
    }

    /* Category-specific icon colors */
    .skill-badge.frontend i { color: #4CAF50; }
    .skill-badge.backend i { color: #FF5722; }
    .skill-badge.database i { color: #2196F3; }
    .skill-badge.mobile i { color: #9C27B0; }
    .skill-badge.tools i { color: #FF9800; }
    .skill-badge.other i { color: #795548; }

    /* Skills Tabs Navigation */
    .skills-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .skill-tab {
        padding: 10px 24px;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 25px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .skill-tab:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: rgba(58, 134, 255, 0.05);
    }

    .skill-tab.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .skill-tab i {
        font-size: 1rem;
    }

    .skills-tab-content {
        display: none;
        animation: fadeInUp 0.5s ease-out;
    }

    .skills-tab-content.active {
        display: block;
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in-up">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="status-badge">
                            <span class="status-dot"></span>
                            Available for opportunities
                        </span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="hero-main-title">
                        Dozer Napitupulu
                    </h1>

                    <!-- Role with animation -->
                    <div class="hero-role-container mb-4">
                        <span class="hero-role-label">—</span>
                        <h2 class="hero-role-text">
                            <span id="typed-role">Full Stack Developer</span>
                        </h2>
                    </div>

                    <!-- Description -->
                    <p class="hero-description mb-5">
                        Specialized in building scalable web and mobile applications using modern technologies. 
                        Passionate about clean code, user experience, and solving complex problems.
                    </p>

                    <!-- Tech Stack Pills -->
                    <div class="tech-stack-container mb-5">
                        <div class="tech-stack-label">Core Technologies</div>
                        <div class="tech-pills">
                            <span class="tech-pill">.NET Core</span>
                            <span class="tech-pill">Laravel</span>
                            <span class="tech-pill">Flutter</span>
                            <span class="tech-pill">C#</span>
                            <span class="tech-pill">PHP</span>
                            <span class="tech-pill">JavaScript</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="hero-cta-container mb-5">
                        <a href="#projects" class="btn-hero-primary">
                            View Work
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="#contact" class="btn-hero-secondary">
                            Get in Touch
                        </a>
                    </div>

                    <!-- Social Links -->
                    <div class="hero-social-container">
                        <div class="social-links-grid">
                            <a href="https://github.com/dozernapitupulu" target="_blank" class="social-link-modern" aria-label="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank" class="social-link-modern" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://www.instagram.com/dozerfrnd/" target="_blank" class="social-link-modern" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://twitter.com/dozernapitupulu" target="_blank" class="social-link-modern" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile Image Side -->
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-visual-container">
                        <!-- Main Profile Card -->
                        <div class="profile-card-modern">
                            <div class="profile-image-container">
                                <img src="{{ asset('images/profile/dozer.png') }}" 
                                     alt="Dozer Napitu - Full Stack Developer"
                                     class="profile-image-modern">
                                <div class="profile-image-border"></div>
                            </div>
                        </div>

                        <!-- Floating Stats Cards -->
                        <div class="floating-stat-card stat-card-1">
                            <div class="stat-icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">3+</div>
                                <div class="stat-label">Years</div>
                            </div>
                        </div>

                        <div class="floating-stat-card stat-card-2">
                            <div class="stat-icon">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">20+</div>
                                <div class="stat-label">Projects</div>
                            </div>
                        </div>

                        <div class="floating-stat-card stat-card-3">
                            <div class="stat-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-label-only">Full Stack</div>
                            </div>
                        </div>

                        <!-- Background Elements -->
                        <div class="hero-bg-element element-1"></div>
                        <div class="hero-bg-element element-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">About Me</h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4 scroll-animate">
                    <div class="stat-card">
                        <div class="stat-number">3+</div>
                        <p class="mb-0 text-muted fw-bold">Years Experience</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.1s">
                    <div class="stat-card">
                        <div class="stat-number">20+</div>
                        <p class="mb-0 text-muted fw-bold">Completed Projects</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.2s">
                    <div class="stat-card">
                        <div class="stat-number">10+</div>
                        <p class="mb-0 text-muted fw-bold">Technologies</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.3s">
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <p class="mb-0 text-muted fw-bold">Commitment</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0 scroll-animate">
                    <p class="mb-3" style="font-size: 1.1rem; line-height: 1.8;">I am an enthusiastic <strong>Full-Stack Developer</strong> specializing in <strong>.NET, Laravel,</strong> and <strong>Flutter</strong> technologies. With a passion for building user-friendly and engaging applications, I focus on creating secure and scalable solutions.</p>
                    <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8;">I'm eager to expand my skill set and contribute to innovative development projects. Currently seeking opportunities to develop skills and gain more practical experience in <strong>Full-Stack Development, Back-End Programming,</strong> and <strong>Web Security</strong>.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> <strong>Full-Stack Development</strong></li>
                                <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> <strong>Mobile App Development</strong></li>
                                <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> <strong>API Development</strong></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> <strong>Database Design</strong></li>
                                <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> <strong>Web Security</strong></li>
                                <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i> <strong>Responsive Design</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 scroll-animate" style="transition-delay: 0.2s">
                    <h3 class="mb-4" style="font-weight: 700;">Technical Skills</h3>
                    
                    <!-- Skills Tabs Navigation -->
                    <div class="skills-tabs">
                        <div class="skill-tab active" data-tab="all">
                            <i class="fas fa-star"></i> All Skills
                        </div>
                        @php
                            $categories = $skills->pluck('category')->unique();
                            $categoryIcons = [
                                'frontend' => 'fas fa-code',
                                'backend' => 'fas fa-server',
                                'database' => 'fas fa-database',
                                'mobile' => 'fas fa-mobile-alt',
                                'tools' => 'fas fa-tools',
                                'framework' => 'fas fa-layer-group',
                                'language' => 'fas fa-file-code'
                            ];
                        @endphp
                        @foreach($categories as $category)
                        <div class="skill-tab" data-tab="{{ $category }}">
                            <i class="{{ $categoryIcons[$category] ?? 'fas fa-cog' }}"></i>
                            {{ ucfirst($category) }}
                        </div>
                        @endforeach
                    </div>

                    <!-- All Skills Tab Content -->
                    <div class="skills-tab-content active" id="tab-all">
                        <div class="skills-category-container">
                            @foreach($skills->groupBy('category') as $category => $categorySkills)
                            <div class="skill-category-item">
                                <h5 class="category-title">
                                    <i class="{{ $categoryIcons[$category] ?? 'fas fa-cog' }}"></i>
                                    {{ ucfirst($category) }}
                                </h5>
                                <div class="skills-list">
                                    @foreach($categorySkills as $skill)
                                    <div class="skill-badge {{ $category }}">
                                        @if($skill->name == 'ASP.NET')
                                            <i class="fab fa-microsoft"></i>
                                        @elseif($skill->name == 'C#')
                                            <i class="fas fa-code"></i>
                                        @elseif($skill->name == 'Laravel')
                                            <i class="fab fa-laravel"></i>
                                        @elseif($skill->name == 'PHP')
                                            <i class="fab fa-php"></i>
                                        @elseif($skill->name == 'Flutter')
                                            <i class="fab fa-flutter"></i>
                                        @elseif($skill->name == 'JavaScript')
                                            <i class="fab fa-js-square"></i>
                                        @elseif($skill->name == 'MySQL' || $skill->name == 'SQL Server')
                                            <i class="fas fa-database"></i>
                                        @elseif($skill->name == 'REST API')
                                            <i class="fas fa-plug"></i>
                                        @elseif($skill->name == 'Git')
                                            <i class="fab fa-git-alt"></i>
                                        @elseif($skill->name == 'Docker')
                                            <i class="fab fa-docker"></i>
                                        @else
                                            <i class="fas fa-code"></i>
                                        @endif
                                        {{ $skill->name }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Individual Category Tab Content -->
                    @foreach($categories as $category)
                    <div class="skills-tab-content" id="tab-{{ $category }}">
                        <div class="skills-category-container">
                            <div class="skill-category-item">
                                <h5 class="category-title">
                                    <i class="{{ $categoryIcons[$category] ?? 'fas fa-cog' }}"></i>
                                    {{ ucfirst($category) }} Skills
                                </h5>
                                <div class="skills-list">
                                    @foreach($skills->where('category', $category) as $skill)
                                    <div class="skill-badge {{ $category }}">
                                        @if($skill->name == 'ASP.NET')
                                            <i class="fab fa-microsoft"></i>
                                        @elseif($skill->name == 'C#')
                                            <i class="fas fa-code"></i>
                                        @elseif($skill->name == 'Laravel')
                                            <i class="fab fa-laravel"></i>
                                        @elseif($skill->name == 'PHP')
                                            <i class="fab fa-php"></i>
                                        @elseif($skill->name == 'Flutter')
                                            <i class="fab fa-flutter"></i>
                                        @elseif($skill->name == 'JavaScript')
                                            <i class="fab fa-js-square"></i>
                                        @elseif($skill->name == 'MySQL' || $skill->name == 'SQL Server')
                                            <i class="fas fa-database"></i>
                                        @elseif($skill->name == 'REST API')
                                            <i class="fas fa-plug"></i>
                                        @elseif($skill->name == 'Git')
                                            <i class="fab fa-git-alt"></i>
                                        @elseif($skill->name == 'Docker')
                                            <i class="fab fa-docker"></i>
                                        @else
                                            <i class="fas fa-code"></i>
                                        @endif
                                        {{ $skill->name }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">My Projects</h2>
                    <p class="projects-subtitle">
                        Projects I've worked on during my time at various companies<br>
                        <strong>Professional Experience • Real-World Solutions • Industry Projects</strong>
                    </p>
                </div>
            </div>
            <div class="row">
                <!-- Project 1: POS System for Café -->
                <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: 0s">
                    <div class="project-card card">
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: white; padding: 20px;">
                                    <i class="fas fa-cash-register fa-4x mb-3" style="opacity: 0.9;"></i>
                                    <h4 style="font-weight: 700;">POS System</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Point of Sale (POS) System for Café Operations</h5>
                            <p class="card-text text-muted">Developed a Point of Sale (POS) system for company-owned café operations, handling transaction processing, inventory management, and sales reporting.</p>
                            <div class="mb-3">
                                <span class="tech-badge">
                                    <i class="fab fa-microsoft tech-aspnet"></i>ASP.NET MVC
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-database tech-sqlserver"></i>SQL Server
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-database tech-mysql"></i>MySQL
                                </span>
                            </div>
                            <a href="{{ route('project.show', 'pos-system-cafe') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 2: Online Ordering Mobile App -->
                <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.1s">
                    <div class="project-card card">
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: white; padding: 20px;">
                                    <i class="fas fa-mobile-alt fa-4x mb-3" style="opacity: 0.9;"></i>
                                    <h4 style="font-weight: 700;">Ordering App</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Online Ordering Mobile Application</h5>
                            <p class="card-text text-muted">Developed an online ordering mobile application similar to popular café ordering platforms, allowing customers to browse menu, place orders, and make payments.</p>
                            <div class="mb-3">
                                <span class="tech-badge">
                                    <i class="fab fa-flutter tech-flutter"></i>Flutter
                                </span>
                                <span class="tech-badge">
                                    <i class="fab fa-microsoft tech-aspnet"></i>ASP.NET
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-code tech-csharp"></i>C#
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-plug tech-restapi"></i>REST API
                                </span>
                            </div>
                            <a href="{{ route('project.show', 'online-ordering-app') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 3: Back-Office Web Application -->
                <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.2s">
                    <div class="project-card card">
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: white; padding: 20px;">
                                    <i class="fas fa-chart-line fa-4x mb-3" style="opacity: 0.9;"></i>
                                    <h4 style="font-weight: 700;">Back-Office</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Back-Office Web Application</h5>
                            <p class="card-text text-muted">Developed a back-office web application to support operational management, reporting, and administrative tasks for café chain operations.</p>
                            <div class="mb-3">
                                <span class="tech-badge">
                                    <i class="fab fa-laravel tech-laravel"></i>Laravel
                                </span>
                                <span class="tech-badge">
                                    <i class="fab fa-php tech-php"></i>PHP
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-database tech-mysql"></i>MySQL
                                </span>
                            </div>
                            <a href="{{ route('project.show', 'back-office-web') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 4: Employee Mobile App -->
                <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.3s">
                    <div class="project-card card">
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: white; padding: 20px;">
                                    <i class="fas fa-users fa-4x mb-3" style="opacity: 0.9;"></i>
                                    <h4 style="font-weight: 700;">Employee App</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Employee Mobile Application</h5>
                            <p class="card-text text-muted">Developed an employee mobile application to support internal operational activities, including task management, communication, and reporting.</p>
                            <div class="mb-3">
                                <span class="tech-badge">
                                    <i class="fab fa-flutter tech-flutter"></i>Flutter
                                </span>
                                <span class="tech-badge">
                                    <i class="fab fa-laravel tech-laravel"></i>Laravel
                                </span>
                                <span class="tech-badge">
                                    <i class="fab fa-php tech-php"></i>PHP
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-plug tech-restapi"></i>REST API
                                </span>
                            </div>
                            <a href="{{ route('project.show', 'employee-mobile-app') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 5: Core Banking Web Implementation -->
                <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.4s">
                    <div class="project-card card">
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: white; padding: 20px;">
                                    <i class="fas fa-university fa-4x mb-3" style="opacity: 0.9;"></i>
                                    <h4 style="font-weight: 700;">Banking System</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Core Banking Web Implementation</h5>
                            <p class="card-text text-muted">Contributed to the implementation of a web-based Core Banking application (Microsys) as a pilot project for multi-branch banking operations.</p>
                            <div class="mb-3">
                                <span class="tech-badge">
                                    <i class="fab fa-microsoft tech-aspnet"></i>ASP.NET
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-code tech-csharp"></i>C#
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-database tech-sqlserver"></i>SQL Server
                                </span>
                            </div>
                            <a href="{{ route('project.show', 'core-banking-web') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 6: Finance Module Development -->
                <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: 0.5s">
                    <div class="project-card card">
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); display: flex; align-items: center; justify-content: center;">
                                <div style="text-align: center; color: white; padding: 20px;">
                                    <i class="fas fa-chart-pie fa-4x mb-3" style="opacity: 0.9;"></i>
                                    <h4 style="font-weight: 700;">Finance Module</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Finance Module Development & System Maintenance</h5>
                            <p class="card-text text-muted">Performed maintenance and feature development for financial modules within the Core Banking web application, ensuring system stability and performance.</p>
                            <div class="mb-3">
                                <span class="tech-badge">
                                    <i class="fab fa-microsoft tech-aspnet"></i>ASP.NET
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-code tech-csharp"></i>C#
                                </span>
                                <span class="tech-badge">
                                    <i class="fas fa-database tech-sqlserver"></i>SQL Server
                                </span>
                            </div>
                            <a href="{{ route('project.show', 'finance-module') }}" class="btn btn-primary w-100">
                                <i class="fas fa-arrow-right me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ url('/projects') }}" class="btn btn-outline-primary btn-lg px-5">
                    <i class="fas fa-th me-2"></i>View All Projects
                </a>
            </div>
        </div>
    </section>

    <!-- Personal Projects Section -->
    <section id="personal-projects" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Personal Projects</h2>
                    <p class="projects-subtitle">
                        My side projects and experiments<br>
                        <strong>Learning • Open Source • Passion Projects</strong>
                    </p>
                </div>
            </div>
            
            @if($personalProjects->count() > 0)
                <div class="row">
                    @foreach($personalProjects as $project)
                    <div class="col-lg-4 col-md-6 mb-4 scroll-animate" style="transition-delay: {{ $loop->index * 0.1 }}s">
                        <div class="project-card card">
                            @if($project->image)
                            <div style="overflow: hidden; height: 200px;">
                                <img src="{{ asset('storage/' . $project->image) }}" 
                                     alt="{{ $project->title }}" 
                                     class="project-img w-100">
                            </div>
                            @else
                            <div style="overflow: hidden;">
                                <div class="project-img" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center;">
                                    <div style="text-align: center; color: white; padding: 20px;">
                                        <i class="fas fa-code fa-4x mb-3" style="opacity: 0.9;"></i>
                                        <h4 style="font-weight: 700;">{{ strtoupper(substr($project->title, 0, 2)) }}</h4>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($project->description, 100) }}</p>
                                
                                @if($project->technologies)
                                <div class="mb-3">
                                    @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                    <span class="tech-badge">
                                        @if($tech == 'Laravel')
                                            <i class="fab fa-laravel tech-laravel"></i>
                                        @elseif($tech == 'PHP')
                                            <i class="fab fa-php tech-php"></i>
                                        @elseif($tech == 'JavaScript')
                                            <i class="fab fa-js-square tech-javascript"></i>
                                        @elseif($tech == 'Flutter')
                                            <i class="fab fa-flutter tech-flutter"></i>
                                        @else
                                            <i class="fas fa-code"></i>
                                        @endif
                                        {{ $tech }}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                                
                                <div class="d-flex gap-2">
                                    @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-dark flex-fill">
                                        <i class="fab fa-github me-2"></i>GitHub
                                    </a>
                                    @endif
                                    
                                    <a href="{{ route('personal.project.show', $project->slug) }}" class="btn btn-primary flex-fill">
                                        <i class="fas fa-arrow-right me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('personal.projects.all') }}" class="btn btn-outline-primary btn-lg px-5">
                        <i class="fas fa-code-branch me-2"></i>View All Personal Projects
                    </a>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-code-branch fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No personal projects available</h4>
                    <p class="text-muted">Check back soon for updates!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Work Experience</h2>
                    <p class="lead">My professional career journey</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @foreach($experiences as $experience)
                    <div class="timeline-item scroll-animate">
                        <h5 class="fw-bold mb-2">{{ $experience->position }}</h5>
                        <h6 style="color: var(--primary-color); font-weight: 600;">
                            <i class="fas fa-building me-2"></i>{{ $experience->company }}
                        </h6>
                        <p class="text-muted mb-3">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                            @if($experience->current)
                                <span class="badge bg-success">Present</span>
                            @else
                                {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                            @endif
                        </p>
                        <p style="line-height: 1.8;">{{ $experience->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section id="certifications" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Certifications</h2>
                    <p class="lead">Professional certifications and achievements</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        @foreach($certifications as $certification)
                        <div class="col-lg-6 mb-4 scroll-animate" style="transition-delay: {{ $loop->index * 0.1 }}s">
                            <div class="card education-card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <i class="fas fa-award fa-2x" style="color: var(--primary-color);"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-2">{{ $certification->name }}</h5>
                                    <h6 class="card-subtitle mb-3" style="color: var(--primary-color); font-weight: 600;">
                                        <i class="fas fa-building me-2"></i>{{ $certification->issuer }}
                                    </h6>
                                    @if($certification->issued_date)
                                    <p class="text-muted mb-3">
                                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($certification->issued_date)->format('M Y') }}
                                    </p>
                                    @endif
                                    @if($certification->url)
                                    <a href="{{ $certification->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt me-2"></i>View Certificate
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title text-white">Let's Collaborate</h2>
                    <p class="lead text-white-50">Have an interesting project? Or just want to chat? Let's connect!</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form id="contactForm" class="scroll-animate">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label text-white">
                                    <i class="fas fa-user me-2"></i>Full Name
                                </label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label text-white">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" class="form-control" id="email" placeholder="name@email.com" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="form-label text-white">
                                <i class="fas fa-tag me-2"></i>Subject
                            </label>
                            <input type="text" class="form-control" id="subject" placeholder="Your message subject" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label text-white">
                                <i class="fas fa-comment-dots me-2"></i>Message
                            </label>
                            <textarea class="form-control" id="message" rows="6" placeholder="Write your message here..." required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Scroll Animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.scroll-animate').forEach(el => {
        observer.observe(el);
    });

    // Form submission
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = this.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        btn.disabled = true;
        
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Sent!';
            
            setTimeout(() => {
                alert('Thank you! Your message has been sent. I will reply soon.');
                this.reset();
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 1000);
        }, 1500);
    });

    // Smooth scroll
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

    // Hero Role Text Animation
    document.addEventListener('DOMContentLoaded', function() {
        const roles = ['Full Stack Developer', 'Software Engineer', 'Web Developer', 'Mobile Developer'];
        let currentIndex = 0;
        const typedElement = document.getElementById('typed-role');
        
        function changeRole() {
            typedElement.style.opacity = '0';
            typedElement.style.transform = 'translateY(-10px)';
            
            setTimeout(() => {
                currentIndex = (currentIndex + 1) % roles.length;
                typedElement.textContent = roles[currentIndex];
                typedElement.style.opacity = '1';
                typedElement.style.transform = 'translateY(0)';
            }, 300);
        }
        
        // Change role every 3 seconds
        setInterval(changeRole, 3000);
        
        // Add transition
        typedElement.style.transition = 'all 0.3s ease';
    });

    // Skills Tabs Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const skillTabs = document.querySelectorAll('.skill-tab');
        const tabContents = document.querySelectorAll('.skills-tab-content');
        
        skillTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Remove active class from all tabs
                skillTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all tab contents
                tabContents.forEach(content => content.classList.remove('active'));
                // Show selected tab content
                document.getElementById(`tab-${tabId}`).classList.add('active');
            });
        });
    });
</script>
@endsection