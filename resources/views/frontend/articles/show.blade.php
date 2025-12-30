@extends('layouts.frontend')

@section('title', $article->title . ' - ' . $company->name)
@section('meta_description', $article->meta_description ?: Str::limit(strip_tags($article->content), 160))

@push('styles')
<style>
    .article-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 100px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .article-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .article-category {
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .article-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .article-excerpt {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin-bottom: 30px;
    }
    
    .article-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        opacity: 0.8;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    
    .article-content {
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
    
    .article-sidebar {
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
    
    .related-articles {
        list-style: none;
        padding: 0;
    }
    
    .related-articles li {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .related-articles li:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    
    .related-articles a {
        color: #2c3e50;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .related-articles a:hover {
        color: #667eea;
    }
    
    .related-articles .article-date {
        color: #7f8c8d;
        font-size: 0.85rem;
        margin-top: 5px;
    }
    
    .share-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }
    
    .share-btn {
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
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
    
    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: white;
    }
    
    .tags-list {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .tag {
        display: inline-block;
        background: #f8f9fa;
        color: #667eea;
        padding: 5px 15px;
        border-radius: 15px;
        text-decoration: none;
        font-size: 0.9rem;
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    
    .tag:hover {
        background: #667eea;
        color: white;
    }
</style>
@endpush

@section('content')
<!-- Article Hero -->
<section class="article-hero" style="background-image: url('https://picsum.photos/1920/600?random={{ $article->slug }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hero-content">
                    @if($article->category)
                        <span class="article-category">{{ $article->category }}</span>
                    @endif
                    
                    <h1 class="article-title">{{ $article->title }}</h1>
                    
                    @if($article->excerpt)
                        <p class="article-excerpt">{{ $article->excerpt }}</p>
                    @endif
                    
                    <div class="article-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $article->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($article->author)
                            <div class="meta-item">
                                <i class="fas fa-user"></i>
                                <span>{{ $article->author }}</span>
                            </div>
                        @endif
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="article-content">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Featured Image -->
                @if($article->featured_image)
                    <div class="mb-4">
                        @include('components.image', [
                            'src' => Storage::url($article->featured_image),
                            'width' => 800,
                            'height' => 400,
                            'seed' => $article->slug . '-featured',
                            'alt' => $article->title,
                            'class' => 'img-fluid rounded'
                        ])
                    </div>
                @else
                    <div class="mb-4">
                        @include('components.image', [
                            'src' => null,
                            'width' => 800,
                            'height' => 400,
                            'seed' => $article->slug . '-featured',
                            'alt' => $article->title,
                            'class' => 'img-fluid rounded'
                        ])
                    </div>
                @endif
                
                <!-- Content Body -->
                <div class="content-body">
                    @if($article->content)
                        {!! $article->content !!}
                    @else
                        <p>Artikel ini sedang dalam proses penulisan. Silakan kembali lagi nanti untuk membaca konten lengkapnya.</p>
                    @endif
                </div>
                
                <!-- Tags -->
                @if($article->tags)
                    <div class="tags-list">
                        <h6>Tags:</h6>
                        @foreach(explode(',', $article->tags) as $tag)
                            <a href="#" class="tag">{{ trim($tag) }}</a>
                        @endforeach
                    </div>
                @endif
                
                <!-- Share Buttons -->
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" class="share-btn facebook">
                        <i class="fab fa-facebook-f me-2"></i>Share
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" 
                       target="_blank" class="share-btn twitter">
                        <i class="fab fa-twitter me-2"></i>Tweet
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                       target="_blank" class="share-btn linkedin">
                        <i class="fab fa-linkedin-in me-2"></i>Share
                    </a>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="article-sidebar">
                    <!-- Related Articles -->
                    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">Related Articles</h5>
                        <ul class="related-articles">
                            @foreach($relatedArticles as $related)
                                <li>
                                    <div class="row">
                                        <div class="col-4">
                                            @include('components.image', [
                                                'src' => $related->featured_image ? Storage::url($related->featured_image) : null,
                                                'width' => 100,
                                                'height' => 80,
                                                'seed' => $related->slug . '-thumb',
                                                'alt' => $related->title,
                                                'class' => 'img-fluid rounded'
                                            ])
                                        </div>
                                        <div class="col-8">
                                            <a href="{{ route('articles.show', $related->slug) }}">
                                                {{ Str::limit($related->title, 50) }}
                                            </a>
                                            <div class="article-date">{{ $related->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <!-- Newsletter Signup -->
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">Stay Updated</h5>
                        <p>Subscribe to our newsletter for the latest insights and updates.</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your email address" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-envelope me-2"></i>Subscribe
                            </button>
                        </form>
                    </div>
                    
                    <!-- Company Info -->
                    <div class="sidebar-widget">
                        <h5 class="sidebar-title">About {{ $company->name }}</h5>
                        <p>{{ $company->description ?: 'Leading consulting firm providing strategic business solutions.' }}</p>
                        
                        @if($company->phone || $company->email)
                        <div class="mt-3">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection