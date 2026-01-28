@extends('layouts.app')

@section('title', $project->title)

@section('styles')
<style>
    /* ============================================
       MODERN PROFESSIONAL DESIGN
    ============================================ */
    
    :root {
        --primary-blue: #3b82f6;
        --primary-purple: #8b5cf6;
        --dark-bg: #0f172a;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
    }

    /* Hero Section - Premium Design */
    .project-hero-modern {
        position: relative;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 120px 0 80px;
        overflow: hidden;
    }

    .project-hero-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .breadcrumb-modern {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 10px 20px;
        display: inline-flex;
        margin-bottom: 2rem;
    }

    .breadcrumb-modern .breadcrumb {
        margin-bottom: 0;
        background: transparent;
    }

    .breadcrumb-modern .breadcrumb-item {
        color: #cbd5e1;
        font-size: 0.875rem;
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #60a5fa;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-modern .breadcrumb-item a:hover {
        color: #93c5fd;
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: #e2e8f0;
    }

    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before {
        color: #64748b;
    }

    .hero-title-modern {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 700;
        color: #f8fafc;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
    }

    .hero-description-modern {
        font-size: 1.25rem;
        line-height: 1.8;
        color: #cbd5e1;
        margin-bottom: 2rem;
    }

    .hero-cta-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-hero-modern {
        padding: 14px 32px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
        color: white;
    }

    .btn-hero-secondary {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: #e2e8f0;
        border-color: rgba(226, 232, 240, 0.2);
    }

    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(226, 232, 240, 0.4);
        transform: translateY(-3px);
        color: #f8fafc;
    }

    .project-image-hero {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .project-image-hero img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Content Section */
    .content-section-modern {
        padding: 80px 0;
        background: white;
    }

    /* Tech Stack - Premium Style */
    .tech-stack-modern {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(139, 92, 246, 0.05));
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .tech-stack-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .tech-stack-title i {
        color: var(--primary-blue);
    }

    .tech-pills-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .tech-pill-modern {
        padding: 12px 20px;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-primary);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .tech-pill-modern i {
        font-size: 1.1rem;
    }

    .tech-pill-modern:hover {
        border-color: var(--primary-blue);
        background: rgba(59, 130, 246, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    /* Project Content */
    .project-content-modern {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid var(--border-color);
    }

    .content-title-modern {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-title-modern i {
        color: var(--primary-purple);
    }

    .project-content-modern .content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--text-secondary);
    }

    .project-content-modern .content h1,
    .project-content-modern .content h2,
    .project-content-modern .content h3 {
        color: var(--text-primary);
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .project-content-modern .content p {
        margin-bottom: 1.5rem;
    }

    .project-content-modern .content img {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }

    /* Sidebar - Info Card */
    .info-card-modern {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 100px;
    }

    .info-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--border-color);
    }

    .info-item-modern {
        margin-bottom: 1.5rem;
    }

    .info-item-modern:last-child {
        margin-bottom: 0;
    }

    .info-label-modern {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }

    .info-value-modern {
        font-size: 1rem;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-value-modern i {
        color: var(--primary-blue);
        font-size: 1.1rem;
    }

    .info-link-modern {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: 8px;
        background: rgba(59, 130, 246, 0.05);
    }

    .info-link-modern:hover {
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary-blue);
        transform: translateX(5px);
    }

    /* Other Projects Card */
    .other-projects-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .project-item-mini {
        padding: 1.25rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        margin-bottom: 1rem;
    }

    .project-item-mini:hover {
        background: rgba(59, 130, 246, 0.03);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .project-item-mini h6 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .project-item-mini h6 a {
        color: var(--text-primary);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .project-item-mini h6 a:hover {
        color: var(--primary-blue);
    }

    .project-item-mini p {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
    }

    .mini-tech-badge {
        padding: 4px 10px;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--primary-blue);
        display: inline-block;
        margin-right: 6px;
        margin-bottom: 6px;
    }

    .btn-view-all-projects {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-purple));
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .btn-view-all-projects:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        color: white;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .project-hero-modern {
            padding: 80px 0 60px;
        }

        .hero-title-modern {
            font-size: 2rem;
        }

        .hero-description-modern {
            font-size: 1.1rem;
        }

        .content-section-modern {
            padding: 60px 0;
        }

        .info-card-modern {
            position: static;
            margin-top: 2rem;
        }
    }

    /* Animation */
    .fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }

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
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="project-hero-modern">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7 fade-in-up">
                <div class="breadcrumb-modern">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('personal.projects.all') }}">Personal Projects</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
                        </ol>
                    </nav>
                </div>
                
                <h1 class="hero-title-modern">{{ $project->title }}</h1>
                
                @if($project->description)
                <p class="hero-description-modern">{{ $project->description }}</p>
                @endif
                
                <div class="hero-cta-group">
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="btn-hero-modern btn-hero-secondary">
                        <i class="fab fa-github"></i>
                        <span>View on GitHub</span>
                    </a>
                    @endif
                    
                    @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" class="btn-hero-modern btn-hero-primary">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Live Demo</span>
                    </a>
                    @endif
                </div>
            </div>
            
            @if($project->image)
            <div class="col-lg-5 mt-5 mt-lg-0 fade-in-up">
                <div class="project-image-hero">
                    <img src="{{ asset($project->image) }}" 
                         alt="{{ $project->title }}" 
                         class="img-fluid">
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="content-section-modern">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Tech Stack -->
                @if($project->technologies && is_array($project->technologies))
                <div class="tech-stack-modern fade-in-up">
                    <h3 class="tech-stack-title">
                        <i class="fas fa-layer-group"></i>
                        Technology Stack
                    </h3>
                    <div class="tech-pills-modern">
                        @foreach($project->technologies as $tech)
                        <span class="tech-pill-modern">
                            @if($tech == 'Laravel')
                                <i class="fab fa-laravel text-danger"></i>
                            @elseif($tech == 'PHP')
                                <i class="fab fa-php text-primary"></i>
                            @elseif($tech == 'JavaScript')
                                <i class="fab fa-js-square text-warning"></i>
                            @elseif($tech == 'Flutter')
                                <i class="fab fa-flutter" style="color: #02569B;"></i>
                            @elseif($tech == 'MySQL')
                                <i class="fas fa-database text-info"></i>
                            @elseif($tech == 'React')
                                <i class="fab fa-react text-info"></i>
                            @elseif($tech == 'Vue')
                                <i class="fab fa-vuejs text-success"></i>
                            @elseif($tech == 'Node.js')
                                <i class="fab fa-node-js text-success"></i>
                            @else
                                <i class="fas fa-code"></i>
                            @endif
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Project Details -->
                @if($project->content)
                <div class="project-content-modern fade-in-up">
                    <h3 class="content-title-modern">
                        <i class="fas fa-file-alt"></i>
                        Project Overview
                    </h3>
                    <div class="content">
                        {!! $project->content !!}
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Project Info -->
                <div class="info-card-modern fade-in-up">
                    <h4 class="info-card-title">Project Information</h4>
                    
                    <div class="info-item-modern">
                        <div class="info-label-modern">Project Date</div>
                        <div class="info-value-modern">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}</span>
                        </div>
                    </div>
                    
                    @if($project->github_url)
                    <div class="info-item-modern">
                        <div class="info-label-modern">Source Code</div>
                        <a href="{{ $project->github_url }}" target="_blank" class="info-link-modern">
                            <i class="fab fa-github"></i>
                            <span>View Repository</span>
                            <i class="fas fa-arrow-right ms-auto"></i>
                        </a>
                    </div>
                    @endif
                    
                    @if($project->live_url)
                    <div class="info-item-modern">
                        <div class="info-label-modern">Live Project</div>
                        <a href="{{ $project->live_url }}" target="_blank" class="info-link-modern">
                            <i class="fas fa-globe"></i>
                            <span>Visit Website</span>
                            <i class="fas fa-arrow-right ms-auto"></i>
                        </a>
                    </div>
                    @endif
                </div>
                
                <!-- Other Projects -->
                @if($otherProjects->count() > 0)
                <div class="other-projects-card fade-in-up">
                    <h4 class="info-card-title">More Projects</h4>
                    
                    @foreach($otherProjects as $other)
                    <div class="project-item-mini">
                        <h6>
                            <a href="{{ route('personal.project.show', $other->slug) }}">
                                {{ $other->title }}
                            </a>
                        </h6>
                        <p>{{ Str::limit($other->description, 80) }}</p>
                        @if($other->technologies && is_array($other->technologies))
                        <div>
                            @foreach(array_slice($other->technologies, 0, 3) as $tech)
                            <span class="mini-tech-badge">{{ $tech }}</span>
                            @endforeach
                            @if(count($other->technologies) > 3)
                            <span class="mini-tech-badge">+{{ count($other->technologies) - 3 }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                    
                    <a href="{{ route('personal.projects.all') }}" class="btn-view-all-projects">
                        <span>View All Projects</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection