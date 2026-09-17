@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div>
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Academic Performance</h2>
            <p class="text-muted small">Automatic grading based on attendance milestones.</p>
        </div>
        <div class="bg-soft-primary p-2 px-3 rounded-pill border border-primary-subtle shadow-sm">
            <span class="text-primary fw-bold small"><i class="fas fa-award me-1"></i> Live Grading Enabled</span>
        </div>
    </div>

    <div class="card border-0 shadow-lg animate-zoom-in delay-1 rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="fw-bold mb-0 text-dark px-2">Student Rankings</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Student</th>
                        <th class="py-3 text-center">Attendance Progress</th>
                        <th class="py-3 text-center">Days Present</th>
                        <th class="py-3 text-end pe-4">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($summary as $item)
                    <tr class="transition-hover">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-gradient-dark text-white rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold shadow-sm">
                                    {{ substr($item['student'], 0, 1) }}
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $item['student'] }}</span>
                                    <span class="text-muted small">Active Student</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="min-width: 200px;">
                            <div class="progress rounded-pill shadow-inner" style="height: 8px;">
                                @php
                                    $percentage = ($item['present_days'] / 30) * 100; // Assuming 30 is max
                                    $color = $item['grade'] == 'A' ? 'bg-success' : ($item['grade'] == 'B' ? 'bg-info' : ($item['grade'] == 'F' ? 'bg-danger' : 'bg-warning'));
                                @endphp
                                <div class="progress-bar {{ $color }} animate-slide-right" role="progressbar" style="width: {{ $percentage }}%"></div>
                            </div>
                        </td>
                        <td class="text-center fw-semibold text-secondary">
                            <span class="badge bg-light text-dark border shadow-sm px-3 py-2 rounded-pill">
                                {{ $item['present_days'] }} Days
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            @php
                                $badgeClass = match($item['grade']) {
                                    'A' => 'bg-success',
                                    'B' => 'bg-info',
                                    'C' => 'bg-warning text-dark',
                                    'D' => 'bg-secondary',
                                    default => 'bg-danger',
                                };
                            @endphp
                            <div class="grade-badge {{ $badgeClass }} shadow-sm">
                                {{ $item['grade'] }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* --- Grade Specific Styles --- */
    .grade-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 1.2rem;
        color: white;
        transition: 0.3s;
    }
    
    .grade-badge:hover {
        transform: rotate(10deg) scale(1.1);
    }

    .bg-gradient-dark { background: linear-gradient(135deg, #2c3e50, #000000); }
    .shadow-inner { box-shadow: inset 0 2px 4px rgba(0,0,0,0.06); }
    
    /* --- Animations --- */
    .animate-slide-right {
        animation: slideRight 1.5s ease-out forwards;
    }

    @keyframes slideRight {
        0% { width: 0%; }
    }

    /* Standard Theme Styles */
    .fw-extrabold { font-weight: 800; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .rounded-4 { border-radius: 1rem !important; }
    .bg-soft-primary { background-color: rgba(78, 115, 223, 0.1); }
    .avatar-sm { width: 40px; height: 40px; }
    
    .transition-hover:hover {
        background-color: #f8f9fc !important;
        transition: 0.3s;
    }
</style>
@endsection