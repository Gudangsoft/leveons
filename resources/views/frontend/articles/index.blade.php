@extends('layouts.frontend')

@section('title', 'Articles & Insights - ' . $company->name)
@section('meta_description', 'Explore our latest articles and insights on business consulting, strategy, and industry trends.')

@push('styles')
<style>
    .articles-hero {
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
    
    .articles-section {
        padding: 80px 0;
    }
    
    .article-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: none;
    }
    
    .article-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .article-image {
        position: relative;
        overflow: hidden;
        height: 250px;
    }
    
    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .article-card:hover .article-image img {
        transform: scale(1.05);
    }
    
    .article-category {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #667eea;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .article-body {
        padding: 30px;
    }
    
    .article-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .article-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        line-height: 1.3;
    }
    
    .article-title a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .article-title a:hover {
        color: #667eea;
    }
    
    .article-excerpt {
        color: #7f8c8d;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    
    .read-more {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .read-more:hover {
        color: #764ba2;
    }
    
    .featured-article {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 60px;
    }
    
    .featured-content {
        padding: 40px;
    }
    
    .featured-badge {
        background: #ff6b6b;
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .featured-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .featured-title a {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .featured-title a:hover {
        color: #667eea;
    }
    
    .filters-section {
        background: #f8f9fa;
        padding: 40px 0;
        border-radius: 15px;
        margin-bottom: 60px;
    }
    
    .filter-btn {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        margin: 5px;
        display: inline-block;
    }
    
    .filter-btn:hover,
    .filter-btn.active {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }
    
    .pagination-wrapper {
        margin-top: 60px;
        text-align: center;
    }
    
    .pagination .page-link {
        color: #667eea;
        border: 2px solid #e9ecef;
        padding: 10px 20px;
        margin: 0 5px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }
</style>
@endpush

@section('content')
<!-- Articles Hero -->
<section class="articles-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1>Articles & Insights</h1>
                    <p>Stay informed with our latest insights, industry trends, and expert analysis on business consulting and strategy.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="articles-section">
    <div class="container">
        <!-- Featured Article -->
        @if(isset($featuredArticle))
        <div class="featured-article">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="featured-content">
                        <span class="featured-badge">Featured Article</span>
                        <h2 class="featured-title">
                            <a href="{{ route('articles.show', $featuredArticle->slug) }}">
                                {{ $featuredArticle->title }}
                            </a>
                        </h2>
                        <div class="article-meta mb-3">
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ $featuredArticle->created_at->format('M d, Y') }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock"></i>
                                {{ ceil(str_word_count(strip_tags($featuredArticle->content)) / 200) }} min read
                            </span>
                        </div>
                        <p class="article-excerpt">{{ $featuredArticle->excerpt ?: Str::limit(strip_tags($featuredArticle->content), 200) }}</p>
                        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="read-more">
                            Read Full Article <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="article-image">
                        @include('components.image', [
                            'src' => $featuredArticle->featured_image ? Storage::url($featuredArticle->featured_image) : null,
                            'width' => 600,
                            'height' => 400,
                            'seed' => $featuredArticle->slug . '-featured',
                            'alt' => $featuredArticle->title,
                            'class' => 'img-fluid'
                        ])
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Filters -->
        <div class="filters-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5 class="mb-4">Filter by Category</h5>
                        <a href="{{ route('articles.index') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">
                            All Articles
                        </a>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <a href="{{ route('articles.index', ['category' => $category]) }}" 
                                   class="filter-btn {{ request('category') == $category ? 'active' : '' }}">
                                    {{ $category }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Articles Grid -->
        <div class="row">
            @if($articles->count() > 0)
                @foreach($articles as $article)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="article-card">
                            <div class="article-image">
                                @include('components.image', [
                                    'src' => $article->featured_image ? Storage::url($article->featured_image) : null,
                                    'width' => 400,
                                    'height' => 250,
                                    'seed' => $article->slug . '-card',
                                    'alt' => $article->title,
                                    'class' => ''
                                ])
                                @if($article->category)
                                    <span class="article-category">{{ $article->category }}</span>
                                @endif
                            </div>
                            <div class="article-body">
                                <div class="article-meta">
                                    <span class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $article->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min
                                    </span>
                                </div>
                                <h3 class="article-title">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="article-excerpt">
                                    {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 120) }}
                                </p>
                                <a href="{{ route('articles.show', $article->slug) }}" class="read-more">
                                    Read More <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="text-center py-5">
                        <img src="https://picsum.photos/300/200?random=empty" alt="No articles" class="img-fluid mb-4 opacity-50">
                        <h3 class="text-muted">No Articles Yet</h3>
                        <p class="text-muted">We're working on bringing you valuable insights. Check back soon!</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="pagination-wrapper">
                {{ $articles->links('custom.pagination') }}
            </div>
        @endif
    </div>
</section>
@endsection