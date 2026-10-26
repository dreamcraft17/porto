@extends('layouts.portfolio')

@section('title', 'Project archive — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell
        :subpage="true"
        :trail="[
            ['label' => 'Work', 'url' => url('/#work')],
            ['label' => 'All projects', 'url' => null],
        ]"
    >
        <article class="page-article">
            <p class="case-kicker">Archive</p>
            <h1 class="section-title">Systems shipped for teams and clients.</h1>
            <p class="page-lead">Professional project write-ups from cafe POS, banking modules, dashboards, and integrations—not concept mockups.</p>

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
                    {{ $projects->links('vendor.pagination.portfolio') }}
                </div>
            @endif
        </article>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
