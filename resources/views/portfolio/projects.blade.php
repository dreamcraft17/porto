@extends('layouts.app')

@section('layout', 'portfolio')

@section('title', 'Project archive — Dozer Napitupulu')

@section('styles')
    @vite(['resources/css/portfolio-case.css'])
@endsection

@section('content')
<div class="portfolio-shell portfolio-case">
    @include('components.portfolio.case-header', [
        'trail' => [
            ['label' => 'Work', 'url' => url('/#work')],
            ['label' => 'All projects', 'url' => null],
        ],
    ])

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

    @include('components.portfolio.sections.footer')
</div>
@endsection
