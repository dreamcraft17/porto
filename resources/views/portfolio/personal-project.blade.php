@extends('layouts.app')

@section('title', $project->title)

@section('styles')
<style>
    .project-hero {
        background: linear-gradient(135deg, rgba(58, 134, 255, 0.1), rgba(138, 43, 226, 0.1));
        padding: 80px 0;
        border-radius: 20px;
        margin-bottom: 50px;
    }
    
    .project-links a {
        margin-right: 15px;
        margin-bottom: 10px;
    }
    
    .tech-stack .badge {
        font-size: 0.9rem;
        padding: 8px 15px;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    
    .project-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 20px 0;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <!-- Project Hero Section -->
    <div class="project-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('personal.projects.all') }}">Personal Projects</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="display-5 fw-bold mb-3">{{ $project->title }}</h1>
                    
                    @if($project->description)
                    <p class="lead mb-4">{{ $project->description }}</p>
                    @endif
                    
                    <div class="project-links d-flex flex-wrap">
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-dark">
                            <i class="fab fa-github me-2"></i>View on GitHub
                        </a>
                        @endif
                        
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="btn btn-primary">
                            <i class="fas fa-external-link-alt me-2"></i>Live Demo
                        </a>
                        @endif
                    </div>
                </div>
                
                @if($project->image)
                <div class="col-lg-4 text-center mt-4 mt-lg-0">
                    <div class="rounded shadow" style="overflow: hidden; max-width: 300px; margin: 0 auto;">
                        <img src="{{ asset('storage/' . $project->image) }}" 
                             alt="{{ $project->title }}" 
                             class="img-fluid">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Project Details -->
    <div class="row">
        <div class="col-lg-8">
            @if($project->technologies)
            <div class="tech-stack mb-5">
                <h4 class="fw-bold mb-3">Tech Stack</h4>
                <div class="d-flex flex-wrap">
                    @foreach($project->technologies as $tech)
                    <span class="badge bg-light text-dark border">
                        @if($tech == 'Laravel')
                            <i class="fab fa-laravel text-danger me-1"></i>
                        @elseif($tech == 'PHP')
                            <i class="fab fa-php text-primary me-1"></i>
                        @elseif($tech == 'JavaScript')
                            <i class="fab fa-js-square text-warning me-1"></i>
                        @elseif($tech == 'Flutter')
                            <i class="fab fa-flutter text-blue me-1"></i>
                        @elseif($tech == 'MySQL')
                            <i class="fas fa-database text-info me-1"></i>
                        @else
                            <i class="fas fa-code me-1"></i>
                        @endif
                        {{ $tech }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
            
            @if($project->content)
            <div class="project-content">
                <h4 class="fw-bold mb-3">Project Details</h4>
                <div class="content">
                    {!! $project->content !!}
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <!-- Project Info Sidebar -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Project Information</h5>
                    
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Project Date</h6>
                        <p class="mb-0">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            {{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}
                        </p>
                    </div>
                    
                    @if($project->github_url)
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Repository</h6>
                        <a href="{{ $project->github_url }}" target="_blank" class="d-inline-flex align-items-center text-decoration-none">
                            <i class="fab fa-github me-2 fs-5"></i>
                            <span>GitHub Repository</span>
                        </a>
                    </div>
                    @endif
                    
                    @if($project->live_url)
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Live Demo</h6>
                        <a href="{{ $project->live_url }}" target="_blank" class="d-inline-flex align-items-center text-decoration-none">
                            <i class="fas fa-external-link-alt me-2 fs-5"></i>
                            <span>View Live Project</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Other Projects -->
            @if($otherProjects->count() > 0)
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Other Personal Projects</h5>
                    
                    @foreach($otherProjects as $other)
                    <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <h6 class="fw-bold mb-1">
                            <a href="{{ route('personal.project.show', $other->slug) }}" 
                               class="text-decoration-none">
                                {{ $other->title }}
                            </a>
                        </h6>
                        <p class="text-muted small mb-2">{{ Str::limit($other->description, 60) }}</p>
                        @if($other->technologies)
                        <div class="d-flex flex-wrap">
                            @foreach(array_slice($other->technologies, 0, 2) as $tech)
                            <span class="badge bg-light text-dark border small me-1 mb-1">
                                {{ $tech }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('personal.projects.all') }}" class="btn btn-outline-primary btn-sm">
                            View All Projects
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection