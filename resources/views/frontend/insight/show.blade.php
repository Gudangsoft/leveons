@extends('layouts.frontend')

@section('title', $insight->title . ' - ' . $company->name)
@section('meta_description', $insight->meta_description ?: Str::limit(strip_tags($insight->content), 160))

@push('styles')
<style>
    .insight-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1e6bb0 100%);
        padding: 120px 0 80px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .insight-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><pattern id="grain" width="100" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="white" opacity="0.1"/><circle cx="30" cy="5" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="15" r="1.2" fill="white" opacity="0.1"/><circle cx="70" cy="8" r="0.8" fill="white" opacity="0.1"/><circle cx="90" cy="12" r="1.3" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="20" fill="url(%23grain)"/></svg>');
        opacity: 0.1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .insight-category {
        background: rgba(254, 211, 26, 0.2);
        color: var(--secondary-color);
        padding: 8px 20px;
        border-radius: 30px;
        display: inline-block;
        margin-bottom: 25px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid rgba(254, 211, 26, 0.3);
        backdrop-filter: blur(10px);
    }
    
    .insight-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 25px;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }
    
    .insight-excerpt {
        font-size: 1.3rem;
        opacity: 0.95;
        max-width: 700px;
        margin-bottom: 35px;
        line-height: 1.6;
    }
    
    .insight-meta {
        display: flex;
        align-items: center;
        gap: 25px;
        opacity: 0.9;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .meta-item i {
        font-size: 0.9rem;
    }
    
    .insight-content {
        padding: 100px 0 80px;
        background: #fafbfc;
    }
    
    .content-container {
        background: white;
        border-radius: 25px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .featured-image-container {
        position: relative;
        height: 400px;
        overflow: hidden;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    }
    
    .featured-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .content-body {
        padding: 60px 50px;
        font-size: 1.15rem;
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
        margin-top: 2.5rem;
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .content-body h1 {
        font-size: 2.8rem;
        border-bottom: 4px solid var(--primary-color);
        padding-bottom: 20px;
        margin-bottom: 2rem;
    }
    
    .content-body h2 {
        font-size: 2.2rem;
        color: var(--primary-color);
        position: relative;
        padding-left: 20px;
    }
    
    .content-body h2::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--secondary-color);
        border-radius: 2px;
    }
    
    .content-body h3 {
        font-size: 1.8rem;
        color: var(--text-dark);
    }
    
    .content-body p {
        margin-bottom: 1.8rem;
        text-align: justify;
    }
    
    .content-body ul,
    .content-body ol {
        margin-bottom: 2rem;
        padding-left: 2.5rem;
    }
    
    .content-body li {
        margin-bottom: 0.8rem;
        line-height: 1.7;
    }
    
    .content-body ul li::marker {
        color: var(--primary-color);
    }
    
    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        margin: 30px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .content-body blockquote {
        background: var(--bg-light);
        border-left: 5px solid var(--primary-color);
        padding: 25px 30px;
        margin: 30px 0;
        border-radius: 0 15px 15px 0;
        font-style: italic;
        font-size: 1.2rem;
        color: var(--text-muted);
    }
    
    .insight-sidebar {
        background: white;
        border-radius: 20px;
        padding: 40px 35px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 110px;
    }
    
    .sidebar-widget {
        margin-bottom: 50px;
    }
    
    .sidebar-widget:last-child {
        margin-bottom: 0;
    }
    
    .sidebar-title {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--primary-color);
        position: relative;
    }
    
    .sidebar-title::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--secondary-color);
    }
    
    .related-insights {
        list-style: none;
        padding: 0;
    }
    
    .related-insights li {
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .related-insights li:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    
    .related-insights li:hover {
        transform: translateX(5px);
    }
    
    .related-insight-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .related-insights a {
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: block;
        line-height: 1.4;
    }
    
    .related-insights a:hover {
        color: var(--primary-color);
    }
    
    .insight-date {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-top: 8px;
        font-weight: 500;
    }
    
    .share-buttons {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        flex-wrap: wrap;
    }
    
    .share-btn {
        padding: 12px 25px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }
    
    .share-btn.facebook {
        background: #3b5998;
        color: white;
    }
    
    .share-btn.twitter {
        background: #1da1f2;
        color: white;
    }
    
    .share-btn.linkedin {
        background: #0077b5;
        color: white;
    }
    
    .share-btn.whatsapp {
        background: #25D366;
        color: white;
    }
    
    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        color: white;
    }
    
    .back-to-insights {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 30px;
        padding: 12px 25px;
        background: rgba(33, 118, 193, 0.1);
        border-radius: 30px;
        transition: all 0.3s ease;
    }
    
    .back-to-insights:hover {
        background: var(--primary-color);
        color: white;
        transform: translateX(-5px);
    }
    
    .back-to-insights i {
        transition: all 0.3s ease;
    }
    
    .back-to-insights:hover i {
        transform: translateX(-3px);
    }
    
    .newsletter-signup {
        background: linear-gradient(135deg, var(--primary-color), #1e6bb0);
        color: white;
        border-radius: 20px;
        padding: 35px 30px;
        text-align: center;
    }
    
    .newsletter-signup h5 {
        color: white;
        margin-bottom: 15px;
        font-weight: 700;
    }
    
    .newsletter-signup p {
        opacity: 0.9;
        margin-bottom: 25px;
    }
    
    .newsletter-signup .form-control {
        border: none;
        border-radius: 25px;
        padding: 12px 20px;
        margin-bottom: 15px;
    }
    
    .newsletter-signup .btn {
        background: var(--secondary-color);
        color: var(--text-dark);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    
    .newsletter-signup .btn:hover {
        background: var(--secondary-hover);
        transform: translateY(-2px);
    }
    
    .author-info {
        background: var(--bg-light);
        border-radius: 15px;
        padding: 25px;
        margin-top: 40px;
        border-left: 4px solid var(--primary-color);
    }
    
    .author-info h6 {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .insight-title {
            font-size: 2.5rem;
        }
        
        .insight-excerpt {
            font-size: 1.1rem;
        }
        
        .insight-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .content-body {
            padding: 40px 25px;
            font-size: 1.1rem;
        }
        
        .insight-sidebar {
            padding: 30px 25px;
            position: static;
        }
        
        .share-buttons {
            justify-content: center;
        }
        
        .featured-image-container {
            height: 250px;
        }
    }
</style>
@endpush

@section('content')
<!-- Back to Insights -->
<div class="container" style="padding-top: 120px;">
    <a href="{{ route('menu.show', 'insight') }}" class="back-to-insights">
        <i class="fas fa-arrow-left"></i>
        Back to Insights
    </a>
</div>

<!-- Insight Hero -->
<section class="insight-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="hero-content">
                    @if($insight->category)
                        <span class="insight-category">{{ $insight->category->name }}</span>
                    @else
                        <span class="insight-category">Business Insight</span>
                    @endif
                    
                    <h1 class="insight-title">{{ $insight->title }}</h1>
                    
                    @if($insight->excerpt)
                        <p class="insight-excerpt">{{ $insight->excerpt }}</p>
                    @endif
                    
                    <div class="insight-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $insight->published_at->format('F d, Y') }}</span>
                        </div>
                        @if($insight->user)
                            <div class="meta-item">
                                <i class="fas fa-user"></i>
                                <span>{{ $insight->user->name }}</span>
                            </div>
                        @endif
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ ceil(str_word_count(strip_tags($insight->content)) / 200) }} min read</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-eye"></i>
                            <span>{{ $insight->views_count }} views</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Insight Content -->
