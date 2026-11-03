<section id="experience" class="block experience-section">
    <div class="section-head">
        <p class="section-label">Roadmap</p>
        <h2 class="section-title">A path through the systems I’ve helped move forward.</h2>
        <p class="section-lead">From shipping individual features to owning the workflows behind them, each stop has added a sharper way to build useful software.</p>
    </div>

    <ol class="roadmap">
        @foreach($experiences as $index => $experience)
            @php
                $experienceTags = collect(['Laravel', 'Next.js', 'NestJS', 'FastAPI', 'ASP.NET MVC', 'Flutter', 'Kotlin', 'MySQL', 'PostgreSQL', 'SQL Server', 'RESTful APIs', 'Dashboards'])
                    ->filter(fn ($tag) => Str::contains(strtolower($experience->description), strtolower($tag)))
                    ->take(5);
            @endphp
            <li class="roadmap-entry {{ $experience->current ? 'is-current' : '' }}">
                <div class="roadmap-marker" aria-hidden="true">
                    <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="roadmap-card">
                    <div class="roadmap-card-head">
                        <p class="roadmap-period">
                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} —
                            {{ $experience->current ? 'Now' : \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                        </p>
                        @if($experience->current)
                            <span class="roadmap-badge">Current focus</span>
                        @endif
                    </div>
                    <h3>{{ $experience->position }}</h3>
                    <p class="roadmap-company">{{ $experience->company }}</p>
                    <p class="roadmap-desc">{{ Str::limit($experience->description, 260) }}</p>
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
