@extends('layouts.portfolio')

@section('title', 'Project archive — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-case.css', 'resources/css/portfolio-polish.css'])
@endpush

@section('content')
<div class="portfolio-shell portfolio-case">
    <x-portfolio.site-header
        :subpage="true"
        :trail="[
            ['label' => 'Work', 'url' => url('/#work')],
            ['label' => 'All projects', 'url' => null],
        ]"
    />

    <main id="main-content">

    <div class="case-index-hero">
        <p class="case-kicker">Archive</p>
        <h1>Systems shipped for teams and clients.</h1>
        <p>Professional project write-ups from cafe POS, banking modules, dashboards, and integrations—not concept mockups.</p>
    </div>

    <div class="case-grid">
        @forelse($projects as $project)
            <x-portfolio.project-card
                :project="$project"
                :url="route('project.show', $project->slug)"
            />
        @empty
            <div class="case-empty">
                <p>No projects published yet. Check back after the next CMS update.</p>
            </div>
        @endforelse
    </div>

    @if($projects->hasPages())
        <div class="case-pagination">
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    @endif

    </main>

    <x-portfolio.site-footer :subpage="true" />
</div>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
