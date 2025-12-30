@extends('layouts.frontend')
@section('title', $whitepaper->meta_title ?: $whitepaper->title)
@section('meta_description', $whitepaper->meta_description ?: Str::limit($whitepaper->description, 160))

@section('content')
<div class="container-fluid p-0"> 
    <!-- Whitepaper Detail -->    
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        @if($whitepaper->image_url)
                        <img src="{{ $whitepaper->image_url }}" class="card-img-top" alt="{{ $whitepaper->title }}" style="height: 300px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" style="height: 300px; background: linear-gradient(45deg, #667eea, #764ba2);">
                            <i class="fas fa-file-alt text-white" style="font-size: 5rem; opacity: 0.7;"></i>
                        </div>
                        @endif
                        
                        <div class="card-body">
                            <!-- Badges -->
                            <div class="mb-3">
                                @if($whitepaper->is_featured)
                                <span class="badge bg-warning text-dark me-2">
                                    <i class="fas fa-star me-1"></i>
                                    Featured
                                </span>
                                @endif
                                <span class="badge bg-secondary me-2">
                                    {{ $whitepaper->file_extension ? strtoupper($whitepaper->file_extension) : 'PDF' }}
                                </span>
                                @if($whitepaper->formatted_file_size)
                                <span class="badge bg-info text-dark">
                                    <i class="fas fa-file me-1"></i>
                                    {{ $whitepaper->formatted_file_size }}
                                </span>
                                @endif
                            </div>
                            
                            <!-- Title -->
                            <h1 class="fw-bold mb-3">{{ $whitepaper->title }}</h1>
                            
                            <!-- Stats -->
                            <div class="d-flex align-items-center mb-4 text-muted">
                                <div class="me-4">
                                    <i class="fas fa-download me-2"></i>
                                    <span>{{ $whitepaper->download_count }} downloads</span>
                                </div>
                                <div class="me-4">
                                    <i class="fas fa-calendar me-2"></i>
                                    <span>{{ $whitepaper->created_at->format('d M Y') }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-clock me-2"></i>
                                    <span>Diperbarui {{ $whitepaper->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Tentang Whitepaper Ini</h5>
                                <p class="text-muted lead">{{ $whitepaper->description }}</p>
                            </div>
                            
                            <!-- What You'll Learn (dummy content) -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">Yang Akan Anda Pelajari</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <span>Strategi implementasi yang terbukti efektif</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <span>Best practices dari industry leaders</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <span>Case studies dan contoh nyata</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <span>Tools dan template siap pakai</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Download Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-download text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Download Gratis</h5>
                            <p class="text-muted mb-4">
                                Dapatkan akses langsung ke whitepaper ini tanpa perlu registrasi
                            </p>
                            <div class="d-grid">
                                <a href="{{ route('whitepapers.download', $whitepaper) }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-download me-2"></i>
                                    Download Sekarang
                                </a>
                            </div>
                            <small class="text-muted mt-3 d-block">
                                File: {{ $whitepaper->file_name ?: $whitepaper->slug . '.pdf' }}
                                @if($whitepaper->formatted_file_size)
                                <br>Size: {{ $whitepaper->formatted_file_size }}
                                @endif
                            </small>
                        </div>
                    </div>
                    
                    <!-- Share Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Bagikan Whitepaper</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($whitepaper->title) }}" 
                                   target="_blank" class="btn btn-outline-info btn-sm flex-fill">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($whitepaper->title . ' - ' . request()->fullUrl()) }}" 
                                   target="_blank" class="btn btn-outline-success btn-sm flex-fill">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Whitepapers -->
                    @if($relatedWhitepapers->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Whitepaper Lainnya</h6>
                            @foreach($relatedWhitepapers as $related)
                            <div class="d-flex mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                                <div class="flex-shrink-0 me-3">
                                    @if($related->image_url)
                                    <img src="{{ $related->image_url }}" alt="{{ $related->title }}" 
                                         class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-file-alt text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="{{ route('whitepapers.show', $related) }}" 
                                           class="text-decoration-none text-dark hover-primary">
                                            {{ Str::limit($related->title, 50) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-download me-1"></i>
                                        {{ $related->download_count }} downloads
                                    </small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-3">Butuh Bantuan Implementasi?</h2>
                    <p class="lead mb-4">
                        Konsultasikan dengan tim expert kami untuk implementasi yang optimal
                    </p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp ?? '6281234567890') }}" 
                       class="btn btn-light btn-lg" target="_blank">
                        <i class="fab fa-whatsapp me-2"></i>
                        Konsultasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.hover-primary:hover {
    color: var(--bs-primary) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>
@endsection