@extends('layouts.admin')

@section('title', 'CTA Sections')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">CTA Sections</h1>
        <a href="{{ route('admin.cta-sections.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New CTA
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All CTA Sections</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Page</th>
                            <th width="20%">Title</th>
                            <th width="30%">Description</th>
                            <th width="10%">Buttons</th>
                            <th width="10%">Status</th>
                            <th width="5%">Order</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ctaSections as $cta)
                            <tr>
                                <td>{{ $cta->id }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($cta->page) }}</span>
                                </td>
                                <td>{{ $cta->title }}</td>
                                <td>{{ Str::limit($cta->description, 80) }}</td>
                                <td>
                                    @if($cta->show_consultation_button)
                                        <span class="badge bg-info text-white mb-1">Consultation</span>
                                    @endif
                                    @if($cta->show_whatsapp_button)
                                        <span class="badge bg-success">WhatsApp</span>
                                    @endif
                                </td>
                                <td>
                                    @if($cta->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $cta->order }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.cta-sections.edit', $cta) }}" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.cta-sections.destroy', $cta) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this CTA section?');"
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
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-0">No CTA sections found.</p>
                                    <a href="{{ route('admin.cta-sections.create') }}" class="btn btn-primary mt-2">
                                        Create First CTA Section
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
