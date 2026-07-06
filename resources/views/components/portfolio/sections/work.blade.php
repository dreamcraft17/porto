<section id="work" class="section-wrap work-section">
    <div class="section-head">
        <div class="section-kicker">Selected work</div>
        <h2 class="section-title">Selected systems for real business workflows.</h2>
    </div>

    <div class="work-list">
        @foreach($projects->take(6) as $project)
        <a class="work-item" href="{{ route('project.show', $project->slug) }}">
            <div class="work-visual">
                <div class="work-visual-icon">
                    @php
                        $icons = ['fa-cash-register', 'fa-mobile-screen-button', 'fa-chart-line', 'fa-users-gear', 'fa-building-columns', 'fa-chart-pie'];
                    @endphp
                    <i class="fas {{ $icons[$loop->index % count($icons)] }}"></i>
                </div>
                <div class="work-index">PROJECT {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
            </div>

            <div class="work-body">
                <div class="work-meta">
                    <span>{{ $project->company ?: 'Project' }}</span>
                    @if($project->project_date)
                    <span>{{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}</span>
                    @endif
                </div>
                <h3 class="work-title">{{ $project->title }}</h3>
                <p class="work-desc">{{ Str::limit($project->description, 150) }}</p>
            </div>

            <div class="work-footer">
                @if($project->technologies)
                <div class="tech-list">
                    @foreach(array_slice(is_array($project->technologies) ? $project->technologies : [], 0, 4) as $tech)
                    <span>{{ $tech }}</span>
                    @endforeach
                </div>
                @endif
                <div class="work-link">View case</div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-4">
        <a class="action-secondary" href="{{ route('projects.all') }}">Browse all projects</a>
    </div>
</section>
