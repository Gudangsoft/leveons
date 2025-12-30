@extends('layouts.frontend')

@section('title', 'Whitepapers - Download Panduan Gratis')
@section('meta_description', 'Download whitepaper dan panduan gratis seputar teknologi, digital transformation, cybersecurity, dan best practices bisnis.')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-primary py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 40vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row align-items-center text-white">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">
                        Download Whitepapers
                    </h1>
                    <p class="lead mb-4">
                        Kumpulan naskah yang ditulis oleh administrator kami, untuk memberikan anda wawasan terkini terkait Business Scale Up, Strategic Marketing dan Finance dan Pengembangan Organisasi.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="badge bg-light text-dark px-3 py-2">
                            <i class="fas fa-download me-2"></i>
                            {{ $whitepapers->total() }} Whitepapers
                        </div>
                        <div class="badge bg-light text-dark px-3 py-2">
                            <i class="fas fa-users me-2"></i>
                            {{ $featuredWhitepapers->sum('download_count') }}+ Downloads
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block">
                    <div class="hero-icon">
                        <i class="fas fa-file-download" style="font-size: 8rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Whitepapers Section -->
    @if($featuredWhitepapers->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-2">Featured Whitepapers</h2>
                    <p class="text-muted">Panduan paling populer dan terpercaya</p>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($featuredWhitepapers as $whitepaper)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        @if($whitepaper->image_url)
                        <img src="{{ $whitepaper->image_url }}" class="card-img-top" alt="{{ $whitepaper->title }}" style="height: 200px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(45deg, #667eea, #764ba2);">
                            <i class="fas fa-file-alt text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                        </div>
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>
                                    Featured
                                </span>
                                <span class="badge bg-secondary ms-2">
                                    {{ $whitepaper->file_extension ? strtoupper($whitepaper->file_extension) : 'PDF' }}
                                </span>
                            </div>
                            
                            <h5 class="card-title fw-bold mb-3">{{ $whitepaper->title }}</h5>
                            <p class="card-text text-muted mb-3 flex-grow-1">
                                {{ Str::limit($whitepaper->description, 120) }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>
                                    {{ $whitepaper->download_count }} downloads
                                </small>
                                <small class="text-muted">
                                    @if($whitepaper->formatted_file_size)
                                        <i class="fas fa-file me-1"></i>
                                        {{ $whitepaper->formatted_file_size }}
                                    @endif
                                </small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('whitepapers.show', $whitepaper) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-2"></i>
                                    Lihat Detail
                                </a>
                                <a href="{{ route('whitepapers.download', $whitepaper) }}" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>
                                    Download Gratis
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- All Whitepapers Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">Semua Whitepapers</h2>
                    <p class="text-muted">Koleksi lengkap panduan dan insight untuk bisnis Anda</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <form method="GET" class="d-flex">
                        <input type="search" name="search" class="form-control me-2" placeholder="Cari whitepaper..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="row g-4">
                @forelse($whitepapers as $whitepaper)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        @if($whitepaper->image_url)
                        <img src="{{ $whitepaper->image_url }}" class="card-img-top" alt="{{ $whitepaper->title }}" style="height: 200px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-file-alt text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                        </div>
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                @if($whitepaper->is_featured)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>
                                    Featured
                                </span>
                                @endif
                                <span class="badge bg-secondary ms-1">
                                    {{ $whitepaper->file_extension ? strtoupper($whitepaper->file_extension) : 'PDF' }}
                                </span>
                            </div>
                            
                            <h5 class="card-title fw-bold mb-3">{{ $whitepaper->title }}</h5>
                            <p class="card-text text-muted mb-3 flex-grow-1">
                                {{ Str::limit($whitepaper->description, 120) }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>
                                    {{ $whitepaper->download_count }} downloads
                                </small>
                                <small class="text-muted">
                                    @if($whitepaper->formatted_file_size)
                                        <i class="fas fa-file me-1"></i>
                                        {{ $whitepaper->formatted_file_size }}
                                    @endif
                                </small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('whitepapers.show', $whitepaper) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-2"></i>
                                    Lihat Detail
                                </a>
                                <a href="{{ route('whitepapers.download', $whitepaper) }}" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>
                                    Download Gratis
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h4 class="text-muted">Tidak ada whitepaper ditemukan</h4>
                        <p class="text-muted">Coba dengan kata kunci yang berbeda</p>
                    </div>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($whitepapers->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $whitepapers->links('custom.pagination') }}
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-3">Butuh Konsultasi Lebih Lanjut?</h2>
                    <p class="lead mb-4">
                        Silahkan Klik Tombol Dibawah ini
                    </p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp ?? '6281234567890') }}" 
                       class="btn btn-light btn-lg" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>
                        Hubungi kami
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.transition-all {
    transition: all 0.3s ease;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>
@endsection