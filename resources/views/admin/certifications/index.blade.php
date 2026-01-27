@extends('layouts.admin')

@section('title', 'Manage Certifications')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Certifications</h1>
        <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add New Certification
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover bg-white shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Order</th>
                    <th>Name</th>
                    <th>Issuer</th>
                    <th>Issued Date</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certifications as $certification)
                <tr>
                    <td>{{ $certification->order }}</td>
                    <td>
                        <strong>{{ $certification->name }}</strong>
                    </td>
                    <td>{{ $certification->issuer }}</td>
                    <td>
                        @if($certification->issued_date)
                            {{ \Carbon\Carbon::parse($certification->issued_date)->format('M Y') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($certification->url)
                            <a href="{{ $certification->url }}" target="_blank" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.certifications.edit', $certification) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.certifications.destroy', $certification) }}" method="POST" class="d-inline">
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