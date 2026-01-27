@extends('layouts.admin')

@section('title', 'Manage Experiences')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Experiences</h1>
        <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Experience
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Order</th>
                    <th>Position</th>
                    <th>Company</th>
                    <th>Duration</th>
                    <th>Current</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($experiences as $experience)
                <tr>
                    <td>{{ $experience->order }}</td>
                    <td>
                        <strong>{{ $experience->position }}</strong>
                        <br>
                        <small class="text-muted">{{ Str::limit($experience->description, 50) }}</small>
                    </td>
                    <td>{{ $experience->company }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                        @if($experience->current)
                            <span class="badge bg-success">Present</span>
                        @else
                            {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                        @endif
                    </td>
                    <td>
                        @if($experience->current)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" class="d-inline">
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