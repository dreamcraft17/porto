@extends('layouts.app')

@section('title', 'All Projects')

@section('content')
    <!-- Hero Section -->
    <section class="projects-hero" style="padding-top: 120px; padding-bottom: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3" style="animation: fadeInUp 0.6s ease;">My Projects</h1>
                    <p class="lead mb-4" style="animation: fadeInUp 0.6s ease 0.2s; animation-fill-mode: both;">Projects I've worked on during my time at various companies</p>
                    <div style="animation: fadeInUp 0.6s ease 0.4s; animation-fill-mode: both;">
                        <span class="badge me-2 mb-2" style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 500;">
                            <i class="bi bi-building"></i> Professional Experience
                        </span>
                        <span class="badge me-2 mb-2" style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 500;">
                            <i class="bi bi-code-slash"></i> Real-World Solutions
                        </span>
                        <span class="badge mb-2" style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 500;">
                            <i class="bi bi-rocket-takeoff"></i> Industry Projects
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row g-4">
                @forelse($projects as $project)
                <div class="col-lg-4 col-md-6">
                    <div class="project-card h-100" style="border: none; border-radius: 15px; overflow: hidden; transition: all 0.3s ease; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                        <div class="position-relative d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, {{ ['#667eea', '#764ba2', '#3a86ff', '#f093fb', '#4facfe'][($loop->index % 5)] }} 0%, {{ ['#764ba2', '#667eea', '#667eea', '#f5576c', '#00f2fe'][($loop->index % 5)] }} 100%);">
                            <div class="text-center">
                                @if($project->technologies)
                                    @php
                                        $techs = json_decode($project->technologies);
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
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge" style="background: rgba(255,255,255,0.95); color: #667eea; font-weight: 600; padding: 8px 12px; border-radius: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    {{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3" style="color: #2d3748;">{{ $project->title }}</h5>
                            <p class="card-text text-muted mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                {{ Str::limit($project->description, 100) }}
                            </p>
                            
                            @if($project->technologies)
                            <div class="mb-4">
                                @foreach(json_decode($project->technologies) as $tech)
                                <span class="badge me-1 mb-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 6px 12px; border-radius: 20px; font-weight: 500; font-size: 0.75rem;">
                                    {{ $tech }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                            
                            <a href="{{ route('project.show', $project->slug) }}" 
                               class="btn w-100" 
                               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(102, 126, 234, 0.4)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 2L7.17 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4H16.83L15 2H9ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17Z" fill="#cbd5e0"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: #2d3748;">No Projects Yet</h4>
                        <p class="text-muted mb-0">New projects will be added soon. Stay tuned!</p>
                    </div>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($projects->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        {{ $projects->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
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
        
        /* Custom Pagination Styles */
        .pagination {
            gap: 8px;
        }
        
        .pagination .page-link {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            color: #667eea;
            font-weight: 600;
            padding: 10px 16px;
            transition: all 0.3s ease;
            min-width: 45px;
            text-align: center;
        }
        
        .pagination .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
            color: white;
        }
        
        .pagination .page-item.disabled .page-link {
            background: #f8f9fa;
            border-color: #e9ecef;
            color: #cbd5e0;
        }
        
        /* Hide default arrow text and use custom */
        .pagination .page-link[rel="prev"]::before {
            content: "←";
            font-size: 1.2rem;
        }
        
        .pagination .page-link[rel="next"]::before {
            content: "→";
            font-size: 1.2rem;
        }
        
        .pagination .page-link[rel="prev"],
        .pagination .page-link[rel="next"] {
            font-size: 0;
        }
        
        .pagination .page-link[rel="prev"]::before,
        .pagination .page-link[rel="next"]::before {
            font-size: 1.2rem;
        }
    </style>
@endsection