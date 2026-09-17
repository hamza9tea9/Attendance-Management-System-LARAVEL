@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 animate-fade-in-up">
            
            <div class="text-center mb-4">
                <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Apply for Leave</h2>
                <p class="text-muted small">Please provide valid dates and a clear reason.</p>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="gradient-orange shadow-sm py-2"></div>
                
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('leave.request') }}">
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="form-label fw-bold text-secondary small text-uppercase">From Date</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden border-0">
                                    <span class="input-group-text bg-light border-0"><i class="far fa-calendar-alt text-warning"></i></span>
                                    <input type="date" name="from_date" class="form-control border-0 bg-light" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold text-secondary small text-uppercase">To Date</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden border-0">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-calendar-check text-warning"></i></span>
                                    <input type="date" name="to_date" class="form-control border-0 bg-light" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Reason for Leave</label>
                            <div class="bg-light rounded-3 p-1 shadow-sm">
                                <textarea name="reason" rows="4" class="form-control border-0 bg-light shadow-none" placeholder="Briefly explain why you need leave..." required></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn gradient-orange text-white w-100 py-3 fw-bold rounded-pill shadow-lg transition-hover mb-3">
                                <i class="fas fa-paper-plane me-2"></i> Submit Request
                            </button>
                            
                            <a href="{{ route('dashboard') }}" class="text-muted text-decoration-none small transition-hover d-block">
                                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradient Theme */
    .gradient-header { background-image: linear-gradient(90deg, #f6c23e, #fb923c); }
    .gradient-orange { background-image: linear-gradient(135deg, #f6c23e, #fb923c) !important; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    
    /* Form Elements */
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(246, 194, 62, 0.15) !important;
    }
    
    .input-group-text { font-size: 0.9rem; }
    .rounded-4 { border-radius: 1.5rem !important; }
    
    /* Animations */
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }

    .transition-hover { transition: 0.3s ease; }
    .transition-hover:hover { transform: translateY(-3px); opacity: 0.9; }
</style>
@endsection