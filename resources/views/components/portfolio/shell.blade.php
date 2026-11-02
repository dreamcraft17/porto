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
            <div class="site-footer-brand">
                <span class="site-footer-eyebrow">Portfolio</span>
                <strong>Dozer Napitupulu</strong>
                <span>Fullstack engineer · Laravel, .NET, Flutter</span>
            </div>
            <nav class="site-footer-links" aria-label="Elsewhere">
                <a href="mailto:{{ config('app.social.email') }}">Email</a>
                <a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer">GitHub</a>
                <a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>
            </nav>
            <a class="site-footer-top" href="#top">Back to top <span aria-hidden="true">↑</span></a>
        </div>
        <div class="site-footer-bottom">
            <p>© {{ date('Y') }} Dozer Napitupulu</p>
            <p class="site-footer-support">Website supported and managed by: Dn Tech (<a href="https://www.dntech.id" target="_blank" rel="noopener noreferrer">www.dntech.id</a>)</p>
            <span class="site-footer-status"><i aria-hidden="true"></i> Available for selected work</span>
        </div>
    </footer>
</div>
