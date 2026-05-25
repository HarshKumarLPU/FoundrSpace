<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::with('startup')->where('status', 'active');

        if (auth()->check()) {
            $query->whereDoesntHave('applications', function ($q) {
                $q->where('user_id', auth()->id())->where('status', 'rejected');
            });
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm)
                  ->orWhereHas('startup', function ($s) use ($searchTerm) {
                      $s->where('name', 'like', $searchTerm);
                  });
            });
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        $jobs = $query->latest()->paginate(10);
        $jobs->appends($request->all());
        
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
        
        $existingApplication = null;
        if (auth()->check()) {
            $existingApplication = auth()->user()->applications()->where('job_posting_id', $job->id)->first();
        }

        return view('jobs.show', compact('job', 'existingApplication'));
    }
}
