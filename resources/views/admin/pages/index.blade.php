@extends('layouts.admin')

@php
    $pageTitle = 'Manajemen Halaman';
    $breadcrumbs = [
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Halaman', 'url' => '']
    ];
@endphp

@section('header-actions')
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Halaman
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-file-earmark-text me-2"></i>Daftar Halaman
        </h5>
    </div>
    
    <div class="card-body p-0">
        @if($pages && $pages->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Author</th>
                            <th>Tanggal</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                        <tr>
                            <td>
                                <strong>{{ $page->title }}</strong>
                                @if($page->meta_description)
                                    <br><small class="text-muted">{{ Str::limit($page->meta_description, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                <code>{{ $page->slug }}</code>
                            </td>
                            <td>
                                @if($page->status === 'published')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>Published
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="bi bi-clock me-1"></i>Draft
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($page->is_featured)
                                    <i class="bi bi-star-fill text-warning" title="Featured"></i>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $page->user->name }}</small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $page->created_at->format('d M Y') }}<br>
                                    {{ $page->created_at->format('H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if($page->status === 'published')
                                        <a href="{{ route('pages.show', $page->slug) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           target="_blank" 
                                           title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('admin.pages.edit', $page) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.pages.destroy', $page) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger btn-delete" 
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-file-earmark-text text-muted mb-3" style="font-size: 3rem;"></i>
                <h5 class="text-muted">Belum Ada Halaman</h5>
                <p class="text-muted mb-4">Mulai dengan membuat halaman pertama Anda</p>
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Buat Halaman Pertama
                </a>
            </div>
        @endif
    </div>
    
    @if($pages && $pages->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $pages->firstItem() ?? 0 }} - {{ $pages->lastItem() ?? 0 }} dari {{ $pages->total() }} halaman
                </div>
                <div>
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

@if($pages && $pages->count() > 0)
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-primary">{{ $pages->total() }}</h3>
                <p class="text-muted mb-0">Total Halaman</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-success">{{ $pages->where('status', 'published')->count() }}</h3>
                <p class="text-muted mb-0">Published</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-warning">{{ $pages->where('is_featured', true)->count() }}</h3>
                <p class="text-muted mb-0">Featured</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .table th {
        border-top: none;
        font-weight: 600;
        background-color: #f8f9fa;
    }
    
    .btn-group .btn {
        border-radius: 0.25rem;
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    code {
        font-size: 0.85rem;
        padding: 2px 6px;
        background-color: #f8f9fa;
        border-radius: 3px;
    }
</style>
@endpush