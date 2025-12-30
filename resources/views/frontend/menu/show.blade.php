@extends('layouts.frontend')

@section('title', $menu->meta_title ?? $menu->title)
@section('meta_description', $menu->meta_description ?? $menu->description)

@push('styles')
<style>
    .page-header {
        @if($menu->hero_background)
            background: linear-gradient(rgba(33, 118, 193, 0.8), rgba(0, 0, 0, 0.6)), url('{{ asset('storage/hero_backgrounds/' . $menu->hero_background) }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        @else
            background: linear-gradient(rgba(33, 118, 193, 0.8), rgba(0, 0, 0, 0.6)), url('https://picsum.photos/1920/1080?random={{ crc32($menu->slug) }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        @endif
        height: 100vh;
        color: white;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .breadcrumb-custom {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        padding: 8px 20px;
        margin-bottom: 30px;
    }
    
    .breadcrumb-custom .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }
    
    .breadcrumb-custom .breadcrumb-item.active {
        color: white;
    }
    
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .page-subtitle {
        font-size: 1.2rem;
        opacity: 0.9; 
    }
    
    .content-section {
        padding: 80px 0;
    }
    
    .content-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-dark);
    }
    
    .content-body h1,
    .content-body h2,
    .content-body h3,
    .content-body h4,
    .content-body h5,
    .content-body h6 {
        color: var(--text-dark);
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .content-body h1 {
        font-size: 2.5rem;
        border-bottom: 3px solid var(--primary-color);
        padding-bottom: 15px;
    }
    
    .content-body h2 {
        font-size: 2rem;
    }
    
    .content-body p {
        margin-bottom: 1.5rem;
    }
    
    .content-body ul,
    .content-body ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .content-body li {
        margin-bottom: 0.5rem;
    }
    
    .children-menu {
        background: #f8f9fa;
        padding: 60px 0;
        margin-top: 60px;
    }
    
    .child-menu-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .child-menu-card:hover {
        transform: translateY(-2px);
        border-color: var(--primary-color);
    }
    
    .child-menu-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
    }
    
    .child-menu-description {
        color: var(--text-muted);
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .child-menu-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .child-menu-link:hover {
        color: var(--primary-hover);
        text-decoration: none;
    }
    
    .sidebar-menu {
        position: sticky;
        top: 100px;
    }
    
    .sidebar-menu .list-group-item {
        border: none;
        border-left: 3px solid transparent;
        background: transparent;
        padding: 12px 20px;
    }
    
    .sidebar-menu .list-group-item:hover,
    .sidebar-menu .list-group-item.active {
        background: #f8f9fa;
        border-left-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .related-services {
        background: white;
        border-radius: 15px;
        padding: 30px;
        border: 1px solid #e9ecef;
        margin-bottom: 30px;
    }
    
    .service-tree {
        padding-left: 0;
        list-style: none;
    }
    
    .service-tree li {
        margin-bottom: 10px;
        position: relative;
    }
    
    .service-tree ul {
        padding-left: 20px;
        margin-top: 10px;
    }
    
    .service-tree a {
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .service-tree a:hover {
        color: var(--primary-color);
    }
    
    /* Brand Color Utilities */
    .text-success {
        color: var(--primary-color) !important;
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
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container"> 
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="page-title">{{ $menu->title }}</h1>
                @if($menu->description)
                    <p class="page-subtitle">{{ $menu->description }}</p>
                @endif
                
            <a href="https://wa.me/628113011115" target="_blank" class="btn btn-orange ms-3">
                KONSULTASI SEKARANG
            </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content-section">
    <div class="container">
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-lg-{{ $menu->children && $menu->children->count() > 0 ? '8' : '12' }}">
                @if($menu->content)
                    <div class="content-body">
                        {!! $menu->content !!}
                    </div>
                @else
                    <div class="content-body">
                        <h2>{{ $menu->title }}</h2>
                        @if($menu->description)
                            <p class="lead">{{ $menu->description }}</p>
                        @endif
                        <p>Informasi lebih detail tentang {{ $menu->title }} akan segera tersedia. Silakan hubungi tim kami untuk informasi lebih lanjut.</p>
                    </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            @if($menu->children && $menu->children->count() > 0)
            <div class="col-lg-4">
                <div class="related-services">
                    <h5 class="mb-4">Related Services</h5>
                    <ul class="service-tree">
                        @foreach($menu->children as $child)
                            <li>
                                <a href="{{ route('menu.show', $child->slug) }}" class="d-block py-2">
                                    <strong>{{ $child->title }}</strong>
                                    @if($child->description)
                                        <br><small class="text-muted">{{ Str::limit($child->description, 60) }}</small>
                                    @endif
                                </a>
                                @if($child->children && $child->children->count() > 0)
                                    <ul>
                                        @foreach($child->children as $grandchild)
                                            <li>
                                                <a href="{{ route('menu.show', $grandchild->slug) }}" class="d-block py-1">
                                                    {{ $grandchild->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Children Menu Section -->
@if($menu->children && $menu->children->count() > 0 && $menu->level < 2)
<section class="children-menu">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">{{ $menu->title }} Services</h2>
                <p class="section-subtitle">
                    Explore our comprehensive range of {{ strtolower($menu->title) }} solutions
                </p>
            </div>
        </div>
        
        <div class="row">
            @foreach($menu->children as $child)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="child-menu-card">
                        <!-- Image Section -->
                        <div class="mb-3">
                            @include('components.image', [
                                'src' => $child->image ? Storage::url($child->image) : null,
                                'width' => 300,
                                'height' => 200,
                                'seed' => $child->slug,
                                'alt' => $child->title,
                                'class' => 'img-fluid rounded'
                            ])
                        </div>
                        
                        <h4 class="child-menu-title">{{ $child->title }}</h4>
                        @if($child->description)
                            <p class="child-menu-description">{{ $child->description }}</p>
                        @endif
                        
                        @if($child->children && $child->children->count() > 0)
                            <div class="mb-3">
                                <small class="text-muted">Includes:</small>
                                <ul class="list-unstyled mt-2">
                                    @foreach($child->children->take(3) as $grandchild)
                                        <li class="mb-1">
                                            <i class="bi bi-check-circle text-success me-2"></i>
                                            {{ $grandchild->title }}
                                        </li>
                                    @endforeach
                                    @if($child->children->count() > 3)
                                        <li class="text-muted">
                                            <small>...and {{ $child->children->count() - 3 }} more</small>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                        
                        <a href="{{ route('menu.show', $child->slug) }}" class="child-menu-link">
                            Learn More <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection