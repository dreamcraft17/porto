@extends('layouts.admin')

@section('title', 'Edit Education')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Education</h1>
        <a href="{{ route('admin.education.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.education.update', $education) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="degree" class="form-label">Degree *</label>
                        <input type="text" class="form-control" id="degree" name="degree" 
                               value="{{ old('degree', $education->degree) }}" required>
                        @error('degree')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institution *</label>
                        <input type="text" class="form-control" id="institution" name="institution" 
                               value="{{ old('institution', $education->institution) }}" required>
                        @error('institution')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date *</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                               value="{{ old('start_date', $education->start_date->format('Y-m-d')) }}" required>
                        @error('start_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                               value="{{ old('end_date', $education->end_date ? $education->end_date->format('Y-m-d') : '') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $education->order) }}">
                        @error('order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="current" name="current" value="1" 
                                   {{ old('current', $education->current) ? 'checked' : '' }}>
                            <label class="form-check-label" for="current">Currently Studying</label>
                        </div>
                        @error('current')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="8">{{ old('description', $education->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Information</h6>
                            <p class="mb-1"><strong>Degree:</strong> {{ $education->degree }}</p>
                            <p class="mb-1"><strong>Institution:</strong> {{ $education->institution }}</p>
                            <p class="mb-1"><strong>Period:</strong> 
                                {{ $education->start_date->format('M Y') }} - 
                                @if($education->current)
                                    <span class="badge bg-success">Present</span>
                                @else
                                    {{ $education->end_date->format('M Y') }}
                                @endif
                            </p>
                            @if($education->description)
                                <p class="mb-0"><strong>Description:</strong> {{ Str::limit($education->description, 100) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Education
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

@section('scripts')
<script>
    document.getElementById('current').addEventListener('change', function() {
        const endDateInput = document.getElementById('end_date');
        if (this.checked) {
            endDateInput.disabled = true;
            endDateInput.value = '';
        } else {
            endDateInput.disabled = false;
        }
    });
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const currentCheckbox = document.getElementById('current');
        const endDateInput = document.getElementById('end_date');
        if (currentCheckbox.checked) {
            endDateInput.disabled = true;
        }
    });
</script>
@endsection