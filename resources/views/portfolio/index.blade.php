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

    /* Hero Section Enhancements */
    .hero-section {
        position: relative;
        overflow: hidden;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(58, 134, 255, 0.1), rgba(138, 43, 226, 0.1));
        z-index: -1;
    }

    .hero-section .display-4 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        line-height: 1.2;
    }

    .hero-section .lead {
        font-size: clamp(1rem, 2vw, 1.25rem);
        color: rgba(255, 255, 255, 0.9);
    }

    .profile-image-wrapper {
        position: relative;
        animation: float 6s ease-in-out infinite;
    }

    .profile-image-wrapper::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color), #ff6b9d);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        border-radius: 50%;
        z-index: -1;
        filter: blur(20px);
        opacity: 0.7;
    }

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
    .tech-dotnet {
        color: #512BD4;
    }
    .tech-aspnet {
        color: #512BD4;
    }
    .tech-csharp {
        color: #239120;
    }
    .tech-sqlserver {
        color: #CC2927;
    }
    .tech-mysql {
        color: #00758F;
    }
    .tech-laravel {
        color: #FF2D20;
    }
    .tech-php {
        color: #777BB4;
    }
    .tech-flutter {
        color: #02569B;
    }
    .tech-restapi {
        color: #6DB33F;
    }
    .tech-javascript {
        color: #F7DF1E;
    }

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

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Social Icon Styles */
    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .social-icon:hover {
        background: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(58, 134, 255, 0.3);
        color: white;
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

    /* Animated Role Text */
    .role-text {
        display: inline-block;
        min-width: 170px;
        text-align: center;
        transition: all 0.5s ease-in-out;
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

    /* Skills Grid Alternative */
    .skills-grid-category {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .skill-card-category {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-align: center;
    }

    .skill-card-category:hover {
        background: white;
        border-color: var(--primary-color);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .skill-card-category .skill-icon {
        font-size: 2rem;
        margin-bottom: 10px;
        color: var(--primary-color);
    }

    .skill-card-category .skill-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .skill-card-category .skill-category {
        font-size: 0.8rem;
        color: #6c757d;
        background: rgba(58, 134, 255, 0.1);
        padding: 3px 10px;
        border-radius: 10px;
        display: inline-block;
    }

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
                    <div class="mb-3">
                        <span class="badge px-4 py-2" style="background: rgba(58, 134, 255, 0.15); color: var(--primary-color); border: 2px solid rgba(58, 134, 255, 0.3); border-radius: 30px; font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;">
                            👋 WELCOME TO MY PAGE
                        </span>
                    </div>
                    <h1 class="display-4 fw-bold mb-3" style="line-height: 1.1;">
                        Hello, I'm
                        <br>
                        <span style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 1.2em;">
                            Dozer Napitupulu
                        </span>
                    </h1>
                    <h2 class="h3 mb-4" style="color: rgba(255, 255, 255, 0.95); font-weight: 600;">
                        <span id="typed-role" style="color: var(--primary-color);"></span>
                    </h2>
                    <p class="lead mb-4" style="font-size: 1.15rem; line-height: 1.7; color: rgba(255, 255, 255, 0.85);">
                        Full-stack expertise across <strong>Web & Mobile platforms</strong>. Building scalable applications with <strong>.NET, Laravel, Flutter</strong> and modern tech stacks.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge px-3 py-2" style="background: rgba(103, 58, 183, 0.2); color: #B39DDB; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(179, 157, 219, 0.3);">
                            <i class="fas fa-laptop-code me-1"></i>.NET Core
                        </span>
                        <span class="badge px-3 py-2" style="background: rgba(103, 58, 183, 0.2); color: #B39DDB; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(179, 157, 219, 0.3);">
                            <i class="fas fa-laptop-code me-1"></i>.NET
                        </span>
                        <span class="badge px-3 py-2" style="background: rgba(244, 67, 54, 0.2); color: #EF9A9A; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(239, 154, 154, 0.3);">
                            <i class="fab fa-laravel me-1"></i>Laravel
                        </span>
                        <span class="badge px-3 py-2" style="background: rgba(33, 150, 243, 0.2); color: #90CAF9; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(144, 202, 249, 0.3);">
                            <i class="fas fa-mobile-alt me-1"></i>Flutter
                        </span>
                        <span class="badge px-3 py-2" style="background: rgba(76, 175, 80, 0.2); color: #A5D6A7; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(165, 214, 167, 0.3);">
                            <i class="fab fa-php me-1"></i>PHP
                        </span>
                        <span class="badge px-3 py-2" style="background: rgba(255, 152, 0, 0.2); color: #FFCC80; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 204, 128, 0.3);">
                            <i class="fab fa-js-square me-1"></i>JavaScript
                        </span>
                        <span class="badge px-3 py-2" style="background: rgba(156, 39, 176, 0.2); color: #CE93D8; font-size: 0.85rem; font-weight: 600; border-radius: 20px; backdrop-filter: blur(10px); border: 1px solid rgba(206, 147, 216, 0.3);">
                            <i class="fas fa-database me-1"></i>MySQL / SQL Server
                        </span>
                    </div>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="#projects" class="btn btn-primary btn-lg px-5 py-3" style="border-radius: 50px; font-weight: 600; box-shadow: 0 10px 30px rgba(58, 134, 255, 0.3);">
                            <i class="fas fa-briefcase me-2"></i>View Portfolio
                        </a>
                        <a href="#contact" class="btn btn-outline-light btn-lg px-5 py-3" style="border-radius: 50px; font-weight: 600; border-width: 2px;">
                            <i class="fas fa-paper-plane me-2"></i>Let's Talk
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <span style="color: rgba(255, 255, 255, 0.7); font-weight: 600; font-size: 0.9rem;">FOLLOW ME</span>
                        <div class="d-flex gap-3">
                            <a href="https://github.com/dozernapitupulu" target="_blank" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                            <!-- LINKEDIN -->
                            <a href="https://www.linkedin.com/in/dozernapitupulu/" target="_blank" class="social-icon">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="https://twitter.com/dozernapitupulu" target="_blank" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <!-- INSTAGRAM -->
                            <a href="https://www.instagram.com/dozerfrnd/" target="_blank" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="profile-image-wrapper">
                        <div class="profile-image-wrapper">
        <div class="rounded-circle overflow-hidden mx-auto position-relative" style="width: 400px; height: 400px; border: 8px solid rgba(255,255,255,0.1); box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);">
            <!-- FOTO PROFIL -->
            <img src="{{ asset('images/profile/dozer.png') }}" 
                 alt="Dozer Napitu - Full Stack Developer"
                 class="w-100 h-100 object-fit-cover"
                 style="object-fit: cover;">
            <div class="position-absolute" style="bottom: 20px; left: 50%; transform: translateX(-50%); background: rgba(255, 255, 255, 0.95); padding: 12px 30px; border-radius: 30px; backdrop-filter: blur(10px); min-width: 200px;">
                <span style="color: #1a1a2e; font-weight: 700; font-size: 0.9rem;">
                    <i class="fas fa-layer-group me-2" style="color: var(--primary-color);"></i>
                    <span class="role-text">Full-Stack Developer</span>
                </span>
            </div>
        </div>
                        <div class="floating-badge" style="position: absolute; top: 30px; right: 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 25px; border-radius: 20px; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4); animation: float 3s ease-in-out infinite;">
                            <div style="color: white; font-weight: 700; font-size: 1.3rem;">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div style="color: rgba(255,255,255,0.9); font-size: 0.75rem; font-weight: 600; margin-top: 5px;">Mobile</div>
                        </div>
                        <div class="floating-badge" style="position: absolute; top: 120px; left: 10px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 15px 25px; border-radius: 20px; box-shadow: 0 10px 30px rgba(240, 147, 251, 0.4); animation: float 3s ease-in-out infinite; animation-delay: 0.5s;">
                            <div style="color: white; font-weight: 700; font-size: 1.3rem;">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div style="color: rgba(255,255,255,0.9); font-size: 0.75rem; font-weight: 600; margin-top: 5px;">Web</div>
                        </div>
                        <div class="floating-badge" style="position: absolute; bottom: 60px; right: 40px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); padding: 18px 28px; border-radius: 20px; box-shadow: 0 10px 30px rgba(79, 172, 254, 0.4); animation: float 3s ease-in-out infinite; animation-delay: 1s;">
                            <div style="color: white; font-weight: 700; font-size: 1.5rem;">3+</div>
                            <div style="color: rgba(255,255,255,0.9); font-size: 0.8rem; font-weight: 600;">Years</div>
                        </div>
                        <div class="floating-badge" style="position: absolute; bottom: 140px; left: 30px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); padding: 18px 28px; border-radius: 20px; box-shadow: 0 10px 30px rgba(250, 112, 154, 0.4); animation: float 3s ease-in-out infinite; animation-delay: 1.5s;">
                            <div style="color: white; font-weight: 700; font-size: 1.5rem;">20+</div>
                            <div style="color: rgba(255,255,255,0.9); font-size: 0.8rem; font-weight: 600;">Projects</div>
                        </div>
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

    // Role text animation
    document.addEventListener('DOMContentLoaded', function() {
        const roleElement = document.querySelector('.role-text');
        const roles = ['Full-Stack Developer', 'Software Engineer'];
        let currentRoleIndex = 0;
        
        function changeRole() {
            // Fade out
            roleElement.style.opacity = '0';
            roleElement.style.transform = 'translateY(10px)';
            
            setTimeout(() => {
                // Change text
                currentRoleIndex = (currentRoleIndex + 1) % roles.length;
                roleElement.textContent = roles[currentRoleIndex];
                
                // Fade in
                roleElement.style.opacity = '1';
                roleElement.style.transform = 'translateY(0)';
            }, 500);
        }
        
        // Start animation after 2 seconds, then every 4 seconds
        setTimeout(() => {
            changeRole();
            setInterval(changeRole, 4000);
        }, 2000);
        
        // Add CSS transition for smooth animation
        roleElement.style.transition = 'all 0.5s ease-in-out';
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