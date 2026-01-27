@extends('layouts.admin')

@section('title', isset($education) ? 'Edit Education' : 'Create Education')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($education) ? 'Edit Education' : 'Create New Education' }}</h1>
        <a href="{{ route('admin.education.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ isset($education) ? route('admin.education.update', $education) : route('admin.education.store') }}" method="POST">
            @csrf
            @if(isset($education))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="degree" class="form-label">Degree *</label>
                        <input type="text" class="form-control" id="degree" name="degree" value="{{ old('degree', $education->degree ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institution *</label>
                        <input type="text" class="form-control" id="institution" name="institution" value="{{ old('institution', $education->institution ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date *</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', isset($education) ? $education->start_date->format('Y-m-d') : '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', isset($education) ? ($education->end_date ? $education->end_date->format('Y-m-d') : '') : '') }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $education->order ?? 0) }}">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="current" name="current" value="1" {{ (old('current', $education->current ?? false)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="current">Currently Studying</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="8">{{ old('description', $education->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    {{ isset($education) ? 'Update Education' : 'Create Education' }}
                </button>
                <a href="{{ route('admin.education.index') }}" class="btn btn-outline-secondary">Cancel</a>
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