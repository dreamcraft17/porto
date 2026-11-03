@props([
    'subpage' => false,
    'trail' => [],
    'certifications' => null,
    'cta' => null,
])

@php
    $section = fn (string $id) => $subpage ? url('/#'.$id) : '#'.$id;
    $home = url('/');
    $showCta = $cta ?? $subpage;
@endphp

<div class="portfolio-shell portfolio-shell--minimal" id="top">
    <header class="site-header" data-site-header>
        <div class="site-header-inner">
            <a class="site-brand" href="{{ $home }}">
                <img src="{{ asset('images/brand/dn-logo.png') }}" alt="Dozer Napitupulu" width="170" height="32" decoding="async">
            </a>

            <button type="button" class="site-nav-toggle" data-nav-toggle aria-expanded="false" aria-controls="site-nav">Menu</button>

            <nav class="site-nav" id="site-nav" data-nav-panel aria-label="Primary">
                <a href="{{ $section('services') }}">Services</a>
                <a href="{{ $section('work') }}">Work</a>
                <a href="{{ $section('experience') }}">Experience</a>
                <a href="{{ route('projects.all') }}" @if(request()->routeIs('projects.all', 'project.show')) aria-current="page" @endif>Projects</a>
                <a href="{{ route('personal.projects.all') }}" @if(request()->routeIs('personal.projects.all', 'personal.project.show')) aria-current="page" @endif>Personal</a>
                <a class="site-nav-cta" href="{{ $section('contact') }}">Contact</a>
            </nav>
        </div>
    </header>

    <main id="main-content" class="page-main">
        @if(count($trail))
            <nav class="page-trail" aria-label="Breadcrumb">
                <a href="{{ $home }}">Home</a>
                @foreach($trail as $item)
                    <span aria-hidden="true">/</span>
                    @if(!empty($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        <span aria-current="page">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        {{ $slot }}

        @if($showCta)
            <section class="block next-step" aria-labelledby="next-step-title">
                <div>
                    <p class="section-label">Next step</p>
                    <h2 class="next-step-title" id="next-step-title">Working on a similar system?</h2>
                </div>
                <a class="btn btn-light" href="{{ url('/#contact') }}">Send a brief</a>
            </section>
        @endif
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <div class="site-footer-grid">
                <div class="site-footer-brand">
                    <a class="site-footer-brand-link" href="{{ $home }}">
                        <img src="{{ asset('images/brand/dn-logo.png') }}" alt="" width="170" height="32" decoding="async">
                        <span class="site-footer-brand-name">Dozer Napitupulu</span>
                    </a>
                    <p class="site-footer-tagline">
                        Personal portfolio for ops software—POS, banking modules, HR tools, and the APIs behind them.
                    </p>
                    <p class="site-footer-tagline">
                        Managed by DN Tech (<a href="https://dntech.id" target="_blank" rel="noopener noreferrer">DN Tech (hosting)</a>)
                    </p>
                </div>

                <div class="site-footer-col">
                    <p class="site-footer-col-title">Portfolio</p>
                    <nav class="site-footer-col-links" aria-label="Portfolio sections">
                        <a href="{{ $section('services') }}">Services</a>
                        <a href="{{ $section('work') }}">Work</a>
                        <a href="{{ $section('experience') }}">Experience</a>
                        <a href="{{ route('projects.all') }}">All projects</a>
                        <a href="{{ route('personal.projects.all') }}">Personal builds</a>
                    </nav>
                </div>

                <div class="site-footer-col">
                    <p class="site-footer-col-title">Connect</p>
                    <nav class="site-footer-col-links" aria-label="Contact">
                        <a href="{{ $section('contact') }}">Send a brief</a>
                        <a href="mailto:{{ config('app.social.email') }}">{{ config('app.social.email') }}</a>
                        <a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer">GitHub</a>
                        <a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                    </nav>
                </div>

                <div class="site-footer-col">
                    <p class="site-footer-col-title">Site</p>
                    <nav class="site-footer-col-links" aria-label="Site">
                        <a href="{{ $section('about') }}">About</a>
                        <a href="{{ $section('contact') }}">Contact</a>
                    </nav>
                </div>
            </div>

            <div class="site-footer-bottom">
                <span>© {{ date('Y') }} Dozer Napitupulu. All rights reserved.</span>
                <span class="site-footer-bottom-note">Full Stack · Software Engineering · Tech consulting · Indonesia</span>
            </div>
        </div>

        <a class="site-footer-scroll" href="#top" aria-label="Back to top">
            <span aria-hidden="true">↑</span>
        </a>
    </footer>
</div>
