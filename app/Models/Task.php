<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'points', 'subject_id'];
    

    // A task belongs to one subject
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }


    // A task has many solutions
    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class);
    }
}
