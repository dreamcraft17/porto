@props([
    'subpage' => false,
])

@php
    $section = fn (string $id) => $subpage ? url('/#'.$id) : '#'.$id;
@endphp

<footer class="site-foot">
    <div class="site-foot-inner">
        <div class="site-foot-brand">
            <span class="brand-mark" aria-hidden="true">DN</span>
            <div>
                <p class="site-foot-name">Dozer Napitupulu</p>
                <p class="site-foot-role">Fullstack engineer · Laravel, .NET, Flutter</p>
            </div>
        </div>
        <nav class="site-foot-links" aria-label="Footer">
            <a href="{{ $section('work') }}">Projects</a>
            <a href="{{ $section('experience') }}">Experience</a>
            <a href="{{ route('projects.all') }}">Archive</a>
            <a href="{{ $section('contact') }}">Contact</a>
        </nav>
        <div class="site-foot-social">
            <a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
            <a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            <a href="mailto:{{ config('app.social.email') }}" aria-label="Email"><i class="fas fa-envelope"></i></a>
        </div>
    </div>
    <p class="site-foot-copy">© {{ date('Y') }} Dozer Napitupulu · Personal portfolio (bukan situs company DN Tech)</p>
</footer>
