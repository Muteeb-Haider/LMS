<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\Task;
use App\Models\Subject;

class SolutionController extends Controller
{
    // Show the evaluation form (Teacher)
    public function evaluateForm($subjectId, $taskId, $solutionId)
    {
        $subject = Subject::findOrFail($subjectId);
        $task = Task::findOrFail($taskId);
        $solution = Solution::with('user')->findOrFail($solutionId);

        return view('solutions.evaluate', compact('subject', 'task', 'solution'));
    }

    // Save evaluation (Teacher)
    public function evaluate(Request $request, $subjectId, $taskId, $solutionId)
    {
        $task = Task::findOrFail($taskId);
        $solution = Solution::findOrFail($solutionId);

        $request->validate([
            'points' => "required|integer|min:0|max:{$task->points}"
        ]);

        $solution->points = $request->points;
        $solution->evaluated_at = now();
        $solution->save();

        return redirect()->route('tasks.show', [$subjectId, $taskId])
            ->with('success', 'Solution evaluated successfully.');
    }

    // Save evaluation (OLD backup version)
    public function storeEvaluation(Request $request, $taskId, $solutionId)
    {
        $solution = Solution::with('task')->findOrFail($solutionId);
        $task = Task::findOrFail($taskId);

        $validated = $request->validate([
            'points' => ['required', 'integer', 'min:0', 'max:' . $task->points],
        ]);

        $solution->points = $validated['points'];
        $solution->evaluated_at = now();
        $solution->save();

        return redirect()->route('tasks.show', [$task->subject_id, $taskId])
            ->with('success', 'Solution evaluated successfully.');
    }
    public function store(Request $request, Subject $subject, Task $task)
    {
        $validated = $request->validate([
            'solution_text' => 'required|string',
        ]);

        $solution = Solution::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'content' => $validated['solution_text'],
        ]);

        return redirect()
            ->route('subjects.show', $subject->id)
            ->with('success', 'Your solution has been submitted successfully!');
    }

}
