@extends('layouts.admin')

@section('title', isset($personalProject) ? 'Edit Personal Project' : 'Create Personal Project')

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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($personalProject) ? 'Edit Personal Project' : 'Create New Personal Project' }}</h1>
        <a href="{{ route('admin.personal-projects.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ isset($personalProject) ? route('admin.personal-projects.update', $personalProject) : route('admin.personal-projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($personalProject))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $personalProject->title ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $personalProject->description ?? '') }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $personalProject->content ?? '') }}</textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="github_url" class="form-label">GitHub URL</label>
                            <input type="url" class="form-control" id="github_url" name="github_url" value="{{ old('github_url', $personalProject->github_url ?? '') }}" placeholder="https://github.com/username/project">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="live_url" class="form-label">Live Demo URL</label>
                            <input type="url" class="form-control" id="live_url" name="live_url" value="{{ old('live_url', $personalProject->live_url ?? '') }}" placeholder="https://project-demo.com">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="technologies" class="form-label">Technologies</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="techInput" placeholder="Add technology (press Enter)">
                            <button class="btn btn-outline-secondary" type="button" id="addTech">Add</button>
                        </div>
                        <div id="techTags">
                            @if(isset($personalProject) && $personalProject->technologies)
                                @foreach($personalProject->technologies as $tech)
                                <span class="tech-tag">
                                    {{ $tech }}
                                    <span class="remove-tech" onclick="removeTech(this)">×</span>
                                    <input type="hidden" name="technologies[]" value="{{ $tech }}">
                                </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="project_date" class="form-label">Project Date *</label>
                        <input type="date" class="form-control" id="project_date" name="project_date" value="{{ old('project_date', isset($personalProject) ? $personalProject->project_date->format('Y-m-d') : '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $personalProject->order ?? 0) }}">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" {{ (old('featured', $personalProject->featured ?? false)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Featured Project</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Project Image</label>
                        @if(isset($personalProject) && $personalProject->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $personalProject->image) }}" alt="{{ $personalProject->title }}" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Recommended size: 800x450px</small>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    {{ isset($personalProject) ? 'Update Project' : 'Create Project' }}
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
</script>
@endsection