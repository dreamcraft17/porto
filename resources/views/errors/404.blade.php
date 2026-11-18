@extends('layouts.portfolio')

@section('title', '404 — Page not found')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell :subpage="true" :cta="false">
        <div class="page-article page-error">
            <p class="section-label">Error 404</p>
            <h1 class="page-title">Page not found</h1>
            <p class="page-lead">The link may have moved, or the page is not published yet.</p>
            <div class="case-actions">
                <a class="btn btn-primary" href="{{ url('/') }}">Back to portfolio</a>
                <a class="btn btn-secondary" href="{{ route('projects.all') }}">View all projects</a>
            </div>
        </div>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
