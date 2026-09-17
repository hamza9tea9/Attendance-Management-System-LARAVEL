@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div>
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Attendance Analytics</h2>
            <p class="text-muted small">Generated Report Results</p>
        </div>
        <a href="{{ url('/admin/attendance/report') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm transition-hover">
            <i class="fas fa-arrow-left me-2"></i> New Search
        </a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4 animate-zoom-in delay-1">
            <div class="card border-0 shadow-lg glow-card gradient-green text-white">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="stats-icon bg-white text-success rounded-circle me-3 shadow">
                        <i class="fas fa-user-check fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 op-8">Present</h6>
                        <h2 class="fw-bold mb-0">{{ $present }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-zoom-in delay-2">
            <div class="card border-0 shadow-lg glow-card gradient-red text-white">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="stats-icon bg-white text-danger rounded-circle me-3 shadow">
                        <i class="fas fa-user-times fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 op-8">Absent</h6>
                        <h2 class="fw-bold mb-0">{{ $absent }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-zoom-in delay-3">
            <div class="card border-0 shadow-lg glow-card gradient-blue text-white">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="stats-icon bg-white text-primary rounded-circle me-3 shadow">
                        <i class="fas fa-calendar-minus fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 op-8">Leave</h6>
                        <h2 class="fw-bold mb-0">{{ $leave }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg animate-fade-in-up delay-4 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Student Name</th>
                        <th class="py-3 text-center">Date</th>
                        <th class="py-3 text-end pe-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                    <tr class="transition-hover">
                        <td class="ps-4 py-3 fw-semibold text-dark">{{ $attendance->user->name }}</td>
                        <td class="text-center text-muted">{{ $attendance->date }}</td>
                        <td class="text-end pe-4"><span class="badge bg-soft-success text-success px-3">Present</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center py-5 text-muted">No records found for this period.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .fw-extrabold { font-weight: 800; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .gradient-green { background-image: linear-gradient(135deg, #1cc88a, #34d399) !important; }
    .gradient-red { background-image: linear-gradient(135deg, #e74a3b, #f87171) !important; }
    .gradient-blue { background-image: linear-gradient(135deg, #4e73df, #22d3ee) !important; }
    .stats-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; }
    .bg-soft-success { background-color: rgba(28, 200, 138, 0.1); }
    .op-8 { opacity: 0.8; }
    .animate-zoom-in { animation: zoomIn 0.5s ease-out; }
    .delay-1 { animation-delay: 0.1s; animation-fill-mode: both; }
    .delay-2 { animation-delay: 0.2s; animation-fill-mode: both; }
    .delay-3 { animation-delay: 0.3s; animation-fill-mode: both; }
    @keyframes zoomIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
</style>
@endsection