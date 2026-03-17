@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Service</h1>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Service Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon Class (Font Awesome)</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" placeholder="fas fa-laptop-code">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Example: fas fa-laptop-code, fas fa-mobile-alt, fas fa-plug</small>
                        @if($service->icon)
                            <div class="mt-2">
                                <i class="{{ $service->icon }}" style="font-size: 1.5rem; color: var(--admin-accent, #c45c26);"></i>
                                <span class="text-muted ms-2">Preview</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $service->order) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $service->active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">
                                Active (Show on website)
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Brief description of the service</small>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Features</label>
                <div id="features-container">
                    @if($service->features && count($service->features) > 0)
                        @foreach($service->features as $feature)
                        <div class="feature-item mb-2 d-flex gap-2">
                            <input type="text" class="form-control" name="features[]" value="{{ $feature }}" placeholder="Feature">
                            <button type="button" class="btn btn-outline-danger remove-feature">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="feature-item mb-2 d-flex gap-2">
                            <input type="text" class="form-control" name="features[]" placeholder="Feature 1">
                            <button type="button" class="btn btn-outline-danger remove-feature" style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-feature">
                    <i class="fas fa-plus me-1"></i> Add Feature
                </button>
                <small class="form-text text-muted d-block mt-2">List key features or benefits of this service</small>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    Update Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('features-container');
        const addBtn = document.getElementById('add-feature');
        
        // Add feature input
        addBtn.addEventListener('click', function() {
            const featureItem = document.createElement('div');
            featureItem.className = 'feature-item mb-2 d-flex gap-2';
            featureItem.innerHTML = `
                <input type="text" class="form-control" name="features[]" placeholder="Feature">
                <button type="button" class="btn btn-outline-danger remove-feature">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(featureItem);
            updateRemoveButtons();
        });
        
        // Remove feature input
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-feature')) {
                e.target.closest('.feature-item').remove();
                updateRemoveButtons();
            }
        });
        
        function updateRemoveButtons() {
            const items = container.querySelectorAll('.feature-item');
            items.forEach((item, index) => {
                const removeBtn = item.querySelector('.remove-feature');
                if (items.length > 1) {
                    removeBtn.style.display = 'block';
                } else {
                    removeBtn.style.display = 'none';
                }
            });
        }
        
        updateRemoveButtons();
    });
</script>
@endsection

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
