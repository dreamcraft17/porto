@extends('layouts.admin')

@section('title', 'Manage Personal Projects')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Personal Projects</h1>
        <a href="{{ route('admin.personal-projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Personal Project
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Order</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Technologies</th>
                    <th>Date</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->order }}</td>
                    <td>
    @if($project->image)
        <img src="{{ asset($project->image) }}" 
             alt="{{ $project->title }}" 
             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
    @else
        <div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-image text-muted"></i>
        </div>
    @endif
</td>
                    <td>
                        <strong>{{ $project->title }}</strong>
                        <br>
                        <small class="text-muted">{{ Str::limit($project->description, 50) }}</small>
                    </td>
                  <td>
    @if(!empty($project->technologies) && is_array($project->technologies))
        @foreach(array_slice($project->technologies, 0, 3) as $tech)
            <span class="badge bg-secondary mb-1">{{ $tech }}</span>
        @endforeach
        @if(count($project->technologies) > 3)
            <span class="badge bg-info">+{{ count($project->technologies) - 3 }}</span>
        @endif
    @else
        <span class="text-muted">-</span>
    @endif
</td>
                    <td>{{ $project->project_date->format('M Y') }}</td>
                    <td>
                        @if($project->featured)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('personal.project.show', $project->slug) }}" target="_blank" class="btn btn-outline-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.personal-projects.edit', $project) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.personal-projects.destroy', $project) }}" method="POST" class="d-inline">
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