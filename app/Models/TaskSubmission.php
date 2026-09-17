<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'submission',
        'status',
        'admin_feedback'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
