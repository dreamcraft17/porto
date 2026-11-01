@props([
    'certifications' => null,
])

@php
    $hasCertifications = $certifications instanceof \Illuminate\Support\Collection && $certifications->isNotEmpty();
@endphp

<div class="portfolio-shell portfolio-shell--split" id="top">
    <div class="split">
        <header class="split-aside intro-section" id="overview">
            <div class="split-aside-inner">
                <img class="split-avatar" src="{{ asset('images/profile/dozer.png') }}" alt="Portrait of Dozer Napitupulu" width="72" height="72" loading="eager" decoding="async">
                <h1 class="split-name">Dozer Napitupulu</h1>
                <p class="split-role">Fullstack Engineer · Laravel, ASP.NET, Flutter</p>
                <p class="intro-title">I build the software behind everyday operations.</p>

                <nav class="split-nav" data-nav-panel aria-label="Sections">
                    <a href="#about"><span class="split-nav-line" aria-hidden="true"></span>About</a>
                    <a href="#experience"><span class="split-nav-line" aria-hidden="true"></span>Experience</a>
                    <a href="#work"><span class="split-nav-line" aria-hidden="true"></span>Work</a>
                    <a href="#capabilities"><span class="split-nav-line" aria-hidden="true"></span>Capabilities</a>
                    @if($hasCertifications)
                        <a href="#certifications"><span class="split-nav-line" aria-hidden="true"></span>Credentials</a>
                    @endif
                    <a href="#contact"><span class="split-nav-line" aria-hidden="true"></span>Contact</a>
                </nav>

                <div class="split-aside-foot">
                    <a class="btn btn-light" href="#contact">Send a brief</a>
                    <ul class="split-social">
                        <li><a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fab fa-github" aria-hidden="true"></i></a></li>
                        <li><a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                        <li><a href="mailto:{{ config('app.social.email') }}" aria-label="Email"><i class="fas fa-envelope" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main id="main-content" class="split-main">
            {{ $slot }}

            <footer class="split-footer">
                <p>© {{ date('Y') }} Dozer Napitupulu</p>
                <a href="{{ route('projects.all') }}">Project archive</a>
                <a href="{{ route('personal.projects.all') }}">Personal projects</a>
                <a href="#top">Back to top ↑</a>
            </footer>
        </main>
    </div>
</div>
