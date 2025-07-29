<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    // Show all subjects the student can take
    public function available()
    {
        $user = auth()->user();

        // Show subjects not yet enrolled by this student
        $subjects = Subject::whereDoesntHave('students', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('teacher')->get();

        return view('subjects.available', compact('subjects'));
    }

    public function enroll(Subject $subject)
    {
        $user = auth()->user();

        if (!$user->enrolledSubjects->contains($subject->id)) {
            $user->enrolledSubjects()->attach($subject->id);
        }

        return redirect()->route('subjects.index')->with('success', 'You have successfully enrolled in the subject!');
    }

    public function leave(Subject $subject)
    {
        $user = auth()->user();
        $user->enrolledSubjects()->detach($subject->id);

        return redirect()->route('subjects.index')->with('success', 'You have successfully left the subject.');
    }
    public function take()
    {
        $user = auth()->user();
        $subjects = \App\Models\Subject::whereDoesntHave('students', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->with('teacher')->get();

        return view('subjects.take', compact('subjects'));
    }




}

