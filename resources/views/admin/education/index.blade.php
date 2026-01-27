@extends('layouts.admin')

@section('title', 'Manage Education')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Education</h1>
        <a href="{{ route('admin.education.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Education
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Order</th>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Duration</th>
                    <th>Current</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($educations as $education)
                <tr>
                    <td>{{ $education->order }}</td>
                    <td>
                        <strong>{{ $education->degree }}</strong>
                        <br>
                        <small class="text-muted">{{ Str::limit($education->description, 50) }}</small>
                    </td>
                    <td>{{ $education->institution }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - 
                        @if($education->current)
                            <span class="badge bg-success">Present</span>
                        @else
                            {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                        @endif
                    </td>
                    <td>
                        @if($education->current)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.education.edit', $education) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.education.destroy', $education) }}" method="POST" class="d-inline">
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