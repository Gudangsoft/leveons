@extends('layouts.admin')

@section('title', 'Create CTA Section')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New CTA Section</h1>
        <a href="{{ route('admin.cta-sections.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">CTA Section Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cta-sections.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="page" class="form-label">Page <span class="text-danger">*</span></label>
                            <select class="form-select @error('page') is-invalid @enderror" 
                                    id="page" 
                                    name="page" 
                                    required>
                                <option value="">Select Page</option>
                                <option value="home" {{ old('page') == 'home' ? 'selected' : '' }}>Home</option>
                                <option value="consultation" {{ old('page') == 'consultation' ? 'selected' : '' }}>Consultation (Konsultasi Online)</option>
                            </select>
                            @error('page')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Select which page this CTA will appear on</small>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="e.g., Siap Memulai Transformasi Bisnis Anda?"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Enter call-to-action description"
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="button_text" class="form-label">Consultation Button Text</label>
                                <input type="text" 
                                       class="form-control @error('button_text') is-invalid @enderror" 
                                       id="button_text" 
                                       name="button_text" 
                                       value="{{ old('button_text', 'Mulai Konsultasi') }}" 
                                       placeholder="e.g., Mulai Konsultasi">
                                @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Text for consultation button</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="button_link" class="form-label">Consultation Button Link</label>
                                <input type="text" 
                                       class="form-control @error('button_link') is-invalid @enderror" 
                                       id="button_link" 
                                       name="button_link" 
                                       value="{{ old('button_link', '/menu/request-consultation') }}" 
                                       placeholder="/menu/request-consultation">
                                @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">URL for consultation form</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="show_consultation_button" 
                                           name="show_consultation_button" 
                                           value="1" 
                                           {{ old('show_consultation_button', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_consultation_button">
                                        Show "Mulai Konsultasi" Button
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="show_whatsapp_button" 
                                           name="show_whatsapp_button" 
                                           value="1" 
                                           {{ old('show_whatsapp_button', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_whatsapp_button">
                                        Show "WhatsApp" Button
                                    </label>
                                </div>
                            </div>
                        </div>
                                       required>
                                @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="button_link" class="form-label">Button Link <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('button_link') is-invalid @enderror" 
                                       id="button_link" 
                                       name="button_link" 
                                       value="{{ old('button_link') }}" 
                                       placeholder="/menu/about-us or /menu/konsultasi-online"
                                       required>
                                @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Use relative path (e.g., /menu/konsultasi-online) or full URL</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="background_color" class="form-label">Background Color</label>
                                <div class="input-group">
                                    <input type="color" 
                                           class="form-control form-control-color @error('background_color') is-invalid @enderror" 
                                           id="background_color" 
                                           name="background_color" 
                                           value="{{ old('background_color', '#1e5a96') }}">
                                    <input type="text" 
                                           class="form-control" 
                                           id="background_color_text" 
                                           value="{{ old('background_color', '#1e5a96') }}" 
                                           readonly>
                                </div>
                                @error('background_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="order" class="form-label">Order</label>
                                <input type="number" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       id="order" 
                                       name="order" 
                                       value="{{ old('order', 0) }}" 
                                       min="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Lower number = higher priority</small>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (Show on website)
                            </label>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.cta-sections.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Create CTA Section
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preview</h6>
                </div>
                <div class="card-body">
                    <div id="preview" style="padding: 40px; text-align: center; color: white; background: linear-gradient(135deg, #1e5a96 0%, #2980b9 100%);">
                        <h2 id="preview-title" style="font-size: 2rem; font-weight: 700; margin-bottom: 15px;">
                            Ready to Transform Your Business?
                        </h2>
                        <p id="preview-description" style="font-size: 1.1rem; margin-bottom: 25px;">
                            Get in touch with our experts at Leveons to discuss how we can help accelerate your growth and achieve sustainable success.
                        </p>
                        <button id="preview-button" class="btn" style="background: #dc3545; color: white; padding: 12px 35px; font-size: 1rem; font-weight: 600; border-radius: 50px;">
                            Contact Us Today
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const buttonTextInput = document.getElementById('button_text');
    const backgroundColorInput = document.getElementById('background_color');
    const backgroundColorText = document.getElementById('background_color_text');
    
    const previewTitle = document.getElementById('preview-title');
    const previewDescription = document.getElementById('preview-description');
    const previewButton = document.getElementById('preview-button');
    const previewDiv = document.getElementById('preview');
    
    titleInput.addEventListener('input', function() {
        previewTitle.textContent = this.value || 'Ready to Transform Your Business?';
    });
    
    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value || 'Get in touch with our experts...';
    });
    
    buttonTextInput.addEventListener('input', function() {
        previewButton.textContent = this.value || 'Contact Us Today';
    });
    
    backgroundColorInput.addEventListener('input', function() {
        backgroundColorText.value = this.value;
        previewDiv.style.background = `linear-gradient(135deg, ${this.value} 0%, ${adjustBrightness(this.value, 20)} 100%)`;
    });
    
    function adjustBrightness(hex, percent) {
        // Simple brightness adjustment
        const num = parseInt(hex.replace('#', ''), 16);
        const amt = Math.round(2.55 * percent);
        const R = (num >> 16) + amt;
        const G = (num >> 8 & 0x00FF) + amt;
        const B = (num & 0x0000FF) + amt;
        return '#' + (0x1000000 + (R<255?R<1?0:R:255)*0x10000 +
            (G<255?G<1?0:G:255)*0x100 +
            (B<255?B<1?0:B:255))
            .toString(16).slice(1);
    }
});
</script>
@endpush
@endsection
