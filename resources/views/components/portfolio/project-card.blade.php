@props([
    'project',
    'url',
    'date' => null,
])

@php
    $techs = is_array($project->technologies ?? null)
        ? $project->technologies
        : (json_decode($project->technologies ?? '[]', true) ?: []);
    $when = $date ?? ($project->project_date ? \Carbon\Carbon::parse($project->project_date)->format('M Y') : null);
    $meta = array_filter([$project->company ?? null, $when]);
@endphp

<a class="case-card" href="{{ $url }}">
    <div class="case-card-thumb">
        @if(!empty($project->image_url ?? null))
            <img src="{{ $project->image_url }}" alt="" loading="lazy" decoding="async">
        @else
            <span class="case-card-placeholder">{{ $project->company ?: $project->title }}</span>
        @endif
    </div>
    <div class="case-card-body">
        @if(count($meta))
            <p class="case-card-meta">{{ implode(' · ', $meta) }}</p>
        @endif
        <h2>{{ $project->title }}</h2>
        @if($project->description)
            <p class="case-card-desc">{{ Str::limit($project->description, 120) }}</p>
        @endif
        @if(count($techs))
            <p class="case-card-tech">{{ implode(' · ', array_slice($techs, 0, 4)) }}</p>
        @endif
    </div>
</a>
