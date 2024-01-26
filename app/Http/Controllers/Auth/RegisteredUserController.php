<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Enseignant;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = ['Admin', 'Enseignant', 'Student'];
        $adminroles = ["Directeur de l'école", "Vice President","Responsable" ];
        return view('auth.register', compact('roles', 'adminroles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
            'role' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = $request->file('image')->store('', 'public');


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'image' => $imagePath,
        ]);
        if ($request->role == 'Admin') {
            Admin::create([
                'user_id' => $user->id,
                'role' => $request->adminrole,
            ]);
        }
        if ($request->role == 'Enseignant') {
            Enseignant::create([
                'user_id' => $user->id,
                'profession' => $request->profession,
            ]);
        }
        if ($request->role == 'Student') {
            Student::create([
                'user_id' => $user->id,
                'section' => $request->section,
            ]);
        }
        event(new Registered($user));

       

        return redirect(RouteServiceProvider::HOME);
    }
}
