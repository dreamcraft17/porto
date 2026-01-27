@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard Overview</h1>
    </div>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ $stats['projects'] }}</h3>
                <p class="text-muted mb-0">Projects</p>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ $stats['personal_projects'] }}</h3>
                <p class="text-muted mb-0">Personal Projects</p>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ $stats['experiences'] }}</h3>
                <p class="text-muted mb-0">Experiences</p>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                    <i class="fas fa-tools"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ $stats['skills'] }}</h3>
                <p class="text-muted mb-0">Skills</p>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ $stats['education'] }}</h3>
                <p class="text-muted mb-0">Education</p>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #a18cd1, #fbc2eb);">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ $stats['certifications'] }}</h3>
                <p class="text-muted mb-0">Certifications</p>
            </div>
        </div>
    </div>
    
    <!-- Recent Projects -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="table-responsive">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-briefcase me-2"></i>Recent Projects
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary float-end">
                                <i class="fas fa-plus me-1"></i> Add New
                            </a>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProjects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->company ?? '-' }}</td>
                                    <td>
                                        @if($project->featured)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline">
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
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="table-responsive">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-code me-2"></i>Recent Personal Projects
                            <a href="{{ route('admin.personal-projects.create') }}" class="btn btn-sm btn-primary float-end">
                                <i class="fas fa-plus me-1"></i> Add New
                            </a>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Technologies</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPersonalProjects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>
                                        @if($project->technologies)
                                            @foreach(array_slice($project->technologies, 0, 2) as $tech)
                                                <span class="badge bg-secondary">{{ $tech }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->featured)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
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
            </div>
        </div>
    </div>
</div>
@endsection