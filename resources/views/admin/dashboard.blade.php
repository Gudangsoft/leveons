@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="text-center mb-5">
                <div class="welcome-card">
                    <div class="welcome-header">
                        <i class="bi bi-speedometer2 welcome-icon"></i>
                        <h1 class="welcome-title">Dashboard Admin</h1>
                        <p class="welcome-subtitle">Selamat datang di panel admin {{ config('app.name') }}</p>
                    </div>
                    
                    <div class="welcome-body">
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="user-details">
                                <h5 class="user-name">{{ Auth::user()->name }}</h5>
                                <p class="user-role">Administrator</p>
                                <p class="current-time">
                                    <i class="bi bi-clock me-2"></i>
                                    {{ now()->setTimezone('Asia/Jakarta')->format('l, d F Y - H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        
                        <div class="quick-actions mt-4">
                            <a href="{{ route('admin.menus.index') }}" class="action-btn">
                                <i class="bi bi-list-nested"></i>
                                <span>Kelola Menu</span>
                            </a>
                            <a href="{{ route('admin.home-hero-sliders.index') }}" class="action-btn">
                                <i class="bi bi-images"></i>
                                <span>Hero Slider</span>
                            </a>
                            <a href="{{ route('admin.company.index') }}" class="action-btn">
                                <i class="bi bi-building"></i>
                                <span>Company</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(33, 118, 193, 0.1);
        border: 1px solid rgba(33, 118, 193, 0.1);
    }
    
    .welcome-header {
        margin-bottom: 2rem;
    }
    
    .welcome-icon {
        font-size: 4rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .welcome-title {
        color: var(--dark-color);
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }
    
    .welcome-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 0;
    }
    
    .user-info {
        background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 1.5rem;
    }
    
    .user-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--secondary-color), rgba(254, 211, 26, 0.9));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--dark-color);
        margin: 0 auto 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .user-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .user-role {
        opacity: 0.9;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }
    
    .current-time {
        background: rgba(255, 255, 255, 0.15);
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin: 0;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }
    
    .quick-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .action-btn {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
        min-width: 120px;
        font-weight: 600;
    }
    
    .action-btn:hover {
        background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(33, 118, 193, 0.3);
    }
    
    .action-btn i {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    
    .action-btn span {
        display: block;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .welcome-title {
            font-size: 2rem;
        }
        
        .action-btn {
            min-width: 100px;
            padding: 0.75rem 1rem;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.4rem;
        }
    }
</style>
@endpush