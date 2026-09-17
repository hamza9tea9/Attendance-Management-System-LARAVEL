@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center animate-fade-in-up">
            <div class="mb-5">
                <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Daily Attendance</h2>
                <p class="text-muted small">Clock in for today: {{ date('D, d M Y') }}</p>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
                <div class="card-body p-5">
                    <div class="attendance-icon-circle mx-auto mb-4 {{ $alreadyMarked ? 'bg-soft-info' : 'bg-soft-success animate-pulse' }}">
                        @if($alreadyMarked)
                            <i class="fas fa-calendar-check text-info fa-3x"></i>
                        @else
                            <i class="fas fa-fingerprint text-success fa-3x"></i>
                        @endif
                    </div>

                    @if($alreadyMarked)
                        <div class="alert alert-info border-0 rounded-pill shadow-sm mb-4">
                            <i class="fas fa-info-circle me-2"></i> You have already marked attendance today!
                        </div>
                        <button class="btn btn-secondary btn-lg w-100 rounded-pill py-3 fw-bold disabled opacity-50">
                            <i class="fas fa-lock me-2"></i> Attendance Logged
                        </button>
                    @else
                        <h4 class="fw-bold text-dark mb-4">Ready to Clock In?</h4>
                        <form action="/attendance/mark" method="POST">
                            @csrf
                            <button type="submit" class="btn gradient-green text-white btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg transition-hover">
                                <i class="fas fa-sign-in-alt me-2"></i> Mark Attendance Now
                            </button>
                        </form>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger border-0 rounded-pill shadow-sm mt-4 animate-zoom-in">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-pill shadow-sm mt-4 animate-zoom-in">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <a href="/dashboard" class="text-muted text-decoration-none small transition-hover">
                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<style>
    /* Gradient Theme */
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .gradient-green { background-image: linear-gradient(135deg, #1cc88a, #34d399) !important; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    
    /* Attendance Visuals */
    .attendance-icon-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }
    
    .bg-soft-success { background-color: rgba(28, 200, 138, 0.1); }
    .bg-soft-info { background-color: rgba(54, 185, 204, 0.1); }

    /* Animations */
    .animate-pulse {
        animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(28, 200, 138, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 15px rgba(28, 200, 138, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(28, 200, 138, 0); }
    }

    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .animate-zoom-in { animation: zoomIn 0.4s ease-out; }

    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes zoomIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }

    .rounded-4 { border-radius: 1.5rem !important; }
    .transition-hover:hover { opacity: 0.9; transform: translateY(-2px); }
</style>
@endsection