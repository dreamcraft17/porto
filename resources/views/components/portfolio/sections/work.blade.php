<section id="work" class="block work-section">
    <div class="block-head">
        <div class="section-kicker">Selected work</div>
        <h2 class="section-title">Selected systems for real business workflows.</h2>
    </div>

    <div class="work-list">
        @forelse($projects->take(6) as $project)
        <a class="work-item" href="{{ route('project.show', $project->slug) }}">
            <span class="work-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

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
        @empty
        <div class="case-empty">
            <p>No featured projects yet. Browse the archive or add entries in the admin CMS.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        <a class="action-secondary" href="{{ route('projects.all') }}">Browse all projects</a>
    </div>
</section>
