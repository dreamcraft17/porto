@if($certifications->count())
<section id="certifications" class="block credentials-section" data-scene="credentials">
    <div class="section-head" data-reveal data-clip-birth>
        <p class="section-label">Credentials</p>
        <h2 class="section-title">Certifications for the stack.</h2>
    </div>

    <ul class="credential-list" data-reveal-stagger>
        @foreach($certifications as $certification)
            <li class="credential-row">
                <div>
                    <h3>{{ $certification->name }}</h3>
                    <p class="credential-issuer">{{ $certification->issuer }}</p>
                </div>
                @if($certification->issued_date)
                    <span class="credential-date">{{ \Carbon\Carbon::parse($certification->issued_date)->format('M Y') }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</section>
@endif
