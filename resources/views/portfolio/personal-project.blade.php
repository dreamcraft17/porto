@extends('layouts.portfolio')

@section('title', $project->title . ' — Dozer Napitupulu')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell
        :subpage="true"
        :trail="[
            ['label' => 'Personal', 'url' => route('personal.projects.all')],
            ['label' => Str::limit($project->title, 40), 'url' => null],
        ]"
    >
        <article class="page-article">
            @include('components.personal-project.hero')
            @include('components.personal-project.content')
        </article>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