<section class="insight-content">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="content-container">
                    <!-- Featured Image -->
                    <div class="featured-image-container">
                        @include('components.image', [
                            'src' => $insight->featured_image ? Storage::url($insight->featured_image) : null,
                            'width' => 800,
                            'height' => 400,
                            'seed' => $insight->slug . '-featured',
                            'alt' => $insight->title,
                            'class' => ''
                        ])
                    </div>
                    
                    <!-- Content Body -->
                    <div class="content-body">
                        @if($insight->content)
                            {!! $insight->content !!}
                        @else
                            <p>This insight is currently being developed. Please check back soon for the complete content.</p>
                        @endif
                        
                        <!-- Author Info -->
                        @if($insight->user)
                        <div class="author-info">
                            <h6>About the Author</h6>
                            <p><strong>{{ $insight->user->name }}</strong> - Expert consultant at {{ $company->name }}, specializing in strategic business solutions and organizational development.</p>
                        </div>
                        @endif
                        
                        <!-- Share Buttons -->
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i>Share
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($insight->title) }}" 
                               target="_blank" class="share-btn twitter">
                                <i class="fab fa-twitter"></i>Tweet
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" class="share-btn linkedin">
                                <i class="fab fa-linkedin-in"></i>Share
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($insight->title . ' - ' . request()->url()) }}" 
                               target="_blank" class="share-btn whatsapp">
                                <i class="fab fa-whatsapp"></i>Share
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="insight-sidebar">
                    <!-- Related Insights -->
                    @if($relatedInsights && $relatedInsights->count() > 0)
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">Related Insights</h5>
                        <ul class="related-insights">
                            @foreach($relatedInsights as $related)
                                <li>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="related-insight-image">
                                                @include('components.image', [
                                                    'src' => $related->featured_image ? Storage::url($related->featured_image) : null,
                                                    'width' => 100,
                                                    'height' => 80,
                                                    'seed' => $related->slug . '-thumb',
                                                    'alt' => $related->title,
                                                    'class' => 'img-fluid'
                                                ])
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <a href="{{ route('insight.show', $related->slug) }}">
                                                {{ Str::limit($related->title, 55) }}
                                            </a>
                                            <div class="insight-date">{{ $related->published_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif 
                    
                    <!-- Company CTA -->
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">Need Expert Advice?</h5>
                        <p>Transform your business with strategic consulting from {{ $company->name }}.</p>
                        
                        @if($company->phone || $company->email)
                        <div class="mt-3 mb-4">
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
                        </div>
                        @endif
                        
                        <a href="https://wa.me/628113011115?text=Halo,%20saya%20ingin%20berkonsultasi%20tentang%20strategi%20bisnis" 
                           target="_blank" class="btn btn-primary w-100" 
                           style="background: var(--primary-color); border: none; border-radius: 25px; padding: 12px; font-weight: 700;">
                            <i class="fab fa-whatsapp me-2"></i>Start Consultation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection