<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', 'Admin')->get();

        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adminroles = ["Directeur de l'école", "Vice President", "Responsable"];
        return view('admins.create', compact('adminroles'));
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
            'role' => 'Admin',
            'image' => $imagePath,
        ]);


        $admin = Admin::create([
            'user_id' => $user->id,
            'role' => $request->adminrole,
        ]);

        event(new Registered($user));

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        $admin = User::find($admin->id);
        return view('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        $admin = User::find($admin->id);
        $adminroles = ["Directeur de l'école", "Vice President", "Responsable"];
        return view('admins.edit', compact('admin', 'adminroles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'], // Update validation for existing email
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Allow optional password update
            'phone' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image'],
            'adminrole' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('', 'public');
            $admin->image = $imagePath;
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password, // Only update password if provided
            'phone' => $request->phone,
            'image' => $admin->image,
        ]);

        $adminrole = Admin::where('user_id', $admin->id)->first();

        $adminrole->update([
            'role' => $request->adminrole,
        ]);

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin = User::find($admin->id);
        $admin->delete();
        return redirect()->route('admin.index');
    }
}
