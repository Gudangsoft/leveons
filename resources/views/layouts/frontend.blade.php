<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    @if($company->favicon)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($company->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="https://picsum.photos/32/32?random=favicon">
    @endif
    
    <title>@yield('title', $company->meta_title ?: $company->name)</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', $company->meta_description ?: $company->description)">
    
    @if(isset($metaKeywords))
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $company->meta_title ?: $company->name)">
    <meta property="og:description" content="@yield('meta_description', $company->meta_description ?: $company->description)">
    @if(isset($featuredImage))
        <meta property="og:image" content="{{ asset('storage/' . $featuredImage) }}">
    @elseif($company->logo)
        <meta property="og:image" content="{{ Storage::url($company->logo) }}">
    @else
        <meta property="og:image" content="https://picsum.photos/1200/630?random=og">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2176C1;     /* Brand Blue */
            --secondary-color: #FED31A;    /* Brand Yellow */
            --accent-color: #EF3A3F;       /* Brand Red */
            --text-dark: #000000;          /* Brand Black */
            --text-muted: #666666;         /* Softer black for readability */
            --bg-light: #f8f9fa;
            --primary-hover: #1e6bb0;      /* Darker blue for hover states */
            --secondary-hover: #e6c018;    /* Darker yellow for hover states */
            --accent-hover: #d32f2f;       /* Darker red for hover states */
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }
        
        /* Navigation Styles */
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .navbar-custom.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .navbar-custom.hidden {
            transform: translateY(-100%);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            text-decoration: none;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            margin: 0 15px;
            padding: 10px 0 !important;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 5px;
            left: 50%;
            background: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover::after {
            width: 100%;
            left: 0;
        }
        
        /* Dropdown Submenu Styles */
        .dropdown-submenu {
            position: relative;
        }
        
        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
            margin-left: -1px;
            min-width: 250px;
        }
        
        .dropdown-submenu:hover .dropdown-menu {
            display: block;
        }
        
        .dropdown-submenu .dropdown-toggle::after {
            display: inline-block;
            margin-left: auto;
            content: "›";
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .mega-menu-item .dropdown-toggle {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        
        .mega-menu-item .dropdown-toggle:hover {
            color: var(--primary-color);
            padding-left: 10px;
        }
        
        .dropdown-submenu .dropdown-item {
            font-size: 0.9rem;
            padding: 8px 20px;
        }
        
        .dropdown-submenu .dropdown-item:hover {
            background: var(--primary-color);
            color: white;
            transform: none;
        }
        
        /* Multi-level dropdown */
        .mega-dropdown {
            position: static !important;
        }
        
        .mega-dropdown-menu {
            width: 100%;
            left: 0;
            right: 0;
            padding: 30px;
            margin-top: 0;
        }
        
        .mega-menu-column {
            padding: 0 20px;
        }
        
        .mega-menu-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
        }
        
        .mega-menu-item {
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .mega-menu-item:last-child {
            border-bottom: none;
        }
        
        .mega-menu-item a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .mega-menu-item a:hover {
            color: var(--primary-color);
            padding-left: 10px;
        }
        
        /* Services Showcase Styles */
        .services-showcase {
            background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%);
        }
        
        .service-showcase-item {
            margin-bottom: 80px;
        }
        
        .service-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
        }
        
        .service-image-wrapper img {
            transition: all 0.4s ease;
        }
        
        .service-image-wrapper:hover img {
            transform: scale(1.05);
        }
        
        .service-showcase-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        .service-showcase-description {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 30px;
        }
        
        .btn-custom-outline {
            display: inline-flex;
            align-items: center;
            padding: 12px 30px;
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-custom-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(33, 118, 193, 0.3);
            text-decoration: none;
        }
        
        /* Additional button variants with brand colors */
        .btn-custom-yellow {
            background: var(--secondary-color);
            color: var(--text-dark);
            border: 2px solid var(--secondary-color);
            padding: 12px 30px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-custom-yellow:hover {
            background: var(--secondary-hover);
            color: var(--text-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(254, 211, 26, 0.3);
            text-decoration: none;
        }
        
        .btn-custom-red {
            background: var(--accent-color);
            color: white;
            border: 2px solid var(--accent-color);
            padding: 12px 30px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-custom-red:hover {
            background: var(--accent-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(239, 58, 63, 0.3);
            text-decoration: none;
        }
        
        /* Tombol Konsultasi Merah */
        .btn-konsultasi {
            background: #EF3A3F;
            color: white;
            border: none;
            padding: 10px 24px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(239, 58, 63, 0.25);
        }
        
        .btn-konsultasi:hover {
            background: #d32f2f;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 58, 63, 0.4);
            text-decoration: none;
        }
        
        /* Tombol WhatsApp Kuning */
        .btn-whatsapp {
            background: #FED31A;
            color: #000;
            border: none;
            padding: 10px 24px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(254, 211, 26, 0.25);
        }
        
        .btn-whatsapp:hover {
            background: #e6c018;
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(254, 211, 26, 0.4);
            text-decoration: none;
        }
        
        /* Old orange button - keep for compatibility */
        .btn-orange {
            background: #FF6B35;
            color: white;
            border: 2px solid #FF6B35;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }
        
        .btn-orange:hover {
            background: #E55A2B;
            border-color: #E55A2B;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
            text-decoration: none;
        }
        
        .service-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(33, 118, 193, 0.3) 50%, transparent 100%);
            margin: 60px 0;
        }
        
        /* Accent elements with brand colors */
        .accent-yellow {
            color: var(--secondary-color);
        }
        
        .accent-red {
            color: var(--accent-color);
        }
        
        .bg-primary-light {
            background: rgba(33, 118, 193, 0.1);
        }
        
        .bg-secondary-light {
            background: rgba(254, 211, 26, 0.1);
        }
        
        .bg-accent-light {
            background: rgba(239, 58, 63, 0.1);
        }
        
        /* Home Content Section Styles */
        .home-content-section .content-wrapper {
            background: white;
            padding: 50px;
            border-radius: 15px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .home-content-section .content-wrapper:hover {
            transform: translateY(-2px);
        }
        
        .home-content-section .content-wrapper h1 {
            color: var(--primary-color);
            margin-bottom: 25px;
        }
        
        .home-content-section .content-wrapper p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-muted);
        }
        
        /* Footer Styles */
        .footer-section {
            background: white;
            color: var(--text-dark);
            padding: 60px 0 30px;
            margin-top: 100px;
            border-top: 1px solid #e9ecef;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .footer-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }
        
        .footer-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            padding: 5px 0;
        }
        
        .footer-link:hover {
            color: var(--secondary-color) !important;
            padding-left: 10px;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 40px;
            padding-top: 30px;
            text-align: center;
            color: rgba(255,255,255,0.8);
        }
        
        /* Social Media Icons in Footer */
        .footer-social-link {
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .footer-social-link:hover {
            color: var(--secondary-color) !important;
            transform: translateY(-2px);
        }
        
        /* Threads Icon Custom (fallback jika FA belum support) */
        .threads-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 192 192' fill='white'%3E%3Cpath d='M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6848 97.2286 61.6848C97.3051 61.6848 97.3819 61.6848 97.4576 61.6855C105.707 61.7381 111.932 64.1366 115.961 68.814C118.893 72.2193 120.854 76.925 121.857 82.8638C114.046 81.6207 105.554 81.2003 96.6047 81.8229C73.3172 83.2765 58.0332 94.9774 58.0332 109.901C58.0332 117.111 60.9028 123.302 66.2648 127.872C72.2759 132.998 80.5471 135.612 89.2286 135.612C103.094 135.612 113.938 129.462 120.354 118.667C123.72 113.324 126.046 106.845 127.267 99.3848C134.953 102.818 140.467 107.776 143.376 113.661C147.647 122.146 147.088 130.675 141.752 137.398C135.534 145.166 124.823 148.96 113.205 148.96C98.6207 148.96 86.7955 144.438 78.5287 135.612C70.8366 127.414 66.9138 116.257 66.9138 103.488L49.0644 103.488C49.0644 119.766 54.4102 134.025 64.5287 144.766C75.3099 156.211 90.3828 162.56 108.205 162.56C124.823 162.56 140.096 157.038 150.205 146.413C159.538 136.576 163.647 123.861 162.369 111.488C161.369 101.488 155.467 93.0383 144.537 86.2848L141.537 88.9883Z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        
        /* Floating WhatsApp Button */
        .floating-whatsapp {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
            animation: pulse 2s infinite;
        }
        
        .floating-whatsapp:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.5);
            text-decoration: none;
        }
        
        .floating-whatsapp i {
            color: white;
            font-size: 28px;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
            }
            50% {
                box-shadow: 0 8px 25px rgba(37, 211, 102, 0.6);
            }
            100% {
                box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
            }
        }
        
        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .navbar-nav .nav-link {
                margin: 0;
                padding: 15px 0 !important;
            }
            
            .btn-konsultasi,
            .btn-whatsapp {
                width: 100%;
                justify-content: center;
                margin: 10px 0 !important;
            }
            
            .navbar-collapse .d-flex {
                flex-direction: column;
                margin-top: 15px;
            }
            
            .dropdown-menu {
                position: static !important;
                transform: none !important;
                border: none;
                box-shadow: none;
                background: var(--bg-light);
                margin: 0;
            }
            
            .mega-dropdown-menu {
                position: static !important;
                width: 100%;
                padding: 15px;
            }
            
            /* Services Showcase Mobile */
            .service-showcase-item .row {
                flex-direction: column !important;
            }
            
            .service-content {
                text-align: center;
                padding: 30px 0 !important;
            }
            
            .service-showcase-title {
                font-size: 1.8rem;
            }
            
            .service-image-wrapper img {
                height: 250px !important;
            }
            
            .home-content-section .content-wrapper {
                padding: 30px 20px;
                margin: 0 15px;
            }
            
            /* Floating WhatsApp Mobile */
            .floating-whatsapp {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
            }
            
            .floating-whatsapp i {
                font-size: 24px;
            }
        }
    </style>
    
    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                @if($company->logo)
                    <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" height="40" class="me-2">
                @else
                    <img src="https://picsum.photos/40/40?random=logo" alt="{{ $company->name }}" height="40" class="me-2">
                @endif 
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @include('partials.navigation')
                </ul>
                <div class="d-flex align-items-center">
                    <!-- Tombol Konsultasi Merah -->
                    <a href="{{ route('consultation.index') }}" class="btn btn-konsultasi me-2 d-flex align-items-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                            <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" fill="white"/>
                        </svg>
                        Konsultasi
                    </a>
                    <!-- Tombol WhatsApp -->
                    @if($company->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" target="_blank" class="btn btn-whatsapp d-flex align-items-center">
                       <i class="fa-solid fa-headphones"></i>
                         &emsp;CS
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    
    
    <!-- Main Content -->
    <div style="padding-top: 90px;">
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer-section mt-0 shadow-none" style="background: #2176C1; color: white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title" style="color: white;">{{ $company->name }}</h5>
                    <p style="color: rgba(255,255,255,0.8);">{{ $company->description ?: 'Leading consulting firm providing strategic business solutions, market research, and executive training programs to accelerate your growth.' }}</p>
                    <div class="mt-3">
                        @if($company->social_media)
                            @if(isset($company->social_media['linkedin']) && $company->social_media['linkedin'])
                                <a href="{{ $company->social_media['linkedin'] }}" target="_blank" class="footer-social-link d-inline-block me-3" style="color: rgba(255,255,255,0.8); font-size: 1.5rem;" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            @endif
                            @if(isset($company->social_media['threads']) && $company->social_media['threads'])
                                <a href="{{ $company->social_media['threads'] }}" target="_blank" class="footer-social-link d-inline-block me-3" style="color: rgba(255,255,255,0.8); font-size: 1.5rem;" title="Threads">
                                    <svg width="24" height="24" viewBox="0 0 192 192" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M141.537 88.9883C140.71 88.5919 139.87 88.2104 139.019 87.8451C137.537 60.5382 122.616 44.905 97.5619 44.745C97.4484 44.7443 97.3355 44.7443 97.222 44.7443C82.2364 44.7443 69.7731 51.1409 62.102 62.7807L75.881 72.2328C81.6116 63.5383 90.6052 61.6848 97.2286 61.6848C97.3051 61.6848 97.3819 61.6848 97.4576 61.6855C105.707 61.7381 111.932 64.1366 115.961 68.814C118.893 72.2193 120.854 76.925 121.857 82.8638C114.046 81.6207 105.554 81.2003 96.6047 81.8229C73.3172 83.2765 58.0332 94.9774 58.0332 109.901C58.0332 117.111 60.9028 123.302 66.2648 127.872C72.2759 132.998 80.5471 135.612 89.2286 135.612C103.094 135.612 113.938 129.462 120.354 118.667C123.72 113.324 126.046 106.845 127.267 99.3848C134.953 102.818 140.467 107.776 143.376 113.661C147.647 122.146 147.088 130.675 141.752 137.398C135.534 145.166 124.823 148.96 113.205 148.96C98.6207 148.96 86.7955 144.438 78.5287 135.612C70.8366 127.414 66.9138 116.257 66.9138 103.488H49.0644C49.0644 119.766 54.4102 134.025 64.5287 144.766C75.3099 156.211 90.3828 162.56 108.205 162.56C124.823 162.56 140.096 157.038 150.205 146.413C159.538 136.576 163.647 123.861 162.369 111.488C161.369 101.488 155.467 93.0383 144.537 86.2848L141.537 88.9883Z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($company->social_media['facebook']) && $company->social_media['facebook'])
                                <a href="{{ $company->social_media['facebook'] }}" target="_blank" class="footer-social-link d-inline-block me-3" style="color: rgba(255,255,255,0.8); font-size: 1.5rem;" title="Facebook"><i class="fab fa-facebook"></i></a>
                            @endif
                            @if(isset($company->social_media['instagram']) && $company->social_media['instagram'])
                                <a href="{{ $company->social_media['instagram'] }}" target="_blank" class="footer-social-link d-inline-block me-3" style="color: rgba(255,255,255,0.8); font-size: 1.5rem;" title="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title" style="color: white;">Services</h6>
                    <a href="{{ route('menu.show', 'consulting') }}" class="footer-link" style="color: rgba(255,255,255,0.8);">Consulting</a>
                    <a href="{{ route('menu.show', 'academy') }}" class="footer-link" style="color: rgba(255,255,255,0.8);">Academy</a>
                    <a href="{{ route('menu.show', 'research') }}" class="footer-link" style="color: rgba(255,255,255,0.8);">Research</a>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title" style="color: white;">Company</h6>
                    <a href="{{ route('menu.show', 'about-us') }}" class="footer-link" style="color: rgba(255,255,255,0.8);">About Us</a>
                    <a href="{{ route('menu.show', 'insight') }}" class="footer-link" style="color: rgba(255,255,255,0.8);">Insights</a>
                    <a href="#" class="footer-link" style="color: rgba(255,255,255,0.8);">Careers</a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h6 class="footer-title" style="color: white;">Contact Info</h6>
                    @if($company->address)
                    <div class="mb-2" style="color: rgba(255,255,255,0.8);">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>{{ $company->address }}</span>
                    </div>
                    @endif
                    @if($company->whatsapp)
                    <div class="mb-2" style="color: rgba(255,255,255,0.8);">
                        <i class="fab fa-whatsapp me-2"></i>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" target="_blank" style="color: rgba(255,255,255,0.8); text-decoration: none;">{{ $company->whatsapp }}</a>
                    </div>
                    @endif
                    @if($company->email)
                    <div class="mb-2" style="color: rgba(255,255,255,0.8);">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:{{ $company->email }}" style="color: rgba(255,255,255,0.8); text-decoration: none;">{{ $company->email }}</a>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="footer-bottom" style="border-top: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.8);">
                <p>&copy; {{ date('Y') }} {{ $company->name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Smart navbar on scroll
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar-custom');
        
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Add scrolled class when scrolling down
            if (scrollTop > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // Hide navbar when scrolling down, show when scrolling up
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                // Scrolling down & past threshold
                navbar.classList.add('hidden');
            } else {
                // Scrolling up or at top
                navbar.classList.remove('hidden');
            }
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
        });
        
        // Multi-level dropdown hover functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownSubmenus = document.querySelectorAll('.dropdown-submenu');
            
            dropdownSubmenus.forEach(function(submenu) {
                const toggle = submenu.querySelector('.dropdown-toggle');
                const submenuDropdown = submenu.querySelector('.dropdown-menu');
                
                // Show submenu on hover
                submenu.addEventListener('mouseenter', function() {
                    submenuDropdown.classList.add('show');
                });
                
                // Hide submenu when leaving
                submenu.addEventListener('mouseleave', function() {
                    submenuDropdown.classList.remove('show');
                });
                
                // Prevent link navigation for parent toggles
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });
        });
    </script>
    
    <!-- Floating WhatsApp Button -->
    @if($company->whatsapp)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}?text=Halo,%20saya%20ingin%20berkonsultasi" target="_blank" class="floating-whatsapp" title="Chat via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    @endif
    
    @stack('scripts')
</body>
</html>