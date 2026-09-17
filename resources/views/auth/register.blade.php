@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden animate-fade-in-up">
                <div class="gradient-purple" style="height: 6px;"></div>
                
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="bg-soft-primary d-inline-block p-3 rounded-circle mb-3">
                            <i class="fas fa-user-plus fa-2x text-primary"></i>
                        </div>
                        <h3 class="fw-black text-dark">Create Account</h3>
                        <p class="text-muted small">Join us today! It only takes a minute to set up your profile.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase tracking-wider">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="far fa-user text-muted"></i></span>
                                <input id="name" type="text" class="form-control bg-light border-0 @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="e.g. Ali Khan">
                            </div>
                            @error('name')
                                <span class="text-danger extra-small mt-1 d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase tracking-wider">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="far fa-envelope text-muted"></i></span>
                                <input id="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ali@example.com">
                            </div>
                            @error('email')
                                <span class="text-danger extra-small mt-1 d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted text-uppercase tracking-wider">Password</label>
                                <input id="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password" placeholder="••••••••">
                                @error('password')
                                    <span class="text-danger extra-small mt-1 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label class="form-label small fw-bold text-muted text-uppercase tracking-wider">Confirm</label>
                                <input id="password-confirm" type="password" class="form-control bg-light border-0" 
                                       name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                            </div>
                        </div>

                        <button type="submit" class="btn gradient-purple text-white w-100 py-3 rounded-pill fw-bold shadow-lg hover-scale mb-4">
                            Create My Account <i class="fas fa-arrow-right ms-2"></i>
                        </button>

                        <div class="text-center">
                            <p class="text-muted small">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Same styling as Login for perfect consistency */
    .gradient-purple { background: linear-gradient(135deg, #6366f1, #a855f7) !important; }
    .bg-soft-primary { background-color: rgba(99, 102, 241, 0.1); }
    .rounded-5 { border-radius: 2rem !important; }
    .extra-small { font-size: 0.75rem; }
    
    .form-control { 
        padding: 12px; 
        font-size: 0.9rem;
        border-radius: 0 12px 12px 0; 
    }
    
    /* Responsive adjustment for password fields */
    @media (min-width: 768px) {
        .col-md-6 .form-control { border-radius: 12px; }
    }

    .input-group-text { border-radius: 12px 0 0 12px; }
    
    .form-control:focus { 
        background-color: #fff !important; 
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.05) !important;
        border: 1px solid #6366f1 !important;
    }

    .hover-scale { transition: 0.3s; }
    .hover-scale:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2) !important; }
    
    .fw-black { font-weight: 900; }

    /* Animation */
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out both; }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection