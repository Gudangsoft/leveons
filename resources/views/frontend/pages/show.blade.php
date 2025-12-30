@extends('layouts.frontend')

@section('title', $page->title . ' - ' . $company->name)
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 100px 0 60px;
        color: white;
        position: relative;
    }
    
    .page-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .page-excerpt {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
    }
    
    .page-content {
        padding: 80px 0;
    }
    
    .content-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #2c3e50;
    }
    
    .content-body h1,
    .content-body h2,
    .content-body h3,
    .content-body h4,
    .content-body h5,
    .content-body h6 {
        color: #2c3e50;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .content-body h1 {
        font-size: 2.5rem;
        border-bottom: 3px solid #667eea;
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
    
    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 20px 0;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    
    .page-sidebar {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .sidebar-widget {
        margin-bottom: 40px;
    }
    
    .sidebar-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
    }
    
    .related-pages {
        list-style: none;
        padding: 0;
    }
    
    .related-pages li {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .related-pages li:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    
    .related-pages a {
        color: #2c3e50;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .related-pages a:hover {
        color: #667eea;
    }
    
    .page-meta {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    
    .meta-item {
        display: inline-block;
        margin-right: 20px;
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    
    .meta-item i {
        margin-right: 5px;
    }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<section class="page-hero" style="background-image: url('https://picsum.photos/1920/600?random={{ $page->slug }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="page-title">{{ $page->title }}</h1>
                    @if($page->excerpt)
                        <p class="page-excerpt">{{ $page->excerpt }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="page-content">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Page Meta -->
                <div class="page-meta">
                    <span class="meta-item">
                        <i class="fas fa-calendar"></i>
                        {{ $page->created_at->format('M d, Y') }}
                    </span>
                    @if($page->updated_at->ne($page->created_at))
                    <span class="meta-item">
                        <i class="fas fa-edit"></i>
                        Updated {{ $page->updated_at->format('M d, Y') }}
                    </span>
                    @endif
                </div>
                
                <!-- Featured Image -->
                @if($page->featured_image)
                    <div class="mb-4">
                        @include('components.image', [
                            'src' => Storage::url($page->featured_image),
                            'width' => 800,
                            'height' => 400,
                            'seed' => $page->slug . '-featured',
                            'alt' => $page->title,
                            'class' => 'img-fluid rounded'
                        ])
                    </div>
                @else
                    <div class="mb-4">
                        @include('components.image', [
                            'src' => null,
                            'width' => 800,
                            'height' => 400,
                            'seed' => $page->slug . '-featured',
                            'alt' => $page->title,
                            'class' => 'img-fluid rounded'
                        ])
                    </div>
                @endif
                
                <!-- Content Body -->
                <div class="content-body">
                    @if($page->content)
                        {!! $page->content !!}
                    @else
                        <p>Konten untuk halaman ini sedang dalam proses pengembangan. Silakan kembali lagi nanti atau hubungi kami untuk informasi lebih lanjut.</p>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="page-sidebar">
                    <!-- Related Pages -->
                    @if(isset($relatedPages) && $relatedPages->count() > 0)
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">Related Pages</h5>
                        <ul class="related-pages">
                            @foreach($relatedPages as $related)
                                <li>
                                    <a href="{{ route('pages.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                    @if($related->excerpt)
                                        <br><small class="text-muted">{{ Str::limit($related->excerpt, 80) }}</small>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <!-- Company Info -->
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">Get in Touch</h5>
                        <p>Have questions about our services? We're here to help!</p>
                        
                        @if($company->phone)
                        <div class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <span>{{ $company->phone }}</span>
                        </div>
                        @endif
                        
                        @if($company->email)
                        <div class="mb-2">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:{{ $company->email }}" class="text-decoration-none">{{ $company->email }}</a>
                        </div>
                        @endif
                        
                        @if($company->address)
                        <div class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>{{ $company->address }}</span>
                        </div>
                        @endif
                        
                        <!-- Social Media -->
                        @if($company->social_media)
                            <div class="mt-3">
                                @if(isset($company->social_media['linkedin']) && $company->social_media['linkedin'])
                                    <a href="{{ $company->social_media['linkedin'] }}" target="_blank" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                @endif
                                @if(isset($company->social_media['facebook']) && $company->social_media['facebook'])
                                    <a href="{{ $company->social_media['facebook'] }}" target="_blank" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                @endif
                                @if(isset($company->social_media['twitter']) && $company->social_media['twitter'])
                                    <a href="{{ $company->social_media['twitter'] }}" target="_blank" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                @endif
                                @if(isset($company->social_media['instagram']) && $company->social_media['instagram'])
                                    <a href="{{ $company->social_media['instagram'] }}" target="_blank" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                        <i class="fab fa-instagram"></i> Instagram
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection