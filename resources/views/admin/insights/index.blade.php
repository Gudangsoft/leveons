@extends('layouts.admin')

@section('title', 'Insight Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Insight Management</h2>
                <a href="{{ route('admin.insights.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus me-2"></i>Tambah Insight
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
                    <h5 class="mb-0">Semua Insights</h5>
                </div>
                <div class="card-body">
                    @if($insights->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Views</th>
                                        <th>Published</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($insights as $insight)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($insight->featured_image)
                                                        <img src="{{ Storage::url($insight->featured_image) }}" 
                                                             alt="{{ $insight->title }}" 
                                                             class="me-3 rounded" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="me-3 bg-light rounded d-flex align-items-center justify-content-center" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="bi bi-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ Str::limit($insight->title, 50) }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $insight->slug }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($insight->category)
                                                    <span class="badge bg-info">{{ $insight->category->name }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $insight->user->name }}</td>
                                            <td>
                                                @if($insight->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-warning">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($insight->is_featured)
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                @else
                                                    <i class="bi bi-star text-muted"></i>
                                                @endif
                                            </td>
                                            <td>{{ number_format($insight->views_count) }} views</td>
                                            <td>
                                                @if($insight->published_at)
                                                    {{ $insight->published_at->format('M d, Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.insights.show', $insight) }}" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.insights.edit', $insight) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if($insight->status === 'published')
                                                        <a href="{{ route('insight.show', $insight->slug) }}" 
                                                           target="_blank"
                                                           class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-box-arrow-up-right"></i>
                                                        </a>
                                                    @endif
                                                    <form method="POST" 
                                                          action="{{ route('admin.insights.destroy', $insight) }}" 
                                                          class="d-inline" 
                                                          onsubmit="return confirm('Are you sure you want to delete this insight?')">
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

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $insights->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-lightbulb text-muted" style="font-size: 3rem;"></i>
                            <h5 class="text-muted mt-3">No Insights Yet</h5>
                            <p class="text-muted">Start creating valuable business insights for your audience.</p>
                            <a href="{{ route('admin.insights.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus me-2"></i>Create First Insight
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection