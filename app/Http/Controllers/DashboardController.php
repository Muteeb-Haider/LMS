<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'teacher') {
            $subjectsCount = $user->subjects()->count();
            $tasksCount = \App\Models\Task::whereIn('subject_id', $user->subjects->pluck('id'))->count();
            $studentsCount = $user->subjects->pluck('students')->flatten()->unique('id')->count();

            return view('dashboard.teacher', compact('user', 'subjectsCount', 'tasksCount', 'studentsCount'));
        }

        if ($user->role === 'student') {
            $subjects = $user->subjects()->with('tasks')->get();

            $tasks = $subjects->pluck('tasks')->flatten();

            $pendingTasksCount = $tasks->filter(function ($task) use ($user) {
                return !$task->solutions()->where('user_id', $user->id)->exists();
            })->count();

            $completedTasksCount = $tasks->filter(function ($task) use ($user) {
                return $task->solutions()->where('user_id', $user->id)->exists();
            })->count();

            $upcomingTasks = $tasks->filter(function ($task) {
                return $task->due_date && now()->lt($task->due_date);
            })->sortBy('due_date')->take(5);

            $subjectsCount = $subjects->count();

            return view('dashboard.student', compact(
                'user',
                'subjectsCount',
                'pendingTasksCount',
                'completedTasksCount',
                'upcomingTasks'
            ));
        }

        abort(403);
    }
}
