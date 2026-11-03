<section id="experience" class="block experience-section">
    <div class="section-head">
        <p class="section-label">Experience</p>
        <h2 class="section-title">Roles where I owned delivery—not just tickets.</h2>
        <p class="section-lead">Newest first. When the employer stays the same, the timeline groups progression without repeating the company banner.</p>
    </div>

    @php
        $techCatalog = collect(['Laravel', 'Next.js', 'NestJS', 'FastAPI', 'ASP.NET MVC', 'Flutter', 'Kotlin', 'MySQL', 'PostgreSQL', 'SQL Server', 'RESTful APIs', 'Dashboards']);
        $previousCompany = null;
    @endphp

    <ol class="roadmap">
        @foreach($experiences as $index => $experience)
            @php
                $company = trim($experience->company ?? '');
                $sameEmployer = $previousCompany !== null
                    && $company !== ''
                    && strcasecmp($previousCompany, $company) === 0;
                $previousCompany = $company;

                $start = \Carbon\Carbon::parse($experience->start_date);
                $end = $experience->current
                    ? now()
                    : ($experience->end_date ? \Carbon\Carbon::parse($experience->end_date) : $start);
                $months = max(1, (int) $start->diffInMonths($end));
                $years = intdiv($months, 12);
                $remainingMonths = $months % 12;
                if ($years > 0 && $remainingMonths > 0) {
                    $durationLabel = $years.' yr '.$remainingMonths.' mo';
                } elseif ($years > 0) {
                    $durationLabel = $years.' yr';
                } else {
                    $durationLabel = $months.' mo';
                }

                $rawDescription = trim($experience->description ?? '');
                $descriptionLines = collect(preg_split('/\r\n|\r|\n/', $rawDescription))
                    ->map(fn ($line) => trim(ltrim($line, "•-\t ")))
                    ->filter()
                    ->values();
                $useBullets = $descriptionLines->count() >= 2;

                $experienceTags = $techCatalog
                    ->filter(fn ($tag) => Str::contains(strtolower($rawDescription), strtolower($tag)))
                    ->take(4);
            @endphp
            <li class="roadmap-entry {{ $experience->current ? 'is-current' : '' }}{{ $sameEmployer ? ' is-continued' : '' }}">
                <div class="roadmap-marker" aria-hidden="true">
                    <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <article class="roadmap-card">
                    <header class="roadmap-card-head">
                        <div class="roadmap-meta">
                            <p class="roadmap-period">
                                <time datetime="{{ $start->format('Y-m') }}">{{ $start->format('M Y') }}</time>
                                <span aria-hidden="true"> — </span>
                                @if($experience->current)
                                    <span>Present</span>
                                @else
                                    <time datetime="{{ $end->format('Y-m') }}">{{ $end->format('M Y') }}</time>
                                @endif
                                <span class="roadmap-duration">{{ $durationLabel }}</span>
                            </p>
                            @if(!$sameEmployer && $company !== '')
                                <p class="roadmap-company">{{ $company }}</p>
                            @elseif($sameEmployer)
                                <p class="roadmap-company roadmap-company--continued">
                                    <span class="roadmap-company-label">Same organisation</span>
                                    <span class="roadmap-company-name">{{ $company }}</span>
                                </p>
                            @endif
                        </div>
                        @if($experience->current)
                            <span class="roadmap-badge">Current role</span>
                        @endif
                    </header>

                    <h3 class="roadmap-role">{{ $experience->position }}</h3>

                    @if($useBullets)
                        <ul class="roadmap-points">
                            @foreach($descriptionLines->take(4) as $line)
                                <li>{{ Str::limit($line, 160) }}</li>
                            @endforeach
                        </ul>
                    @elseif($rawDescription !== '')
                        <p class="roadmap-desc">{{ Str::limit($rawDescription, 220) }}</p>
                    @endif

                    @if($experienceTags->isNotEmpty())
                        <ul class="tag-list tag-list--compact" aria-label="Technologies referenced in this role">
                            @foreach($experienceTags as $tag)
                                <li>{{ $tag }}</li>
                            @endforeach
                        </ul>
                    @endif
                </article>
            </li>
        @endforeach
    </ol>
</section>
