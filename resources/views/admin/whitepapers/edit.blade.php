@extends('layouts.admin')

@section('title', 'Edit Whitepaper')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Whitepaper</h1>
    <div>
        <a href="{{ route('admin.whitepapers.show', $whitepaper) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
            <i class="fas fa-eye fa-sm text-white-50"></i> View
        </a>
        <a href="{{ route('admin.whitepapers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Whitepaper Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.whitepapers.update', $whitepaper) }}" method="POST" enctype="multipart/form-data" id="whitepaper-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $whitepaper->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug', $whitepaper->slug) }}">
                        <small class="form-text text-muted">Leave empty to auto-generate from title</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description', $whitepaper->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Cover Image</label>
                                @if($whitepaper->image_url)
                                <div class="mb-2">
                                    <img src="{{ $whitepaper->image_url }}" alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                                    <br><small class="text-muted">Current image</small>
                                </div>
                                @endif
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <small class="form-text text-muted">Max size: 2MB. Formats: JPEG, PNG, WebP. Leave empty to keep current image.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Whitepaper File</label>
                                @if($whitepaper->file_name)
                                <div class="mb-2">
                                    <div class="badge badge-info">{{ $whitepaper->file_name }}</div>
                                    @if($whitepaper->formatted_file_size)
                                    <div class="badge badge-secondary">{{ $whitepaper->formatted_file_size }}</div>
                                    @endif
                                    <br><small class="text-muted">Current file</small>
                                </div>
                                @endif
                                <input type="file" class="form-control-file @error('file') is-invalid @enderror" 
                                       id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx">
                                <small class="form-text text-muted">Max size: 10MB. Formats: PDF, DOC, DOCX, PPT, PPTX. Leave empty to keep current file.</small>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $whitepaper->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Whitepaper
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $whitepaper->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Whitepaper
                        </button>
                        <a href="{{ route('admin.whitepapers.show', $whitepaper) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.whitepapers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                           id="meta_title" name="meta_title" value="{{ old('meta_title', $whitepaper->meta_title) }}" form="whitepaper-form">
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                              id="meta_description" name="meta_description" rows="3" form="whitepaper-form">{{ old('meta_description', $whitepaper->meta_description) }}</textarea>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                           id="meta_keywords" name="meta_keywords" 
                           value="{{ old('meta_keywords', is_array($whitepaper->meta_keywords) ? implode(', ', $whitepaper->meta_keywords) : '') }}" form="whitepaper-form">
                    <small class="form-text text-muted">Separate keywords with commas</small>
                    @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="mb-3">
                        <h4 class="text-primary">{{ $whitepaper->download_count }}</h4>
                        <small class="text-muted">Total Downloads</small>
                    </div>
                    <div class="mb-3">
                        <strong>Created:</strong><br>
                        <small>{{ $whitepaper->created_at->format('d M Y, H:i') }}</small>
                    </div>
                    <div>
                        <strong>Last Updated:</strong><br>
                        <small>{{ $whitepaper->updated_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title if slug is empty
    $('#title').on('input', function() {
        let currentSlug = $('#slug').val();
        let originalSlug = '{{ $whitepaper->slug }}';
        
        // Only auto-generate if slug is empty or is the same as original
        if (!currentSlug || currentSlug === originalSlug) {
            let title = $(this).val();
            let slug = title.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            $('#slug').val(slug);
        }
    });
</script>
@endpush