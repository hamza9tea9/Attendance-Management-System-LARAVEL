<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // Show attendance page (button to mark)
    public function showAttendance()
    {
        $userId = Auth::id();
        $today = date('Y-m-d');

        // Check if user already marked today
        $alreadyMarked = Attendance::where('user_id', $userId)
                                   ->where('date', $today)
                                   ->exists();

        return view('student.attendance', compact('alreadyMarked'));
    }

    // Handle marking attendance
    public function markAttendance()
    {
        $userId = Auth::id();
        $today = date('Y-m-d');

        // Check if user already marked today
        $existing = Attendance::where('user_id', $userId)
                              ->where('date', $today)
                              ->first();

        if ($existing) {
            return redirect('/attendance/status')->with('error', 'You have already marked attendance today!');
        }

        // Create new attendance record
        Attendance::create([
            'user_id' => $userId,
            'date' => $today,
            'status' => 'Present'
        ]);

        return redirect('/attendance/status')->with('success', 'Attendance marked successfully!');
    }

    // View all attendance of the student
    public function viewAttendance()
    {
        $userId = Auth::id();
        $records = Attendance::where('user_id', $userId)
                             ->orderBy('date', 'desc')
                             ->get();

        return view('student.attendance_status', compact('records'));
    }
}
