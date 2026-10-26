@extends('layouts.portfolio')

@section('title', $project->title . ' — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-case.css', 'resources/css/portfolio-polish.css', 'resources/css/personal-project.css'])
@endpush

@section('content')
<div class="portfolio-shell portfolio-case">
    <x-portfolio.site-header
        :subpage="true"
        :trail="[
            ['label' => 'Personal', 'url' => route('personal.projects.all')],
            ['label' => Str::limit($project->title, 40), 'url' => null],
        ]"
    />

    <main id="main-content">
        @include('components.personal-project.hero')
        @include('components.personal-project.content')
    </main>

    <x-portfolio.site-footer :subpage="true" />
</div>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
