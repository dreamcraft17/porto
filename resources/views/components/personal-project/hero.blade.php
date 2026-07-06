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
                     <img src="{{ $project->image_url }}"
                          alt="{{ $project->title }}" 
                          class="img-fluid">
                 </div>
             </div>
             @endif
         </div>
     </div>
 </section>
