<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'subject_code', 'credit_value', 'user_id'];

    // A subject belongs to a teacher
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A subject has many tasks
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }


    // // A subject has many students (pivot)
    // public function students(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class)->withTimestamps();
    // }
    // Subject.php
    public function students()
    {
        return $this->belongsToMany(\App\Models\User::class)->withTimestamps();
    }
    public function teachingSubjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }


}
