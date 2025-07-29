<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Support\Facades\Hash;

class LmsSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Create Teachers
        $alice = User::create([
            'name' => 'Alice Teacher',
            'email' => 'alice@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $bob = User::create([
            'name' => 'Bob Teacher',
            'email' => 'bob@lms.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // ✅ Create Students
        $students = User::factory()->count(3)->create([
            'role' => 'student',
        ]);

        // ✅ Create Subjects
        $webDev = Subject::create([
            'name' => 'Web Development',
            'description' => 'HTML, CSS, Laravel, etc.',
            'subject_code' => 'IK-WEB101',
            'credit_value' => 4,
            'user_id' => $alice->id,
        ]);

        $cybersec = Subject::create([
            'name' => 'Cybersecurity Basics',
            'description' => 'Security principles and practices.',
            'subject_code' => 'IK-CYB102',
            'credit_value' => 3,
            'user_id' => $bob->id,
        ]);

        // ✅ Enroll students
        foreach ($students as $student) {
            $student->enrolledSubjects()->attach([$webDev->id, $cybersec->id]);
        }

        // ✅ Create Tasks
        $htmlTask = Task::create([
            'name' => 'HTML Page Assignment',
            'description' => 'Create a responsive HTML page.',
            'points' => 10,
            'subject_id' => $webDev->id,
        ]);

        $quizTask = Task::create([
            'name' => 'Security Quiz',
            'description' => 'Answer 10 questions about security.',
            'points' => 20,
            'subject_id' => $cybersec->id,
        ]);

        // ✅ Create Solutions by first student
        $firstStudent = $students->first();

        Solution::create([
            'task_id' => $htmlTask->id,
            'user_id' => $firstStudent->id,
            'content' => 'My HTML solution...',
        ]);

        Solution::create([
            'task_id' => $quizTask->id,
            'user_id' => $firstStudent->id,
            'content' => 'Answers to security quiz...',
            'earned_points' => 15,
            'evaluated_at' => now(),
        ]);
    }
}
