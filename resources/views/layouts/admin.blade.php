<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $pageTitle ?? 'Admin Panel' }} - {{ config('app.name', 'CMS Website') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #2176C1;
            --secondary-color: #FED31A;
            --accent-color: #EF3A3F;
            --dark-color: #000000;
            --admin-primary: #2176C1;
            --admin-secondary: #FED31A;
            --admin-accent: #EF3A3F;
            --admin-sidebar: #1a1a1a;
            --admin-sidebar-hover: #2176C1;
            --admin-sidebar-active: linear-gradient(135deg, #2176C1, rgba(33, 118, 193, 0.9));
        }
        
        body {
            font-size: 0.9rem;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            width: 250px;
            background-color: var(--admin-sidebar);
        }
        
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            color: #ccc;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin: 0.2rem 0.5rem;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, var(--admin-sidebar-hover), rgba(33, 118, 193, 0.8));
            color: #fff;
            border-left-color: var(--secondary-color);
            transform: translateX(2px);
        }
        
        .sidebar .nav-link.active {
            background: var(--admin-sidebar-active);
            color: #fff;
            border-left-color: var(--secondary-color);
            box-shadow: 0 2px 8px rgba(33, 118, 193, 0.3);
        }
        
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
            font-weight: 600;
        }
        
        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }
        
        .main-content {
            margin-left: 250px;
            padding-top: 48px;
        }
        
        .content-header {
            padding: 1.5rem 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 2rem;
        }
        
        .stats-card {
            border-left: 4px solid var(--admin-primary);
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            border-left-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-bottom: 2px solid var(--primary-color);
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) > td {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
            color: white;
            font-weight: 600;
            border: none;
        }
        
        .btn-sm {
            font-size: 0.8rem;
        }
        
        .alert {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, var(--accent-color), rgba(239, 58, 63, 0.8));
            color: white;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(33, 118, 193, 0.3);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--secondary-color), rgba(254, 211, 26, 0.9));
            border: none;
            color: var(--dark-color);
            font-weight: 600;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--accent-color), rgba(239, 58, 63, 0.9));
            border: none;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }
            
            .main-content {
                margin-left: 0;
                padding-top: 0;
            }
        }
    </style>
    
    @stack('styles')
</head>

