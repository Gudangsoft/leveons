@extends('layouts.admin')

@section('title', 'Whitepaper Management')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Whitepaper Management</h1>
    <a href="{{ route('admin.whitepapers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add New Whitepaper
    </a>
</div>
 
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Whitepapers</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Downloads</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($whitepapers as $whitepaper)
                    <tr>
                        <td>
                            @if($whitepaper->image_url)
                                <img src="{{ $whitepaper->image_url }}" alt="{{ $whitepaper->title }}" 
                                     class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-file-alt text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div>
                                <strong>{{ $whitepaper->title }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($whitepaper->description, 80) }}</small>
                                @if($whitepaper->file_name)
                                <br>
                                <small class="badge badge-info">{{ $whitepaper->file_name }}</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-success">{{ $whitepaper->download_count }}</span>
                            @if($whitepaper->formatted_file_size)
                            <br><small class="text-muted">{{ $whitepaper->formatted_file_size }}</small>
                            @endif
                        </td>
                        <td>
                            @if($whitepaper->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($whitepaper->is_featured)
                                <span class="badge badge-warning">Featured</span>
                            @else
                                <span class="badge badge-light">Regular</span>
                            @endif
                        </td>
                        <td>
                            <small>{{ $whitepaper->created_at->format('d M Y') }}</small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.whitepapers.show', $whitepaper) }}" 
                                   class="btn btn-sm btn-info">
                                    View
                                </a>
                                <a href="{{ route('admin.whitepapers.edit', $whitepaper) }}" 
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('admin.whitepapers.destroy', $whitepaper) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this whitepaper?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-file-alt text-muted mb-3" style="font-size: 3rem;"></i>
                            <br>
                            <strong>No whitepapers found</strong>
                            <br>
                            <a href="{{ route('admin.whitepapers.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-plus"></i> Add First Whitepaper
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($whitepapers->hasPages())
        <div class="d-flex justify-content-center">
            {{ $whitepapers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": false,
            "info": false,
            "searching": true,
            "ordering": true,
            "columnDefs": [
                { "orderable": false, "targets": [0, 6] }
            ]
        });
    });
</script>
@endpush