@extends('layouts.admin')

@section('title', 'View Insight - ' . $insight->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Insight Details</h2>
                <div>
                    @if($insight->status === 'published')
                        <a href="{{ route('insight.show', $insight->slug) }}" target="_blank" class="btn btn-success">
                            <i class="bi bi-box-arrow-up-right me-2"></i>View Live
                        </a>
                    @endif
                    <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.insights.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Main Content -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ $insight->title }}</h5>
                        </div>
                        <div class="card-body">
                            @if($insight->featured_image)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($insight->featured_image) }}" 
                                         alt="{{ $insight->title }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 300px;">
                                </div>
                            @endif

                            @if($insight->excerpt)
                                <div class="alert alert-info">
                                    <strong>Excerpt:</strong> {{ $insight->excerpt }}
                                </div>
                            @endif

                            <div class="insight-content">
                                {!! $insight->content !!}
                            </div>
                        </div>
                    </div>

                    <!-- SEO Information -->
                    @if($insight->meta_title || $insight->meta_description)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">SEO Information</h6>
                        </div>
                        <div class="card-body">
                            @if($insight->meta_title)
                                <div class="mb-3">
                                    <strong>Meta Title:</strong>
                                    <p class="mb-0">{{ $insight->meta_title }}</p>
                                </div>
                            @endif
                            
                            @if($insight->meta_description)
                                <div class="mb-0">
                                    <strong>Meta Description:</strong>
                                    <p class="mb-0">{{ $insight->meta_description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar with Details -->
                <div class="col-md-4">
                    <!-- Status Card -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Publication Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Status:</strong>
                                @if($insight->status === 'published')
                                    <span class="badge bg-success ms-2">Published</span>
                                @else
                                    <span class="badge bg-warning ms-2">Draft</span>
                                @endif
                            </div>

                            @if($insight->published_at)
                                <div class="mb-3">
                                    <strong>Published:</strong><br>
                                    <small>{{ $insight->published_at->format('F d, Y \a\t g:i A') }}</small>
                                </div>
                            @endif

                            <div class="mb-3">
                                <strong>Created:</strong><br>
                                <small>{{ $insight->created_at->format('F d, Y \a\t g:i A') }}</small>
                            </div>

                            <div class="mb-3">
                                <strong>Last Updated:</strong><br>
                                <small>{{ $insight->updated_at->format('F d, Y \a\t g:i A') }}</small>
                            </div>

                            <div class="mb-0">
                                <strong>Views:</strong>
                                <span class="badge bg-info ms-2">{{ number_format($insight->views_count) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Insight Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Slug:</strong><br>
                                <code>{{ $insight->slug }}</code>
                            </div>

                            @if($insight->category)
                                <div class="mb-3">
                                    <strong>Category:</strong><br>
                                    <span class="badge bg-info">{{ $insight->category->name }}</span>
                                </div>
                            @endif

                            <div class="mb-3">
                                <strong>Author:</strong><br>
                                {{ $insight->user->name }}
                            </div>

                            <div class="mb-3">
                                <strong>Featured:</strong>
                                @if($insight->is_featured)
                                    <i class="bi bi-star-fill text-warning ms-2"></i>
                                    <span class="text-success">Yes</span>
                                @else
                                    <i class="bi bi-star text-muted ms-2"></i>
                                    <span class="text-muted">No</span>
                                @endif
                            </div>

                            <div class="mb-0">
                                <strong>Sort Order:</strong><br>
                                {{ $insight->sort_order }}
                            </div>
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h6 class="mb-0">Actions</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.insights.edit', $insight) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil me-2"></i>Edit Insight
                                </a>
                                
                                @if($insight->status === 'published')
                                    <a href="{{ route('insight.show', $insight->slug) }}" target="_blank" class="btn btn-success">
                                        <i class="bi bi-box-arrow-up-right me-2"></i>View Live
                                    </a>
                                @endif

                                <form method="POST" 
                                      action="{{ route('admin.insights.destroy', $insight) }}" 
                                      onsubmit="return confirm('Are you sure you want to delete this insight? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-trash me-2"></i>Delete Insight
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .insight-content {
        font-size: 1.1rem;
        line-height: 1.7;
    }
    
    .insight-content h1,
    .insight-content h2,
    .insight-content h3,
    .insight-content h4,
    .insight-content h5,
    .insight-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .insight-content p {
        margin-bottom: 1.5rem;
    }
    
    .insight-content ul,
    .insight-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .insight-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    .insight-content blockquote {
        border-left: 4px solid #007bff;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6c757d;
    }
</style>
@endpush