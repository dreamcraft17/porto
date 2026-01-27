@extends('layouts.admin')

@section('title', 'Manage Skills')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Skills</h1>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Skill
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Order</th>
                    <th>Skill</th>
                    <th>Category</th>
                    <th>Proficiency</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skills as $skill)
                <tr>
                    <td>{{ $skill->order }}</td>
                    <td>
                        <strong>{{ $skill->name }}</strong>
                    </td>
                    <td>
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
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $skill->proficiency }}%; background-color: var(--primary-color);"></div>
                            </div>
                            <span>{{ $skill->proficiency }}%</span>
                        </div>
                    </td>
                    <td>
                        @if($skill->icon)
                            <i class="{{ $skill->icon }}"></i>
                        @else
                            <i class="fas fa-code text-muted"></i>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection