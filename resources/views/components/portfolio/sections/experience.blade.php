<section id="experience" class="section-wrap experience-section">
    <div class="history-head">
        <i class="fas fa-briefcase"></i>
        <h2 class="history-title">Professional History</h2>
    </div>

    <div class="timeline-list">
        @foreach($experiences as $experience)
        <article class="timeline-entry">
            <div class="timeline-date">
                <span class="timeline-step">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                <span>
                    <span class="timeline-period">
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                        @if($experience->current)
                            Present
                        @else
                            {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                        @endif
                    </span>
                    <span class="timeline-duration {{ $experience->current ? 'is-current' : '' }}">
                        {{ $experience->current ? 'Current role' : 'Completed role' }}
                    </span>
                </span>
            </div>
            <div class="timeline-body">
                <div class="timeline-heading">
                    <div>
                        <h3>{{ $experience->position }}</h3>
                        <div class="timeline-company">{{ $experience->company }}</div>
                    </div>
                    @if($experience->current)
                    <span class="timeline-current">Now</span>
                    @endif
                </div>
                <p>{{ Str::limit($experience->description, 260) }}</p>
                @php
                    $experienceTags = collect(['Laravel', 'Next.js', 'NestJS', 'FastAPI', 'ASP.NET MVC', 'Flutter', 'Kotlin', 'MySQL', 'PostgreSQL', 'SQL Server', 'RESTful APIs', 'Dashboards'])
                        ->filter(fn ($tag) => Str::contains(strtolower($experience->description), strtolower($tag)))
                        ->take(5);
                @endphp
                @if($experienceTags->isNotEmpty())
                <div class="timeline-stack" aria-label="Experience technologies">
                    @foreach($experienceTags as $tag)
                    <span>{{ $tag }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </article>
        @endforeach
    </div>
</section>
