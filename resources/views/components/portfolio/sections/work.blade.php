<section id="work" class="block work-section">
    <div class="section-head section-head--split">
        <div>
            <p class="section-label">Selected work</p>
            <h2 class="section-title">Systems built around the work people actually have to do.</h2>
        </div>
        <a class="link-arrow" href="{{ route('projects.all') }}">All projects →</a>
    </div>

    @if($projects->isNotEmpty())
        <ul class="work-grid">
            @foreach($projects->take(6) as $project)
                @php
                    $techs = is_array($project->technologies) ? array_slice($project->technologies, 0, 4) : [];
                    $meta = array_filter([
                        $project->company,
                        $project->project_date ? \Carbon\Carbon::parse($project->project_date)->format('Y') : null,
                    ]);
                @endphp
                <li class="work-card">
                    <div class="work-card-thumb">
                        @if(!empty($project->image_url))
                            <img src="{{ $project->image_url }}" alt="" width="640" height="400" loading="lazy" decoding="async">
                        @else
                            <span>{{ $project->company ?: 'Project' }}</span>
                        @endif
                    </div>
                    <div class="work-card-body">
                        @if(count($meta))
                            <p class="work-card-meta">{{ implode(' · ', $meta) }}</p>
                        @endif
                        <h3 class="work-card-title">
                            <a class="card-link" href="{{ route('project.show', $project->slug) }}">{{ $project->title }}</a>
                        </h3>
                        <p class="work-card-desc">{{ Str::limit($project->description, 130) }}</p>
                        @if(count($techs))
                            <ul class="tag-list" aria-label="Technologies used">
                                @foreach($techs as $tech)
                                    <li>{{ $tech }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="case-empty">
            <p>The case list is being updated. Browse the archive for the full record.</p>
        </div>
    @endif
</section>
