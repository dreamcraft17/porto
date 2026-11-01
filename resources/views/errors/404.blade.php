@extends('layouts.portfolio')

@section('title', '404 — Halaman tidak ditemukan')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell :subpage="true" :cta="false">
        <div class="page-article page-error">
            <p class="section-label">Error 404</p>
            <h1 class="page-title">Halaman tidak ditemukan</h1>
            <p class="page-lead">Link mungkin sudah pindah atau belum dipublish dari CMS.</p>
            <div class="case-actions">
                <a class="btn btn-primary" href="{{ url('/') }}">Kembali ke portfolio</a>
                <a class="btn btn-secondary" href="{{ route('projects.all') }}">Lihat semua project</a>
            </div>
        </div>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
