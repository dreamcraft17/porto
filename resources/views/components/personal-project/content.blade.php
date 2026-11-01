@php
    $techs = is_array($project->technologies) ? $project->technologies : [];
@endphp

<div class="case-layout">
    <div class="case-main">
        @if($project->content)
            <div class="case-prose">
                {!! $project->sanitizedHtml() !!}
            </div>
        @else
            <p class="case-lead">Notes for this project are not published yet.</p>
        @endif
    </div>

    <aside class="case-sidebar" aria-label="Project details">
        <dl class="case-facts">
            @if($project->project_date)
                <div>
                    <dt>Date</dt>
                    <dd>{{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}</dd>
                </div>
            @endif
            @if(count($techs))
                <div>
                    <dt>Stack</dt>
                    <dd>{{ implode(', ', $techs) }}</dd>
                </div>
            @endif
        </dl>

        @if($otherProjects->count() > 0)
            <div class="case-more">
                <h2 class="section-label">More personal projects</h2>
                <ul class="case-more-list">
                    @foreach($otherProjects as $other)
                        <li>
                            <a href="{{ route('personal.project.show', $other->slug) }}">{{ $other->title }}</a>
                            <p>{{ Str::limit($other->description, 72) }}</p>
                        </li>
                    @endforeach
                </ul>
                <a class="link-arrow" href="{{ route('personal.projects.all') }}">All personal projects →</a>
            </div>
        @endif
    </aside>
</div>
