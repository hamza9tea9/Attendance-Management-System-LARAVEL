@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div>
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Leave Status</h2>
            <p class="text-muted small">Track your leave applications and admin feedback.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-warning rounded-pill px-4 shadow-sm transition-hover">
            <i class="fas fa-arrow-left me-2"></i> Dashboard
        </a>
    </div>

    @if($leaves->count() > 0)
    <div class="card border-0 shadow-lg animate-fade-in-up delay-1 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold">Duration</th>
                        <th class="py-3 text-uppercase small fw-bold">Reason</th>
                        <th class="py-3 text-center text-uppercase small fw-bold">Status</th>
                        <th class="py-3 pe-4 text-uppercase small fw-bold">Admin Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr class="transition-hover">
                        <td class="ps-4 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark small">
                                    <i class="far fa-calendar-alt text-warning me-1"></i> {{ date('d M', strtotime($leave->from_date)) }} 
                                    <i class="fas fa-long-arrow-alt-right mx-1 text-muted"></i> 
                                    {{ date('d M, Y', strtotime($leave->to_date)) }}
                                </span>
                            </div>
                        </td>
                        <td class="py-3 text-muted small" style="max-width: 250px;">
                            <i class="fas fa-quote-left opacity-25 me-1"></i> {{ $leave->reason }}
                        </td>
                        <td class="py-3 text-center">
                            @php
                                $statusClass = match($leave->status) {
                                    'Approved' => 'bg-soft-success text-success',
                                    'Rejected' => 'bg-soft-danger text-danger',
                                    default => 'bg-soft-warning text-warning',
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 fw-bold shadow-sm">
                                {{ $leave->status }}
                            </span>
                        </td>
                        <td class="py-3 pe-4">
                            @if($leave->admin_comment)
                                <div class="p-2 bg-light rounded-3 border-start border-3 border-secondary small text-dark fst-italic">
                                    "{{ $leave->admin_comment }}"
                                </div>
                            @else
                                <span class="text-muted extra-small">No comments yet</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
        <div class="text-center py-5 animate-zoom-in">
            <div class="icon-circle bg-light d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 100px; height: 100px; border-radius: 50%;">
                <i class="fas fa-paper-plane text-muted opacity-25 fa-3x"></i>
            </div>
            <h4 class="text-secondary fw-bold">No Leave Requests</h4>
            <p class="text-muted mx-auto" style="max-width: 300px;">
                You haven't submitted any leave applications yet.
            </p>
        </div>
    @endif
</div>

<style>
    /* Gradient Theme */
    .gradient-header { background-image: linear-gradient(90deg, #f6c23e, #fb923c); }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    
    /* Soft Badges */
    .bg-soft-success { background-color: rgba(28, 200, 138, 0.15); }
    .bg-soft-danger { background-color: rgba(231, 74, 59, 0.15); }
    .bg-soft-warning { background-color: rgba(246, 194, 62, 0.15); }

    /* Layout & UI */
    .extra-small { font-size: 0.75rem; }
    .rounded-4 { border-radius: 1.25rem !important; }
    .transition-hover:hover { background-color: #fffbf2 !important; transition: 0.2s; }
    
    /* Animations */
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }

    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection