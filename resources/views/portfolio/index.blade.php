@extends('layouts.portfolio')

@section('title', 'Dozer Napitupulu — Fullstack Engineer')

@push('styles')
    @vite(['resources/css/portfolio-home.css', 'resources/css/portfolio-polish.css'])
@endpush

@section('content')
<div class="portfolio-shell">
    <x-portfolio.site-header />

    <main id="main-content" class="page-main">
        @include('components.portfolio.sections.overview')
        @include('components.portfolio.sections.capabilities')
        @include('components.portfolio.sections.about')
        @include('components.portfolio.sections.work')
        @include('components.portfolio.sections.experience')
        @if($certifications->count())
            @include('components.portfolio.sections.certifications')
        @endif
        @include('components.portfolio.sections.contact')
    </main>

    <x-portfolio.site-footer />
</div>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-contact.js', 'resources/js/portfolio-nav.js'])
@endpush
