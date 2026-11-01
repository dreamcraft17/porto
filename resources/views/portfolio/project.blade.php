@extends('layouts.portfolio')

@section('title', $project->title . ' — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
@php
    $techs = is_array($project->technologies ?? null)
        ? $project->technologies
        : (json_decode($project->technologies ?? '[]', true) ?: []);

    $content = $project->content ?? '';
    $lines = explode("\n", $content);
    $filteredLines = [];
    foreach ($lines as $line) {
        if (preg_match('/^(company|role|technologies):/i', trim($line))) {
            continue;
        }
        $filteredLines[] = $line;
    }
    $cleanContent = trim(implode("\n", $filteredLines));
    $contentHasMarkup = $cleanContent !== strip_tags($cleanContent);
    $renderedContent = $contentHasMarkup
        ? clean($cleanContent)
        : nl2br(e($cleanContent));
@endphp

    <x-portfolio.shell
        :subpage="true"
        :trail="[
            ['label' => 'Projects', 'url' => route('projects.all')],
            ['label' => Str::limit($project->title, 40), 'url' => null],
        ]"
    >
        <article class="page-article">
            <header class="case-hero">
                <p class="section-label">{{ $project->company ?: 'Case study' }}</p>
                <h1 class="case-title">{{ $project->title }}</h1>
                @if($project->description)
                    <p class="case-lead">{{ $project->description }}</p>
                @endif
                @if($project->url || $project->github_url)
                    <div class="case-actions">
                        @if($project->url)
                            <a class="btn btn-primary" href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">Live demo ↗</a>
                        @endif
                        @if($project->github_url)
                            <a class="btn btn-secondary" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">Source code ↗</a>
                        @endif
                    </div>
                @endif
            </header>

            @if(!empty($project->image_url ?? null))
                <figure class="case-cover">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" width="960" height="600" loading="eager" decoding="async">
                </figure>
            @endif

            <div class="case-layout">
                <div class="case-main">
                    @if($cleanContent !== '')
                        <div class="case-prose">{!! $renderedContent !!}</div>
                    @else
                        <p class="case-lead">A full write-up for this project is not published yet.</p>
                    @endif
                </div>

                <aside class="case-sidebar" aria-label="Project details">
                    <dl class="case-facts">
                        @if($project->company)
                            <div>
                                <dt>Company</dt>
                                <dd>{{ $project->company }}</dd>
                            </div>
                        @endif
                        @if($project->role)
                            <div>
                                <dt>Role</dt>
                                <dd>{{ $project->role }}</dd>
                            </div>
                        @endif
                        @if($project->project_date)
                            <div>
                                <dt>Date</dt>
                                <dd>{{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}</dd>
                            </div>
                        @endif
                        @if(count($techs))
                            <div>
                                <dt>Stack</dt>
                                <dd>{{ implode(', ', $techs) }}</dd>
                            </div>
                        @endif
                    </dl>

                    @if($otherProjects->count() > 0)
                        <div class="case-more">
                            <h2 class="section-label">More projects</h2>
                            <ul class="case-more-list">
                                @foreach($otherProjects as $otherProject)
                                    <li>
                                        <a href="{{ route('project.show', $otherProject->slug) }}">{{ $otherProject->title }}</a>
                                        <p>{{ Str::limit($otherProject->description, 72) }}</p>
                                    </li>
                                @endforeach
                            </ul>
                            <a class="link-arrow" href="{{ route('projects.all') }}">All projects →</a>
                        </div>
                    @endif
                </aside>
            </div>
        </article>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
