@extends('layouts.admin')

@section('title', 'Consultant Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Consultant Management</h2>
                <a href="{{ route('admin.consultants.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus me-2"></i>Tambah Consultant
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Semua Consultants</h5>
                </div>
                <div class="card-body">
                    @if($consultants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($consultants as $consultant)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($consultant->avatar)
                                                        <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                                                             alt="{{ $consultant->name }}" 
                                                             class="me-3 rounded-circle" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="bi bi-person text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $consultant->name }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $consultant->slug }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $consultant->title ?: '-' }}</td>
                                            <td>{{ $consultant->company ?: '-' }}</td>
                                            <td>{{ $consultant->price_text ?: '-' }}</td>
                                            <td>
                                                @if($consultant->is_published)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-warning">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.consultants.show', $consultant) }}" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.consultants.edit', $consultant) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if($consultant->is_published)
                                                        <a href="{{ route('consultant.show', $consultant->slug) }}" 
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-box-arrow-up-right"></i>
                                                        </a>
                                                    @endif
                                                    <form method="POST" 
                                                          action="{{ route('admin.consultants.destroy', $consultant) }}" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this consultant?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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

                        <div class="mt-4">
                            {{ $consultants->links() }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada consultant. <a href="{{ route('admin.consultants.create') }}">Tambah consultant baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
