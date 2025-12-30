@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    
    <h2 class="text-center mb-4" style="color: var(--dark-color); font-weight: 700;">Create Account</h2>
    
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
               placeholder="Enter your full name">
        
        @error('name')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" required autocomplete="email"
               placeholder="Enter your email address">
        
        @error('email')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
               name="password" required autocomplete="new-password"
               placeholder="Enter your password">
        
        @error('password')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" 
               name="password_confirmation" required autocomplete="new-password"
               placeholder="Confirm your password">
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-user-plus me-2"></i>{{ __('Register') }}
        </button>
    </div>
    
    <div class="text-center mt-3">
        <a class="text-primary text-decoration-none" href="{{ route('login') }}">
            Already have an account? Login here
        </a>
    </div>
</form>
@endsection
