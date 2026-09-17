<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\AdminComment;

class AdminLeaveController extends Controller
{
    // Show all leave requests
    public function index()
    {
        $leaves = Leave::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.leave_requests', compact('leaves'));
    }

    // Approve or reject a leave
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->status = $request->status;          // approved or rejected
        $leave->admin_comment = $request->admin_comment;
        $leave->save();

        return back()->with('success', 'Leave updated successfully');
    }
  

public function updateLeave(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Approved,Rejected',
        'comment' => 'required|string'
    ]);

    $leave = Leave::findOrFail($id);

    // Update status
    $leave->status = $request->status;
    $leave->save();

    // Add admin comment
    $comment = AdminComment::updateOrCreate(
        ['leave_id' => $leave->id],
        ['comment' => $request->comment]
    );

    return redirect('/admin/leaves')->with('success', 'Leave status updated successfully!');
}

}
