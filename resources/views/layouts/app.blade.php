<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-color: #2176C1;
            --secondary-color: #FED31A;
            --accent-color: #EF3A3F;
            --dark-color: #000000;
        }
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, rgba(33, 118, 193, 0.8) 100%);
        }
        
        .auth-card {
            max-width: 400px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
        }
        
        .auth-header {
            padding: 30px 30px 20px;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
        }
        
        .auth-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 10px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .auth-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .auth-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            margin-top: 5px;
            margin-bottom: 0;
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(33, 118, 193, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), rgba(33, 118, 193, 0.9));
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 118, 193, 0.3);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
    </style>
</head>
<body>
    @php
        $company = App\Models\Company::getSettings();
    @endphp
    
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="auth-logo">
                @else
                    <div class="auth-logo d-flex align-items-center justify-content-center" style="font-size: 2rem; font-weight: bold; color: var(--primary-color);">
                        {{ strtoupper(substr($company->name, 0, 1)) }}
                    </div>
                @endif
                <h1 class="auth-title">{{ $company->name }}</h1>
                @if($company->tagline)
                    <p class="auth-subtitle">{{ $company->tagline }}</p>
                @endif
            </div>
            <div class="auth-body">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
