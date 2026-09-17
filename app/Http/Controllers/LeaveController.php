<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;
use App\Models\Attendance;

class LeaveController extends Controller
{
    // Show leave request form
    public function showLeaveForm()
    {
        return view('student.leave_request');
    }

    // Store leave request
    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
            'reason'    => 'required|string',
        ]);

        Leave::create([
            'user_id'   => Auth::id(),
            'from_date' => $request->from_date,
            'to_date'   => $request->to_date,
            'reason'    => $request->reason,
            'status'    => 'Pending',
        ]);

        return redirect()->route('leave.status')
            ->with('success', 'Leave request sent successfully');
    }

    // Show all leaves for logged-in student
    public function viewStatus()
    {
        $leaves = Leave::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('student.leave_status', compact('leaves'));
    }

    // Student grade
    public function viewGrade()
    {
        $student = Auth::user();

        $presentDays = Attendance::where('user_id', $student->id)->count();

        if ($presentDays >= 26) $grade = 'A';
        elseif ($presentDays >= 20) $grade = 'B';
        elseif ($presentDays >= 15) $grade = 'C';
        elseif ($presentDays >= 10) $grade = 'D';
        else $grade = 'F';

        return view('student.grade', compact('presentDays', 'grade'));
    }
}
