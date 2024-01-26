<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants = User::where('role', 'Enseignant')->get();
        return view('enseignants.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enseignants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8'],
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
            'profession' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = $request->file('image')->store('', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'Enseignant',
            'image' => $imagePath,
        ]);

        $enseignant = Enseignant::create([
            'user_id' => $user->id,
            'profession' => $request->profession,
        ]);

        event(new Registered($user));

        return redirect()->route('enseignant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $enseignant)
    {
        $enseignant = User::find($enseignant->id);
        return view('enseignants.show', compact('enseignant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $enseignant)
    {
        $enseignant = User::find($enseignant->id);
        return view('enseignants.edit', compact('enseignant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $enseignant)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8'],
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
            'profession' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('', 'public');
            $enseignant->image = $imagePath;
        }

        $enseignant->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);
        $enseignantprofession = Enseignant::where('user_id', $enseignant->id)->first();
        $enseignantprofession->update([
            'profession' => $request->profession,
        ]);

        return redirect()->route('enseignant.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $enseignant)
    {
        $enseignant->delete();
        return redirect()->route('enseignant.index');
    }
}
