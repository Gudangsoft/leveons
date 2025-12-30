@extends('layouts.admin')

@section('title', 'Menu Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Menu Management</h2>
                <div>
                    <form action="{{ route('admin.menus.clear-cache') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-arrow-clockwise me-2"></i>Clear Cache
                        </button>
                    </form>
                </div>
            </div> 

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Struktur Menu Hierarkis</h5>
                </div>
                <div class="card-body">
                    @if($menus && count($menus) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Level</th>
                                        <th>Sort Order</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $menu)
                                        @include('admin.menus.partials.menu-row', ['menu' => $menu, 'level' => 0])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-diagram-3 text-muted" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Semua menu telah dikonfigurasi</h5>
                            <p class="text-muted">Menu sistem telah disiapkan dan hanya dapat diedit</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .menu-level-0 { padding-left: 0; font-weight: bold; }
    .menu-level-1 { padding-left: 20px; }
    .menu-level-2 { padding-left: 40px; }
    .menu-level-3 { padding-left: 60px; }
    
    .badge-status {
        font-size: 0.8rem;
    }
    
    .menu-actions {
        white-space: nowrap;
    }
    
    .menu-title {
        color: #2c3e50;
        text-decoration: none;
    }
    
    .menu-title:hover {
        color: #3498db;
        text-decoration: underline;
    }
</style>
@endpush