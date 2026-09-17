@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 animate-fade-in-down">
        <div class="col-12 text-center">
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Performance Report</h2>
            <p class="text-muted small">Your grade is automatically calculated based on attendance milestones.</p>
        </div>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-5 animate-zoom-in delay-1">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-body p-5 text-center">
                    <h6 class="text-uppercase tracking-widest text-muted fw-bold small mb-4">Total Present Days</h6>
                    <div class="display-3 fw-extrabold text-primary mb-2">{{ $presentDays }}</div>
                    <p class="text-muted small mb-4">Out of 30 days (Monthly Cycle)</p>

                    <div class="grade-circle mx-auto my-4 shadow-sm 
                        {{ $grade == 'A' ? 'border-success text-success' : 
                          ($grade == 'B' ? 'border-info text-info' : 
                          ($grade == 'C' ? 'border-warning text-warning' : 'border-danger text-danger')) }}">
                        <span class="display-1 fw-black">{{ $grade }}</span>
                    </div>
                    
                    <h4 class="fw-bold mt-3">Current Grade</h4>
                </div>
            </div>
        </div>

        <div class="col-md-5 animate-zoom-in delay-2">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-light border-0 py-3">
                    <h6 class="mb-0 fw-bold text-dark px-2"><i class="fas fa-list-ul me-2 text-primary"></i> Grading Criteria</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span><i class="fas fa-award text-success me-2"></i> 26+ Days</span>
                            <span class="badge bg-success rounded-pill px-3">Grade A</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span><i class="fas fa-medal text-info me-2"></i> 20–25 Days</span>
                            <span class="badge bg-info rounded-pill px-3">Grade B</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span><i class="fas fa-star text-warning me-2"></i> 15–19 Days</span>
                            <span class="badge bg-warning text-dark rounded-pill px-3">Grade C</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <span><i class="fas fa-chevron-right text-danger me-2"></i> 10–14 Days</span>
                            <span class="badge bg-danger rounded-pill px-3">Grade D</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4 bg-light">
                            <span><i class="fas fa-exclamation-triangle text-muted me-2"></i> Below 10 Days</span>
                            <span class="badge bg-dark rounded-pill px-3">Grade F</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="/dashboard" class="btn btn-outline-secondary rounded-pill px-5 transition-hover">
            <i class="fas fa-home me-2"></i> Back to Dashboard
        </a>
    </div>
</div>

<style>
    /* Gradient Theme */
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    
    /* Grade Circle Styling */
    .grade-circle {
        width: 160px;
        height: 160px;
        border: 8px solid;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        transition: 0.3s ease;
    }
    
    .grade-circle:hover {
        transform: scale(1.05) rotate(5deg);
    }

    .fw-black { font-weight: 900; }
    .tracking-widest { letter-spacing: 0.1em; }
    .rounded-4 { border-radius: 1.5rem !important; }

    /* Animations */
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-zoom-in { animation: zoomIn 0.5s ease-out; }
    .delay-1 { animation-delay: 0.1s; animation-fill-mode: both; }
    .delay-2 { animation-delay: 0.3s; animation-fill-mode: both; }

    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes zoomIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
    
    .transition-hover:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
</style>
@endsection