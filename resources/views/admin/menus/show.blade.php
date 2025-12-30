@extends('layouts.admin')

@section('title', 'Show Menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Detail Menu: {{ $menu->title }}</h2>
                <div>
                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Menu</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Title:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $menu->title }}
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Slug:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <code>{{ $menu->slug }}</code>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Type:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <span class="badge bg-info">{{ ucfirst($menu->type) }}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Status:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <span class="badge bg-{{ $menu->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($menu->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            @if($menu->parent)
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Parent:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <a href="{{ route('admin.menus.show', $menu->parent) }}" class="text-decoration-none">
                                        {{ $menu->parent->title }}
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Level:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $menu->level }}
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Sort Order:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $menu->sort_order }}
                                </div>
                            </div>
                            
                            @if($menu->url)
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>URL:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <a href="{{ $menu->url }}" target="_blank" class="text-decoration-none">
                                        {{ $menu->url }}
                                        <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            @if($menu->description)
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Description:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {!! nl2br(e($menu->description)) !!}
                                </div>
                            </div>
                            @endif
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Created:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $menu->created_at->format('d M Y H:i') }}
                                    @if($menu->user)
                                        oleh <strong>{{ $menu->user->name }}</strong>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Updated:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $menu->updated_at->format('d M Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($menu->content)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Content</h5>
                        </div>
                        <div class="card-body">
                            <div class="content-preview" style="max-height: 400px; overflow-y: auto;">
                                {!! nl2br(e($menu->content)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">SEO Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Meta Title:</strong>
                                <p class="text-muted mb-0">{{ $menu->meta_title ?: 'Tidak diatur' }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Meta Description:</strong>
                                <p class="text-muted mb-0">{{ $menu->meta_description ?: 'Tidak diatur' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($menu->children->count() > 0)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Sub Menus ({{ $menu->children->count() }})</h5>
                        </div>
                        <div class="card-body">
                            @foreach($menu->children->sortBy('sort_order') as $child)
                            <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div>
                                    <a href="{{ route('admin.menus.show', $child) }}" class="text-decoration-none">
                                        {{ $child->title }}
                                    </a>
                                    <br>
                                    <small class="text-muted">{{ $child->slug }}</small>
                                </div>
                                <div>
                                    <span class="badge bg-{{ $child->status === 'active' ? 'success' : 'danger' }}">
                                        {{ $child->status }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-2"></i>Edit Menu
                                </a>
                                
                                @if($menu->type === 'page')
                                <a href="{{ url($menu->slug) }}" target="_blank" class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-2"></i>View Page
                                </a>
                                @endif
                                
                                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100" 
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash me-2"></i>Delete Menu
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection