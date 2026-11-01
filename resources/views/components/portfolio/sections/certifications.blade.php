@if($certifications->count())
<section id="certifications" class="block credentials-section">
    <div class="section-head">
        <p class="section-label">Credentials</p>
        <h2 class="section-title">Certifications for the stack.</h2>
        <p class="section-summary">
            Focused learning across cloud fundamentals, web development, networking, and algorithm foundations.
        </p>
    </div>

    <ul class="credential-list">
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
