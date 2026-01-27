@extends('layouts.app')

@section('title', 'Portfolio - Home')

@section('styles')
<style>
    /* ============================================
       BASE & ANIMATIONS
    ============================================ */
    
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
        50% { transform: translateY(-15px); }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }

    /* ============================================
       HERO SECTION - PROFESSIONAL DESIGN
    ============================================ */
    
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
            radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
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

    .hero-main-title {
        font-size: clamp(2.5rem, 6vw, 5rem);
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.1;
        letter-spacing: -0.02em;
        margin-bottom: 1.5rem;
    }

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

    .hero-description {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #cbd5e1;
        max-width: 600px;
    }

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

    .hero-visual-container {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        height: 600px;
    }

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

    /* ============================================
       PROFESSIONAL SECTION STYLES
    ============================================ */

    /* Base Section Styling */
    .section-modern {
        padding: 120px 0;
        position: relative;
    }

    .section-modern-light {
        background: #f8fafc;
    }

    .section-modern-dark {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        color: #f8fafc;
    }

    /* Section Headers */
    .section-header-modern {
        text-align: center;
        margin-bottom: 5rem;
    }

    .section-eyebrow-modern {
        font-family: 'Source Code Pro', monospace;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #3b82f6;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .section-title-modern {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }

    .section-description-modern {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #64748b;
        max-width: 700px;
        margin: 0 auto;
    }

    .section-modern-dark .section-description-modern {
        color: #94a3b8;
    }

    /* Stats Cards - Modern Design */
    .stats-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 5rem;
    }

    .stat-card-modern {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .stat-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }

    .stat-card-modern:hover::before {
        opacity: 1;
    }

    .stat-card-modern .stat-number {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-card-modern .stat-label {
        font-size: 1rem;
        color: #64748b;
        font-weight: 600;
    }

    /* Content Grid - Two Column Layout */
    .content-grid-modern {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: start;
    }

    .content-block-modern {
        font-size: 1.125rem;
        line-height: 1.8;
        color: #475569;
    }

    .content-block-modern strong {
        color: #1e293b;
    }

    .feature-list-modern {
        list-style: none;
        padding: 0;
        display: grid;
        gap: 1rem;
    }

    .feature-item-modern {
        display: flex;
        align-items: start;
        gap: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 12px;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .feature-item-modern:hover {
        background: #f8fafc;
        border-left-color: #3b82f6;
        transform: translateX(5px);
    }

    .feature-icon-modern {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3b82f6;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    /* Skills Section - Modern Tabs */
    .skills-container-modern {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
    }

    .skills-tabs-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .skill-tab-modern {
        padding: 12px 24px;
        background: #f1f5f9;
        border: 2px solid transparent;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .skill-tab-modern:hover {
        background: #e0f2fe;
        color: #0284c7;
    }

    .skill-tab-modern.active {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border-color: #3b82f6;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .skills-content-modern {
        display: none;
    }

    .skills-content-modern.active {
        display: block;
        animation: fadeInUp 0.5s ease;
    }

    .skill-category-modern {
        margin-bottom: 2.5rem;
    }

    .skill-category-modern:last-child {
        margin-bottom: 0;
    }

    .skill-category-title-modern {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .skill-category-title-modern i {
        color: #3b82f6;
    }

    .skills-grid-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .skill-badge-modern {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(139, 92, 246, 0.08));
        border: 2px solid rgba(59, 130, 246, 0.15);
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.3s ease;
    }

    .skill-badge-modern:hover {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }

    .skill-badge-modern i {
        font-size: 1.1rem;
    }

    /* Projects Grid - Modern Cards */
    .projects-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    .project-card-modern {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid #e2e8f0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .project-card-modern:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border-color: #3b82f6;
    }

    .project-image-modern {
        height: 220px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .project-image-modern::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.3));
    }

    .project-icon-modern {
        color: white;
        font-size: 4rem;
        opacity: 0.9;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .project-card-modern:hover .project-icon-modern {
        transform: scale(1.1);
    }

    .project-content-modern {
        padding: 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .project-title-modern {
        font-size: 1.375rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .project-description-modern {
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 1.5rem;
        flex: 1;
    }

    .project-tech-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .tech-tag-modern {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #f1f5f9;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #475569;
        transition: all 0.3s ease;
    }

    .tech-tag-modern:hover {
        background: #3b82f6;
        color: white;
    }

    .project-link-modern {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .project-link-modern:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        color: white;
    }

    /* Timeline - Modern Design */
    .timeline-modern {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
    }

    .timeline-item-modern {
        position: relative;
        padding-left: 3rem;
        padding-bottom: 3rem;
        border-left: 2px solid #e2e8f0;
    }

    .timeline-item-modern:last-child {
        border-left-color: transparent;
        padding-bottom: 0;
    }

    .timeline-item-modern::before {
        content: '';
        position: absolute;
        left: -9px;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        border: 4px solid #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transition: all 0.3s ease;
    }

    .timeline-item-modern:hover::before {
        transform: scale(1.3);
        box-shadow: 0 0 0 8px rgba(59, 130, 246, 0.15);
    }

    .timeline-content-modern {
        background: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .timeline-content-modern:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
        transform: translateX(5px);
    }

    .timeline-position-modern {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .timeline-company-modern {
        font-size: 1.125rem;
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .timeline-date-modern {
        font-size: 0.95rem;
        color: #64748b;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .timeline-description-modern {
        color: #475569;
        line-height: 1.8;
    }

    /* Certifications Grid */
    .certifications-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 2rem;
    }

    .certification-card-modern {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        transition: all 0.3s ease;
        border: 2px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .certification-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .certification-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }

    .certification-card-modern:hover::before {
        opacity: 1;
    }

    .certification-icon-modern {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
    }

    .certification-name-modern {
        font-size: 1.375rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }

    .certification-issuer-modern {
        font-size: 1.125rem;
        font-weight: 600;
        color: #3b82f6;
        margin-bottom: 1rem;
    }

    .certification-date-modern {
        font-size: 0.95rem;
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    .certification-link-modern {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #f1f5f9;
        color: #3b82f6;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .certification-link-modern:hover {
        background: #3b82f6;
        color: white;
    }

    /* Contact Form - Modern Design */
    .contact-form-modern {
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group-modern {
        margin-bottom: 2rem;
    }

    .form-label-modern {
        font-size: 1rem;
        font-weight: 600;
        color: #f8fafc;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control-modern {
        width: 100%;
        padding: 14px 20px;
        background: rgba(51, 65, 85, 0.5);
        border: 2px solid rgba(148, 163, 184, 0.2);
        border-radius: 12px;
        color: #f8fafc;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-control-modern:focus {
        outline: none;
        background: rgba(51, 65, 85, 0.7);
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .form-control-modern::placeholder {
        color: #94a3b8;
    }

    textarea.form-control-modern {
        resize: vertical;
        min-height: 150px;
    }

    .btn-submit-modern {
        width: 100%;
        padding: 16px 32px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.125rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit-modern:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(59, 130, 246, 0.4);
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

    /* Responsive */
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

        .content-grid-modern {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .stat-card-1, .stat-card-2, .stat-card-3 {
            padding: 1rem;
        }

        .stat-card-2 {
            left: -20px;
        }

        .section-modern {
            padding: 80px 0;
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

        .btn-hero-primary, .btn-hero-secondary {
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

        .section-title-modern {
            font-size: 2rem;
        }

        .projects-grid-modern {
            grid-template-columns: 1fr;
        }

        .certifications-grid-modern {
            grid-template-columns: 1fr;
        }

        .skills-container-modern {
            padding: 2rem 1.5rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in-up">
                    <div class="mb-4">
                        <span class="status-badge">
                            <span class="status-dot"></span>
                            Available for opportunities
                        </span>
                    </div>

                    <h1 class="hero-main-title">
                        Dozer Napitupulu
                    </h1>

                    <div class="hero-role-container mb-4">
                        <span class="hero-role-label">—</span>
                        <h2 class="hero-role-text">
                            <span id="typed-role">Full Stack Developer</span>
                        </h2>
                    </div>

                    <p class="hero-description mb-5">
                        Specialized in building scalable web and mobile applications using modern technologies. 
                        Passionate about clean code, user experience, and solving complex problems.
                    </p>

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

                    <div class="hero-cta-container mb-5">
                        <a href="#projects" class="btn-hero-primary">
                            View Work
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="#contact" class="btn-hero-secondary">
                            Get in Touch
                        </a>
                    </div>

                    <div class="hero-social-container">
                        <div class="social-links-grid">
                            <a href="https://github.com/dreamcraft17" target="_blank" class="social-link-modern" aria-label="GitHub">
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

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-visual-container">
                        <div class="profile-card-modern">
                            <div class="profile-image-container">
                                <img src="{{ asset('images/profile/dozer.png') }}" 
                                     alt="Dozer Napitu - Full Stack Developer"
                                     class="profile-image-modern">
                                <div class="profile-image-border"></div>
                            </div>
                        </div>

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

                        <div class="hero-bg-element element-1"></div>
                        <div class="hero-bg-element element-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-modern section-modern-light">
        <div class="container">
            <div class="section-header-modern scroll-animate">
                <div class="section-eyebrow-modern">Get to know me</div>
                <h2 class="section-title-modern">About Me</h2>
                <p class="section-description-modern">
                    Full-stack developer with a passion for creating elegant solutions to complex problems
                </p>
            </div>

            <div class="stats-grid-modern">
                <div class="stat-card-modern scroll-animate">
                    <div class="stat-number">3+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-card-modern scroll-animate" style="transition-delay: 0.1s">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Completed Projects</div>
                </div>
                <div class="stat-card-modern scroll-animate" style="transition-delay: 0.2s">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Technologies</div>
                </div>
                <div class="stat-card-modern scroll-animate" style="transition-delay: 0.3s">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Commitment</div>
                </div>
            </div>

            <div class="content-grid-modern">
                <div class="scroll-animate">
                    <div class="content-block-modern mb-4">
                        <p class="mb-4">
                            I am an enthusiastic <strong>Full-Stack Developer</strong> specializing in <strong>.NET, Laravel,</strong> and <strong>Flutter</strong> technologies. With a passion for building user-friendly and engaging applications, I focus on creating secure and scalable solutions.
                        </p>
                        <p>
                            I'm eager to expand my skill set and contribute to innovative development projects. Currently seeking opportunities to develop skills and gain more practical experience in <strong>Full-Stack Development, Back-End Programming,</strong> and <strong>Web Security</strong>.
                        </p>
                    </div>

                    <ul class="feature-list-modern">
                        <li class="feature-item-modern">
                            <div class="feature-icon-modern">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <strong>Full-Stack Development</strong>
                        </li>
                        <li class="feature-item-modern">
                            <div class="feature-icon-modern">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <strong>Mobile App Development</strong>
                        </li>
                        <li class="feature-item-modern">
                            <div class="feature-icon-modern">
                                <i class="fas fa-plug"></i>
                            </div>
                            <strong>API Development</strong>
                        </li>
                        <li class="feature-item-modern">
                            <div class="feature-icon-modern">
                                <i class="fas fa-database"></i>
                            </div>
                            <strong>Database Design</strong>
                        </li>
                        <li class="feature-item-modern">
                            <div class="feature-icon-modern">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <strong>Web Security</strong>
                        </li>
                        <li class="feature-item-modern">
                            <div class="feature-icon-modern">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <strong>Responsive Design</strong>
                        </li>
                    </ul>
                </div>

                <div class="scroll-animate" style="transition-delay: 0.2s">
                    <div class="skills-container-modern">
                        <h3 class="mb-4" style="font-size: 1.75rem; font-weight: 700;">Technical Skills</h3>
                        
                        <div class="skills-tabs-modern">
                            <div class="skill-tab-modern active" data-tab="all">
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
                            <div class="skill-tab-modern" data-tab="{{ $category }}">
                                <i class="{{ $categoryIcons[$category] ?? 'fas fa-cog' }}"></i>
                                {{ ucfirst($category) }}
                            </div>
                            @endforeach
                        </div>

                        <div class="skills-content-modern active" id="tab-all">
                            @foreach($skills->groupBy('category') as $category => $categorySkills)
                            <div class="skill-category-modern">
                                <h5 class="skill-category-title-modern">
                                    <i class="{{ $categoryIcons[$category] ?? 'fas fa-cog' }}"></i>
                                    {{ ucfirst($category) }}
                                </h5>
                                <div class="skills-grid-modern">
                                    @foreach($categorySkills as $skill)
                                    <div class="skill-badge-modern">
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

                        @foreach($categories as $category)
                        <div class="skills-content-modern" id="tab-{{ $category }}">
                            <div class="skill-category-modern">
                                <h5 class="skill-category-title-modern">
                                    <i class="{{ $categoryIcons[$category] ?? 'fas fa-cog' }}"></i>
                                    {{ ucfirst($category) }} Skills
                                </h5>
                                <div class="skills-grid-modern">
                                    @foreach($skills->where('category', $category) as $skill)
                                    <div class="skill-badge-modern">
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section-modern" style="background: white;">
        <div class="container">
            <div class="section-header-modern scroll-animate">
                <div class="section-eyebrow-modern">Portfolio</div>
                <h2 class="section-title-modern">Featured Projects</h2>
                <p class="section-description-modern">
                    Professional experience building real-world solutions across web and mobile platforms
                </p>
            </div>

            <div class="projects-grid-modern">
                <div class="project-card-modern scroll-animate">
                    <div class="project-image-modern" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-cash-register project-icon-modern"></i>
                    </div>
                    <div class="project-content-modern">
                        <h3 class="project-title-modern">POS System for Café Operations</h3>
                        <p class="project-description-modern">
                            Developed a comprehensive Point of Sale system handling transactions, inventory, and sales reporting for café operations.
                        </p>
                        <div class="project-tech-modern">
                            <span class="tech-tag-modern">
                                <i class="fab fa-microsoft"></i> ASP.NET MVC
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-database"></i> SQL Server
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-database"></i> MySQL
                            </span>
                        </div>
                        <a href="{{ route('project.show', 'pos-system-cafe') }}" class="project-link-modern">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="project-card-modern scroll-animate" style="transition-delay: 0.1s">
                    <div class="project-image-modern" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-mobile-alt project-icon-modern"></i>
                    </div>
                    <div class="project-content-modern">
                        <h3 class="project-title-modern">Online Ordering Mobile App</h3>
                        <p class="project-description-modern">
                            Built a mobile ordering platform enabling customers to browse menus, place orders, and make secure payments.
                        </p>
                        <div class="project-tech-modern">
                            <span class="tech-tag-modern">
                                <i class="fab fa-flutter"></i> Flutter
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fab fa-microsoft"></i> ASP.NET
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-plug"></i> REST API
                            </span>
                        </div>
                        <a href="{{ route('project.show', 'online-ordering-app') }}" class="project-link-modern">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="project-card-modern scroll-animate" style="transition-delay: 0.2s">
                    <div class="project-image-modern" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-chart-line project-icon-modern"></i>
                    </div>
                    <div class="project-content-modern">
                        <h3 class="project-title-modern">Back-Office Web Application</h3>
                        <p class="project-description-modern">
                            Developed administrative platform for operational management, reporting, and business intelligence.
                        </p>
                        <div class="project-tech-modern">
                            <span class="tech-tag-modern">
                                <i class="fab fa-laravel"></i> Laravel
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fab fa-php"></i> PHP
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-database"></i> MySQL
                            </span>
                        </div>
                        <a href="{{ route('project.show', 'back-office-web') }}" class="project-link-modern">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="project-card-modern scroll-animate" style="transition-delay: 0.3s">
                    <div class="project-image-modern" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-users project-icon-modern"></i>
                    </div>
                    <div class="project-content-modern">
                        <h3 class="project-title-modern">Employee Mobile Application</h3>
                        <p class="project-description-modern">
                            Created internal mobile app for employee task management, communication, and operational workflows.
                        </p>
                        <div class="project-tech-modern">
                            <span class="tech-tag-modern">
                                <i class="fab fa-flutter"></i> Flutter
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fab fa-laravel"></i> Laravel
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-plug"></i> REST API
                            </span>
                        </div>
                        <a href="{{ route('project.show', 'employee-mobile-app') }}" class="project-link-modern">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="project-card-modern scroll-animate" style="transition-delay: 0.4s">
                    <div class="project-image-modern" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-university project-icon-modern"></i>
                    </div>
                    <div class="project-content-modern">
                        <h3 class="project-title-modern">Core Banking System</h3>
                        <p class="project-description-modern">
                            Contributed to enterprise banking application implementation supporting multi-branch operations.
                        </p>
                        <div class="project-tech-modern">
                            <span class="tech-tag-modern">
                                <i class="fab fa-microsoft"></i> ASP.NET
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-code"></i> C#
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-database"></i> SQL Server
                            </span>
                        </div>
                        <a href="{{ route('project.show', 'core-banking-web') }}" class="project-link-modern">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="project-card-modern scroll-animate" style="transition-delay: 0.5s">
                    <div class="project-image-modern" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                        <i class="fas fa-chart-pie project-icon-modern"></i>
                    </div>
                    <div class="project-content-modern">
                        <h3 class="project-title-modern">Finance Module Development</h3>
                        <p class="project-description-modern">
                            Maintained and enhanced financial modules ensuring system stability and performance optimization.
                        </p>
                        <div class="project-tech-modern">
                            <span class="tech-tag-modern">
                                <i class="fab fa-microsoft"></i> ASP.NET
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-code"></i> C#
                            </span>
                            <span class="tech-tag-modern">
                                <i class="fas fa-database"></i> SQL Server
                            </span>
                        </div>
                        <a href="{{ route('project.show', 'finance-module') }}" class="project-link-modern">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 scroll-animate">
                <a href="{{ url('/projects') }}" class="btn-hero-primary" style="display: inline-flex;">
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
    <section id="experience" class="section-modern section-modern-light">
        <div class="container">
            <div class="section-header-modern scroll-animate">
                <div class="section-eyebrow-modern">Career Journey</div>
                <h2 class="section-title-modern">Work Experience</h2>
                <p class="section-description-modern">
                    Professional experience building enterprise solutions and leading development projects
                </p>
            </div>

            <div class="timeline-modern">
                @foreach($experiences as $experience)
                <div class="timeline-item-modern scroll-animate">
                    <div class="timeline-content-modern">
                        <h3 class="timeline-position-modern">{{ $experience->position }}</h3>
                        <div class="timeline-company-modern">
                            <i class="fas fa-building"></i>
                            {{ $experience->company }}
                        </div>
                        <div class="timeline-date-modern">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                            @if($experience->current)
                                <span style="color: #10b981; font-weight: 600;">Present</span>
                            @else
                                {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                            @endif
                        </div>
                        <p class="timeline-description-modern">{{ $experience->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section id="certifications" class="section-modern" style="background: white;">
        <div class="container">
            <div class="section-header-modern scroll-animate">
                <div class="section-eyebrow-modern">Achievements</div>
                <h2 class="section-title-modern">Certifications</h2>
                <p class="section-description-modern">
                    Professional certifications and continuous learning achievements
                </p>
            </div>

            <div class="certifications-grid-modern">
                @foreach($certifications as $certification)
                <div class="certification-card-modern scroll-animate" style="transition-delay: {{ $loop->index * 0.1 }}s">
                    <div class="certification-icon-modern">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="certification-name-modern">{{ $certification->name }}</h3>
                    <div class="certification-issuer-modern">
                        <i class="fas fa-building me-2"></i>{{ $certification->issuer }}
                    </div>
                    @if($certification->issued_date)
                    <div class="certification-date-modern">
                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($certification->issued_date)->format('M Y') }}
                    </div>
                    @endif
                    @if($certification->url)
                    <a href="{{ $certification->url }}" target="_blank" class="certification-link-modern">
                        <i class="fas fa-external-link-alt"></i>
                        View Certificate
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-modern section-modern-dark">
        <div class="container">
            <div class="section-header-modern scroll-animate">
                <div class="section-eyebrow-modern" style="color: #60a5fa;">Get in Touch</div>
                <h2 class="section-title-modern" style="color: #f8fafc;">Let's Work Together</h2>
                <p class="section-description-modern" style="color: #cbd5e1;">
                    Have a project in mind? Let's discuss how I can help bring your ideas to life
                </p>
            </div>

            <div class="contact-form-modern scroll-animate">
                <form id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-modern">
                                <label for="name" class="form-label-modern">
                                    <i class="fas fa-user"></i>
                                    Full Name
                                </label>
                                <input type="text" class="form-control-modern" id="name" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-modern">
                                <label for="email" class="form-label-modern">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <input type="email" class="form-control-modern" id="email" placeholder="john@example.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-modern">
                        <label for="subject" class="form-label-modern">
                            <i class="fas fa-tag"></i>
                            Subject
                        </label>
                        <input type="text" class="form-control-modern" id="subject" placeholder="Project Discussion" required>
                    </div>
                    <div class="form-group-modern">
                        <label for="message" class="form-label-modern">
                            <i class="fas fa-comment-dots"></i>
                            Message
                        </label>
                        <textarea class="form-control-modern" id="message" placeholder="Tell me about your project..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit-modern">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
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
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Message Sent!';
            
            setTimeout(() => {
                alert('Thank you! Your message has been sent successfully.');
                this.reset();
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 1500);
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
        
        setInterval(changeRole, 3000);
        typedElement.style.transition = 'all 0.3s ease';
    });

    // Skills Tabs Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const skillTabs = document.querySelectorAll('.skill-tab-modern');
        const tabContents = document.querySelectorAll('.skills-content-modern');
        
        skillTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                skillTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                tabContents.forEach(content => content.classList.remove('active'));
                document.getElementById(`tab-${tabId}`).classList.add('active');
            });
        });
    });
</script>
@endsection