@extends('layouts.admin')

@section('title', 'Home Hero Slider Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Home Hero Slider Management</h2>
                @if($sliders->count() < 5)
                    <a href="{{ route('admin.home-hero-sliders.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus me-2"></i>Tambah Slider
                    </a>
                @else
                    <span class="text-muted">Maksimal 5 slider tercapai</span>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Hero Slider ({{ $sliders->count() }}/5)</h5>
                </div>
                <div class="card-body">
                    @if($sliders->count() > 0)
                        <div class="row">
                            @foreach($sliders as $slider)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        @if($slider->hero_background)
                                            <img src="{{ asset('storage/hero_backgrounds/' . $slider->hero_background) }}" 
                                                 class="card-img-top" alt="{{ $slider->title }}" style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top" style="height: 200px; background-image: url('https://picsum.photos/400/200?random={{ $loop->iteration }}'); background-size: cover; background-position: center;">
                                            </div>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $slider->title }}</h5>
                                            @if($slider->description)
                                                <p class="card-text text-muted small">{{ Str::limit($slider->description, 100) }}</p>
                                            @endif
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="badge {{ $slider->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $slider->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                    <span class="badge bg-info">Order: {{ $slider->sort_order }}</span>
                                                </div>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.home-hero-sliders.show', $slider) }}" class="btn btn-outline-info" title="View">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.home-hero-sliders.edit', $slider) }}" class="btn btn-outline-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.home-hero-sliders.destroy', $slider) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-images text-muted" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Belum ada hero slider</h5>
                            <p class="text-muted">Tambahkan hero slider untuk homepage</p>
                            <a href="{{ route('admin.home-hero-sliders.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus me-2"></i>Tambah Slider
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection