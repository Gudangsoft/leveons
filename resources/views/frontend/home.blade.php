@extends('layouts.frontend')

@section('title', 'Home - ' . $company->name)
@section('meta_description', $company->meta_description ?: $company->description)

@push('styles')
<style>
    .hero-slider {
        position: relative;
        min-height: 70vh;
        overflow: hidden;
    }
    
    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .hero-slide.active {
        opacity: 1;
    }
    
    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(33, 118, 193, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        max-width: 600px;
    }
    
    .btn-primary-custom {
        background: var(--accent-color);
        border: none;
        padding: 15px 35px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
        display: inline-block;
    }
    
    .btn-primary-custom:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(239, 58, 63, 0.3);
        color: white;
    }
    
    .hero-nav-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        display: flex;
        gap: 10px;
    }
    
    .hero-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .hero-dot.active {
        background: white;
        transform: scale(1.2);
    }
    
    .hero-arrows {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .hero-arrows:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .hero-prev {
        left: 20px;
    }
    
    .hero-next {
        right: 20px;
    }
    
    .section-title {
        font-size: 3rem;
        font-weight: 700;
        color: var(--text-dark);
        text-align: center;
        margin-bottom: 20px;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: var(--text-muted);
        text-align: center;
        margin-bottom: 60px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--text-dark) 100%);
        padding: 80px 0;
        text-align: center;
        color: white;
    }
    
    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .cta-description {
        font-size: 1.2rem;
        margin-bottom: 40px;
        opacity: 0.9;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Home Content Section Styles */
    .home-content-section .content-wrapper {
        transition: all 0.3s ease;
    }
    
    .home-content-section .content-wrapper:hover {
        transform: translateY(-2px);
    }
    
    .home-content-section .content-inner h1,
    .home-content-section .content-inner h2,
    .home-content-section .content-inner h3 {
        color: var(--text-dark);
        margin-bottom: 1rem;
    }
    
    .home-content-section .content-inner p {
        color: var(--text-muted);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    
    .home-content-section .content-inner {
        text-align: left;
    }
    
    .content-image-wrapper {
        transition: all 0.3s ease;
    }
    
    .content-image-wrapper:hover {
        transform: scale(1.02);
    }
    
    .content-image-wrapper img {
        transition: all 0.3s ease;
    }
    
    .content-image-wrapper:hover img {
        filter: brightness(1.1);
    }
    
    .content-image-overlay {
        transition: all 0.3s ease;
        backdrop-filter: blur(2px);
    }
    
    /* Info Cards */
    .info-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }
    
    /* Background utility classes for info cards */
    .bg-primary-light {
        background-color: rgba(33, 118, 193, 0.08) !important;
    }
    
    .bg-secondary-light {
        background-color: rgba(254, 211, 26, 0.08) !important;
    }
    
    .bg-accent-light {
        background-color: rgba(239, 58, 63, 0.08) !important;
    }
    
    /* Services Showcase Section */
    .services-showcase .row {
        display: flex;
        flex-wrap: wrap;
    }
    
    .services-showcase .row > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }
    
    /* Service Card Modern Style */
    .service-card-modern {
        border-radius: 0;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: white;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .service-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .service-card-image {
        width: 100%;
        height: 280px;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }
    
    .service-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .service-card-modern:hover .service-card-image img {
        transform: scale(1.1);
    }
    
    .service-card-body {
        padding: 50px 30px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1;
    }
    
    .service-card-title {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 30px;
        text-transform: uppercase;
    }
    
    .btn-service-detail {
        background: transparent;
        color: white;
        border: 2px solid white;
        padding: 12px 40px;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 0;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-transform: capitalize;
    }
    
    .btn-service-detail:hover {
        background: white;
        color: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }

    /* Home Content Section Styles */
    .home-content-section .content-wrapper {
        transition: all 0.3s ease;
    }
    
    .home-content-section .content-wrapper:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
    }
    
    .home-content-section .content-body h2,
    .home-content-section .content-body h3 {
        color: var(--primary-color);
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .home-content-section .content-body p {
        margin-bottom: 1rem;
    }
    
    .home-content-section .content-body ul,
    .home-content-section .content-body ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .home-content-section .content-body li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
    
    @media (max-width: 768px) {
        .home-content-section .content-wrapper {
            padding: 40px 25px !important;
        }
        
        .home-content-section .content-inner h1 {
            font-size: 2rem !important;
            text-align: center;
        }
        
        .home-content-section .content-inner p {
            text-align: center !important;
        }
        
        .content-image-wrapper {
            margin-top: 30px;
        }
        
        .service-card-modern {
            margin-bottom: 30px;
        }
        
        .service-card-title {
            font-size: 1.5rem;
        }
        
        .service-card-body {
            padding: 40px 20px;
            min-height: 180px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Slider Section -->
<section class="hero-slider" id="heroSlider">
    @if($heroSliders && $heroSliders->count() > 0)
        @foreach($heroSliders as $index => $slider)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
             style="background-image: url('{{ $slider->hero_background ? asset('storage/hero_backgrounds/' . $slider->hero_background) : 'https://picsum.photos/1920/1080?random=' . ($index + 1) }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="hero-content">
                            <h1 class="hero-title">{{ $slider->title }}</h1>
                            @if($slider->description)
                                <p class="hero-subtitle">{{ $slider->description }}</p>
                            @endif
                            @if($slider->button_text && $slider->button_url)
                                <a href="{{ $slider->button_url }}" class="btn btn-primary-custom">
                                    {{ $slider->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        @if($heroSliders->count() > 1)
            <!-- Navigation Dots -->
            <div class="hero-nav-dots">
                @foreach($heroSliders as $index => $slider)
                    <span class="hero-dot {{ $index === 0 ? 'active' : '' }}" 
                          onclick="currentSlide({{ $index + 1 }})"></span>
                @endforeach
            </div>
            
            <!-- Navigation Arrows -->
            <button class="hero-arrows hero-prev" onclick="changeSlide(-1)">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="hero-arrows hero-next" onclick="changeSlide(1)">
                <i class="bi bi-chevron-right"></i>
            </button>
        @endif
    @else
        <!-- Fallback Hero Section -->
        <div class="hero-slide active" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="hero-content">
                            <h1 class="hero-title">{{ $homeMenu->title ?? $company->name }}</h1>
                            <p class="hero-subtitle">
                                {{ $homeMenu->description ?? $company->description ?? 'We provide comprehensive business consulting services to help your organization grow and succeed in today\'s competitive market.' }}
                            </p>
                            <a href="{{ route('menu.show', 'service') }}" class="btn btn-primary-custom">
                                Explore Our Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>

<!-- Home Content Section - Updated v2.0 -->
@if($homeMenu && $homeMenu->content)
<section class="home-content-section" style="padding: 80px 0; background: #f5f5f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-11">
                <div class="content-wrapper" style="background: #ffffff; padding: 60px 50px; border-radius: 8px; box-shadow: 0 5px 25px rgba(0,0,0,0.1); margin: 0 auto;">
                    <div class="row align-items-center g-5">
                        <!-- Content Text - Left Side -->
                        <div class="col-lg-{{ $homeMenu->hero_background ? '6' : '12' }}">
                            <div class="content-inner" style="padding-right: {{ $homeMenu->hero_background ? '20px' : '0' }};">
                                @if($homeMenu->meta_title)
                                    <h1 class="mb-4" style="color: #2176C1; font-size: 3rem; font-weight: 700; line-height: 1.2; letter-spacing: -0.5px;">
                                        {{ $homeMenu->meta_title }}
                                    </h1>
                                @else
                                    <h1 class="mb-4" style="color: #2176C1; font-size: 3rem; font-weight: 700; line-height: 1.2; letter-spacing: -0.5px;">
                                        {{ $homeMenu->title }}
                                    </h1>
                                @endif
                                
                                @if($homeMenu->description)
                                    <p class="mb-4" style="color: #333; font-size: 1.05rem; line-height: 1.8; text-align: justify; font-weight: 400;">
                                        {{ $homeMenu->description }}
                                    </p>
                                @endif
                                
                                <!-- Content Body -->
                                <div class="content-body" style="color: #555; font-size: 0.95rem; line-height: 1.7;">
                                    {!! $homeMenu->content !!}
                                </div>
                                 
                            </div>
                        </div>
                        
                        <!-- Hero Image - Right Side -->
                        @if($homeMenu->hero_background)
                        <div class="col-lg-6">
                            <div class="content-image-wrapper" style="text-align: center; padding-left: 20px;">
                                <img src="{{ asset('storage/hero_backgrounds/' . $homeMenu->hero_background) }}" 
                                     alt="{{ $homeMenu->title }}" 
                                     class="img-fluid"
                                     style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 3px 15px rgba(0,0,0,0.08);">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Services Section -->
<section class="services-showcase" style="padding: 100px 0; background: #f8f9fa;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Our Professional Services</h2>
                <p class="section-subtitle">
                    Comprehensive solutions designed to accelerate your business growth and operational excellence
                </p>
            </div>
        </div>
        
        @if($featuredMenus && $featuredMenus->count() > 0)
            <div class="row g-4">
                @foreach($featuredMenus->take(3) as $index => $menu)
                    @php
                        $cardColors = [
                            ['bg' => '#FF6B35', 'text' => 'white'],  // Orange
                            ['bg' => '#EF3A3F', 'text' => 'white'],  // Red
                            ['bg' => '#2176C1', 'text' => 'white']   // Blue
                        ];
                        $color = $cardColors[$index % 3];
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card-modern h-100">
                            <div class="service-card-image">
                                <img src="{{ $menu->hero_background ? asset('storage/hero_backgrounds/' . $menu->hero_background) : 'https://picsum.photos/400/300?random=' . ($index + 1) }}" 
                                     alt="{{ $menu->title }}" 
                                     class="img-fluid">
                            </div>
                            <div class="service-card-body" style="background: {{ $color['bg'] }};">
                                <h3 class="service-card-title text-{{ $color['text'] }}">{{ $menu->title }}</h3>
                                <a href="{{ route('menu.show', $menu->slug) }}" class="btn btn-service-detail">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Fallback services if no featured menus -->
            @php
                $fallbackServices = [
                    [
                        'title' => 'CONSULTING',
                        'image' => 'https://picsum.photos/400/300?random=consulting',
                        'slug' => 'consulting',
                        'color' => '#FF6B35'
                    ],
                    [
                        'title' => 'ACADEMY',
                        'image' => 'https://picsum.photos/400/300?random=academy',
                        'slug' => 'academy',
                        'color' => '#EF3A3F'
                    ],
                    [
                        'title' => 'RESEARCH',
                        'image' => 'https://picsum.photos/400/300?random=research',
                        'slug' => 'research',
                        'color' => '#2176C1'
                    ]
                ];
            @endphp
            
            <div class="row g-4">
                @foreach($fallbackServices as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-card-modern h-100">
                            <div class="service-card-image">
                                <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="img-fluid">
                            </div>
                            <div class="service-card-body" style="background: {{ $service['color'] }};">
                                <h3 class="service-card-title text-white">{{ $service['title'] }}</h3>
                                <a href="{{ route('menu.show', $service['slug']) }}" class="btn btn-service-detail">
                                    View Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
@if($ctaSection && $ctaSection->is_active)
<section class="cta-section" style="background: linear-gradient(135deg, {{ $ctaSection->background_color }} 0%, {{ $ctaSection->background_color }}dd 100%);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-white">{{ $ctaSection->title }}</h2>
                <p class="cta-description">
                    {{ $ctaSection->description }}
                </p>
                <a href="{{ $ctaSection->button_link }}" class="btn btn-primary-custom">
                    {{ $ctaSection->button_text }}
                </a>
            </div>
        </div>
    </div>
</section>
@else
<!-- Default CTA if no active section -->
<section class="cta-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title text-white">Ready to Transform Your Business?</h2>
                <p class="cta-description">
                    Get in touch with our experts at {{ $company->name }} to discuss how we can help accelerate your growth and achieve sustainable success.
                </p>
                <a href="{{ route('menu.show', 'about-us') }}" class="btn btn-primary-custom">
                    Contact Us Today
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.hero-dot');
const totalSlides = slides.length;

function showSlide(index) {
    // Remove active class from all slides and dots
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    // Add active class to current slide and dot
    slides[index].classList.add('active');
    if (dots[index]) {
        dots[index].classList.add('active');
    }
}

function currentSlide(index) {
    currentSlideIndex = index - 1;
    showSlide(currentSlideIndex);
}

function changeSlide(direction) {
    currentSlideIndex += direction;
    
    if (currentSlideIndex >= totalSlides) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = totalSlides - 1;
    }
    
    showSlide(currentSlideIndex);
}

// Auto slide (optional)
@if($heroSliders && $heroSliders->count() > 1)
setInterval(() => {
    changeSlide(1);
}, 5000); // Change slide every 5 seconds
@endif
</script>
@endpush