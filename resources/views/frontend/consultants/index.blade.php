@extends('layouts.frontend')

@section('title', (isset($menu) ? $menu->title : 'Konsultasi Online') . ' - ' . ($company->name ?? config('app.name')))

@push('styles')
<style>
    .consultant-page-hero {
        background: var(--primary-color);
        padding: 60px 0 40px;
        margin-bottom: 50px;
    }

    .consultant-card {
        background: #FED31A;
        border-radius: 20px;
        padding: 40px 30px;
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .consultant-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .consultant-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .consultant-avatar-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
    }

    .consultant-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid rgba(255, 255, 255, 0.5);
        background: white;
    }

    .consultant-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
    }

    .consultant-title {
        font-size: 1rem;
        color: #555;
        margin-bottom: 8px;
    }

    .consultant-company {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 15px;
    }

    .consultant-price {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .btn-view-profile {
        background: var(--primary-color);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-view-profile:hover {
        background: #1a5c96;
        color: white;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .consultant-card {
            margin-bottom: 30px;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<section class="consultant-page-hero">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-white">
                <h1 class="mb-3" style="font-size: 2.5rem; font-weight: 700;">
                    {{ isset($menu) ? $menu->title : 'Konsultasi Online' }}
                </h1>
                <p class="lead mb-0">
                    {{ isset($menu) && $menu->description ? $menu->description : 'Temui Konsultan Profesional Kami' }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Consultants Grid -->
<section style="padding: 0 0 80px;">
    <div class="container">
        @if($consultants && $consultants->count() > 0)
            <div class="row g-4">
                @foreach($consultants as $consultant)
                    <div class="col-lg-6 col-md-6">
                        <div class="consultant-card">
                            <div class="text-center">
                                <div class="consultant-avatar-wrapper">
                                    @if($consultant->avatar)
                                        <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                                             alt="{{ $consultant->name }}" 
                                             class="consultant-avatar">
                                    @else
                                        <div class="consultant-avatar d-flex align-items-center justify-content-center bg-light">
                                            <i class="bi bi-person" style="font-size: 3rem; color: #ccc;"></i>
                                        </div>
                                    @endif
                                </div>

                                <h3 class="consultant-name">{{ $consultant->name }}</h3>
                                
                                @if($consultant->title)
                                    <p class="consultant-title">{{ $consultant->title }}</p>
                                @endif

                                @if($consultant->company)
                                    <p class="consultant-company">{{ $consultant->company }}</p>
                                @endif

                                @if($consultant->price_text)
                                    <p class="consultant-price">{{ $consultant->price_text }}</p>
                                @endif

                                <a href="{{ route('consultant.show', $consultant->slug) }}" 
                                   class="btn-view-profile">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                Belum ada konsultan yang tersedia saat ini.
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
@if($ctaSection && $ctaSection->is_active)
<section style="padding: 60px 0; background: linear-gradient(135deg, {{ $ctaSection->background_color }} 0%, {{ $ctaSection->background_color }}dd 100%);">
    <div class="container">
        <div class="row justify-content-center text-center text-white">
            <div class="col-lg-8">
                <h2 class="mb-4" style="font-weight: 700;">{{ $ctaSection->title }}</h2>
                <p class="lead mb-4">{{ $ctaSection->description }}</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    @if($ctaSection->show_consultation_button)
                        <a href="{{ $ctaSection->button_link }}" 
                           class="btn btn-light btn-lg" 
                           style="border-radius: 50px; padding: 15px 40px; font-weight: 600;">
                            <i class="bi bi-chat-dots me-2"></i>{{ $ctaSection->button_text }}
                        </a>
                    @endif
                    @if($ctaSection->show_whatsapp_button && isset($company) && $company->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" 
                           target="_blank"
                           class="btn btn-lg" 
                           style="background: #FED31A; color: #333; border-radius: 50px; padding: 15px 40px; font-weight: 600;">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- Default CTA if no active section -->
<section style="padding: 60px 0; background: linear-gradient(135deg, var(--primary-color) 0%, #1a5c96 100%);">
    <div class="container">
        <div class="row justify-content-center text-center text-white">
            <div class="col-lg-8">
                <h2 class="mb-4" style="font-weight: 700;">Siap Memulai Transformasi Bisnis Anda?</h2>
                <p class="lead mb-4">Hubungi kami untuk konsultasi gratis dan diskusikan kebutuhan bisnis Anda dengan tim expert kami</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('consultation.index') }}" 
                       class="btn btn-light btn-lg" 
                       style="border-radius: 50px; padding: 15px 40px; font-weight: 600;">
                        <i class="bi bi-chat-dots me-2"></i>Mulai Konsultasi
                    </a>
                    @if(isset($company) && $company->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" 
                           target="_blank"
                           class="btn btn-lg" 
                           style="background: #FED31A; color: #333; border-radius: 50px; padding: 15px 40px; font-weight: 600;">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
