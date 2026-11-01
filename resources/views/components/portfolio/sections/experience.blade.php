<section id="experience" class="block experience-section">
    <div class="section-head">
        <p class="section-label">Experience</p>
        <h2 class="section-title">Where the work has been tested.</h2>
    </div>

    <ol class="timeline">
        @foreach($experiences as $experience)
            @php
                $experienceTags = collect(['Laravel', 'Next.js', 'NestJS', 'FastAPI', 'ASP.NET MVC', 'Flutter', 'Kotlin', 'MySQL', 'PostgreSQL', 'SQL Server', 'RESTful APIs', 'Dashboards'])
                    ->filter(fn ($tag) => Str::contains(strtolower($experience->description), strtolower($tag)))
                    ->take(5);
            @endphp
            <li class="timeline-entry">
                <div class="timeline-period">
                    <span>
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} —
                        {{ $experience->current ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                    </span>
                    @if($experience->current)
                        <span class="timeline-badge">Current</span>
                    @endif
                </div>
                <div class="timeline-body">
                    <h3>{{ $experience->position }}</h3>
                    <p class="timeline-company">{{ $experience->company }}</p>
                    <p class="timeline-desc">{{ Str::limit($experience->description, 260) }}</p>
                    @if($experienceTags->isNotEmpty())
                        <ul class="tag-list" aria-label="Technologies used">
                            @foreach($experienceTags as $tag)
                                <li>{{ $tag }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</section>
