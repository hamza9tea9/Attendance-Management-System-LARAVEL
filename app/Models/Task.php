<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    // Add all fillable fields
    protected $fillable = [
        'title',
        'description',
        'assigned_to',      // student id
        'status',           // Pending, Completed, Approved, Rejected
        'response',         // student's response
        'admin_comment'     // admin review comment
    ];

    // Relationship: a task belongs to a student
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Optional: if you are storing multiple submissions in separate table
    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }
}

