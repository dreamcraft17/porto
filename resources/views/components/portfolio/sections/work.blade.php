<section id="work" class="split-section" aria-labelledby="work-heading">
    <h2 class="split-heading" id="work-heading">Work</h2>

    @if($projects->isNotEmpty())
        <ol class="entry-list">
            @foreach($projects->take(6) as $project)
                @php
                    $techs = is_array($project->technologies) ? array_slice($project->technologies, 0, 5) : [];
                @endphp
                <li class="entry entry--project">
                    <div class="entry-thumb">
                        @if(!empty($project->image_url))
                            <img src="{{ $project->image_url }}" alt="" width="200" height="125" loading="lazy" decoding="async">
                        @else
                            <span>{{ $project->company ?: 'Project' }}</span>
                        @endif
                    </div>
                    <div class="entry-body">
                        <h3 class="entry-title">
                            <a class="entry-link" href="{{ route('project.show', $project->slug) }}">{{ $project->title }} <span aria-hidden="true">↗</span></a>
                        </h3>
                        <p class="entry-meta">
                            {{ $project->company ?: 'Project' }}@if($project->project_date) · {{ \Carbon\Carbon::parse($project->project_date)->format('Y') }}@endif
                        </p>
                        <p class="entry-desc">{{ Str::limit($project->description, 160) }}</p>
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
        </ol>
    @else
        <div class="case-empty">
            <p>The case list is being updated. Browse the archive for the full record.</p>
        </div>
    @endif

    <a class="link-arrow section-more" href="{{ route('projects.all') }}">View full project archive →</a>
</section>