<body>
    @php
        $company = App\Models\Company::getSettings();
    @endphp
    
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" 
         style="background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.95));">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" 
                     style="width: 30px; height: 30px; object-fit: contain; background: white; border-radius: 50%; padding: 3px; margin-right: 8px;">
            @else
                <div style="width: 30px; height: 30px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px; font-weight: bold; color: var(--primary-color); font-size: 0.8rem;">
                    {{ strtoupper(substr($company->name, 0, 1)) }}
                </div>
            @endif
            <span>{{ $company->name ?? 'Admin Panel' }}</span>
        </a>
        
        <div class="navbar-nav ms-auto">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3 text-light" href="{{ route('home') }}" target="_blank" 
                   style="background: rgba(254, 211, 26, 0.2); border-radius: 20px; margin: 0.25rem;">
                    <i class="bi bi-box-arrow-up-right me-2"></i>Lihat Website
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}" 
                               href="{{ route('admin.menus.index') }}">
                                <i class="bi bi-list-nested me-2"></i>
                                Menu & Pages
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.insights.*') ? 'active' : '' }}" 
                               href="{{ route('admin.insights.index') }}">
                                <i class="bi bi-lightbulb me-2"></i>
                                Insights
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.whitepapers.*') ? 'active' : '' }}" 
                               href="{{ route('admin.whitepapers.index') }}">
                                <i class="bi bi-file-earmark-pdf me-2"></i>
                                Whitepapers
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.consultants.*') ? 'active' : '' }}" 
                               href="{{ route('admin.consultants.index') }}">
                                <i class="bi bi-people me-2"></i>
                                Consultants
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}" 
                               href="{{ route('admin.packages.index') }}">
                                <i class="bi bi-box-seam me-2"></i>
                                Consultation Packages
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.cta-sections.*') ? 'active' : '' }}" 
                               href="{{ route('admin.cta-sections.index') }}">
                                <i class="bi bi-megaphone me-2"></i>
                                CTA Sections
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" 
                               href="{{ route('admin.bookings.index') }}">
                                <i class="bi bi-calendar-check me-2"></i>
                                Bookings
                                @php
                                    $pendingCount = \App\Models\ConsultantBooking::where('status', 'pending')->count();
                                @endphp
                                @if($pendingCount > 0)
                                    <span class="badge bg-warning text-dark ms-auto">{{ $pendingCount }}</span>
                                @endif
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.consultation-requests.*') ? 'active' : '' }}" 
                               href="{{ route('admin.consultation-requests.index') }}">
                                <i class="bi bi-chat-dots me-2"></i>
                                Consultation Requests
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.home-hero-sliders.*') ? 'active' : '' }}" 
                               href="{{ route('admin.home-hero-sliders.index') }}">
                                <i class="bi bi-images me-2"></i>
                                Home Hero Sliders
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.company.*') ? 'active' : '' }}" 
                               href="{{ route('admin.company.index') }}">
                                <i class="bi bi-building me-2"></i>
                                Company Settings
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <hr class="text-muted">
                        </li>
                        
                        <li class="nav-item">
                            <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start w-100 border-0" 
                                        onclick="return confirm('Yakin ingin menghapus cache?')">
                                    <i class="bi bi-arrow-clockwise me-2"></i>
                                    Clear Cache
                                </button>
                            </form>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    
                    <div class="mt-auto p-3" style="border-top: 1px solid #333;">
                        <small class="text-muted">
                            <div class="d-flex align-items-center mb-2">
                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.8)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px; color: white; font-weight: bold; font-size: 0.7rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="color: #ccc; font-weight: 600;">{{ Auth::user()->name }}</div>
                                    <div style="color: #888; font-size: 0.7rem;">Administrator</div>
                                </div>
                            </div>
                            <div class="text-center" style="color: var(--secondary-color); font-size: 0.7rem;">
                                <i class="bi bi-clock me-1"></i>{{ now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </div>
                        </small>
                    </div>
                </div>
            </nav>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Content Header -->
                @if(isset($pageTitle) || isset($breadcrumbs))
                <div class="content-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if(isset($pageTitle))
                                <h1 class="h3 mb-0">{{ $pageTitle }}</h1>
                            @endif
                            @if(isset($breadcrumbs))
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        @foreach($breadcrumbs as $breadcrumb)
                                            @if($loop->last)
                                                <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
                                            @else
                                                <li class="breadcrumb-item">
                                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </nav>
                            @endif
                        </div>
                        @yield('header-actions')
                    </div>
                </div>
                @endif
                
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Ada kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Main Content Area -->
                @yield('content')
                
                <!-- Footer -->
                <footer class="mt-5 py-4 border-top text-center" 
                        style="background: linear-gradient(135deg, #f8f9fa, #ffffff); border-top: 2px solid var(--primary-color) !important;">
                    <small style="color: #666;">
                        &copy; {{ date('Y') }} <strong style="color: var(--primary-color);">{{ $company->name ?? config('app.name') }}</strong> Admin Panel | 
                        <span style="color: var(--accent-color);">Laravel {{ app()->version() }}</span> | 
                        <i class="bi bi-lightning-charge" style="color: var(--secondary-color);"></i> 
                        <span style="color: var(--primary-color);">Optimized Performance</span>
                    </small>
                </footer>
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Debug jQuery -->
    <script>
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
        } else {
            console.log('jQuery version:', jQuery.fn.jquery);
        }
    </script>
    
    <!-- Custom Admin JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-persistent)');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    if (bsAlert) {
                        bsAlert.close();
                    }
                }, 5000);
            });
        });
        
        // Confirm delete actions
        document.addEventListener('click', function(e) {
            if (e.target.matches('.btn-delete') || e.target.closest('.btn-delete')) {
                if (!confirm('Yakin ingin menghapus item ini?')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>