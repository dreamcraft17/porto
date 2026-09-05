@extends('layouts.app')

@section('layout', 'portfolio')

@section('title', 'Dozer Napitupulu - Fullstack Engineer')

@section('styles')
    @vite(['resources/css/portfolio-home.css'])
@endsection

@section('content')
<div class="portfolio-shell">
    @include('components.portfolio.header')

    <main class="page-main">
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
</div>
@endsection

@section('scripts')
    @vite(['resources/js/portfolio-contact.js'])
@endsection
