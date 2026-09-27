@extends('layouts.app')

@section('layout', 'portfolio')

@section('title', $project->title . ' — Dozer Napitupulu')

@section('styles')
    @vite(['resources/css/portfolio-case.css'])
@endsection

@section('content')
<div class="portfolio-shell portfolio-case">
    @include('components.portfolio.case-header', [
        'trail' => [
            ['label' => 'Personal', 'url' => route('personal.projects.all')],
            ['label' => Str::limit($project->title, 40), 'url' => null],
        ],
    ])

    @include('components.personal-project.hero')
    @include('components.personal-project.content')
    @include('components.portfolio.sections.footer')
</div>
@endsection
