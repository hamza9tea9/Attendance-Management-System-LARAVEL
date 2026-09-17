@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 animate-fade-in-down text-center">
        <div class="col-12">
            <h2 class="fw-extrabold text-transparent bg-clip-text gradient-header mb-2">Create New Task</h2>
            <p class="text-muted fs-6">Assign objectives and provide detailed instructions to your students.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 animate-fade-in-up delay-1">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="gradient-blue shadow-sm py-2"></div>
                
                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-pill px-4 mb-4 animate-zoom-in">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="/admin/tasks/assign" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase tracking-wider">Task Title</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-heading text-primary"></i></span>
                                <input type="text" name="title" class="form-control form-control-lg border-0 bg-light shadow-none" placeholder="Enter task name..." required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase tracking-wider">Assign To Student</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-user-graduate text-primary"></i></span>
                                <select name="assigned_to" class="form-select form-control-lg border-0 bg-light shadow-none" required>
                                    <option value="" selected disabled>Choose a student...</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold text-secondary small text-uppercase tracking-wider">Task Description & Instructions</label>
                            <div class="bg-light rounded-3 p-1">
                                <textarea name="description" rows="6" class="form-control border-0 bg-light shadow-none" placeholder="Provide detailed steps or requirements for the task..." required></textarea>
                            </div>
                            
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn gradient-blue text-white px-5 py-3 fw-bold rounded-pill shadow-lg transition-hover w-100">
                                <i class="fas fa-paper-plane me-2"></i> Launch Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styling for Forms */
    .tracking-wider { letter-spacing: 0.05em; }
    .form-control-lg, .form-select-lg { font-size: 1rem; }
    .input-group-text { border-radius: 0.75rem 0 0 0.75rem !important; }
    .form-control, .form-select { border-radius: 0 0.75rem 0.75rem 0 !important; }
    
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1) !important;
        border: 1px solid #4e73df !important;
    }

    textarea.form-control { border-radius: 0.75rem !important; }

    /* Standard Theme Styles */
    .fw-extrabold { font-weight: 800; }
    .text-transparent { color: transparent; }
    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
    .gradient-header { background-image: linear-gradient(90deg, #4e73df, #22d3ee); }
    .gradient-blue { background-image: linear-gradient(135deg, #4e73df, #22d3ee) !important; }
    .rounded-4 { border-radius: 1.25rem !important; }
    
    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(78, 115, 223, 0.3) !important;
    }

    /* Animations */
    .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    .delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }

    @keyframes fadeInDown { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection