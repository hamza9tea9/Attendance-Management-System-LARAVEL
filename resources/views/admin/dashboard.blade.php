@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="display-5 fw-extrabold text-transparent bg-clip-text gradient-header animate-fade-in-down">
                Welcome, Admin
            </h1>
            <p class="text-muted fs-5 animate-fade-in-up">Manage your realm with ease and style.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4 col-sm-6 animate-zoom-in delay-1">
            <a href="/admin/attendance/report" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-blue text-center">
                    <div class="card-body p-4">
                        <div class="icon-box bg-white text-primary rounded-circle shadow mb-3">
                            <i class="fas fa-clipboard-check fa-2x"></i>
                        </div>
                        <h5 class="card-title fw-bold">Attendance</h5>
                        <p class="card-text small op-8">View daily presence reports.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-2">
            <a href="/admin/grades" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-green text-center">
                    <div class="card-body p-4">
                        <div class="icon-box bg-white text-success rounded-circle shadow mb-3">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                        <h5 class="card-title fw-bold">Performance</h5>
                        <p class="card-text small op-8">Grade statistics.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 animate-zoom-in delay-3">
            <a href="/admin/leaves" class="text-decoration-none text-white">
                <div class="card h-100 border-0 shadow-lg glow-card transition-hover gradient-orange text-center">
                    <div class="card-body p-4">
                        <div class="icon-box bg-white text-warning rounded-circle shadow mb-3">
                            <i class="fas fa-envelope-open-text fa-2x"></i>
                        </div>
                        <h5 class="card-title fw-bold">Requests</h5>
                        <p class="card-text small op-8">Pending leave decisions.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4 animate-fade-in-up delay-4">
        <div class="col-md-6">
            <div class="card shadow border-0 list-card transition-hover">
                <a href="/admin/tasks/assign" class="stretched-link text-decoration-none">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="icon-shape bg-soft-info text-info rounded-3 p-3">
                            <i class="fas fa-plus-circle fa-xl"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1 text-dark">Assign New Task</h6>
                            <p class="text-muted small mb-0">Delegate work quickly.</p>
                        </div>
                        <i class="fas fa-arrow-right text-info ms-auto fs-5 arrow-animate"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow border-0 list-card transition-hover">
                <a href="/admin/tasks/review" class="stretched-link text-decoration-none">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="icon-shape bg-soft-dark text-dark rounded-3 p-3">
                            <i class="fas fa-check-double fa-xl"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-1 text-dark">Review Submissions</h6>
                            <p class="text-muted small mb-0">Check team performance.</p>
                        </div>
                        <i class="fas fa-arrow-right text-dark ms-auto fs-5 arrow-animate"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- Modern Typography --- */
    .fw-extrabold { font-weight: 800; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .text-white .card-title, .text-white .card-text { color: white !important; }
    .op-8 { opacity: 0.8; }

    /* --- Gradients --- */
    .gradient-blue { background-image: linear-gradient(135deg, #4e73df, #22d3ee) !important; }
    .gradient-green { background-image: linear-gradient(135deg, #1cc88a, #34d399) !important; }
    .gradient-orange { background-image: linear-gradient(135deg, #f6c23e, #fb923c) !important; }
    .bg-soft-info { background-color: rgba(34, 211, 238, 0.1); }
    .bg-soft-dark { background-color: rgba(90, 92, 105, 0.1); }

    /* --- Hover & Glow Effects --- */
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .card:hover { transform: translateY(-7px) !important; box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important; }
    .glow-card:hover { box-shadow: 0 0.5rem 2rem rgba(78, 115, 223, 0.4) !important; }
    .list-card:hover { border: 1px solid #4e73df; }
    .arrow-animate { transition: transform 0.3s ease; }
    .card:hover .arrow-animate { transform: translateX(5px); }
    
    /* --- Shapes --- */
    .icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 65px; height: 65px;
    }
    .icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* --- Keyframe Animations --- */
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .animate-zoom-in { animation: zoomIn 0.5s ease-out; }
    .delay-1 { animation-delay: 0.1s; animation-fill-mode: both; }
    .delay-2 { animation-delay: 0.2s; animation-fill-mode: both; }
    .delay-3 { animation-delay: 0.3s; animation-fill-mode: both; }
    .delay-4 { animation-delay: 0.4s; animation-fill-mode: both; }

    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes zoomIn {
        0% { opacity: 0; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection