<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show($subjectId, $taskId)
    {
        $task = \App\Models\Task::with('solutions.user')->findOrFail($taskId);
        $subject = \App\Models\Subject::with('students')->findOrFail($subjectId);
        $students = $subject->students()->where('role', 'student')->get();
        $studentCount = $students->count();

        return view('tasks.show', compact('task', 'subject', 'students', 'studentCount'));
    }


    public function edit($subjectId, $taskId)
    {
        $task = Task::findOrFail($taskId);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $subjectId, $taskId)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'points' => 'required|integer|min:0',
        ]);

        $task = Task::findOrFail($taskId);
        $task->update($request->all());

        return redirect()->route('tasks.show', [$subjectId, $taskId])->with('success', 'Task updated!');
    }



    public function create($subjectId)
    {
        $subject = \App\Models\Subject::findOrFail($subjectId);
        return view('tasks.create', compact('subject'));
    }

    public function store(Request $request, $subjectId)
    {
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'points' => 'required|integer|min:0',
        ]);

        \App\Models\Task::create([
            'subject_id' => $subjectId,
            'name' => $request->name,
            'description' => $request->description,
            'points' => $request->points,
        ]);

        return redirect()->route('subjects.show', $subjectId)->with('success', 'Task created.');
    }

}
