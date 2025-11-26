<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // List all roles
    public function index()
    {
        $roles = DB::table('roles')->get();
        return view('roles.index', compact('roles'));
    }

    // Show create form
    public function create()
    {
        return view('roles.create');
    }

    // Store new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:255',
        ]);

        DB::table('roles')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();
        return view('roles.edit', compact('role'));
    }

    // Update role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'description' => 'nullable|string|max:255',
        ]);

        DB::table('roles')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->route('roles.index')
                         ->with('success', 'Role updated successfully.');
    }

    // Delete role
    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Role deleted successfully.');
    }
}
