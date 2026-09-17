<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;

class AttendanceReportController extends Controller
{
    // Controller logic will go here
    public function studentReport(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'from_date' => 'required|date',
        'to_date' => 'required|date|after_or_equal:from_date',
    ]);

    $userId = $request->user_id;
    $from = Carbon::parse($request->from_date);
    $to = Carbon::parse($request->to_date);

    $present = Attendance::where('user_id', $userId)
                 ->whereBetween('date', [$from, $to])
                 ->where('status', 'present')
                 ->count();

    $absent = Attendance::where('user_id', $userId)
                 ->whereBetween('date', [$from, $to])
                 ->where('status', 'absent')
                 ->count();

    $leave = Leave::where('user_id', $userId)
                ->where('status', 'approved')
                ->whereBetween('from_date', [$from, $to])
                ->count();

    $user = User::find($userId);

    return view('attendance.student_report', compact('user', 'present', 'absent', 'leave', 'from', 'to'));
}

}
