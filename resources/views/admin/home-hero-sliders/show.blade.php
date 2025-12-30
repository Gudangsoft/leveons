@extends('layouts.admin')

@section('title', 'Hero Slider Detail')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Hero Slider Detail</h2>
                <div class="btn-group">
                    <a href="{{ route('admin.home-hero-sliders.edit', $homeHeroSlider) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.home-hero-sliders.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Title</th>
                                    <td>{{ $homeHeroSlider->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $homeHeroSlider->description ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Button Text</th>
                                    <td>{{ $homeHeroSlider->button_text ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Button URL</th>
                                    <td>
                                        @if($homeHeroSlider->button_url)
                                            <a href="{{ $homeHeroSlider->button_url }}" target="_blank">{{ $homeHeroSlider->button_url }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sort Order</th>
                                    <td>{{ $homeHeroSlider->sort_order }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $homeHeroSlider->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $homeHeroSlider->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $homeHeroSlider->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $homeHeroSlider->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-4">
                            <h5>Hero Background Image</h5>
                            @if($homeHeroSlider->hero_background)
                                <img src="{{ asset('storage/hero_backgrounds/' . $homeHeroSlider->hero_background) }}" 
                                     alt="{{ $homeHeroSlider->title }}" class="img-fluid rounded">
                            @else
                                <div class="rounded" style="height: 200px; background-image: url('https://picsum.photos/400/200?random={{ $homeHeroSlider->id }}'); background-size: cover; background-position: center;">
                                </div>
                                <small class="text-muted mt-2 d-block">Using placeholder image (no upload)</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection