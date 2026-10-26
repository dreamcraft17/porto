@extends('layouts.portfolio')

@section('title', 'Personal projects — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell
        :subpage="true"
        :trail="[
            ['label' => 'Personal projects', 'url' => null],
        ]"
    >
        <article class="page-article">
            <p class="case-kicker">Side builds</p>
            <h1 class="section-title">Experiments and open repos.</h1>
            <p class="page-lead">Learning spikes, tools I dogfood, and repos that are safe to share publicly.</p>

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
                    {{ $projects->links('vendor.pagination.portfolio') }}
                </div>
            @endif
        </article>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
