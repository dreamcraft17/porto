@if($certifications->count())
<section id="certifications" class="split-section" aria-labelledby="certifications-heading">
    <h2 class="split-heading" id="certifications-heading">Credentials</h2>

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
