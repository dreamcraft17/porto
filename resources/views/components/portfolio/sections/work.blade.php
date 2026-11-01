<section id="work" class="block work-section">
    <div class="section-head section-head--split">
        <div>
            <p class="section-label">Selected work</p>
            <h2 class="section-title">Systems built around the work people actually have to do.</h2>
        </div>
        <a class="link-arrow" href="{{ route('projects.all') }}">All projects →</a>
    </div>

    @if($projects->isNotEmpty())
        <ol class="work-list">
            @foreach($projects->take(6) as $project)
                @php
                    $techs = is_array($project->technologies) ? array_slice($project->technologies, 0, 4) : [];
                @endphp
                <li>
                    <a class="work-row" href="{{ route('project.show', $project->slug) }}">
                        <span class="work-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="work-main">
                            <h3 class="work-title">{{ $project->title }}</h3>
                            <p class="work-desc">{{ Str::limit($project->description, 150) }}</p>
                            @if(count($techs))
                                <p class="work-tech">{{ implode(' · ', $techs) }}</p>
                            @endif
                        </div>
                        <div class="work-meta">
                            <span>{{ $project->company ?: 'Project' }}</span>
                            @if($project->project_date)
                                <span>{{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}</span>
                            @endif
                        </div>
                        <span class="work-arrow" aria-hidden="true">→</span>
                    </a>
                </li>
            @endforeach
        </ol>
    @else
        <div class="case-empty">
            <p>The case list is being updated. Browse the archive for the full record.</p>
        </div>
    @endif
</section>
