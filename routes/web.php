<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\StudentSubjectController;
use App\Models\Task;

Route::get('/', fn() => view('welcome'));

Route::get('/contact', fn() => view('layouts.contact'))->name('contact');

// ✅ Authenticated + Verified Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // ✅ Dashboard Route
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'teacher') {
            $subjectsCount = $user->subjects()->count();
            $tasksCount = Task::whereIn('subject_id', $user->subjects->pluck('id'))->count();
            $studentsCount = $user->subjects->pluck('students')->flatten()->unique('id')->count();

            return view('dashboard.teacher', compact(
                'user',
                'subjectsCount',
                'tasksCount',
                'studentsCount'
            ));
        }

        if ($user->role === 'student') {
            $subjects = $user->subjects()->with('tasks')->get();
            $subjectsCount = $subjects->count();

            $pendingTasksCount = $subjects->pluck('tasks')->flatten()
                ->filter(fn($task) => !$task->solutions()->where('user_id', $user->id)->exists())
                ->count();

            $completedTasksCount = $subjects->pluck('tasks')->flatten()
                ->filter(fn($task) => $task->solutions()->where('user_id', $user->id)->exists())
                ->count();

            $upcomingTasks = $subjects->pluck('tasks')->flatten()
                ->filter(fn($task) => $task->due_date && now()->lt($task->due_date))
                ->sortBy('due_date')
                ->take(5);

            return view('dashboard.student', compact(
                'user',
                'subjectsCount',
                'pendingTasksCount',
                'completedTasksCount',
                'upcomingTasks'
            ));
        }

        abort(403);
    })->name('dashboard');

    // ✅ Subject Routes
    Route::resource('subjects', SubjectController::class);

    // ✅ Task Routes
    Route::prefix('subjects/{subject}/tasks')->group(function () {
        Route::get('create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('{task}', [TaskController::class, 'update'])->name('tasks.update');
    });

    // ✅ Solution Evaluation (Teacher)
    Route::prefix('subjects/{subject}/tasks/{task}/solutions')->group(function () {
        Route::get('{solution}/evaluate', [SolutionController::class, 'evaluateForm'])->name('solutions.evaluate');
        Route::post('{solution}/evaluate', [SolutionController::class, 'evaluate'])->name('solutions.evaluate.store');
    });

    // ✅ Student Subject Actions
    Route::get('/subjects/take', [StudentSubjectController::class, 'take'])->name('subjects.take');
    Route::post('/subjects/{subject}/enroll', [StudentSubjectController::class, 'enroll'])->name('subjects.enroll');
    Route::delete('/subjects/{subject}/leave', [StudentSubjectController::class, 'leave'])->name('subjects.leave');

    // ✅ Task Submission (Student)
    Route::prefix('subjects/{subject}/tasks/{task}')->group(function () {
        Route::get('submit', [SolutionController::class, 'create'])->name('solutions.create');
        Route::post('submit', [SolutionController::class, 'store'])->name('solutions.store');
    });
});

// ✅ Profile Routes (No email verification required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
