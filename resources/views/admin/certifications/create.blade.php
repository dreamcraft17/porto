@extends('layouts.admin')

@section('title', isset($certification) ? 'Edit Certification' : 'Create Certification')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($certification) ? 'Edit Certification' : 'Create New Certification' }}</h1>
        <a href="{{ route('admin.certifications.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ isset($certification) ? route('admin.certifications.update', $certification) : route('admin.certifications.store') }}" method="POST">
            @csrf
            @if(isset($certification))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Certification Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $certification->name ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="issuer" class="form-label">Issuer *</label>
                        <input type="text" class="form-control" id="issuer" name="issuer" value="{{ old('issuer', $certification->issuer ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="issued_date" class="form-label">Issued Date</label>
                        <input type="date" class="form-control" id="issued_date" name="issued_date" value="{{ old('issued_date', isset($certification) ? ($certification->issued_date ? $certification->issued_date->format('Y-m-d') : '') : '') }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $certification->order ?? 0) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="url" class="form-label">Certificate URL</label>
                        <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $certification->url ?? '') }}" placeholder="https://example.com/certificate">
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Provide a URL to the certificate if it's available online (e.g., LinkedIn, credential website).
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    {{ isset($certification) ? 'Update Certification' : 'Create Certification' }}
                </button>
                <a href="{{ route('admin.certifications.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@section('styles')
<style>
    .form-container {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection
@endsection