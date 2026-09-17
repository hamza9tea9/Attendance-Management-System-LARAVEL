@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div>
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Leave Management</h2>
            <p class="text-muted small">Review and respond to student leave applications.</p>
        </div>
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-pill px-4 animate-zoom-in">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card border-0 shadow-lg animate-fade-in-up delay-1 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Student</th>
                        <th class="py-3">Duration</th>
                        <th class="py-3" style="width: 25%;">Reason</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 pe-4 text-center">Action & Decision</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr class="transition-hover">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-soft-primary text-primary rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold">
                                    {{ substr($leave->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $leave->user->name }}</span>
                                    <span class="text-muted extra-small">ID: #{{ $leave->user->id }}</span>
                                </div>
                            </div>
                        </td>
                            <td class="py-3">
                                <div class="small text-dark mb-1">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <span class="text-muted small">From:</span> {{ $leave->from_date }}
                                </div>
                                <div class="small text-dark">
                                    <i class="far fa-calendar-check text-info me-2"></i>
                                    <span class="text-muted small">To:</span> {{ $leave->to_date }}
                                </div>
                            </td>
                        <td class="py-3">
                            <p class="mb-0 small text-dark fst-italic bg-light p-2 rounded-3 border-start border-primary border-3">
                                "{{ Str::limit($leave->reason, 50) }}"
                            </p>
                        </td>
                        <td class="py-3 text-center">
                            @php
                                $statusClass = match($leave->status) {
                                    'Approved' => 'bg-soft-success text-success',
                                    'Rejected' => 'bg-soft-danger text-danger',
                                    default => 'bg-soft-warning text-warning',
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 fw-bold">
                                {{ $leave->status }}
                            </span>
                            @if($leave->admin_comment)
                                <div class="extra-small text-muted mt-1 mt-1" title="{{ $leave->admin_comment }}">
                                    <i class="fas fa-comment-dots"></i> Commented
                                </div>
                            @endif
                        </td>
                        <td class="py-3 pe-4">
                            <form method="POST" action="/admin/leaves/{{ $leave->id }}/update" class="d-flex gap-2 align-items-center">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <select name="status" class="form-select border-0 bg-light shadow-none" required style="max-width: 100px;">
                                        <option value="">Status</option>
                                        <option value="Approved" {{ $leave->status == 'Approved' ? 'selected' : '' }}>Approve</option>
                                        <option value="Rejected" {{ $leave->status == 'Rejected' ? 'selected' : '' }}>Reject</option>
                                    </select>
                                    <input type="text" name="admin_comment" class="form-control border-0 bg-light shadow-none" placeholder="Comment..." required value="{{ $leave->admin_comment }}">
                                    <button type="submit" class="btn btn-primary px-3 shadow-sm border-0">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Custom Styling for Leaves */
    .extra-small { font-size: 0.75rem; }
    .bg-soft-success { background-color: rgba(28, 200, 138, 0.15); }
    .bg-soft-danger { background-color: rgba(231, 74, 59, 0.15); }
    .bg-soft-warning { background-color: rgba(246, 194, 62, 0.15); }
    .bg-soft-primary { background-color: rgba(78, 115, 223, 0.1); }
    
    .form-select, .form-control {
        font-size: 0.85rem;
        transition: 0.3s;
    }
    
    .form-select:focus, .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1) !important;
    }

    .btn-primary { background: linear-gradient(135deg, #4e73df, #22d3ee); }

    /* Standard Theme Styles */
    .fw-extrabold { font-weight: 800; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .rounded-4 { border-radius: 1rem !important; }
    .avatar-sm { width: 38px; height: 38px; font-size: 0.9rem; }
    
    .transition-hover:hover {
        background-color: #fcfcfd !important;
        transform: scale(1.002);
    }

    /* Animations */
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }

    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection