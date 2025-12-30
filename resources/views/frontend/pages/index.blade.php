@extends('layouts.frontend')

@section('title', 'Pages - ' . $company->name)
@section('meta_description', 'Browse all our pages and content sections for comprehensive information about our services and company.')

@push('styles')
<style>
    .pages-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 100px 0 60px;
        color: white;
        position: relative;
    }
    
    .hero-content h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
    }
    
    .pages-section {
        padding: 80px 0;
    }
    
    .page-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: none;
    }
    
    .page-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .page-image {
        position: relative;
        overflow: hidden;
        height: 200px;
    }
    
    .page-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .page-card:hover .page-image img {
        transform: scale(1.05);
    }
    
    .page-status {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .page-status.published {
        background: rgba(40, 167, 69, 0.9);
    }
    
    .page-status.draft {
        background: rgba(255, 193, 7, 0.9);
    }
    
    .page-body {
        padding: 25px;
    }
    
    .page-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        color: #7f8c8d;
        font-size: 0.85rem;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .page-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 12px;
        line-height: 1.3;
    }
    
    .page-title a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .page-title a:hover {
        color: #667eea;
    }
    
    .page-excerpt {
        color: #7f8c8d;
        line-height: 1.6;
        margin-bottom: 18px;
        font-size: 0.95rem;
    }
    
    .read-more {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .read-more:hover {
        color: #764ba2;
    }
    
    .search-section {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 50px;
    }
    
    .search-form {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .search-input {
        border: 2px solid #e9ecef;
        border-radius: 25px;
        padding: 12px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .search-btn {
        background: #667eea;
        border: 2px solid #667eea;
        border-radius: 25px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        background: #764ba2;
        border-color: #764ba2;
    }
    
    .categories-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 50px;
    }
    
    .category-tag {
        background: #f8f9fa;
        color: #667eea;
        padding: 8px 18px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        margin: 5px;
        display: inline-block;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .category-tag:hover,
    .category-tag.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .pagination-wrapper {
        margin-top: 60px;
        text-align: center;
    }
    
    .pagination .page-link {
        color: #667eea;
        border: 2px solid #e9ecef;
        padding: 8px 16px;
        margin: 0 3px;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }
    
    .empty-state img {
        opacity: 0.5;
        margin-bottom: 30px;
    }
    
    .empty-state h3 {
        color: #7f8c8d;
        margin-bottom: 15px;
    }
    
    .empty-state p {
        color: #95a5a6;
    }
</style>
@endpush

@section('content')
<!-- Pages Hero -->
<section class="pages-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1>All Pages</h1>
                    <p>Explore our comprehensive collection of pages containing detailed information about our services, company, and resources.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pages Section -->
<section class="pages-section">
    <div class="container">
        <!-- Search Section -->
        <div class="search-section">
            <div class="text-center mb-4">
                <h5>Find What You're Looking For</h5>
                <p class="text-muted">Search through our pages to find specific information</p>
            </div>
            <form class="search-form" method="GET">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control search-input" 
                           placeholder="Search pages..."
                           value="{{ request('search') }}">
                    <button class="btn btn-primary search-btn" type="submit">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Categories -->
        @if(isset($categories) && count($categories) > 0)
        <div class="categories-section">
            <div class="text-center mb-4">
                <h5>Browse by Category</h5>
            </div>
            <div class="text-center">
                <a href="{{ route('pages.index') }}" 
                   class="category-tag {{ !request('category') ? 'active' : '' }}">
                    All Pages
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('pages.index', ['category' => $category]) }}" 
                       class="category-tag {{ request('category') == $category ? 'active' : '' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Pages Grid -->
        <div class="row">
            @if($pages->count() > 0)
                @foreach($pages as $page)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="page-card">
                            <div class="page-image">
                                @include('components.image', [
                                    'src' => $page->featured_image ? Storage::url($page->featured_image) : null,
                                    'width' => 350,
                                    'height' => 200,
                                    'seed' => $page->slug . '-card',
                                    'alt' => $page->title,
                                    'class' => ''
                                ])
                                <span class="page-status {{ $page->status ?? 'published' }}">
                                    {{ ucfirst($page->status ?? 'Published') }}
                                </span>
                            </div>
                            <div class="page-body">
                                <div class="page-meta">
                                    <span class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $page->created_at->format('M d, Y') }}
                                    </span>
                                    @if($page->updated_at->ne($page->created_at))
                                    <span class="meta-item">
                                        <i class="fas fa-edit"></i>
                                        Updated
                                    </span>
                                    @endif
                                </div>
                                <h3 class="page-title">
                                    <a href="{{ route('pages.show', $page->slug) }}">
                                        {{ $page->title }}
                                    </a>
                                </h3>
                                <p class="page-excerpt">
                                    {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 100) }}
                                </p>
                                <a href="{{ route('pages.show', $page->slug) }}" class="read-more">
                                    Read More <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="empty-state">
                        @include('components.image', [
                            'src' => null,
                            'width' => 300,
                            'height' => 200,
                            'seed' => 'empty-pages',
                            'alt' => 'No pages found',
                            'class' => 'img-fluid'
                        ])
                        <h3>No Pages Found</h3>
                        <p>
                            @if(request('search'))
                                We couldn't find any pages matching "{{ request('search') }}". Try a different search term.
                            @elseif(request('category'))
                                No pages found in the "{{ request('category') }}" category.
                            @else
                                We're working on adding pages with valuable content. Check back soon!
                            @endif
                        </p>
                        @if(request('search') || request('category'))
                            <a href="{{ route('pages.index') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-arrow-left me-2"></i>View All Pages
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($pages->hasPages())
            <div class="pagination-wrapper">
                {{ $pages->appends(request()->query())->links('custom.pagination') }}
            </div>
        @endif
    </div>
</section>
@endsection