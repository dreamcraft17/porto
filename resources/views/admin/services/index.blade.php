@extends('layouts.admin')

@section('title', 'Manage Services')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Services</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Service
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-hover bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Order</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Features</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $service->order }}</td>
                    <td>
                        @if($service->icon)
                            <i class="{{ $service->icon }}" style="font-size: 1.5rem; color: var(--admin-accent, #c45c26);"></i>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $service->title }}</strong>
                    </td>
                    <td>
                        <span class="text-muted">{{ Str::limit($service->description, 60) }}</span>
                    </td>
                    <td>
                        @if($service->features && count($service->features) > 0)
                            <span class="badge bg-info">{{ count($service->features) }} features</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($service->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this service?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p>No services found. <a href="{{ route('admin.services.create') }}">Create your first service</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
