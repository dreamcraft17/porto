@extends('layouts.portfolio')

@section('title', 'Personal projects — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-case.css', 'resources/css/portfolio-polish.css'])
@endpush

@section('content')
<div class="portfolio-shell portfolio-case">
    <x-portfolio.site-header
        :subpage="true"
        :trail="[
            ['label' => 'Personal projects', 'url' => null],
        ]"
    />

    <main id="main-content">
        <div class="case-index-hero">
            <p class="case-kicker">Side builds</p>
            <h1>Experiments and open repos.</h1>
            <p>Learning spikes, tools I dogfood, and repos that are safe to share publicly.</p>
        </div>

        <div class="case-grid">
            @forelse($projects as $project)
                <x-portfolio.project-card
                    :project="$project"
                    :url="route('personal.project.show', $project->slug)"
                />
            @empty
                <div class="case-empty">
                    <p>No personal projects published yet.</p>
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
