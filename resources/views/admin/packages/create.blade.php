@extends('layouts.admin')

@section('title', 'Add New Package')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Consultation Package</h2>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="consultant_id" class="form-label">Consultant <span class="text-danger">*</span></label>
                            <select class="form-select @error('consultant_id') is-invalid @enderror" 
                                    id="consultant_id" 
                                    name="consultant_id" 
                                    required>
                                <option value="">Select Consultant</option>
                                @foreach($consultants as $consultant)
                                    <option value="{{ $consultant->id }}" {{ old('consultant_id') == $consultant->id ? 'selected' : '' }}>
                                        {{ $consultant->name }} - {{ $consultant->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('consultant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Package Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="e.g., Konsultasi 30 Menit"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" 
                                   name="duration" 
                                   value="{{ old('duration') }}"
                                   placeholder="e.g., 30 menit"
                                   required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (Numeric) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price') }}"
                                   placeholder="e.g., 1500000"
                                   step="0.01"
                                   required>
                            <small class="text-muted">Enter price in number format (e.g., 1500000)</small>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price_display" class="form-label">Price Display <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('price_display') is-invalid @enderror" 
                                   id="price_display" 
                                   name="price_display" 
                                   value="{{ old('price_display') }}"
                                   placeholder="e.g., Rp1.500.000"
                                   required>
                            <small class="text-muted">Display format (e.g., Rp1.500.000)</small>
                            @error('price_display')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="platform" class="form-label">Platform <span class="text-danger">*</span></label>
                            <select class="form-select @error('platform') is-invalid @enderror" 
                                    id="platform" 
                                    name="platform" 
                                    required>
                                <option value="Google Meet" {{ old('platform') == 'Google Meet' ? 'selected' : '' }}>Google Meet</option>
                                <option value="Zoom" {{ old('platform') == 'Zoom' ? 'selected' : '' }}>Zoom</option>
                                <option value="Microsoft Teams" {{ old('platform') == 'Microsoft Teams' ? 'selected' : '' }}>Microsoft Teams</option>
                                <option value="WhatsApp Call" {{ old('platform') == 'WhatsApp Call' ? 'selected' : '' }}>WhatsApp Call</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Enter package description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', 0) }}"
                                   placeholder="0">
                            <small class="text-muted">Lower numbers appear first (default: 0)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1">Only active packages are shown to customers</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_popular" 
                                       name="is_popular"
                                       {{ old('is_popular') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_popular">
                                    Mark as Popular
                                </label>
                            </div>
                            <small class="text-muted d-block mt-1">Shows "Popular" badge on this package</small>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Package
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
