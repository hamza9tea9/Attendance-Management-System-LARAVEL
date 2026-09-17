@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div>
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-1">Tasks for Review</h2>
            <p class="text-muted small">Evaluate submissions and provide constructive feedback.</p>
        </div>
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-pill px-4 animate-zoom-in">
                <i class="fas fa-check-double me-2"></i> {{ session('success') }}
            </div>
        @endif
    </div>

    @if($tasks->count() > 0)
    <div class="card border-0 shadow-lg animate-fade-in-up delay-1 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Task Details</th>
                        <th class="py-3">Student</th>
                        <th class="py-3" style="width: 20%;">Student Response</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 pe-4 text-center">Decision Panel</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $statusColors = [
                            'Pending' => 'bg-soft-secondary text-secondary',
                            'Completed' => 'bg-soft-info text-info',
                            'Approved' => 'bg-soft-success text-success',
                            'Rejected' => 'bg-soft-danger text-danger',
                        ];
                    @endphp
                    @foreach($tasks as $task)
                    <tr class="transition-hover">
                        <td class="ps-4 py-3">
                            <h6 class="fw-bold text-dark mb-1">{{ $task->title }}</h6>
                            <p class="text-muted small mb-0 text-truncate" style="max-width: 200px;" title="{{ $task->description }}">
                                {{ $task->description }}
                            </p>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-dark text-white rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold small">
                                    {{ substr($task->assignedUser->name ?? 'N', 0, 1) }}
                                </div>
                                <span class="fw-semibold small">{{ $task->assignedUser->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="bg-light p-2 rounded-3 border-start border-3 border-info">
                                <p class="extra-small mb-0 text-dark fst-italic">
                                    "{{ $task->response ?? 'No response yet' }}"
                                </p>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge rounded-pill {{ $statusColors[$task->status] ?? 'bg-secondary' }} px-3 py-2 fw-bold">
                                {{ $task->status }}
                            </span>
                            @if($task->admin_comment)
                                <div class="extra-small text-muted mt-1 fst-italic">
                                    <i class="fas fa-comment-dots"></i> {{ Str::limit($task->admin_comment, 20) }}
                                </div>
                            @endif
                        </td>
                        <td class="py-3 pe-4">
                            @if($task->status == 'Completed')
                                <form action="{{ route('admin.tasks.submitReview', $task->id) }}" method="POST" class="p-2 bg-light rounded-3 shadow-sm border">
                                    @csrf
                                    <div class="d-flex gap-1 mb-2">
                                        <select name="status" class="form-select form-select-sm border-0 shadow-none bg-white" required>
                                            <option value="">Decision</option>
                                            <option value="Approved">Approve</option>
                                            <option value="Rejected">Reject</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm rounded-2">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                    <textarea name="admin_comment" class="form-control form-control-sm border-0 shadow-none bg-white" placeholder="Add feedback..." rows="1" required></textarea>
                                </form>
                            @else
                                <div class="text-center">
                                    <span class="text-muted small"><i class="fas fa-lock me-1"></i> Reviewed</span>
                                </div>
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
            <div class="empty-state-icon mb-4">
                <div class="icon-circle bg-light d-inline-flex align-items-center justify-content-center">
                    <i class="fas fa-inbox text-muted opacity-25 fa-4x"></i>
                </div>
            </div>
            <h4 class="text-secondary fw-bold mb-2">No Tasks for Review</h4>
            <p class="text-muted mx-auto mb-4" style="max-width: 350px;">
                Currently, there are no pending student submissions that require your attention.
            </p>
            <a href="/dashboard" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm transition-hover">
                Return to Dashboard
            </a>
        </div>
    @endif
</div>

<style>
    /* Custom Styling */
    .extra-small { font-size: 0.75rem; }
    .bg-soft-success { background-color: rgba(28, 200, 138, 0.15); }
    .bg-soft-danger { background-color: rgba(231, 74, 59, 0.15); }
    .bg-soft-info { background-color: rgba(54, 185, 204, 0.15); }
    .bg-soft-secondary { background-color: rgba(133, 135, 150, 0.15); }
    
    .form-select-sm, .form-control-sm { font-size: 0.75rem; }
    .btn-primary { background: linear-gradient(135deg, #4e73df, #22d3ee); border: none; }
    
    .avatar-sm { width: 32px; height: 32px; }
    .rounded-4 { border-radius: 1rem !important; }
    
    /* Hover & Transitions */
    .transition-hover:hover {
        background-color: #f8faff !important;
        transition: 0.2s ease-in-out;
    }

    /* Standard Header Styles */
    .fw-extrabold { font-weight: 800; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }

    /* Animations */
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }

    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection