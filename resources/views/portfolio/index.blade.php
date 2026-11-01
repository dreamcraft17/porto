@extends('layouts.portfolio')

@section('title', 'Dozer Napitupulu — Fullstack Engineer')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell :certifications="$certifications">
        @include('components.portfolio.sections.overview')
        @include('components.portfolio.sections.capabilities')
        @include('components.portfolio.sections.about')
        @include('components.portfolio.sections.work')
        @include('components.portfolio.sections.experience')
        @if($certifications->count())
            @include('components.portfolio.sections.certifications')
        @endif
        @include('components.portfolio.sections.contact')
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-contact.js', 'resources/js/portfolio-nav.js'])
@endpush
