@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Company Settings</h2>
            </div>

            <form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name', $company->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tagline" class="form-label">Tagline</label>
                                            <input type="text" class="form-control @error('tagline') is-invalid @enderror" 
                                                   id="tagline" name="tagline" value="{{ old('tagline', $company->tagline) }}">
                                            @error('tagline')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description', $company->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Contact Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" name="phone" value="{{ old('phone', $company->phone) }}"
                                                   placeholder="+62 21 1234567">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="whatsapp" class="form-label"><i class="fab fa-whatsapp text-success"></i> WhatsApp</label>
                                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                                   id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $company->whatsapp) }}"
                                                   placeholder="+62 812 3456 7890 or 6281234567890">
                                            @error('whatsapp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Format: +62xxx atau 62xxx (tanpa spasi untuk link WA)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email', $company->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="3">{{ old('address', $company->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                           id="website" name="website" value="{{ old('website', $company->website) }}" placeholder="https://example.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Social Media</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook" class="form-label"><i class="fab fa-facebook text-primary"></i> Facebook</label>
                                            <input type="url" class="form-control" 
                                                   id="facebook" name="social_media[facebook]" 
                                                   value="{{ old('social_media.facebook', $company->social_media['facebook'] ?? '') }}" 
                                                   placeholder="https://facebook.com/yourpage">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="threads" class="form-label"><i class="fab fa-threads"></i> Threads</label>
                                            <input type="url" class="form-control" 
                                                   id="threads" name="social_media[threads]" 
                                                   value="{{ old('social_media.threads', $company->social_media['threads'] ?? '') }}" 
                                                   placeholder="https://threads.net/@yourhandle">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instagram" class="form-label"><i class="fab fa-instagram text-danger"></i> Instagram</label>
                                            <input type="url" class="form-control" 
                                                   id="instagram" name="social_media[instagram]" 
                                                   value="{{ old('social_media.instagram', $company->social_media['instagram'] ?? '') }}" 
                                                   placeholder="https://instagram.com/yourhandle">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="linkedin" class="form-label"><i class="fab fa-linkedin text-primary"></i> LinkedIn</label>
                                            <input type="url" class="form-control" 
                                                   id="linkedin" name="social_media[linkedin]" 
                                                   value="{{ old('social_media.linkedin', $company->social_media['linkedin'] ?? '') }}" 
                                                   placeholder="https://linkedin.com/company/yourcompany">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="youtube" class="form-label"><i class="fab fa-youtube text-danger"></i> YouTube</label>
                                    <input type="url" class="form-control" 
                                           id="youtube" name="social_media[youtube]" 
                                           value="{{ old('social_media.youtube', $company->social_media['youtube'] ?? '') }}" 
                                           placeholder="https://youtube.com/@yourchannel">
                                </div>
                            </div>
                        </div>

                        <!-- SEO Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">SEO Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" name="meta_title" value="{{ old('meta_title', $company->meta_title) }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $company->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="google_analytics" class="form-label">Google Analytics ID</label>
                                    <input type="text" class="form-control @error('google_analytics') is-invalid @enderror" 
                                           id="google_analytics" name="google_analytics" value="{{ old('google_analytics', $company->google_analytics) }}" 
                                           placeholder="GA-XXXXXXXXX-X">
                                    @error('google_analytics')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Footer Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="footer_text" class="form-label">Footer Text</label>
                                    <textarea class="form-control @error('footer_text') is-invalid @enderror" 
                                              id="footer_text" name="footer_text" rows="3">{{ old('footer_text', $company->footer_text) }}</textarea>
                                    @error('footer_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Logo & Favicon -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Branding</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Company Logo</label>
                                    @if($company->logo)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($company->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    @else
                                        <div class="mb-2">
                                            <div class="bg-light border rounded p-3 text-center">
                                                <i class="bi bi-image" style="font-size: 2rem; color: #ccc;"></i>
                                                <div class="text-muted">No logo uploaded</div>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                           id="logo" name="logo" accept="image/*">
                                    <div class="form-text">Upload JPG, PNG, or GIF. Max size: 2MB</div>
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    @if($company->favicon)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($company->favicon) }}" alt="Current Favicon" class="img-thumbnail" style="max-height: 32px;">
                                        </div>
                                    @else
                                        <div class="mb-2">
                                            <div class="bg-light border rounded p-2 text-center" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-globe2" style="font-size: 1rem; color: #ccc;"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('favicon') is-invalid @enderror" 
                                           id="favicon" name="favicon" accept=".ico,.png">
                                    <div class="form-text">Upload ICO or PNG. Max size: 1MB</div>
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Business Hours -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Business Hours</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $days = [
                                        'monday' => 'Monday',
                                        'tuesday' => 'Tuesday',
                                        'wednesday' => 'Wednesday',
                                        'thursday' => 'Thursday',
                                        'friday' => 'Friday',
                                        'saturday' => 'Saturday',
                                        'sunday' => 'Sunday'
                                    ];
                                @endphp

                                @foreach($days as $day => $label)
                                    <div class="mb-2">
                                        <label class="form-label">{{ $label }}</label>
                                        <input type="text" class="form-control form-control-sm" 
                                               name="business_hours[{{ $day }}]" 
                                               value="{{ old('business_hours.'.$day, $company->business_hours[$day] ?? '09:00 - 17:00') }}" 
                                               placeholder="09:00 - 17:00 or Closed">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check-lg me-2"></i>Update Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection