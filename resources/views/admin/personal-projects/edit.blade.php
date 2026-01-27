@extends('layouts.admin')

@section('title', 'Edit Personal Project')

@section('styles')
<style>
    .form-container {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .tech-tag {
        display: inline-block;
        background: #e9ecef;
        padding: 5px 10px;
        border-radius: 20px;
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    
    .tech-tag .remove-tech {
        cursor: pointer;
        margin-left: 5px;
        color: #dc3545;
    }
    
    .image-preview {
        max-width: 300px;
        height: auto;
        border-radius: 10px;
        margin-bottom: 15px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Personal Project</h1>
        <a href="{{ route('admin.personal-projects.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.personal-projects.update', $personalProject) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title', $personalProject->title) }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $personalProject->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $personalProject->content) }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="github_url" class="form-label">GitHub URL</label>
                            <input type="url" class="form-control" id="github_url" name="github_url" 
                                   value="{{ old('github_url', $personalProject->github_url) }}" 
                                   placeholder="https://github.com/username/project">
                            @error('github_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="live_url" class="form-label">Live Demo URL</label>
                            <input type="url" class="form-control" id="live_url" name="live_url" 
                                   value="{{ old('live_url', $personalProject->live_url) }}" 
                                   placeholder="https://project-demo.com">
                            @error('live_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="technologies" class="form-label">Technologies</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="techInput" placeholder="Add technology (press Enter)">
                            <button class="btn btn-outline-secondary" type="button" id="addTech">Add</button>
                        </div>
                        <div id="techTags">
                            @php
                                $technologies = old('technologies', $personalProject->technologies ?? []);
                            @endphp
                            @if(is_array($technologies))
                                @foreach($technologies as $tech)
                                <span class="tech-tag">
                                    {{ $tech }}
                                    <span class="remove-tech" onclick="removeTech(this)">×</span>
                                    <input type="hidden" name="technologies[]" value="{{ $tech }}">
                                </span>
                                @endforeach
                            @endif
                        </div>
                        @error('technologies')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="project_date" class="form-label">Project Date *</label>
                        <input type="date" class="form-control" id="project_date" name="project_date" 
                               value="{{ old('project_date', $personalProject->project_date->format('Y-m-d')) }}" required>
                        @error('project_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $personalProject->order) }}">
                        @error('order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" 
                                   {{ old('featured', $personalProject->featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Featured Project</label>
                        </div>
                        @error('featured')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Project Image</label>
                        @if($personalProject->image)
                            <div class="mb-3">
                                <p class="mb-2"><strong>Current Image:</strong></p>
                                <img src="{{ asset('storage/' . $personalProject->image) }}" 
                                     alt="{{ $personalProject->title }}" 
                                     class="image-preview">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image. Recommended size: 800x450px</small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Information</h6>
                            <p class="mb-1"><strong>Slug:</strong> {{ $personalProject->slug }}</p>
                            <p class="mb-1"><strong>Created:</strong> {{ $personalProject->created_at->format('M d, Y') }}</p>
                            <p class="mb-1"><strong>Updated:</strong> {{ $personalProject->updated_at->format('M d, Y') }}</p>
                            <p class="mb-0">
                                <strong>Status:</strong> 
                                @if($personalProject->featured)
                                    <span class="badge bg-success">Featured</span>
                                @else
                                    <span class="badge bg-secondary">Regular</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Personal Project
                </button>
                <a href="{{ route('admin.personal-projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Technology tags management
    document.getElementById('addTech').addEventListener('click', addTechnology);
    document.getElementById('techInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTechnology();
        }
    });
    
    function addTechnology() {
        const input = document.getElementById('techInput');
        const tech = input.value.trim();
        
        if (tech) {
            const tagsDiv = document.getElementById('techTags');
            
            // Check if already exists
            const existing = Array.from(tagsDiv.querySelectorAll('input[type="hidden"]'))
                .some(input => input.value === tech);
            
            if (!existing) {
                const tag = document.createElement('span');
                tag.className = 'tech-tag';
                tag.innerHTML = `
                    ${tech}
                    <span class="remove-tech" onclick="removeTech(this)">×</span>
                    <input type="hidden" name="technologies[]" value="${tech}">
                `;
                tagsDiv.appendChild(tag);
            }
            
            input.value = '';
        }
    }
    
    function removeTech(element) {
        element.parentElement.remove();
    }
    
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let previewContainer = document.getElementById('imagePreviewContainer');
                if (!previewContainer) {
                    previewContainer = document.createElement('div');
                    previewContainer.id = 'imagePreviewContainer';
                    previewContainer.className = 'mb-3';
                    this.parentNode.insertBefore(previewContainer, this);
                }
                previewContainer.innerHTML = `
                    <p class="mb-2"><strong>New Image Preview:</strong></p>
                    <img src="${e.target.result}" class="image-preview">
                `;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection