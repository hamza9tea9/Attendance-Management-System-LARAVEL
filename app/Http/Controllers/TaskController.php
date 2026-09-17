<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{
    // Show form to assign task
    public function showAssignForm()
    {
        $students = User::all(); // filter by role if needed
        return view('admin.assign_task', compact('students'));
    }

    // Save new task
    public function assignTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to' => 'required|exists:users,id'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'status' => 'Pending'
        ]);

        return redirect()->back()->with('success', 'Task assigned successfully!');
    }
    // Show tasks assigned to logged-in student
public function studentTasks()
{
    $userId = Auth::id();
    $tasks = Task::where('assigned_to', $userId)->get();
    return view('student.tasks', compact('tasks'));
}

// Submit task response
public function submitTask(Request $request, $id)
{
    $request->validate([
        'response' => 'required|string',
    ]);

    $task = Task::findOrFail($id);

    // Only allow student who is assigned
    if ($task->assigned_to != Auth::id()) {
        return redirect()->back()->with('error', 'Unauthorized');
    }

    $task->response = $request->response;
    $task->status = 'Completed'; // mark as completed after submission
    $task->save();

    return redirect()->back()->with('success', 'Task response submitted successfully!');
}
// Show all completed tasks for admin review
public function reviewTasks()
{
    $tasks = Task::where('status', 'Completed')->get();
    return view('admin.review_tasks', compact('tasks'));
}

// Submit admin review
public function submitReview(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Approved,Rejected',
        'admin_comment' => 'required|string'
    ]);

    $task = Task::findOrFail($id);
    $task->status = $request->status;
    $task->admin_comment = $request->admin_comment;
    $task->save();

    return redirect()->back()->with('success', 'Task reviewed successfully!');
}

}
