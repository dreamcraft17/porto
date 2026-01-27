@extends('layouts.admin')

@section('title', 'Edit Experience')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Experience</h1>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.experiences.update', $experience) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="position" class="form-label">Position *</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $experience->position) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="company" class="form-label">Company *</label>
                        <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $experience->company) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date *</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $experience->order) }}">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="current" name="current" value="1" {{ old('current', $experience->current) ? 'checked' : '' }}>
                            <label class="form-check-label" for="current">Current Position</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="10" required>{{ old('description', $experience->description) }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Experience
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