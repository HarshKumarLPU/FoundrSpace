<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request, JobPosting $job)
    {
        $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|string|max:5000',
        ]);

        // Ensure user is freelancer
        if ($request->user()->role !== 'freelancer') {
            return back()->with('error', 'Only registered freelancers can apply for job positions.');
        }

        // Check if already applied
        $existing = Application::where('job_posting_id', $job->id)
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already applied for this job position.');
        }

        $resumePath = 'resumes/mock_resume.pdf';
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'job_posting_id' => $job->id,
            'user_id' => $request->user()->id,
            'resume' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return redirect()->route('freelancer.dashboard')->with('success', 'Application submitted successfully!');
    }

    public function accept(Application $application)
    {
        $startup = auth()->user()->startup;
        if (!$startup || $application->jobPosting->startup_id !== $startup->id) {
            abort(403, 'Unauthorized action.');
        }

        $application->update(['status' => 'accepted']);
        return back()->with('success', "Application for {$application->user->name} accepted.");
    }

    public function reject(Application $application)
    {
        $startup = auth()->user()->startup;
        if (!$startup || $application->jobPosting->startup_id !== $startup->id) {
            abort(403, 'Unauthorized action.');
        }

        $application->update(['status' => 'rejected']);
        return back()->with('success', "Application for {$application->user->name} rejected.");
    }
}
