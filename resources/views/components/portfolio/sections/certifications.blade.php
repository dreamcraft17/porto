@if($certifications->count())
<section id="certifications" class="section-wrap credentials-section">
    <div class="section-head">
        <div class="section-kicker">Credentials</div>
        <h2 class="section-title">Certifications for the stack.</h2>
        <p class="section-summary">
            Focused learning across cloud fundamentals, web development, networking, and algorithm foundations.
        </p>
    </div>

    <div class="credential-list">
        @foreach($certifications as $certification)
        <div class="credential-row">
            <span class="credential-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
            <div class="credential-info">
                <h3>{{ $certification->name }}</h3>
                <span class="issuer-tag">{{ $certification->issuer }}</span>
            </div>
            @if($certification->issued_date)
            <span class="credential-date">{{ \Carbon\Carbon::parse($certification->issued_date)->format('M Y') }}</span>
            @endif
            <span class="credential-badge">Credential</span>
        </div>
        @endforeach
    </div>
</section>
@endif
