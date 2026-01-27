@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <!-- Hero Section with Gradient Background -->
    <section class="project-detail-hero" style="padding-top: 100px; padding-bottom: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <nav aria-label="breadcrumb" style="animation: fadeInUp 0.6s ease;">
                        <ol class="breadcrumb bg-transparent p-0 mb-4">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                                    <i class="bi bi-house-door"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('/projects') }}" style="color: rgba(255,255,255,0.8); text-decoration: none;">Projects</a>
                            </li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($project->title, 30) }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="display-5 fw-bold mb-4" style="animation: fadeInUp 0.6s ease 0.2s; animation-fill-mode: both;">{{ $project->title }}</h1>
                    
                    <!-- Company & Role Highlight - After Title -->
                    @if($project->company || $project->role)
                    <div class="company-role-highlight mb-4 p-4" style="animation: fadeInUp 0.6s ease 0.3s; animation-fill-mode: both; background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 100%); border-radius: 20px; border: 3px solid rgba(255,255,255,0.6); box-shadow: 0 10px 30px rgba(0,0,0,0.25); backdrop-filter: blur(10px); position: relative; overflow: hidden;">
                        <!-- Animated background -->
                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%); animation: rotateGradient 8s linear infinite;"></div>
                        
                        <div class="row align-items-center position-relative" style="z-index: 1;">
                            @if($project->company)
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper me-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5); transform: rotate(-5deg);">
                                        <i class="bi bi-building-fill" style="color: white; font-size: 1.8rem; transform: rotate(5deg);"></i>
                                    </div>
                                    <div>
                                        <div class="text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #667eea; letter-spacing: 2px; margin-bottom: 4px;">COMPANY</div>
                                        <div class="fw-bold" style="color: #1a202c; font-size: 1.4rem; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ $project->company }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if($project->role)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper me-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(240, 147, 251, 0.5); transform: rotate(5deg);">
                                        <i class="bi bi-person-badge-fill" style="color: white; font-size: 1.8rem; transform: rotate(-5deg);"></i>
                                    </div>
                                    <div>
                                        <div class="text-uppercase" style="font-size: 0.65rem; font-weight: 700; color: #f093fb; letter-spacing: 2px; margin-bottom: 4px;">ROLE</div>
                                        <div class="fw-bold" style="color: #1a202c; font-size: 1.4rem; line-height: 1.2; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ $project->role }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="mb-3" style="animation: fadeInUp 0.6s ease 0.5s; animation-fill-mode: both;">
                        <span class="badge me-2 mb-2" style="background: rgba(255,255,255,0.25); padding: 10px 18px; border-radius: 20px; font-size: 0.9rem;">
                            <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}
                        </span>
                        @if($project->technologies)
                            @foreach(json_decode($project->technologies) as $tech)
                            <span class="badge me-1 mb-2" style="background: rgba(255,255,255,0.25); padding: 10px 18px; border-radius: 20px; font-size: 0.9rem;">
                                {{ $tech }}
                            </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Content Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <!-- Technology Icons Banner -->
                    @if($project->technologies)
                    <div class="tech-banner mb-5" style="background: white; border-radius: 20px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                        <h5 class="fw-bold mb-3" style="color: #2d3748;">Technologies Used</h5>
                        <div class="d-flex flex-wrap align-items-center gap-4">
                            @php
                                $techs = json_decode($project->technologies);
                            @endphp
                            @foreach($techs as $tech)
                            <div class="text-center" style="min-width: 60px;">
                                <div class="mb-2" style="font-size: 2.5rem; color: #667eea;">
                                    @if(stripos($tech, 'php') !== false)
                                        <i class="devicon-php-plain"></i>
                                    @elseif(stripos($tech, 'laravel') !== false)
                                        <i class="devicon-laravel-plain"></i>
                                    @elseif(stripos($tech, 'javascript') !== false || stripos($tech, 'js') !== false)
                                        <i class="devicon-javascript-plain"></i>
                                    @elseif(stripos($tech, 'react') !== false)
                                        <i class="devicon-react-original"></i>
                                    @elseif(stripos($tech, 'vue') !== false)
                                        <i class="devicon-vuejs-plain"></i>
                                    @elseif(stripos($tech, 'angular') !== false)
                                        <i class="devicon-angularjs-plain"></i>
                                    @elseif(stripos($tech, 'node') !== false)
                                        <i class="devicon-nodejs-plain"></i>
                                    @elseif(stripos($tech, 'python') !== false)
                                        <i class="devicon-python-plain"></i>
                                    @elseif(stripos($tech, 'mysql') !== false)
                                        <i class="devicon-mysql-plain"></i>
                                    @elseif(stripos($tech, 'mongodb') !== false)
                                        <i class="devicon-mongodb-plain"></i>
                                    @elseif(stripos($tech, 'postgresql') !== false)
                                        <i class="devicon-postgresql-plain"></i>
                                    @elseif(stripos($tech, 'java') !== false)
                                        <i class="devicon-java-plain"></i>
                                    @elseif(stripos($tech, 'flutter') !== false)
                                        <i class="devicon-flutter-plain"></i>
                                    @elseif(stripos($tech, 'asp.net') !== false || stripos($tech, 'asp') !== false)
                                        <i class="devicon-dotnetcore-plain"></i>
                                    @elseif(stripos($tech, 'c#') !== false)
                                        <i class="devicon-csharp-plain"></i>
                                    @elseif(stripos($tech, 'rest') !== false || stripos($tech, 'api') !== false)
                                        <i class="bi bi-cloud"></i>
                                    @else
                                        <i class="bi bi-code-slash"></i>
                                    @endif
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem; font-weight: 500;">{{ $tech }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Project Content Card -->
                    <div class="content-card mb-5" style="background: white; border-radius: 20px; padding: 40px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                        <h4 class="fw-bold mb-4" style="color: #2d3748;">Project Overview</h4>
                        <div class="project-content" style="line-height: 1.8; color: #4a5568; font-size: 1.05rem;">
                            @php
                                // Remove company, role, and technologies lines from content
                                $content = $project->content;
                                $lines = explode("\n", $content);
                                $filteredLines = [];
                                
                                foreach($lines as $line) {
                                    $trimmed = trim($line);
                                    $lower = strtolower($trimmed);
                                    
                                    // Skip lines that start with company, role, or technologies
                                    if (preg_match('/^(company|role|technologies):/i', $trimmed)) {
                                        continue;
                                    }
                                    
                                    $filteredLines[] = $line;
                                }
                                
                                $cleanContent = implode("\n", $filteredLines);
                            @endphp
                            {!! nl2br(e($cleanContent)) !!}
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex flex-wrap gap-3 mb-5 justify-content-center">
                        @if($project->url)
                        <a href="{{ $project->url }}" target="_blank" class="btn btn-lg px-5" 
                           style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);"
                           onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 20px rgba(102, 126, 234, 0.4)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.3)'">
                            <i class="bi bi-box-arrow-up-right me-2"></i> View Live Demo
                        </a>
                        @endif
                        
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-lg px-5" 
                           style="background: #24292e; color: white; border: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);"
                           onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 20px rgba(0, 0, 0, 0.3)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 0, 0, 0.2)'">
                            <i class="bi bi-github me-2"></i> View Source Code
                        </a>
                        @endif
                        
                        <a href="{{ url('/projects') }}" class="btn btn-lg px-5" 
                           style="background: white; color: #667eea; border: 2px solid #667eea; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;"
                           onmouseover="this.style.background='#667eea'; this.style.color='white'"
                           onmouseout="this.style.background='white'; this.style.color='#667eea'">
                            <i class="bi bi-arrow-left me-2"></i> Back to Projects
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Related Projects -->
            @if($otherProjects->count() > 0)
            <div class="row mt-5">
                <div class="col-12 mb-4">
                    <h3 class="fw-bold text-center" style="color: #2d3748;">More Projects</h3>
                    <p class="text-center text-muted">Check out these other projects</p>
                </div>
                
                @foreach($otherProjects as $otherProject)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card h-100" style="border: none; border-radius: 15px; overflow: hidden; transition: all 0.3s ease; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                        <div class="position-relative d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, {{ ['#667eea', '#764ba2', '#3a86ff', '#f093fb', '#4facfe'][($loop->index % 5)] }} 0%, {{ ['#764ba2', '#667eea', '#667eea', '#f5576c', '#00f2fe'][($loop->index % 5)] }} 100%);">
                            <div class="text-center">
                                @if($otherProject->technologies)
                                    @php
                                        $techs = json_decode($otherProject->technologies);
                                        $displayTechs = array_slice($techs, 0, 3);
                                    @endphp
                                    <div class="d-flex flex-wrap justify-content-center gap-3 px-4">
                                        @foreach($displayTechs as $tech)
                                        <div class="text-white" style="font-size: 2.5rem; opacity: 0.9;">
                                            @if(stripos($tech, 'php') !== false)
                                                <i class="devicon-php-plain"></i>
                                            @elseif(stripos($tech, 'laravel') !== false)
                                                <i class="devicon-laravel-plain"></i>
                                            @elseif(stripos($tech, 'javascript') !== false || stripos($tech, 'js') !== false)
                                                <i class="devicon-javascript-plain"></i>
                                            @elseif(stripos($tech, 'react') !== false)
                                                <i class="devicon-react-original"></i>
                                            @elseif(stripos($tech, 'vue') !== false)
                                                <i class="devicon-vuejs-plain"></i>
                                            @elseif(stripos($tech, 'angular') !== false)
                                                <i class="devicon-angularjs-plain"></i>
                                            @elseif(stripos($tech, 'node') !== false)
                                                <i class="devicon-nodejs-plain"></i>
                                            @elseif(stripos($tech, 'python') !== false)
                                                <i class="devicon-python-plain"></i>
                                            @elseif(stripos($tech, 'mysql') !== false)
                                                <i class="devicon-mysql-plain"></i>
                                            @elseif(stripos($tech, 'mongodb') !== false)
                                                <i class="devicon-mongodb-plain"></i>
                                            @elseif(stripos($tech, 'postgresql') !== false)
                                                <i class="devicon-postgresql-plain"></i>
                                            @elseif(stripos($tech, 'java') !== false)
                                                <i class="devicon-java-plain"></i>
                                            @elseif(stripos($tech, 'flutter') !== false)
                                                <i class="devicon-flutter-plain"></i>
                                            @elseif(stripos($tech, 'asp.net') !== false || stripos($tech, 'asp') !== false)
                                                <i class="devicon-dotnetcore-plain"></i>
                                            @elseif(stripos($tech, 'c#') !== false)
                                                <i class="devicon-csharp-plain"></i>
                                            @elseif(stripos($tech, 'rest') !== false || stripos($tech, 'api') !== false)
                                                <i class="bi bi-cloud"></i>
                                            @else
                                                <i class="bi bi-code-slash"></i>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3" style="color: #2d3748;">{{ $otherProject->title }}</h5>
                            <p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
                                {{ Str::limit($otherProject->description, 80) }}
                            </p>
                            <a href="{{ route('project.show', $otherProject->slug) }}" 
                               class="btn w-100" 
                               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(102, 126, 234, 0.4)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <style>
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
        
        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2) !important;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.6);
            content: "→";
        }
        
        .tech-banner,
        .content-card {
            transition: all 0.3s ease;
        }
        
        .tech-banner:hover,
        .content-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
        }
        
        /* Company Role Highlight Animation */
        .company-role-highlight {
            animation: pulseGlow 2s ease-in-out infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            }
            50% {
                box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4), 0 0 0 4px rgba(102, 126, 234, 0.1);
            }
        }
        
        .company-role-highlight:hover {
            animation: none;
            transform: scale(1.02);
            box-shadow: 0 12px 36px rgba(0,0,0,0.25) !important;
        }
        
        @keyframes rotateGradient {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection