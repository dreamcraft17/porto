<div class="case-body">
    <div class="case-layout">
        <div>
            @if($project->technologies && is_array($project->technologies))
                <div class="case-panel">
                    <h2>Stack</h2>
                    <div class="case-tech">
                        @foreach($project->technologies as $tech)
                            <span>{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($project->content)
                <div class="case-panel">
                    <h2>Overview</h2>
                    <div class="case-prose content">
                        {!! $project->sanitizedHtml() !!}
                    </div>
                </div>
            @endif
        </div>

        <aside class="case-sidebar">
            <div class="case-panel">
                <h3>Details</h3>
                <div class="case-info-row">
                    <div class="case-info-label">Date</div>
                    <div class="case-info-value">{{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}</div>
                </div>
                @if($project->github_url)
                    <a class="case-link-row" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-github" aria-hidden="true"></i> Repository
                    </a>
                @endif
                @if($project->live_url)
                    <a class="case-link-row" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-globe" aria-hidden="true"></i> Live URL
                    </a>
                @endif
            </div>

            @if($otherProjects->count() > 0)
                <div class="case-panel">
                    <h3>More personal</h3>
                    <ul class="case-more-list">
                        @foreach($otherProjects as $other)
                            <li>
                                <a href="{{ route('personal.project.show', $other->slug) }}">{{ $other->title }}</a>
                                <p>{{ Str::limit($other->description, 72) }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <a class="case-btn case-btn-secondary" href="{{ route('personal.projects.all') }}" style="margin-top:12px;width:100%;justify-content:center;">View all</a>
                </div>
            @endif
        </aside>
    </div>
</div>
