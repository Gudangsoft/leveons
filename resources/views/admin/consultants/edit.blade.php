@extends('layouts.admin')

@section('title', 'Edit Consultant')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Consultant: {{ $consultant->name }}</h2>
                <a href="{{ route('admin.consultants.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.consultants.update', $consultant) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $consultant->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug', $consultant->slug) }}"
                                           placeholder="Leave empty to auto-generate from name">
                                    <small class="text-muted">URL-friendly version of name.</small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title/Position</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $consultant->title) }}"
                                           placeholder="e.g., CEO, Senior Consultant">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="company" class="form-label">Company</label>
                                    <input type="text" 
                                           class="form-control @error('company') is-invalid @enderror" 
                                           id="company" 
                                           name="company" 
                                           value="{{ old('company', $consultant->company) }}"
                                           placeholder="e.g., D'Consulting">
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price_text" class="form-label">Price Text</label>
                                    <input type="text" 
                                           class="form-control @error('price_text') is-invalid @enderror" 
                                           id="price_text" 
                                           name="price_text" 
                                           value="{{ old('price_text', $consultant->price_text) }}"
                                           placeholder="e.g., Start from Rp 1.5 jt">
                                    @error('price_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" 
                                              name="bio" 
                                              rows="6"
                                              placeholder="Write a short biography...">{{ old('bio', $consultant->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="expertise" class="form-label">Expertise</label>
                                    <input type="text" 
                                           class="form-control @error('expertise') is-invalid @enderror" 
                                           id="expertise" 
                                           name="expertise" 
                                           value="{{ old('expertise', $consultant->expertise) }}"
                                           placeholder="e.g., Tax Planning, Business Advisory, etc (comma separated)">
                                    <small class="text-muted">Separate multiple expertise with commas</small>
                                    @error('expertise')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="booking_url" class="form-label">Booking URL</label>
                                    <input type="url" 
                                           class="form-control @error('booking_url') is-invalid @enderror" 
                                           id="booking_url" 
                                           name="booking_url" 
                                           value="{{ old('booking_url', $consultant->booking_url) }}"
                                           placeholder="https://example.com/booking">
                                    <small class="text-muted">External booking system URL (optional)</small>
                                    @error('booking_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="consultation_packages" class="form-label">Consultation Packages (JSON)</label>
                                    <textarea class="form-control @error('consultation_packages') is-invalid @enderror" 
                                              id="consultation_packages" 
                                              name="consultation_packages" 
                                              rows="10"
                                              placeholder='[{"name":"Konsultasi 30 Menit","duration":"30 menit","price":1500000,"price_display":"Rp1.500.000","description":"Sesi konsultasi 30 menit","platform":"Google Meet"}]'>{{ old('consultation_packages', is_array($consultant->consultation_packages) ? json_encode($consultant->consultation_packages, JSON_PRETTY_PRINT) : $consultant->consultation_packages) }}</textarea>
                                    <small class="text-muted">Enter packages in JSON format</small>
                                    @error('consultation_packages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar Image</label>
                                    
                                    @if($consultant->avatar)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                                                 alt="{{ $consultant->name }}" 
                                                 class="img-fluid rounded"
                                                 style="max-height: 200px;">
                                            <p class="text-muted small mt-1">Current avatar</p>
                                        </div>
                                    @endif
                                    
                                    <input type="file" 
                                           class="form-control @error('avatar') is-invalid @enderror" 
                                           id="avatar" 
                                           name="avatar"
                                           accept="image/*"
                                           onchange="previewImage(event)">
                                    <small class="text-muted">Max 2MB. JPG, PNG, WEBP. Leave empty to keep current.</small>
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_published" 
                                               name="is_published"
                                               {{ old('is_published', $consultant->is_published) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">
                                            Published
                                        </label>
                                    </div>
                                    <small class="text-muted">Uncheck to save as draft</small>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Consultant
                            </button>
                            <a href="{{ route('admin.consultants.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const slugField = document.getElementById('slug');
    if (!slugField.value || slugField.dataset.manual !== 'true') {
        slugField.value = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }
});

document.getElementById('slug').addEventListener('input', function() {
    this.dataset.manual = 'true';
});
</script>
@endpush
@endsection
