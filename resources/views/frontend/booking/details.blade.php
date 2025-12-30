@extends('layouts.frontend')

@section('title', 'Booking Details - ' . $company->name)

@push('styles')
<style>
    .booking-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px;
        min-height: 100vh;
        background: #f5f5f5;
    }

    .booking-wrapper {
        display: grid;
        grid-template-columns: 400px 1fr;
        gap: 40px;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    }

    .booking-summary {
        background: white;
        padding: 40px 30px;
        border-right: 1px solid #e9ecef;
    }

    .back-button {
        background: transparent;
        border: none;
        color: #666;
        cursor: pointer;
        padding: 8px;
        margin-bottom: 30px;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        color: var(--primary-color);
        transform: translateX(-3px);
    }

    .consultant-info {
        text-align: center;
        margin-bottom: 30px;
    }

    .consultant-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid #f0f0f0;
    }

    .consultant-name {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
    }

    .package-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: #1a1a1a;
    }

    .summary-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        color: #666;
    }

    .summary-item i {
        font-size: 1.1rem;
        color: #999;
        margin-top: 2px;
        width: 20px;
    }

    .summary-item-text {
        flex: 1;
        line-height: 1.6;
    }

    .summary-item strong {
        display: block;
        color: #333;
        margin-bottom: 2px;
    }

    .form-wrapper {
        padding: 40px 50px;
    }

    .form-header {
        margin-bottom: 35px;
    }

    .form-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .form-header p {
        color: #666;
        margin: 0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 0.95rem;
    }

    .form-group label .required {
        color: #dc3545;
        margin-left: 3px;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 140px;
        font-family: inherit;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.05rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #3b82f6;
        color: white;
        margin-top: 30px;
    }

    .btn-submit:hover:not(:disabled) {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .btn-submit:disabled {
        background: #9ca3af;
        cursor: not-allowed;
    }

    @media (max-width: 968px) {
        .booking-wrapper {
            grid-template-columns: 1fr;
        }

        .booking-summary {
            border-right: none;
            border-bottom: 1px solid #e9ecef;
        }

        .form-wrapper {
            padding: 30px 25px;
        }
    }

    @media (max-width: 768px) {
        .booking-container {
            padding: 20px 15px;
        }

        .consultant-avatar {
            width: 80px;
            height: 80px;
        }

        .package-title {
            font-size: 1.2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="booking-container">
    <div class="booking-wrapper">
        <!-- Left Column: Booking Summary -->
        <div class="booking-summary">
            <button class="back-button" onclick="history.back()">
                <i class="bi bi-arrow-left"></i>
            </button>

            <div class="consultant-info">
                @if($consultant->avatar)
                    <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                         alt="{{ $consultant->name }}" 
                         class="consultant-avatar">
                @else
                    <div class="consultant-avatar bg-light d-flex align-items-center justify-content-center">
                        <i class="bi bi-person" style="font-size: 2rem;"></i>
                    </div>
                @endif
                <div class="consultant-name">{{ $consultant->name }}</div>
            </div>

            @php
                // Handle both database objects and JSON arrays
                $packageName = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->name : $selectedPackage['name'];
                $packageDuration = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->duration : $selectedPackage['duration'];
                $packagePlatform = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->platform : $selectedPackage['platform'];
                $packagePriceDisplay = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->price_display : $selectedPackage['price_display'];
            @endphp

            <h2 class="package-title">{{ $packageName }}</h2>

            <div class="summary-item">
                <i class="bi bi-clock"></i>
                <div class="summary-item-text">
                    <strong>{{ $packageDuration }}</strong>
                </div>
            </div>

            <div class="summary-item">
                <i class="bi bi-camera-video"></i>
                <div class="summary-item-text">
                    <strong>{{ $packagePlatform }}</strong>
                </div>
            </div>

            <div class="summary-item">
                <i class="bi bi-cash-coin"></i>
                <div class="summary-item-text">
                    <strong>{{ $packagePriceDisplay }}</strong>
                </div>
            </div>

            <div class="summary-item">
                <i class="bi bi-calendar-check"></i>
                <div class="summary-item-text">
                    @php
                        $startTime = \Carbon\Carbon::parse($bookingDate . ' ' . $bookingTime);
                        $duration = (int) $packageDuration; // e.g., "30 menit" -> 30
                        $endTime = $startTime->copy()->addMinutes($duration);
                    @endphp
                    <strong>{{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}, {{ $startTime->format('d/m/Y') }}</strong>
                </div>
            </div>

            <div class="summary-item">
                <i class="bi bi-globe"></i>
                <div class="summary-item-text">
                    <strong>Asia/Jakarta</strong>
                </div>
            </div>
        </div>

        <!-- Right Column: Form -->
        <div class="form-wrapper">
            <div class="form-header">
                <button class="back-button" onclick="history.back()" style="margin-bottom: 20px;">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <h2>Enter Details</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="background: #fee; color: #c33; padding: 15px; border-radius: 8px; margin-bottom: 25px; border-left: 4px solid #c33;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.invoice', $consultant->slug) }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="booking_date" value="{{ $bookingDate }}">
                <input type="hidden" name="booking_time" value="{{ $bookingTime }}">
                <input type="hidden" name="package" value="{{ request()->get('package', 0) }}">

                <div class="form-group">
                    <label for="full_name">
                        Your Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control @error('full_name') is-invalid @enderror" 
                           id="full_name" 
                           name="full_name" 
                           value="{{ old('full_name') }}"
                           placeholder="Your Name"
                           required>
                    @error('full_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        Your Email <span class="required">*</span>
                    </label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           placeholder="Your Email"
                           required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">
                        Phone Number <span class="required">*</span>
                    </label>
                    <input type="tel" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}"
                           placeholder="08xxxxxxxxxx"
                           required>
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="notes">
                        What is this meeting about?
                    </label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" 
                              name="notes" 
                              placeholder="Please share anything that will help prepare for our meeting.">{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    Schedule Meeting
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('bookingForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
});
</script>
@endpush
@endsection
