<header class="case-hero">
    <p class="section-label">Personal project</p>
    <h1 class="case-title">{{ $project->title }}</h1>
    @if($project->description)
        <p class="case-lead">{{ $project->description }}</p>
    @endif
    @if($project->live_url || $project->github_url)
        <div class="case-actions">
            @if($project->live_url)
                <a class="btn btn-primary" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">Live site ↗</a>
            @endif
            @if($project->github_url)
                <a class="btn btn-secondary" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">Repository ↗</a>
            @endif
        </div>
    @endif
</header>

@if($project->image)
    <figure class="case-cover">
        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" width="960" height="600" loading="eager" decoding="async">
    </figure>
@endif
