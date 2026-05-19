<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::with('startup')->where('status', 'active')->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_range' => 'nullable|string|max:255',
            'type' => 'required|string',
        ]);

        $request->user()->startup->jobPostings()->create([
            'title' => $request->title,
            'description' => $request->description,
            'salary_range' => $request->salary_range,
            'type' => $request->type,
            'status' => 'active',
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
    }
    
    public function show(JobPosting $job)
    {
        $job->load('startup');
        return view('jobs.show', compact('job'));
    }
}
