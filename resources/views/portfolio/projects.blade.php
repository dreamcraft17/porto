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
            <header class="page-head">
                <p class="section-label">Archive</p>
                <h1 class="page-title">Systems shipped for teams and clients.</h1>
                <p class="page-lead">Professional project write-ups from cafe POS, banking modules, dashboards, and integrations—not concept mockups.</p>
            </header>

            @if($projects->isNotEmpty())
                <table class="archive-table">
                    <thead>
                        <tr>
                            <th scope="col">Year</th>
                            <th scope="col">Project</th>
                            <th scope="col" class="archive-hide-sm">Made at</th>
                            <th scope="col" class="archive-hide-md">Built with</th>
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
                                    <a href="{{ route('project.show', $project->slug) }}">{{ $project->title }} <span aria-hidden="true">↗</span></a>
                                    @if($project->description)
                                        <p>{{ Str::limit($project->description, 110) }}</p>
                                    @endif
                                </td>
                                <td class="archive-hide-sm">{{ $project->company ?: '—' }}</td>
                                <td class="archive-hide-md">
                                    @if(count($techs))
                                        <ul class="tag-list">
                                            @foreach($techs as $tech)
                                                <li>{{ $tech }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="case-empty">
                    <p>No projects published yet. Check back after the next CMS update.</p>
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
