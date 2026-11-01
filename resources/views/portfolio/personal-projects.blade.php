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
            <header class="page-head">
                <p class="section-label">Side builds</p>
                <h1 class="page-title">Experiments and open repos.</h1>
                <p class="page-lead">Learning spikes, tools I dogfood, and repos that are safe to share publicly.</p>
            </header>

            @if($projects->isNotEmpty())
                <table class="archive-table">
                    <thead>
                        <tr>
                            <th scope="col">Year</th>
                            <th scope="col">Project</th>
                            <th scope="col" class="archive-hide-md">Built with</th>
                            <th scope="col" class="archive-hide-sm">Links</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            @php
                                $techs = is_array($project->technologies) ? array_slice($project->technologies, 0, 4) : [];
                            @endphp
                            <tr>
                                <td class="archive-year">{{ $project->project_date ? \Carbon\Carbon::parse($project->project_date)->format('Y') : '—' }}</td>
                                <td class="archive-title">
                                    <a href="{{ route('personal.project.show', $project->slug) }}">{{ $project->title }} <span aria-hidden="true">↗</span></a>
                                    @if($project->description)
                                        <p>{{ Str::limit($project->description, 110) }}</p>
                                    @endif
                                </td>
                                <td class="archive-hide-md">
                                    @if(count($techs))
                                        <ul class="tag-list">
                                            @foreach($techs as $tech)
                                                <li>{{ $tech }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="archive-hide-sm archive-links">
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $project->title }} on GitHub"><i class="fab fa-github" aria-hidden="true"></i></a>
                                    @endif
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $project->title }} live site"><i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="case-empty">
                    <p>No personal projects published yet.</p>
                </div>
            @endif

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
