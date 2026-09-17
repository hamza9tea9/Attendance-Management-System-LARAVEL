<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin dashboard
            return view('admin.dashboard');
        }

        // Student dashboard: count pending tasks
        $pendingTasksCount = Task::where('assigned_to', $user->id)
                                 ->where('status', 'Pending')
                                 ->count();

        return view('student.dashboard', compact('pendingTasksCount'));
    }
}
