@extends('layouts.app')

@section('title', 'Personal Projects')

@section('content')
<section class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Personal Projects</h2>
                <p class="projects-subtitle">
                    Explore my side projects and experiments<br>
                    <strong>Learning Projects • Open Source • Passion Projects</strong>
                </p>
            </div>
        </div>
        
        @if($projects->count() > 0)
            <div class="row">
                @foreach($projects as $project)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card card">
                        @if($project->image)
                        <div style="overflow: hidden; height: 200px;">
                            <img src="{{ asset('storage/' . $project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="project-img w-100">
                        </div>
                        @else
                        <div style="overflow: hidden;">
                            <div class="project-img" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
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
                                @foreach($project->technologies as $tech)
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
                                
                                @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" class="btn btn-primary flex-fill">
                                    <i class="fas fa-external-link-alt me-2"></i>Live Demo
                                </a>
                                @else
                                <a href="{{ route('personal.project.show', $project->slug) }}" class="btn btn-primary flex-fill">
                                    <i class="fas fa-arrow-right me-2"></i>View Details
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-code-branch fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No personal projects yet</h4>
                <p class="text-muted">Check back soon for updates!</p>
            </div>
        @endif
    </div>
</section>
@endsection