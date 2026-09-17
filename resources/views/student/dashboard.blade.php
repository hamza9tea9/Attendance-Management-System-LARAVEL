@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 animate-fade-in-down">
        <div class="col-12 text-center text-md-start">
            <h1 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-2">
                Welcome, {{ Auth::user()->name }}! 👋
            </h1>
            <p class="text-muted fs-5">Student Portal — Manage your presence and performance.</p>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4 col-sm-6 animate-zoom-in delay-1">
            <a href="{{ route('attendance.show') }}" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-blue rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="img-container mb-3 mx-auto shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/3242/3242257.png" alt="Mark" class="img-fluid floating-img">
                        </div>
                        <h5 class="fw-bold mb-1">Mark Attendance</h5>
                        <p class="extra-small op-8">Submit your daily presence</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-2">
            <a href="{{ url('/attendance/status') }}" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-blue-dark rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="img-container mb-3 mx-auto shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/2666/2666505.png" alt="Status" class="img-fluid floating-img">
                        </div>
                        <h5 class="fw-bold mb-1">View Attendance</h5>
                        <p class="extra-small op-8">Check your history</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-3">
            <a href="{{ url('/leave/request') }}" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-orange rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="img-container mb-3 mx-auto shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/2855/2855146.png" alt="Leave" class="img-fluid floating-img">
                        </div>
                        <h5 class="fw-bold mb-1">Mark Leave</h5>
                        <p class="extra-small op-8">Submit leave request</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-4">
            <a href="{{ url('/leave/status') }}" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-orange-dark rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="img-container mb-3 mx-auto shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/1904/1904527.png" alt="Status" class="img-fluid floating-img">
                        </div>
                        <h5 class="fw-bold mb-1">Leave Status</h5>
                        <p class="extra-small op-8">Approved or Pending?</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-5">
            <a href="{{ url('/student/grade') }}" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-green rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="img-container mb-3 mx-auto shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/1904/1904425.png" alt="Grades" class="img-fluid floating-img">
                        </div>
                        <h5 class="fw-bold mb-1">View Grade</h5>
                        <p class="extra-small op-8">Academic performance</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-6">
            <a href="{{ url('/student/tasks') }}" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-purple rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="img-container mb-3 mx-auto shadow-sm">
                            <img src="https://cdn-icons-png.flaticon.com/512/2092/2092100.png" alt="Tasks" class="img-fluid floating-img">
                        </div>
                        <h5 class="fw-bold mb-1">View Tasks</h5>
                        <p class="extra-small op-8">Assignments & Deadlines</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
    /* Gradients matching your theme */
    .gradient-blue { background-image: linear-gradient(135deg, #4e73df, #22d3ee) !important; }
    .gradient-blue-dark { background-image: linear-gradient(135deg, #2e59d9, #4e73df) !important; }
    .gradient-orange { background-image: linear-gradient(135deg, #f6c23e, #fb923c) !important; }
    .gradient-orange-dark { background-image: linear-gradient(135deg, #e67e22, #f39c12) !important; }
    .gradient-green { background-image: linear-gradient(135deg, #1cc88a, #34d399) !important; }
    .gradient-purple { background-image: linear-gradient(135deg, #6366f1, #a855f7) !important; }

    /* Pictorial/Image Box */
    .img-container {
        width: 70px; height: 70px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        padding: 12px;
    }

    .floating-img {
        filter: brightness(0) invert(1); /* Makes icons White */
        max-width: 100%; transition: 0.3s ease;
    }

    .card:hover .floating-img { transform: scale(1.15) rotate(5deg); }

    /* Core Styling */
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .rounded-4 { border-radius: 1.25rem !important; }
    .extra-small { font-size: 0.75rem; }
    .op-8 { opacity: 0.8; }
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important; }

    /* Animations */
    .animate-zoom-in { animation: zoomIn 0.5s ease-out both; }
    .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.15s; }
    .delay-3 { animation-delay: 0.2s; } .delay-4 { animation-delay: 0.25s; }
    .delay-5 { animation-delay: 0.3s; } .delay-6 { animation-delay: 0.35s; }

    @keyframes zoomIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
</style>
@endsection