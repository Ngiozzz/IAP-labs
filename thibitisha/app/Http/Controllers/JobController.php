<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    // List all jobs
    public function index()
    {
        $jobs = DB::table('jobs')->get(); // using query builder
        return view('jobs.index', compact('jobs'));
    }

    // Show create form
    public function create()
    {
        return view('jobs.create');
    }

    // Store new job
    public function store(Request $request)
    {
        $request->validate([
            'queue' => 'required|string|max:255',
            'payload' => 'required|string',
            'attempts' => 'required|integer',
            'available_at' => 'required|integer',
        ]);

        DB::table('jobs')->insert([
            'queue' => $request->queue,
            'payload' => $request->payload,
            'attempts' => $request->attempts,
            'reserved_at' => $request->reserved_at ?? null,
            'available_at' => $request->available_at,
            'created_at' => time(),
        ]);

        return redirect()->route('jobs.index')
                         ->with('success', 'Job added to queue successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $job = DB::table('jobs')->where('id', $id)->first();
        return view('jobs.edit', compact('job'));
    }

    // Update job
    public function update(Request $request, $id)
    {
        $request->validate([
            'queue' => 'required|string|max:255',
            'payload' => 'required|string',
            'attempts' => 'required|integer',
            'available_at' => 'required|integer',
        ]);

        DB::table('jobs')->where('id', $id)->update([
            'queue' => $request->queue,
            'payload' => $request->payload,
            'attempts' => $request->attempts,
            'reserved_at' => $request->reserved_at ?? null,
            'available_at' => $request->available_at,
        ]);

        return redirect()->route('jobs.index')
                         ->with('success', 'Job updated successfully.');
    }

    // Delete job
    public function destroy($id)
    {
        DB::table('jobs')->where('id', $id)->delete();

        return redirect()->route('jobs.index')
                         ->with('success', 'Job deleted successfully.');
    }
}
