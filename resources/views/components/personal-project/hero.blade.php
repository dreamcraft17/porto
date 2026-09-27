<section class="case-hero">
    <div class="case-hero-grid">
        <div>
            <p class="case-kicker">Personal project</p>
            <h1 class="case-title">{{ $project->title }}</h1>
            @if($project->description)
                <p class="case-lead">{{ $project->description }}</p>
            @endif
            <div class="case-actions">
                @if($project->github_url)
                    <a class="case-btn case-btn-secondary" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">
                        GitHub <i class="fab fa-github" aria-hidden="true"></i>
                    </a>
                @endif
                @if($project->live_url)
                    <a class="case-btn case-btn-primary" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">
                        Live site <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                    </a>
                @endif
                <a class="case-btn case-btn-secondary" href="{{ route('personal.projects.all') }}">All personal</a>
            </div>
        </div>
        @if($project->image)
            <div class="case-cover">
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" width="960" height="600" loading="eager" decoding="async">
            </div>
        @endif
    </div>
</section>
