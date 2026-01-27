@extends('layouts.admin')

@section('title', isset($experience) ? 'Edit Experience' : 'Create Experience')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($experience) ? 'Edit Experience' : 'Create New Experience' }}</h1>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ isset($experience) ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" method="POST">
            @csrf
            @if(isset($experience))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="position" class="form-label">Position *</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $experience->position ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="company" class="form-label">Company *</label>
                        <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $experience->company ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date *</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', isset($experience) ? $experience->start_date->format('Y-m-d') : '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', isset($experience) ? ($experience->end_date ? $experience->end_date->format('Y-m-d') : '') : '') }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $experience->order ?? 0) }}">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="current" name="current" value="1" {{ (old('current', $experience->current ?? false)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="current">Current Position</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="10" required>{{ old('description', $experience->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    {{ isset($experience) ? 'Update Experience' : 'Create Experience' }}
                </button>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline-secondary">Cancel</a>
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