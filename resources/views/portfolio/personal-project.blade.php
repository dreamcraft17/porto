@extends('layouts.app')

@section('title', $project->title)

@section('styles')
    @vite(['resources/css/personal-project.css'])
@endsection

@section('content')
@include('components.personal-project.hero')
@include('components.personal-project.content')
@endsection
