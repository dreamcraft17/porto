@props([
    'subpage' => false,
    'trail' => [],
    'certifications' => null,
])

@php
    $section = fn (string $id) => $subpage ? url('/#'.$id) : '#'.$id;
    $home = url('/');
    $certCount = $certifications instanceof \Illuminate\Support\Collection
        ? $certifications->count()
        : 0;
@endphp

<div class="portfolio-shell portfolio-shell--v3 portfolio-shell--epic">
    <aside class="site-rail" id="site-rail-panel" data-rail-panel aria-label="Site navigation">
        <a class="rail-logo" href="{{ $home }}">
            <span class="rail-logo-mark">D</span>
            <span class="rail-logo-text">
                <strong>Dozer</strong>
                <small>Fullstack</small>
            </span>
        </a>

        @if(count($trail))
            <nav class="rail-trail" aria-label="Breadcrumb">
                @foreach($trail as $index => $item)
                    @if($index > 0)<span class="rail-trail-sep">→</span>@endif
                    @if(!empty($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        <span aria-current="page">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <nav class="rail-nav" aria-label="Primary">
            <a href="{{ $section('overview') }}"><span>01</span> Start</a>
            <a href="{{ $section('about') }}"><span>02</span> Profile</a>
            <a href="{{ $section('work') }}"><span>03</span> Work</a>
            <a href="{{ $section('experience') }}"><span>04</span> History</a>
            @if($certCount > 0)
                <a href="{{ $section('certifications') }}"><span>05</span> Credentials</a>
            @endif
            <a href="{{ route('projects.all') }}"><span>→</span> All projects</a>
            <a href="{{ route('personal.projects.all') }}"><span>→</span> Personal</a>
        </nav>

        <div class="rail-cta">
            <a class="rail-nav-cta" href="{{ $section('contact') }}">Contact</a>
        </div>

        <div class="rail-foot">
            <div class="rail-social">
                <a href="{{ config('app.social.github') }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
                <a href="{{ config('app.social.linkedin') }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="mailto:{{ config('app.social.email') }}" aria-label="Email"><i class="fas fa-envelope"></i></a>
            </div>
            <p class="rail-copy">© {{ date('Y') }} Dozer Napitupulu</p>
            <p class="rail-managed">
                Website dikelola oleh / Managed by:
                <a href="https://dntech.id" target="_blank" rel="noopener noreferrer">dntech.id</a>
            </p>
        </div>
    </aside>

    <div class="site-canvas">
        <header class="site-mobile-bar">
            <a class="rail-logo rail-logo--compact" href="{{ $home }}">
                <span class="rail-logo-mark">D</span>
                <strong>Dozer</strong>
            </a>
            <button type="button" class="site-rail-toggle" data-rail-toggle aria-expanded="false" aria-controls="site-rail-panel" aria-label="Menu">
                <span></span><span></span>
            </button>
        </header>

        <div class="site-rail-overlay" data-rail-overlay hidden></div>

        <main id="main-content" class="page-main">
            {{ $slot }}
        </main>

        <footer class="site-credit">
            <p>Personal portfolio · Laravel, .NET, Flutter · Bukan situs company DN Tech</p>
            <p class="site-managed">
                Website dikelola oleh / Managed by:
                <a href="https://dntech.id" target="_blank" rel="noopener noreferrer">dntech.id</a>
            </p>
        </footer>
    </div>
</div>
