@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-in-down">
        <div class="text-start">
            <h1 class="fw-black text-transparent bg-clip-text gradient-purple-text mb-0">Task Workspace</h1>
            <p class="text-muted small mb-0">Manage your assignments and teacher feedback.</p>
        </div>
        <a href="/dashboard" class="btn btn-outline-primary rounded-pill px-4 shadow-sm transition-hover">
            <i class="fas fa-chevron-left me-2"></i> Back to Dashboard
        </a>
    </div>

    @forelse($tasks as $task)
        <div class="task-wrapper mb-5 animate-fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <span class="badge gradient-purple rounded-pill px-3 py-2 shadow-sm">
                    <i class="fas fa-hashtag me-1"></i> ASGN-{{ $task->id }}
                </span>
                <span class="ms-3 badge rounded-pill px-3 py-2 border {{ $task->status == 'Pending' ? 'text-warning border-warning' : 'text-success border-success' }} bg-white">
                   <i class="fas fa-circle me-1 small"></i> {{ $task->status }}
                </span>
            </div>

            <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-light p-4 p-md-5 border-end border-2">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box-small gradient-purple me-2">
                                <i class="fas fa-book-open text-white"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0">{{ $task->title }}</h4>
                        </div>
                        <div class="p-3 rounded-4 bg-white shadow-sm border-start border-4 border-primary mt-4">
                            <p class="mb-0 text-secondary fst-italic">
                                <i class="fas fa-quote-left me-2 opacity-25"></i>{{ $task->description }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-7 p-4 p-md-5 bg-white">
                        <div class="submission-box">
                            <h6 class="fw-bold text-dark mb-3 small text-uppercase tracking-wider">
                                <i class="fas fa-paper-plane me-2 text-primary"></i> Your Submission
                            </h6>
                            
                            @if($task->status == 'Pending')
                                <form action="{{ route('student.tasks.submit', $task->id) }}" method="POST">
                                    @csrf
                                    <textarea name="response" class="form-control premium-input mb-3 shadow-none" 
                                              rows="4" placeholder="Briefly describe your work..." required>{{ old('response') }}</textarea>
                                    <button type="submit" class="btn gradient-purple text-white w-100 rounded-pill py-3 fw-bold shadow-lg hover-scale">
                                        Submit Assignment <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </form>
                            @else
                                <div class="p-3 rounded-4 bg-soft-purple text-dark border border-primary border-opacity-10 mb-3">
                                    <p class="mb-0 small">{{ $task->response }}</p>
                                </div>
                            @endif
                        </div>

                        @if($task->admin_comment)
                        <div class="feedback-container mt-5">
                            <div class="feedback-bubble p-4 rounded-4 shadow-lg animate-zoom-in">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="admin-icon gradient-orange me-2">
                                        <i class="fas fa-user-check text-white"></i>
                                    </div>
                                    <span class="fw-bold text-white small">Admin Feedback:</span>
                                </div>
                                <p class="mb-0 text-white-50 small fst-italic ps-4">
                                    "{{ $task->admin_comment }}"
                                </p>
                                <div class="bubble-arrow"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <div class="bg-light d-inline-block p-4 rounded-circle mb-4">
                <i class="fas fa-check-double fa-3x text-muted opacity-50"></i>
            </div>
            <h4 class="text-secondary fw-bold">All caught up!</h4>
            <p class="text-muted">No new assignments assigned to you.</p>
        </div>
    @endif
</div>

<style>
    /* Theme Gradients */
    .gradient-purple { background: linear-gradient(135deg, #6366f1, #a855f7) !important; }
    .gradient-orange { background: linear-gradient(135deg, #f6c23e, #fb923c) !important; }
    .gradient-purple-text { background: linear-gradient(90deg, #6366f1, #a855f7); background-clip: text; -webkit-background-clip: text; color: transparent; }
    
    .bg-soft-purple { background-color: rgba(99, 102, 241, 0.08); }
    .fw-black { font-weight: 900; }
    .rounded-5 { border-radius: 2rem !important; }

    /* UI Elements */
    .icon-box-small, .admin-icon {
        width: 35px; height: 35px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-size: 0.9rem;
    }

    .premium-input {
        background: #f8fafc; border: 2px solid #f1f5f9; border-radius: 1.2rem;
        padding: 1rem; transition: 0.3s;
    }
    .premium-input:focus { border-color: #6366f1; background: #fff; }

    /* Admin Highlight Bubble */
    .feedback-bubble { background: #1e293b; color: white; position: relative; border-left: 5px solid #fb923c; }
    .bubble-arrow {
        position: absolute; top: -10px; left: 25px;
        border-left: 10px solid transparent; border-right: 10px solid transparent; border-bottom: 10px solid #1e293b;
    }

    /* Animations & Hovers */
    .hover-scale { transition: 0.3s; }
    .hover-scale:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3) !important; }
    .transition-hover:hover { background-color: #6366f1; color: white !important; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out both; }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection