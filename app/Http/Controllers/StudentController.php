<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('role', 'Student')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],

        ]);

        $imagePath = $request->file('image')->store('', 'public');


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'Student',
            'image' => $imagePath,
        ]);


        $student = Student::create([
            'user_id' => $user->id,
            'section' => $request->section,
        ]);

        event(new Registered($user));

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        $student = User::find($student->id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student)
    {
        $student = User::find($student->id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
            'section' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('', 'public');
            $student->image = $imagePath;
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $student->password,
            'phone' => $request->phone,

        ]);

        $sectionsection = Student::where('user_id', $student->id)->first();

        $sectionsection->update([
            'section' => $request->section,
        ]);

        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('student.index');
    }
}
