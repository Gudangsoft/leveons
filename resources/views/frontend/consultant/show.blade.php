@extends('layouts.frontend')

@section('title', $consultant->name . ' - ' . $company->name)
@section('meta_description', $consultant->bio ? Str::limit($consultant->bio, 160) : $consultant->name . ' - ' . $consultant->title)

@push('styles')
<style>
    .consultant-hero {
        background: #f8f9fa;
        padding: 80px 0 60px;
        position: relative;
    }

    .consultant-avatar {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 6px solid white;
        object-fit: cover;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        background: white;
    }

    .consultant-card {
        background: white;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-top: 0;
        position: relative;
        z-index: 2;
    }

    .expertise-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 20px 0;
    }

    .expertise-tag {
        background: #e9ecef;
        color: #495057;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .consultation-package {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        position: relative;
    }

    .consultation-package:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 20px rgba(33, 118, 193, 0.1);
    }

    .consultation-package.featured {
        border-color: var(--primary-color);
        background: #f0f7ff;
    }

    .package-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary-color);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .package-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .package-name i {
        color: var(--primary-color);
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .package-description {
        color: #666;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .package-details {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .package-detail-item {
        display: flex;
        align-items: center;
        color: #555;
        font-size: 0.9rem;
    }

    .package-detail-item i {
        margin-right: 8px;
        color: var(--primary-color);
    }

    .package-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .btn-book {
        background: white;
        color: #333;
        border: 2px solid #333;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-book:hover {
        background: #333;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .bio-section {
        line-height: 1.8;
        font-size: 1.05rem;
        color: #555;
        text-align: justify;
    }

    @media (max-width: 768px) {
        .consultant-avatar {
            width: 150px;
            height: 150px;
        }

        .consultant-card {
            padding: 30px 20px;
            margin-top: -50px;
        }

        .consultant-hero {
            padding: 60px 0 40px;
        }
    }
</style>
@endpush

@section('content')
<!-- Consultant Hero Section -->
<section class="consultant-hero">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                @if($consultant->avatar)
                    <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                         alt="{{ $consultant->name }}" 
                         class="consultant-avatar mx-auto d-block mb-4">
                @else
                    <div class="consultant-avatar mx-auto d-block mb-4 bg-white d-flex align-items-center justify-content-center">
                        <i class="bi bi-person" style="font-size: 5rem; color: #ccc;"></i>
                    </div>
                @endif
                
                <h1 class="mb-3" style="color: #333; font-size: 2.5rem; font-weight: 700;">
                    {{ $consultant->name }}
                </h1>

                @if($consultant->expertise)
                    <div class="expertise-tags justify-content-center">
                        @foreach(explode(', ', $consultant->expertise) as $skill)
                            <span class="expertise-tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Consultant Details -->
<section style="padding: 40px 0 80px; background: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Consultation Packages -->
                @php
                    // Use database packages if available, otherwise fallback to JSON packages
                    $packagesFromDB = $consultant->packages->count() > 0;
                    $displayPackages = $packagesFromDB ? $consultant->packages : ($consultant->consultation_packages ?? []);
                @endphp
                
                @if(count($displayPackages) > 0)
                    <div class="mb-5">
                        <h2 class="mb-4" style="color: #333; font-weight: 700; text-align: center;">
                            Pilih Paket Konsultasi
                        </h2>
                        @foreach($displayPackages as $index => $package)
                            @php
                                // Handle both database objects and JSON arrays
                                $packageName = $packagesFromDB ? $package->name : $package['name'];
                                $packageDescription = $packagesFromDB ? $package->description : $package['description'];
                                $packageDuration = $packagesFromDB ? $package->duration : $package['duration'];
                                $packagePlatform = $packagesFromDB ? $package->platform : $package['platform'];
                                $packagePriceDisplay = $packagesFromDB ? $package->price_display : $package['price_display'];
                                $isPopular = $packagesFromDB ? $package->is_popular : ($index === 0);
                            @endphp
                            
                            <div class="consultation-package {{ $isPopular ? 'featured' : '' }}">
                                @if($isPopular)
                                    <span class="package-badge">Popular</span>
                                @endif
                                
                                <h3 class="package-name">
                                    <i class="bi bi-circle-fill"></i>
                                    {{ $packageName }}
                                </h3>
                                
                                <p class="package-description">
                                    {{ $packageDescription }}
                                </p>
                                
                                <div class="package-details">
                                    <div class="package-detail-item">
                                        <i class="bi bi-clock"></i>
                                        <span>{{ $packageDuration }}</span>
                                    </div>
                                    <div class="package-detail-item">
                                        <i class="bi bi-camera-video"></i>
                                        <span>{{ $packagePlatform }}</span>
                                    </div>
                                    <div class="package-detail-item">
                                        <i class="bi bi-cash-coin"></i>
                                        <span>{{ $packagePriceDisplay }}</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="package-price">
                                        {{ $packagePriceDisplay }}
                                    </div>
                                    <a href="{{ route('booking.calendar', ['slug' => $consultant->slug, 'event' => $index === 0 ? '30min' : '60min', 'package' => $index]) }}" 
                                       class="btn-book">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Bio Section -->
                <div class="consultant-card">
                    <div class="text-center mb-5">
                        @if($consultant->title)
                            <h4 class="mb-3" style="color: #666; font-weight: 400;">
                                {{ $consultant->title }}
                            </h4>
                        @endif

                        @if($consultant->company)
                            <p class="mb-4" style="color: #888; font-size: 1.1rem;">
                                <i class="bi bi-building me-2"></i>{{ $consultant->company }}
                            </p>
                        @endif
                    </div>

                    @if($consultant->bio)
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <h3 class="mb-4" style="color: var(--primary-color); font-weight: 600;">
                                    <i class="bi bi-person-badge me-2"></i>Tentang Saya
                                </h3>
                                <div class="bio-section">
                                    {!! nl2br(e($consultant->bio)) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
