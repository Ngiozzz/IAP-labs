<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; // Add this

class DoctorController extends Controller
{
    // List doctors
    public function index()
    {
        $users = User::all(); // All users
        return view('doctors.index', compact('users'));
    }

    // Create form
    public function create()
    {
        return view('doctors.create');
    }

    // Store doctor
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role, // ✅ Set role to doctor
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor created successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        $roles = Role::all(); // Get all roles from the database

        return view('doctors.edit', compact('doctor', 'roles'));
    }

    // Update doctor
    public function update(Request $request, $id)
    {
        $doctor = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $doctor->id,
            'role'  => 'required|exists:roles,name', // Validation
        ]);

        $doctor->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role, // ✅ Update role
        ]);

        return redirect()->route('doctors.index')
                        ->with('success', 'Doctor updated successfully.');
    }

    // Delete doctor
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor deleted successfully.');
    }
}
