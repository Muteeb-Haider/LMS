<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isTeacher()) {
            // Teacher: show subjects they teach
            $subjects = $user->subjects;
        } elseif ($user->isStudent()) {
            // Student: show subjects they enrolled
            $subjects = $user->enrolledSubjects;
        } else {
            $subjects = collect(); // Empty collection if unknown role
        }

        return view('subjects.index', compact('subjects'));
    }


    public function create()
    {
        $user = auth()->user();

        // Only needed for student
        $subjects = [];
        if ($user->isStudent()) {
            $subjects = Subject::whereDoesntHave('students', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->with('teacher')->get();
        }

        return view('subjects.create', compact('subjects'));
    }
    // public function show($id)
    // {
    //     $subject = Subject::findOrFail($id);
    //     return view('subjects.show', compact('subject'));
    // }

    public function show($id)
    {
        $subject = Subject::with('tasks')->findOrFail($id);

        $students = $subject->students()->where('role', 'student')->get();
        $studentCount = $students->count();

        $user = auth()->user();

        if ($user->isTeacher()) {
            return view('subjects.show', compact('subject', 'students', 'studentCount'));
        } elseif ($user->isStudent()) {
            return view('subjects.show_student', compact('subject', 'students', 'studentCount'));
        } else {
            abort(403, 'Unauthorized');
        }
    }




    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'subject_code' => 'required|regex:/^IK\-[A-Z]{3}\d{3}$/',
            'credit_value' => 'required|integer|min:1',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated!');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted!');
    }
    // public function available()
    // {

    //     // (This part won't run while dd is there)
    //     $user = auth()->user();
    //     $enrolledSubjectIds = $user->enrolledSubjects()->pluck('subject_id');
    //     $availableSubjects = Subject::whereNotIn('id', $enrolledSubjectIds)->get();

    //     return view('subjects.available', compact('availableSubjects'));
    // }
    // public function available()
    // {
    //     dd("This route is now working!"); // 👈 test this
    // }


    // Uncomment this method if you want to allow students to enroll in subjects

    // public function enroll(Subject $subject)
// {
//     $user = auth()->user();
//     $user->enrolledSubjects()->attach($subject->id);

    //     return redirect()->route('dashboard')->with('success', 'You have enrolled in the subject.');
// }
    // public function enroll(Subject $subject)
    // {
    //     \Log::info('Enroll method called', [
    //         'subject_id' => $subject->id,
    //         'user_id' => auth()->id()
    //     ]);

    //     $user = auth()->user();
    //     $user->enrolledSubjects()->attach($subject->id);

    //     return redirect()->route('dashboard')->with('success', 'Enrolled successfully!');
    // }
    // public function enroll(Subject $subject)
    // {
    //     $user = auth()->user();

    //     if ($user->enrolledSubjects()->where('subject_id', $subject->id)->exists()) {
    //         return redirect()->back()->with('error', 'You are already enrolled!');
    //     }

    //     $user->enrolledSubjects()->attach($subject->id);
    //     return redirect()->route('dashboard')->with('success', 'Enrolled successfully!');
    // }


    // public function leave(Subject $subject)
    // {
    //     $user = auth()->user();
    //     $user->enrolledSubjects()->detach($subject->id);

    //     return redirect()->route('dashboard')->with('success', 'You have left the subject.');
    // }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'subject_code' => 'required|regex:/^IK-[A-Z]{3}[0-9]{3}$/|unique:subjects',
            'credit_value' => 'required|integer|min:1',
        ]);

        Subject::create([
            'name' => $request->name,
            'description' => $request->description,
            'subject_code' => $request->subject_code,
            'credit_value' => $request->credit_value,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }
}
