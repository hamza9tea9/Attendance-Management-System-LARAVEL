<?php

use Illuminate\Support\Facades\Route;

/* ======================
   AUTH CONTROLLERS
====================== */
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/* ======================
   APP CONTROLLERS
====================== */
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminLeaveController;
use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\TaskController; // <-- TaskController now outside Admin folder
use App\Http\Controllers\DashboardController;
/* ======================
   DEFAULT ROUTE
====================== */
Route::get('/', function () {
    return redirect('/login');
});

/* ======================
   AUTH ROUTES
====================== */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/* ======================
   DASHBOARD ROUTE
====================== */
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/* ======================
   STUDENT ROUTES (AUTHENTICATED)
====================== */
Route::middleware(['auth'])->group(function () {

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance.show');
    Route::post('/attendance/mark', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/attendance/status', [AttendanceController::class, 'viewAttendance'])->name('attendance.status');

    // Leave
    Route::get('/leave/request', [LeaveController::class, 'showLeaveForm'])->name('leave.show');
    Route::post('/leave/request', [LeaveController::class, 'store'])->name('leave.request');
    Route::get('/leave/status', [LeaveController::class, 'viewStatus'])->name('leave.status');

    // Student report
    Route::get('/attendance/student-report', [AttendanceReportController::class, 'studentReport'])->name('attendance.student.report');

    // Student grade
    Route::get('/student/grade', [LeaveController::class, 'viewGrade'])->name('student.grade');

    // Student tasks
    Route::get('/student/tasks', [TaskController::class, 'studentTasks'])->name('student.tasks');
    Route::post('/student/tasks/{id}/submit', [TaskController::class, 'submitTask'])->name('student.tasks.submit');
});

/* ======================
   ADMIN ROUTES (AUTH + IS_ADMIN)
====================== */
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Leave approval
    Route::get('/admin/leaves', [AdminLeaveController::class, 'index'])->name('admin.leaves');
    Route::post('/admin/leaves/{id}/update', [AdminLeaveController::class, 'update'])->name('admin.leaves.update');

    // Attendance reports
    Route::get('/admin/attendance/report', [AdminAttendanceController::class, 'showReportForm'])->name('admin.attendance.report.form');
    Route::post('/admin/attendance/report', [AdminAttendanceController::class, 'generateReport'])->name('admin.attendance.report.generate');

    // Grade summary
    Route::get('/admin/grades', [AdminAttendanceController::class, 'gradeSummary'])->name('admin.grades');

    // Admin tasks
    Route::get('/admin/tasks/assign', [TaskController::class, 'showAssignForm'])->name('admin.tasks.assign.form');
    Route::post('/admin/tasks/assign', [TaskController::class, 'assignTask'])->name('admin.tasks.assign');
    Route::get('/admin/tasks/review', [TaskController::class, 'reviewTasks'])->name('admin.tasks.review');
    Route::post('/admin/tasks/{id}/review', [TaskController::class, 'submitReview'])->name('admin.tasks.submitReview');

    });

