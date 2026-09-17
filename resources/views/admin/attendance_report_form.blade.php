@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center animate-fade-in-up">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header gradient-blue text-white py-4 text-center">
                    <h3 class="fw-bold mb-0">Generate Attendance Report</h3>
                    <p class="op-8 mb-0">Select student and date range</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ url('/admin/attendance/report') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Select Student (Optional)</label>
                            <select name="student_id" class="form-select form-control-lg border-0 bg-light shadow-sm">
                                <option value="">All Students</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary small text-uppercase">From Date</label>
                                <input type="date" name="from_date" class="form-control form-control-lg border-0 bg-light shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary small text-uppercase">To Date</label>
                                <input type="date" name="to_date" class="form-control form-control-lg border-0 bg-light shadow-sm" required>
                            </div>
                        </div>
                        <button type="submit" class="btn gradient-blue text-white w-100 py-3 fw-bold rounded-pill shadow transition-hover mt-2">
                            Fetch Report <i class="fas fa-search-analytics ms-2"></i>
                        </button>
                    </form>
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
    .gradient-blue { background-image: linear-gradient(135deg, #4e73df, #22d3ee) !important; }
    .rounded-4 { border-radius: 1.5rem !important; }
    .op-8 { opacity: 0.8; }
    .transition-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(78,115,223,0.3) !important; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }
    @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
</style>
@endsection