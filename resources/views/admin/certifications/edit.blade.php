@extends('layouts.admin')

@section('title', 'Edit Certification')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Certification</h1>
        <a href="{{ route('admin.certifications.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.certifications.update', $certification) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Certification Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $certification->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="issuer" class="form-label">Issuer *</label>
                        <input type="text" class="form-control" id="issuer" name="issuer" 
                               value="{{ old('issuer', $certification->issuer) }}" required>
                        @error('issuer')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="issued_date" class="form-label">Issued Date</label>
                        <input type="date" class="form-control" id="issued_date" name="issued_date" 
                               value="{{ old('issued_date', $certification->issued_date ? $certification->issued_date->format('Y-m-d') : '') }}">
                        @error('issued_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $certification->order) }}">
                        @error('order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="url" class="form-label">Certificate URL</label>
                        <input type="url" class="form-control" id="url" name="url" 
                               value="{{ old('url', $certification->url) }}" 
                               placeholder="https://example.com/certificate">
                        @error('url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Provide a URL to the certificate if it's available online.
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Information</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $certification->name }}</p>
                            <p class="mb-1"><strong>Issuer:</strong> {{ $certification->issuer }}</p>
                            @if($certification->issued_date)
                                <p class="mb-1"><strong>Issued:</strong> {{ $certification->issued_date->format('M Y') }}</p>
                            @endif
                            @if($certification->url)
                                <p class="mb-0"><strong>URL:</strong> <a href="{{ $certification->url }}" target="_blank">View Certificate</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Certification
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