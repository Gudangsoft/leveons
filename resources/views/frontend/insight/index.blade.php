@extends('layouts.frontend')

@section('title', 'Insights - ' . $company->name)
@section('meta_description', 'Explore our latest business insights, industry analysis, and strategic consulting knowledge to accelerate your business growth.')

@push('styles')
<style>
    .insights-hero {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1e6bb0 100%);
        padding: 100px 0 60px;
        color: white;
        position: relative;
    }
    
    .insights-hero::before {
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
    
    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .hero-content p {
        font-size: 1.3rem;
        opacity: 0.95;
        max-width: 600px;
        line-height: 1.6;
    }
    
    .insights-section {
        padding: 80px 0;
        background: #fafbfc;
    }
    
    .search-filter-section {
        background: white;
        padding: 40px 0;
        margin-bottom: 40px;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
    }
    
    .search-box {
        position: relative;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .search-input {
        width: 100%;
        padding: 15px 50px 15px 20px;
        border: 2px solid #e9ecef;
        border-radius: 50px;
        font-size: 1rem;
        outline: none;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .search-input:focus {
        border-color: var(--primary-color);
        background: white;
        box-shadow: 0 0 0 3px rgba(33, 118, 193, 0.1);
    }
    
    .search-btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: var(--primary-color);
        border: none;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        background: var(--primary-hover);
        transform: translateY(-50%) scale(1.05);
    }
    
    .category-filters {
        margin-top: 30px;
        text-align: center;
    }
    
    .category-filter {
        display: inline-block;
        padding: 8px 20px;
        margin: 5px;
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .category-filter:hover,
    .category-filter.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(33, 118, 193, 0.3);
    }
    
    .insight-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        height: 100%;
        border: none;
        position: relative;
    }
    
    .insight-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }
    
    .insight-image {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    }
    
    .insight-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s ease;
    }
    
    .insight-card:hover .insight-image img {
        transform: scale(1.08);
    }
    
    .insight-category {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.95);
        color: var(--primary-color);
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .insight-body {
        padding: 35px 30px 30px;
    }
    
    .insight-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 18px;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }
    
    .meta-item i {
        color: var(--primary-color);
        font-size: 0.8rem;
    }
    
    .insight-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .insight-title a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .insight-title a:hover {
        color: var(--primary-color);
    }
    
    .insight-excerpt {
        color: #6c757d;
        line-height: 1.7;
        margin-bottom: 25px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .read-more {
        color: var(--primary-color);
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }
    
    .read-more:hover {
        color: var(--primary-hover);
        gap: 12px;
    }
    
    .read-more i {
        transition: all 0.3s ease;
    }
    
    .featured-insights {
        margin-bottom: 80px;
    }
    
    .featured-insight {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
        position: relative;
    }
    
    .featured-content {
        padding: 50px;
    }
    
    .featured-badge {
        background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
        color: white;
        padding: 10px 25px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 5px 15px rgba(239, 58, 63, 0.3);
    }
    
    .featured-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 25px;
        line-height: 1.2;
    }
    
    .featured-title a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .featured-title a:hover {
        color: var(--primary-color);
    }
    
    .featured-excerpt {
        font-size: 1.1rem;
        color: #6c757d;
        line-height: 1.8;
        margin-bottom: 30px;
    }
    
    .pagination-wrapper {
        margin-top: 80px;
        text-align: center;
    }
    
    .pagination .page-link {
        color: var(--primary-color);
        border: 2px solid #e9ecef;
        padding: 12px 24px;
        margin: 0 8px;
        border-radius: 30px;
        font-weight: 700;
        transition: all 0.3s ease;
        background: white;
        text-decoration: none;
    }
    
    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(33, 118, 193, 0.3);
    }
    
    /* Remove any icons from pagination */
    .pagination .page-link::before,
    .pagination .page-link::after {
        display: none !important;
    }
    
    .pagination .page-link i,
    .pagination .page-link .fas,
    .pagination .page-link .fa {
        display: none !important;
    }
    
    .insights-cta {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #f4d03f 100%);
        padding: 60px 0;
        margin-top: 80px;
        border-radius: 25px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .insights-cta::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><circle cx="30" cy="30" r="2" fill="white" opacity="0.1"/></svg>');
        animation: float 20s infinite linear;
    }
    
    @keyframes float {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    .cta-content {
        position: relative;
        z-index: 2;
    }
    
    .cta-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
    
    .cta-description {
        font-size: 1.2rem;
        color: var(--text-dark);
        margin-bottom: 30px;
        opacity: 0.8;
    }
    
    .btn-cta {
        background: var(--primary-color);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 25px rgba(33, 118, 193, 0.3);
    }
    
    .btn-cta:hover {
        background: var(--primary-hover);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(33, 118, 193, 0.4);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }
        
        .hero-content p {
            font-size: 1.1rem;
        }
        
        .featured-title {
            font-size: 2rem;
        }
        
        .featured-content {
            padding: 30px 25px;
        }
        
        .insight-body {
            padding: 25px 20px;
        }
        
        .cta-title {
            font-size: 2rem;
        }
        
        .search-filter-section {
            padding: 30px 0;
        }
        
        .category-filters {
            margin-top: 20px;
        }
    }
</style>
@endpush

