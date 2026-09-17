@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div>
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Attendance History</h2>
            <p class="text-muted small">Keep track of your daily presence records.</p>
        </div>
        <a href="/dashboard" class="btn btn-outline-primary rounded-pill px-4 shadow-sm transition-hover">
            <i class="fas fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-pill shadow-sm mb-4 animate-zoom-in">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-pill shadow-sm mb-4 animate-zoom-in">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-lg animate-fade-in-up delay-1 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Date</th>
                        <th class="py-3 text-center">Day</th>
                        <th class="py-3 text-end pe-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                    <tr class="transition-hover">
                        <td class="ps-4 py-3 fw-bold text-dark">
                            <i class="far fa-calendar-alt text-primary me-2"></i>
                            {{ date('d M, Y', strtotime($record->date)) }}
                        </td>
                        <td class="text-center text-muted">
                            {{ date('l', strtotime($record->date)) }}
                        </td>
                        <td class="text-end pe-4">
                            @php
                                $status = $record->status ?? 'Present'; // Default present if logic says so
                                $statusClass = match($status) {
                                    'Present' => 'bg-soft-success text-success',
                                    'Absent' => 'bg-soft-danger text-danger',
                                    'Leave' => 'bg-soft-warning text-warning',
                                    default => 'bg-soft-primary text-primary',
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 fw-bold">
                                {{ $status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="fas fa-history fa-3x mb-3 opacity-25"></i>
                            <p class="mb-0">No attendance records found yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Gradient Theme */
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    
    /* Soft Badges */
    .bg-soft-success { background-color: rgba(28, 200, 138, 0.1); }
    .bg-soft-danger { background-color: rgba(231, 74, 59, 0.1); }
    .bg-soft-warning { background-color: rgba(246, 194, 62, 0.1); }
    .bg-soft-primary { background-color: rgba(78, 115, 223, 0.1); }

    /* Layout & Animations */
    .rounded-4 { border-radius: 1.25rem !important; }
    .transition-hover:hover { background-color: #f8faff !important; }
    
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .animate-zoom-in { animation: zoomIn 0.4s ease-out; }
    .delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }

    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes zoomIn { 0% { opacity: 0; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
</style>
@endsection