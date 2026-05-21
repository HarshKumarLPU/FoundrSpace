<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\User;
use App\Models\JobPosting;
use App\Models\Investor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Enforce admin check
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $pendingStartups = Startup::with(['user', 'category'])
            ->where('status', 'pending')
            ->latest()
            ->get();
            
        $approvedStartups = Startup::with(['user', 'category'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        $stats = [
            'total_users' => User::count(),
            'total_startups' => Startup::count(),
            'total_jobs' => JobPosting::count(),
            'total_investors' => Investor::count(),
        ];

        return view('dashboards.admin', compact('pendingStartups', 'approvedStartups', 'stats'));
    }

    public function approveStartup(Startup $startup)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $startup->update(['status' => 'approved']);

        return redirect()->route('admin.dashboard')->with('success', "Startup '{$startup->name}' approved successfully!");
    }

    public function rejectStartup(Startup $startup)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $startup->update(['status' => 'rejected']);

        return redirect()->route('admin.dashboard')->with('success', "Startup '{$startup->name}' has been rejected.");
    }

    public function verifyStartup(Startup $startup)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $startup->update(['is_verified' => !$startup->is_verified]);

        return back()->with('success', "Startup verification status updated successfully!");
    }
}
