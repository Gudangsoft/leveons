@extends('layouts.admin')

@section('title', 'Consultation Packages')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Consultation Packages</h1>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Package
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.packages.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Filter by Consultant</label>
                    <select name="consultant_id" class="form-select">
                        <option value="">All Consultants</option>
                        @foreach($consultants as $consultant)
                            <option value="{{ $consultant->id }}" {{ request('consultant_id') == $consultant->id ? 'selected' : '' }}>
                                {{ $consultant->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Packages Table -->
    <div class="card">
        <div class="card-body">
            @if($packages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Consultant</th>
                                <th>Package Name</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Platform</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td>
                                        <strong>{{ $package->consultant->name }}</strong><br>
                                        <small class="text-muted">{{ $package->consultant->title }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $package->name }}</strong>
                                        @if($package->is_popular)
                                            <span class="badge bg-info ms-1">Popular</span>
                                        @endif
                                        @if($package->description)
                                            <br><small class="text-muted">{{ Str::limit($package->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $package->duration }}</td>
                                    <td><strong class="text-success">{{ $package->price_display }}</strong></td>
                                    <td>
                                        <i class="bi bi-camera-video me-1"></i>{{ $package->platform }}
                                    </td>
                                    <td>{{ $package->order }}</td>
                                    <td>
                                        @if($package->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.packages.edit', $package->id) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.packages.destroy', $package->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this package?')"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $packages->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-box-seam" style="font-size: 3rem; color: #ddd;"></i>
                    <p class="text-muted mt-3">No packages found</p>
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Create First Package
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
