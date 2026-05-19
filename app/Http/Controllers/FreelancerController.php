<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function dashboard(Request $request)
    {
        // Enforce freelancer check
        if ($request->user()->role !== 'freelancer') {
            abort(403, 'Unauthorized action.');
        }

        // Fetch applications with job and startup details
        $applications = Application::with(['jobPosting.startup'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('dashboards.freelancer', compact('applications'));
    }
}
