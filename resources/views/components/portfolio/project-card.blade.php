@props([
    'project',
    'url',
    'date' => null,
])

<a class="case-card" href="{{ $url }}">
    <div class="case-card-thumb">
        @if(!empty($project->image_url ?? null))
            <img src="{{ $project->image_url }}"
                 alt=""
                 loading="lazy"
                 decoding="async">
        @elseif(!empty($project->image))
            <img src="{{ str_starts_with($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}"
                 alt=""
                 loading="lazy"
                 decoding="async">
        @else
            <span class="case-kicker">{{ $project->company ?: 'Case study' }}</span>
        @endif
    </div>
    <div class="case-card-body">
        <h2>{{ $project->title }}</h2>
        <p>{{ Str::limit($project->description, 120) }}</p>
        @php
            $techs = is_array($project->technologies ?? null)
                ? $project->technologies
                : (json_decode($project->technologies ?? '[]', true) ?: []);
        @endphp
        @if(count($techs))
            <div class="case-tech">
                @foreach(array_slice($techs, 0, 4) as $tech)
                    <span>{{ $tech }}</span>
                @endforeach
            </div>
        @endif
        <span class="case-card-foot">
            @if($date)
                {{ $date }}
            @elseif($project->project_date)
                {{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}
            @else
                View case →
            @endif
        </span>
    </div>
</a>
