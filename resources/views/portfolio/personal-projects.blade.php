@extends('layouts.app')

@section('layout', 'portfolio')

@section('title', 'Personal projects — Dozer Napitupulu')

@section('styles')
    @vite(['resources/css/portfolio-case.css'])
@endsection

@section('content')
<div class="portfolio-shell portfolio-case">
    @include('components.portfolio.case-header', [
        'trail' => [
            ['label' => 'Personal projects', 'url' => null],
        ],
    ])

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

    @include('components.portfolio.sections.footer')
</div>
@endsection
