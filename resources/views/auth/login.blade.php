@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <h2 class="text-center mb-4" style="color: var(--dark-color); font-weight: 700;">Welcome Back</h2>
    
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
               name="password" required autocomplete="current-password"
               placeholder="Enter your password">
        
        @error('password')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-sign-in-alt me-2"></i>{{ __('Login') }}
        </button>
        
        <button type="button" class="btn btn-outline-success" id="autoFillBtn" onclick="autoFillAdmin()">
            <i class="fas fa-user-shield me-2"></i> Auto Fill Admin
        </button>
    </div>
    
    @if (Route::has('password.request'))
        <div class="text-center mt-3">
            <a class="text-primary text-decoration-none" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
    @endif
</form>

<script>
function autoFillAdmin() {
    document.getElementById('email').value = 'admin@cms.com';
    document.getElementById('password').value = 'password';
    
    // Add visual feedback
    const button = document.getElementById('autoFillBtn');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check me-2"></i> Filled!';
    button.classList.remove('btn-outline-success');
    button.classList.add('btn-success');
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-success');
    }, 1500);
}
</script>
@endsection
