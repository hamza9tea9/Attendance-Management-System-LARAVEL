@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden animate-fade-in-up">
                <div class="gradient-purple" style="height: 6px;"></div>
                
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="bg-soft-primary d-inline-block p-3 rounded-circle mb-3">
                            <i class="fas fa-user-lock fa-2x text-primary"></i>
                        </div>
                        <h3 class="fw-black text-dark">Welcome Back!</h3>
                        <p class="text-muted small">Please enter your credentials to access your portal.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase tracking-wider">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="far fa-envelope text-muted"></i></span>
                                <input id="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                            </div>
                            @error('email')
                                <span class="text-danger extra-small mt-1 d-block" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label class="form-label small fw-bold text-muted text-uppercase tracking-wider">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="extra-small text-decoration-none text-primary fw-bold" href="{{ route('password.request') }}">Forgot?</a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-key text-muted"></i></span>
                                <input id="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="text-danger extra-small mt-1 d-block" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">Keep me logged in</label>
                            </div>
                        </div>

                        <button type="submit" class="btn gradient-purple text-white w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale mb-4">
                            Login to Portal <i class="fas fa-sign-in-alt ms-2"></i>
                        </button>

                        <div class="text-center">
                            <p class="text-muted small">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-purple { background: linear-gradient(135deg, #6366f1, #a855f7) !important; }
    .bg-soft-primary { background-color: rgba(99, 102, 241, 0.1); }
    .extra-small { font-size: 0.75rem; }
    .rounded-5 { border-radius: 2rem !important; }
    .form-control:focus { background-color: #fff !important; box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.15) !important; }
    .input-group-text { border-radius: 12px 0 0 12px; }
    .form-control { border-radius: 0 12px 12px 0; padding: 12px; }
    .hover-scale { transition: 0.3s; }
    .hover-scale:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2) !important; }
    .fw-black { font-weight: 900; }
</style>
@endsection