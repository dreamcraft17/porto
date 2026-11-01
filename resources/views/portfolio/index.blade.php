@extends('layouts.portfolio')

@section('title', 'Dozer Napitupulu — Fullstack Engineer')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.split-shell :certifications="$certifications">
        @include('components.portfolio.sections.about')
        @include('components.portfolio.sections.experience')
        @include('components.portfolio.sections.work')
        @include('components.portfolio.sections.capabilities')
        @if($certifications->count())
            @include('components.portfolio.sections.certifications')
        @endif
        @include('components.portfolio.sections.contact')
    </x-portfolio.split-shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-contact.js', 'resources/js/portfolio-nav.js'])
@endpush
