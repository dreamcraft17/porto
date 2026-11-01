<section id="experience" class="split-section" aria-labelledby="experience-heading">
    <h2 class="split-heading" id="experience-heading">Experience</h2>

    <ol class="entry-list">
        @foreach($experiences as $experience)
            @php
                $experienceTags = collect(['Laravel', 'Next.js', 'NestJS', 'FastAPI', 'ASP.NET MVC', 'Flutter', 'Kotlin', 'MySQL', 'PostgreSQL', 'SQL Server', 'RESTful APIs', 'Dashboards'])
                    ->filter(fn ($tag) => Str::contains(strtolower($experience->description), strtolower($tag)))
                    ->take(5);
            @endphp
            <li class="entry">
                <p class="entry-date">
                    {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} —
                    {{ $experience->current ? 'Present' : \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                </p>
                <div class="entry-body">
                    <h3 class="entry-title">
                        {{ $experience->position }} <span>· {{ $experience->company }}</span>
                    </h3>
                    <p class="entry-desc">{{ Str::limit($experience->description, 260) }}</p>
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
