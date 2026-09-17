<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Leave;

class AdminAttendanceController extends Controller
{
    // Show form to select student and date range
    public function showReportForm()
    {
        $students = User::all(); // you can filter by role if needed
        return view('admin.attendance_report_form', compact('students'));
    }

    // Generate report
    public function generateReport(Request $request)
    {
        $request->validate([
            'student_id' => 'nullable|exists:users,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $query = Attendance::query();

        if ($request->student_id) {
            $query->where('user_id', $request->student_id);
        }

        $query->whereBetween('date', [$request->from_date, $request->to_date]);

        $attendances = $query->get();

        // Count Present / Absent / Leave
        $present = $attendances->count(); // assuming every row = present
        $absent = 0; // we can calculate if needed
        $leave = Leave::whereBetween('from_date', [$request->from_date, $request->to_date])
                      ->when($request->student_id, fn($q) => $q->where('user_id', $request->student_id))
                      ->where('status', 'Approved')
                      ->count();

        return view('admin.attendance_report', compact('attendances', 'present', 'absent', 'leave'));
    }
    // Function to calculate grade based on attendance days
private function calculateGrade($presentDays)
{
    if ($presentDays >= 26) return 'A';
    if ($presentDays >= 20) return 'B';
    if ($presentDays >= 15) return 'C';
    if ($presentDays >= 10) return 'D';
    return 'F';
}
// Show grade summary for all students
public function gradeSummary()
{
    $students = \App\Models\User::all(); // get all students
    $summary = [];

    foreach ($students as $student) {
        // Count present days
        $presentDays = \App\Models\Attendance::where('user_id', $student->id)->count();
        // Calculate grade
        $grade = $this->calculateGrade($presentDays);

        $summary[] = [
            'student' => $student->name,
            'present_days' => $presentDays,
            'grade' => $grade
        ];
    }

    return view('admin.grade_summary', compact('summary'));
}

}
