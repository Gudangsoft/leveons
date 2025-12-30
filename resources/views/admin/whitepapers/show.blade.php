@extends('layouts.admin')

@section('title', 'View Whitepaper: ' . $whitepaper->title)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View Whitepaper</h1>
    <div>
        <a href="{{ route('whitepapers.show', $whitepaper) }}" target="_blank" 
           class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-external-link-alt fa-sm text-white-50"></i> View Frontend
        </a>
        <a href="{{ route('admin.whitepapers.edit', $whitepaper) }}" 
           class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('admin.whitepapers.index') }}" 
           class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Whitepaper Details</h6>
            </div>
            <div class="card-body">
                @if($whitepaper->image_url)
                <div class="text-center mb-4">
                    <img src="{{ $whitepaper->image_url }}" alt="{{ $whitepaper->title }}" 
                         class="img-fluid rounded" style="max-height: 300px;">
                </div>
                @endif
                
                <div class="mb-4">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if($whitepaper->is_active)
                            <span class="badge badge-success badge-lg">Active</span>
                        @else
                            <span class="badge badge-secondary badge-lg">Inactive</span>
                        @endif
                        
                        @if($whitepaper->is_featured)
                            <span class="badge badge-warning badge-lg">Featured</span>
                        @endif
                        
                        @if($whitepaper->file_extension)
                            <span class="badge badge-info badge-lg">{{ strtoupper($whitepaper->file_extension) }}</span>
                        @endif
                        
                        @if($whitepaper->formatted_file_size)
                            <span class="badge badge-secondary badge-lg">{{ $whitepaper->formatted_file_size }}</span>
                        @endif
                    </div>
                    
                    <h2 class="mb-3">{{ $whitepaper->title }}</h2>
                    <p class="text-muted mb-2"><strong>Slug:</strong> {{ $whitepaper->slug }}</p>
                    <p class="lead">{{ $whitepaper->description }}</p>
                </div>
                
                @if($whitepaper->file_name)
                <div class="mb-4">
                    <h5>File Information</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>File Name:</strong></td>
                                <td>{{ $whitepaper->file_name }}</td>
                            </tr>
                            @if($whitepaper->formatted_file_size)
                            <tr>
                                <td><strong>File Size:</strong></td>
                                <td>{{ $whitepaper->formatted_file_size }}</td>
                            </tr>
                            @endif
                            @if($whitepaper->file_extension)
                            <tr>
                                <td><strong>File Type:</strong></td>
                                <td>{{ strtoupper($whitepaper->file_extension) }}</td>
                            </tr>
                            @endif
                            @if($whitepaper->file_url)
                            <tr>
                                <td><strong>Download:</strong></td>
                                <td>
                                    <a href="{{ route('whitepapers.download', $whitepaper) }}" 
                                       class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-download"></i> Download File
                                    </a>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- SEO Information -->
        @if($whitepaper->meta_title || $whitepaper->meta_description || $whitepaper->meta_keywords)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                @if($whitepaper->meta_title)
                <div class="mb-3">
                    <strong>Meta Title:</strong>
                    <p class="mb-0">{{ $whitepaper->meta_title }}</p>
                </div>
                @endif
                
                @if($whitepaper->meta_description)
                <div class="mb-3">
                    <strong>Meta Description:</strong>
                    <p class="mb-0">{{ $whitepaper->meta_description }}</p>
                </div>
                @endif
                
                @if($whitepaper->meta_keywords && count($whitepaper->meta_keywords) > 0)
                <div class="mb-3">
                    <strong>Meta Keywords:</strong>
                    <div class="mt-2">
                        @foreach($whitepaper->meta_keywords as $keyword)
                            <span class="badge badge-light mr-1">{{ $keyword }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-lg-4">
        <!-- Statistics Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <h2 class="text-primary">{{ $whitepaper->download_count }}</h2>
                    <p class="text-muted mb-0">Total Downloads</p>
                </div>
                
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <span class="text-muted">{{ $whitepaper->created_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    <span class="text-muted">{{ $whitepaper->updated_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div class="mb-3">
                    <strong>Updated:</strong><br>
                    <span class="text-muted">{{ $whitepaper->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        
        <!-- Actions Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.whitepapers.edit', $whitepaper) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Whitepaper
                    </a>
                    
                    <a href="{{ route('whitepapers.show', $whitepaper) }}" target="_blank" class="btn btn-success">
                        <i class="fas fa-external-link-alt"></i> View Frontend
                    </a>
                    
                    @if($whitepaper->file_url)
                    <a href="{{ route('whitepapers.download', $whitepaper) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-download"></i> Download File
                    </a>
                    @endif
                    
                    <hr>
                    
                    <form action="{{ route('admin.whitepapers.destroy', $whitepaper) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this whitepaper? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Delete Whitepaper
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.whitepapers.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-list"></i> All Whitepapers
                    </a>
                    <a href="{{ route('admin.whitepapers.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-plus"></i> Add New Whitepaper
                    </a>
                    <a href="{{ route('whitepapers.index') }}" target="_blank" class="list-group-item list-group-item-action">
                        <i class="fas fa-globe"></i> View All Public Whitepapers
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.badge-lg {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}
</style>
@endpush