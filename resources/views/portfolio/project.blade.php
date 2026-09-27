@extends('layouts.app')

@section('layout', 'portfolio')

@section('title', $project->title . ' — Dozer Napitupulu')

@section('styles')
    @vite(['resources/css/portfolio-case.css'])
@endsection

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
@endphp

<div class="portfolio-shell portfolio-case">
    @include('components.portfolio.case-header', [
        'trail' => [
            ['label' => 'Projects', 'url' => route('projects.all')],
            ['label' => Str::limit($project->title, 40), 'url' => null],
        ],
    ])

    <section class="case-hero">
        <div class="case-hero-grid">
            <div>
                <p class="case-kicker">{{ $project->company ?: 'Case study' }}</p>
                <h1 class="case-title">{{ $project->title }}</h1>
                @if($project->description)
                    <p class="case-lead">{{ $project->description }}</p>
                @endif
                <div class="case-meta">
                    @if($project->project_date)
                        <span>{{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}</span>
                    @endif
                    @if($project->role)
                        <span>{{ $project->role }}</span>
                    @endif
                    @foreach($techs as $tech)
                        <span>{{ $tech }}</span>
                    @endforeach
                </div>
                <div class="case-actions">
                    @if($project->url)
                        <a class="case-btn case-btn-primary" href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
                            Live demo <i class="fas fa-arrow-up-right-from-square" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if($project->github_url)
                        <a class="case-btn case-btn-secondary" href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">
                            Source <i class="fab fa-github" aria-hidden="true"></i>
                        </a>
                    @endif
                    <a class="case-btn case-btn-secondary" href="{{ route('projects.all') }}">All projects</a>
                </div>
            </div>
        </div>
    </section>

    <div class="case-body">
        <div class="case-layout">
            <div>
                @if(count($techs))
                    <div class="case-panel">
                        <h2>Stack</h2>
                        <div class="case-tech">
                            @foreach($techs as $tech)
                                <span>{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($cleanContent !== '')
                    <div class="case-panel">
                        <h2>Overview</h2>
                        <div class="case-prose">{!! nl2br(e($cleanContent)) !!}</div>
                    </div>
                @endif
            </div>

            <aside class="case-sidebar">
                <div class="case-panel">
                    <h3>Details</h3>
                    @if($project->company)
                        <div class="case-info-row">
                            <div class="case-info-label">Company</div>
                            <div class="case-info-value">{{ $project->company }}</div>
                        </div>
                    @endif
                    @if($project->role)
                        <div class="case-info-row">
                            <div class="case-info-label">Role</div>
                            <div class="case-info-value">{{ $project->role }}</div>
                        </div>
                    @endif
                    @if($project->project_date)
                        <div class="case-info-row">
                            <div class="case-info-label">Date</div>
                            <div class="case-info-value">{{ \Carbon\Carbon::parse($project->project_date)->format('F Y') }}</div>
                        </div>
                    @endif
                </div>

                @if($otherProjects->count() > 0)
                    <div class="case-panel">
                        <h3>More cases</h3>
                        <ul class="case-more-list">
                            @foreach($otherProjects as $otherProject)
                                <li>
                                    <a href="{{ route('project.show', $otherProject->slug) }}">{{ $otherProject->title }}</a>
                                    <p>{{ Str::limit($otherProject->description, 72) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </div>

    @include('components.portfolio.sections.footer')
</div>
@endsection
