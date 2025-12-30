@extends('layouts.frontend')

@section('title', 'Form Konsultasi - ' . $company->name)

@section('content')
<div class="consultation-page" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Left Column - Form -->
            <div class="col-lg-7">
                <div class="consultation-form-wrapper">
                    <!-- Header with icon -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#2176C1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h1 class="h2 fw-bold mb-0">Mulai Konsultasi</h1>
                        </div>
                        <p class="text-muted mb-0">Isi formulir di bawah ini dan tim kami akan menghubungi Anda dalam 1×24 jam</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('consultation.store') }}" method="POST" class="consultation-form needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Nama Lengkap -->
                            <div class="col-md-6">
                                <label for="full_name" class="form-label">
                                    <i class="fas fa-user text-primary me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('full_name') is-invalid @enderror" 
                                       id="full_name" 
                                       name="full_name" 
                                       placeholder="Masukkan nama lengkap Anda"
                                       value="{{ old('full_name') }}"
                                       required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope text-primary me-2"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       placeholder="nama@email.com"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone text-primary me-2"></i>Nomor Telepon
                                </label>
                                <input type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       placeholder="{{ $company && $company->whatsapp ? preg_replace('/^(\+?62|0)(\d{3})(\d{4})(\d+)$/', '+62 $2 $3 $4', $company->whatsapp) : '+62 812 3456 7890' }}"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Perusahaan/Organisasi -->
                            <div class="col-md-6">
                                <label for="company_name" class="form-label">
                                    <i class="fas fa-building text-primary me-2"></i>Perusahaan/Organisasi
                                </label>
                                <input type="text" 
                                       class="form-control @error('company_name') is-invalid @enderror" 
                                       id="company_name" 
                                       name="company_name" 
                                       placeholder="Nama perusahaan Anda"
                                       value="{{ old('company_name') }}">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Posisi/Jabatan -->
                            <div class="col-md-6">
                                <label for="position" class="form-label">
                                    <i class="fas fa-user-tie text-primary me-2"></i>Posisi/Jabatan
                                </label>
                                <input type="text" 
                                       class="form-control @error('position') is-invalid @enderror" 
                                       id="position" 
                                       name="position" 
                                       placeholder="CEO, Manager, etc."
                                       value="{{ old('position') }}">
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis Layanan -->
                            <div class="col-md-6">
                                <label for="service_needs" class="form-label">
                                    <i class="fas fa-tasks text-primary me-2"></i>Jenis Layanan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('service_needs') is-invalid @enderror" 
                                        id="service_needs" 
                                        name="service_needs" 
                                        required>
                                    <option value="">Pilih jenis layanan...</option>
                                    <option value=" Consulting" {{ old('service_needs') == ' Consulting' ? 'selected' : '' }}> Consulting</option>
                                    <option value="research" {{ old('service_needs') == 'research' ? 'selected' : '' }}>Research</option>
                                    <option value="Academy" {{ old('service_needs') == 'Academy' ? 'selected' : '' }}>Academy</option>
                                    
                                </select>
                                @error('service_needs')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pesan/Deskripsi Kebutuhan -->
                            <div class="col-12">
                                <label for="scope_details" class="form-label">
                                    <i class="fas fa-comment-dots text-primary me-2"></i>Pesan/Deskripsi Kebutuhan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('scope_details') is-invalid @enderror" 
                                          id="scope_details" 
                                          name="scope_details" 
                                          rows="4" 
                                          placeholder="Ceritakan lebih detail tentang kebutuhan konsultasi Anda, tantangan yang dihadapi, atau tujuan yang ingin dicapai..."
                                          required>{{ old('scope_details') }}</textarea>
                                @error('scope_details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Privacy Info -->
                        <div class="mt-3">
                            <p class="small text-muted mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                Semakin detail informasi yang Anda berikan, semakin tepat solusi yang bisa kami tawarkan.
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Konsultasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column - Contact Info -->
            <div class="col-lg-5">
                <div class="consultation-sidebar">
                    <!-- Butuh Bantuan Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-headset text-primary fs-3 me-3"></i>
                                <h3 class="h5 mb-0 fw-bold">Butuh Bantuan?</h3>
                            </div>
                            
                            <!-- Email -->
                            <div class="contact-item mb-3">
                                <p class="mb-1 fw-semibold"><i class="fas fa-envelope text-muted me-2"></i>Email:</p>
                                <a href="mailto:{{ $company->email ?? 'info@leveons.id' }}" class="text-primary text-decoration-none">
                                    {{ $company->email ?? 'info@leveons.id' }}
                                </a>
                            </div>

                            <!-- WhatsApp -->
                            @if($company && $company->whatsapp)
                                @php
                                    // Format nomor WhatsApp untuk display dan link
                                    $whatsappNumber = $company->whatsapp;
                                    // Remove non-numeric characters for link
                                    $whatsappLink = preg_replace('/[^0-9]/', '', $whatsappNumber);
                                    // Ensure it starts with 62
                                    if (substr($whatsappLink, 0, 1) === '0') {
                                        $whatsappLink = '62' . substr($whatsappLink, 1);
                                    } elseif (substr($whatsappLink, 0, 2) !== '62') {
                                        $whatsappLink = '62' . $whatsappLink;
                                    }
                                    
                                    // Format for display (add spaces)
                                    $whatsappDisplay = $whatsappNumber;
                                    if (preg_match('/^(\+?62|0)(\d{3})(\d{4})(\d+)$/', $whatsappNumber, $matches)) {
                                        $whatsappDisplay = '+62 ' . $matches[2] . ' ' . $matches[3] . ' ' . $matches[4];
                                    }
                                @endphp
                                <div class="contact-item mb-3">
                                    <p class="mb-1 fw-semibold"><i class="fab fa-whatsapp text-muted me-2"></i>WhatsApp:</p>
                                    <a href="https://wa.me/{{ $whatsappLink }}" class="text-primary text-decoration-none" target="_blank">
                                        {{ $whatsappDisplay }}
                                    </a>
                                </div>
                            @else
                                <div class="contact-item mb-3">
                                    <p class="mb-1 fw-semibold"><i class="fab fa-whatsapp text-muted me-2"></i>WhatsApp:</p>
                                    <a href="https://wa.me/6281234567890" class="text-primary text-decoration-none" target="_blank">+62 812 3456 7890</a>
                                </div>
                            @endif

                            <!-- Waktu Respons -->
                            <div class="contact-item">
                                <p class="mb-1 fw-semibold"><i class="far fa-clock text-muted me-2"></i>Waktu Respons:</p>
                                <p class="mb-0 text-muted">1×24 jam (hari kerja)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Proses Konsultasi Card -->
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-lightbulb fs-3 me-3"></i>
                                <h3 class="h5 mb-0 fw-bold">Proses Konsultasi</h3>
                            </div>

                            <div class="process-steps">
                                <!-- Step 1 -->
                                <div class="process-step d-flex mb-3">
                                    <div class="step-number me-3">
                                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px;">1</div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Isi Formulir</h6>
                                        <p class="small mb-0 opacity-75">Lengkapi informasi kebutuhan Anda</p>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="process-step d-flex mb-3">
                                    <div class="step-number me-3">
                                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px;">2</div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Tim Kami Merespons</h6>
                                        <p class="small mb-0 opacity-75">Maksimal 1×24 jam hari kerja</p>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="process-step d-flex mb-3">
                                    <div class="step-number me-3">
                                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px;">3</div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Diskusi & Analisis</h6>
                                        <p class="small mb-0 opacity-75">Memahami kebutuhan secara mendalam</p>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="process-step d-flex">
                                    <div class="step-number me-3">
                                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px;">4</div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Proposal Solusi</h6>
                                        <p class="small mb-0 opacity-75">Rekomendasi strategi terbaik</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .consultation-page {
        min-height: 100vh;
        padding: 60px 0;
    }

    .consultation-form-wrapper {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        border-top: 4px solid #2176C1;
    }

    .consultation-form .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #2c3e50;
        font-size: 14px;
    }

    .consultation-form .form-control,
    .consultation-form .form-select {
        border: 1.5px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .consultation-form .form-control:focus,
    .consultation-form .form-select:focus {
        border-color: #2176C1;
        box-shadow: 0 0 0 3px rgba(33, 118, 193, 0.1);
        outline: none;
    }

    .consultation-form .form-control::placeholder {
        color: #adb5bd;
    }

    .consultation-form textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .consultation-sidebar .card {
        border-radius: 16px;
        transition: transform 0.3s ease;
    }

    .consultation-sidebar .card:hover {
        transform: translateY(-5px);
    }

    .contact-item {
        padding: 12px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .contact-item:last-child {
        margin-bottom: 0 !important;
    }

    .contact-item a {
        font-size: 15px;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .contact-item a:hover {
        color: #1557a0 !important;
        text-decoration: underline !important;
    }

    .process-steps {
        margin-top: 24px;
    }

    .process-step {
        position: relative;
        padding-bottom: 16px;
    }

    .process-step:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 32px;
        width: 2px;
        height: calc(100% - 16px);
        background: rgba(255, 255, 255, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #2176C1 0%, #1557a0 100%);
        border: none;
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(33, 118, 193, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(33, 118, 193, 0.4);
        background: linear-gradient(135deg, #1557a0 0%, #2176C1 100%);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .card.bg-primary {
        background: linear-gradient(135deg, #2176C1 0%, #1557a0 100%) !important;
    }

    @media (max-width: 991px) {
        .consultation-form-wrapper {
            padding: 30px 20px;
        }
        
        .consultation-sidebar {
            margin-top: 30px;
        }
    }

    @media (max-width: 576px) {
        .consultation-page {
            padding: 30px 0;
        }

        .consultation-form-wrapper {
            padding: 24px 16px;
            border-radius: 12px;
        }

        .consultation-form .form-control,
        .consultation-form .form-select {
            font-size: 14px;
        }
    }

    /* Animation for form inputs */
    .consultation-form .form-control:focus,
    .consultation-form .form-select:focus {
        animation: pulse 0.3s ease;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.01); }
        100% { transform: scale(1); }
    }

    /* Invalid feedback styling */
    .invalid-feedback {
        font-size: 13px;
        margin-top: 6px;
    }

    /* Success alert styling */
    .alert-success {
        border-radius: 10px;
        border: none;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    
    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 12) {
            value = value.substring(0, 12);
        }
        e.target.value = value;
    });
</script>
@endpush
@endsection