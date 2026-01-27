@extends('layouts.admin')

@section('title', isset($skill) ? 'Edit Skill' : 'Create Skill')

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
    }
    
    .category-badge.active {
        transform: scale(1.05);
        box-shadow: 0 0 0 2px var(--primary-color);
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
        <h1 class="h3 mb-0">{{ isset($skill) ? 'Edit Skill' : 'Create New Skill' }}</h1>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>
    
    <div class="form-container">
        <form action="{{ isset($skill) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST">
            @csrf
            @if(isset($skill))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Skill Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $skill->name ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            @foreach($categories as $category)
                            <span class="badge category-badge {{ old('category', $skill->category ?? '') == $category ? 'active' : '' }}" 
                                  style="font-size: 0.9rem; padding: 8px 12px; cursor: pointer;"
                                  onclick="document.getElementById('category').value = '{{ $category }}'; 
                                           document.querySelectorAll('.category-badge').forEach(b => b.classList.remove('active'));
                                           this.classList.add('active');">
                                {{ ucfirst($category) }}
                            </span>
                            @endforeach
                        </div>
                        <input type="hidden" id="category" name="category" value="{{ old('category', $skill->category ?? '') }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="proficiency" class="form-label">Proficiency *</label>
                        <input type="range" class="form-range" id="proficiency" name="proficiency" min="1" max="100" value="{{ old('proficiency', $skill->proficiency ?? 50) }}" oninput="updateProficiencyValue(this.value)">
                        <div class="d-flex justify-content-between">
                            <small>1%</small>
                            <span id="proficiencyValue" class="fw-bold">{{ old('proficiency', $skill->proficiency ?? 50) }}%</span>
                            <small>100%</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $skill->order ?? 0) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text icon-preview">
                                <i id="iconPreview" class="{{ old('icon', $skill->icon ?? 'fas fa-code') }}"></i>
                            </span>
                            <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $skill->icon ?? '') }}" 
                                   placeholder="fas fa-code, fab fa-js, etc.">
                        </div>
                        <small class="text-muted">Use Font Awesome class names. Example: "fas fa-code", "fab fa-js"</small>
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
                                    'fas fa-server' => 'Server'
                                ];
                            @endphp
                            @foreach($commonIcons as $icon => $label)
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('{{ $icon }}')">
                                <i class="{{ $icon }} me-1"></i> {{ $label }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    {{ isset($skill) ? 'Update Skill' : 'Create Skill' }}
                </button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
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