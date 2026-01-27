@extends('layouts.admin')

@section('title', 'Edit Skill')

@section('styles')
<style>
    .form-container {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .category-badge {
        cursor: pointer;
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .category-badge.active {
        transform: scale(1.05);
        box-shadow: 0 0 0 2px var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .icon-preview {
        font-size: 24px;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 10px;
        margin-right: 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Skill</h1>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Skill Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $skill->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            @foreach($categories as $category)
                            <span class="badge category-badge {{ old('category', $skill->category) == $category ? 'active' : '' }}" 
                                  style="font-size: 0.9rem; padding: 8px 12px; cursor: pointer; background: {{ 
                                    $category == 'frontend' ? '#4CAF50' : 
                                    ($category == 'backend' ? '#FF5722' : 
                                    ($category == 'database' ? '#2196F3' : 
                                    ($category == 'mobile' ? '#9C27B0' : 
                                    ($category == 'tools' ? '#FF9800' : 
                                    ($category == 'framework' ? '#673AB7' : '#795548'))))) 
                                  }}; color: white;"
                                  onclick="selectCategory('{{ $category }}')">
                                {{ ucfirst($category) }}
                            </span>
                            @endforeach
                        </div>
                        <input type="hidden" id="category" name="category" value="{{ old('category', $skill->category) }}" required>
                        @error('category')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="proficiency" class="form-label">Proficiency *</label>
                        <input type="range" class="form-range" id="proficiency" name="proficiency" 
                               min="1" max="100" value="{{ old('proficiency', $skill->proficiency) }}" 
                               oninput="updateProficiencyValue(this.value)">
                        <div class="d-flex justify-content-between">
                            <small>1%</small>
                            <span id="proficiencyValue" class="fw-bold">{{ old('proficiency', $skill->proficiency) }}%</span>
                            <small>100%</small>
                        </div>
                        @error('proficiency')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" 
                               value="{{ old('order', $skill->order) }}">
                        @error('order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text icon-preview">
                                <i id="iconPreview" class="{{ old('icon', $skill->icon ?? 'fas fa-code') }}"></i>
                            </span>
                            <input type="text" class="form-control" id="icon" name="icon" 
                                   value="{{ old('icon', $skill->icon) }}" 
                                   placeholder="fas fa-code, fab fa-js, etc.">
                        </div>
                        <small class="text-muted">Use Font Awesome class names. Example: "fas fa-code", "fab fa-js"</small>
                        @error('icon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Common Icons:</label>
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $commonIcons = [
                                    'fas fa-code' => 'Code',
                                    'fab fa-js' => 'JavaScript',
                                    'fab fa-laravel' => 'Laravel',
                                    'fab fa-php' => 'PHP',
                                    'fab fa-microsoft' => '.NET',
                                    'fab fa-flutter' => 'Flutter',
                                    'fas fa-database' => 'Database',
                                    'fab fa-git-alt' => 'Git',
                                    'fab fa-docker' => 'Docker',
                                    'fas fa-server' => 'Server',
                                    'fab fa-react' => 'React',
                                    'fab fa-vuejs' => 'Vue.js',
                                    'fab fa-node-js' => 'Node.js',
                                    'fab fa-python' => 'Python'
                                ];
                            @endphp
                            @foreach($commonIcons as $icon => $label)
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('{{ $icon }}')">
                                <i class="{{ $icon }} me-1"></i> {{ $label }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Current Information</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $skill->name }}</p>
                            <p class="mb-1"><strong>Category:</strong> 
                                <span class="badge" style="background: {{ 
                                    $skill->category == 'frontend' ? '#4CAF50' : 
                                    ($skill->category == 'backend' ? '#FF5722' : 
                                    ($skill->category == 'database' ? '#2196F3' : 
                                    ($skill->category == 'mobile' ? '#9C27B0' : 
                                    ($skill->category == 'tools' ? '#FF9800' : 
                                    ($skill->category == 'framework' ? '#673AB7' : '#795548'))))) 
                                }}; color: white;">
                                    {{ ucfirst($skill->category) }}
                                </span>
                            </p>
                            <p class="mb-1"><strong>Proficiency:</strong> {{ $skill->proficiency }}%</p>
                            <p class="mb-0"><strong>Icon:</strong> 
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }}"></i> ({{ $skill->icon }})
                                @else
                                    <i class="fas fa-code"></i> Default
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Skill
                </button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function selectCategory(category) {
        document.getElementById('category').value = category;
        document.querySelectorAll('.category-badge').forEach(badge => {
            badge.classList.remove('active');
        });
        event.target.classList.add('active');
    }
    
    function updateProficiencyValue(value) {
        document.getElementById('proficiencyValue').textContent = value + '%';
    }
    
    function setIcon(icon) {
        document.getElementById('icon').value = icon;
        document.getElementById('iconPreview').className = icon;
    }
    
    // Update icon preview on input
    document.getElementById('icon').addEventListener('input', function() {
        document.getElementById('iconPreview').className = this.value;
    });
    
    // Initialize category badges
    document.addEventListener('DOMContentLoaded', function() {
        const currentCategory = document.getElementById('category').value;
        if (currentCategory) {
            document.querySelectorAll('.category-badge').forEach(badge => {
                if (badge.textContent.trim().toLowerCase() === currentCategory) {
                    badge.classList.add('active');
                }
            });
        }
    });
</script>
@endsection