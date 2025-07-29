<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ✅ Subjects taught by teacher
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
    // For students
// For students taking multiple subjects
    public function enrolledSubjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }



    // ✅ Subjects enrolled by student
    // public function enrolledSubjects()
    // {
    //     return $this->belongsToMany(Subject::class, 'subject_user', 'user_id', 'subject_id')->withTimestamps();
    // }


    // ✅ Solutions submitted by student
    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class);
    }

    // ✅ Helpers
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
    
}
