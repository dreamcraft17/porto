@props([
    'subpage' => false,
    'trail' => [],
])

@php
    $section = fn (string $id) => $subpage ? url('/#'.$id) : '#'.$id;
    $home = url('/');
@endphp

<header class="site-headbar">
    <a class="head-brand" href="{{ $subpage ? $home : '#overview' }}">
        <span class="brand-mark">DN</span>
        <span>
            <span class="brand-name">Dozer Napitupulu</span>
            <span class="brand-role">Fullstack engineer</span>
        </span>
    </a>

    @if(count($trail))
        <nav class="case-crumb case-crumb--inline" aria-label="Breadcrumb">
            @foreach($trail as $index => $item)
                @if($index > 0)
                    <span aria-hidden="true">/</span>
                @endif
                @if(!empty($item['url']))
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @else
                    <span aria-current="page">{{ $item['label'] }}</span>
                @endif
            @endforeach
        </nav>
    @endif

    <button
        type="button"
        class="head-nav-toggle"
        data-nav-toggle
        aria-expanded="false"
        aria-controls="site-nav-panel"
        aria-label="Buka menu"
    >
        <i class="fas fa-bars" aria-hidden="true"></i>
    </button>

    <nav class="head-nav" id="site-nav-panel" data-nav-panel aria-hidden="true" aria-label="Navigasi utama">
        <a href="{{ $section('overview') }}">Start</a>
        <a href="{{ $section('about') }}">About</a>
        <a href="{{ $section('work') }}">Work</a>
        <a href="{{ $section('experience') }}">Timeline</a>
        @if(isset($certifications) && $certifications->count())
            <a href="{{ $section('certifications') }}">Proof</a>
        @endif
        <a href="{{ route('projects.all') }}">Archive</a>
        <a class="head-cta" href="{{ $section('contact') }}">Email or brief</a>
    </nav>
</header>
