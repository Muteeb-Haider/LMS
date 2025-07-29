<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solution extends Model
{
    protected $casts = [
        'evaluated_at' => 'datetime',
    ];

    protected $fillable = ['task_id', 'user_id', 'content', 'earned_points', 'evaluated_at'];

    // A solution belongs to a task
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    // A solution is submitted by a student (user)
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