@section('content')
<!-- Insights Hero -->
<section class="insights-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1>Business Insights</h1>
                    <p>Discover expert analysis, industry trends, and strategic insights that drive business transformation and sustainable growth.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Insights Section -->
<section class="insights-section">
    <div class="container">
        
        <!-- Search & Filter -->
        <div class="search-filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search-box">
                            <input type="text" class="search-input" placeholder="Search insights..." id="searchInput">
                            <button class="search-btn" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Featured Insights -->
        @if($featuredInsights && $featuredInsights->count() > 0)
        <div class="featured-insights">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-5" style="font-weight: 800; color: #2c3e50;">Featured Insights</h2>
                </div>
            </div>
            
            @foreach($featuredInsights as $featured)
            <div class="featured-insight">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="featured-content">
                            <span class="featured-badge">Featured</span>
                            <h2 class="featured-title">
                                <a href="{{ route('insight.show', $featured->slug) }}">
                                    {{ $featured->title }}
                                </a>
                            </h2>
                            <div class="insight-meta mb-4">
                                <span class="meta-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $featured->published_at->format('M d, Y') }}
                                </span>
                                <span class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    {{ ceil(str_word_count(strip_tags($featured->content)) / 200) }} min read
                                </span>
                            </div>
                            <p class="featured-excerpt">{{ $featured->excerpt_text }}</p>
                            <a href="{{ route('insight.show', $featured->slug) }}" class="btn-cta">
                                Read Full Insight <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="insight-image">
                            @include('components.image', [
                                'src' => $featured->featured_image ? Storage::url($featured->featured_image) : null,
                                'width' => 600,
                                'height' => 400,
                                'seed' => $featured->slug . '-featured',
                                'alt' => $featured->title,
                                'class' => 'img-fluid'
                            ])
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Insights Grid -->
        <div class="row">
            <div class="col-12 mb-5">
                <h2 class="text-center" style="font-weight: 800; color: #2c3e50;">
                    Latest Insights
                    <div style="width: 80px; height: 4px; background: linear-gradient(90deg, var(--primary-color), var(--secondary-color)); margin: 15px auto; border-radius: 2px;"></div>
                </h2>
            </div>
        </div>
        
        <div class="row">
            @if($insights->count() > 0)
                @foreach($insights as $insight)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="insight-card">
                            <div class="insight-image">
                                @include('components.image', [
                                    'src' => $insight->featured_image ? Storage::url($insight->featured_image) : null,
                                    'width' => 400,
                                    'height' => 280,
                                    'seed' => $insight->slug . '-card',
                                    'alt' => $insight->title,
                                    'class' => ''
                                ])
                                @if($insight->category)
                                    <span class="insight-category">{{ $insight->category->name }}</span>
                                @else
                                    <span class="insight-category">Business</span>
                                @endif
                            </div>
                            <div class="insight-body">
                                <div class="insight-meta">
                                    <span class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $insight->published_at->format('M d, Y') }}
                                    </span>
                                    <span class="meta-item">
                                        <i class="fas fa-eye"></i>
                                        {{ $insight->views_count }} views
                                    </span>
                                </div>
                                <h3 class="insight-title">
                                    <a href="{{ route('insight.show', $insight->slug) }}">
                                        {{ $insight->title }}
                                    </a>
                                </h3>
                                <p class="insight-excerpt">
                                    {{ $insight->excerpt_text }}
                                </p>
                                <a href="{{ route('insight.show', $insight->slug) }}" class="read-more">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="text-center py-5">
                        <div style="font-size: 80px; color: #e9ecef; margin-bottom: 30px;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 style="color: #6c757d; font-weight: 700;">No Insights Available Yet</h3>
                        <p style="color: #adb5bd; font-size: 1.1rem;">We're working on bringing you valuable business insights. Check back soon!</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($insights->hasPages())
        <div class="pagination-wrapper">
            {{ $insights->links('custom.pagination') }}
        </div>
        @endif
        
        <!-- Whitepaper CTA Section -->
        <div class="insights-cta">
            <div class="container">
                <div class="cta-content">
                    <h2 class="cta-title">Get Our Exclusive Whitepapers</h2>
                    <p class="cta-description">Download comprehensive business guides and strategic insights to accelerate your growth</p>
                    <a href="{{ route('whitepapers.index') }}" class="btn-cta">
                        <i class="fas fa-download"></i>
                        Download Whitepapers
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.querySelector('.search-btn');
    
    function performSearch() {
        const query = searchInput.value.toLowerCase();
        const insightCards = document.querySelectorAll('.insight-card');
        
        insightCards.forEach(card => {
            const title = card.querySelector('.insight-title').textContent.toLowerCase();
            const excerpt = card.querySelector('.insight-excerpt').textContent.toLowerCase();
            
            if (title.includes(query) || excerpt.includes(query)) {
                card.closest('.col-lg-4').style.display = 'block';
            } else {
                card.closest('.col-lg-4').style.display = 'none';
            }
        });
    }
    
    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    // Category filter functionality
    const categoryFilters = document.querySelectorAll('.category-filter');
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all filters
            categoryFilters.forEach(f => f.classList.remove('active'));
            
            // Add active class to clicked filter
            this.classList.add('active');
            
            // Filter logic would go here for actual implementation
            console.log('Filter clicked:', this.textContent);
        });
    });
});
</script>
@endpush