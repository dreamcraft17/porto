@extends('layouts.portfolio')

@section('title', '404 — Halaman tidak ditemukan')

@push('styles')
    @vite(['resources/css/portfolio-public.css'])
@endpush

@section('content')
    <x-portfolio.shell :subpage="true">
        <div class="page-error">
            <p class="page-error-code" aria-hidden="true">404</p>
            <h1>Halaman tidak ditemukan</h1>
            <p>Link mungkin sudah pindah atau belum dipublish dari CMS.</p>
            <a class="action-primary" href="{{ url('/') }}">Kembali ke portfolio</a>
        </div>
    </x-portfolio.shell>
@endsection

@push('scripts')
    @vite(['resources/js/portfolio-nav.js'])
@endpush
