<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function create()
    {
        return view('investors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization' => 'nullable|string|max:255',
            'investment_range' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $request->user()->investor()->create([
            'organization' => $request->organization,
            'investment_range' => $request->investment_range,
            'bio' => $request->bio,
            'is_verified' => false,
        ]);

        return redirect()->route('investor.dashboard')->with('success', 'Investor profile created successfully.');
    }

    public function dashboard(Request $request)
    {
        $investor = $request->user()->investor;

        if ($investor) {
            $startups = \App\Models\Startup::with(['category', 'user'])
                ->where('status', 'approved')
                ->latest()
                ->get();

            $fundingRequests = \App\Models\FundingRequest::with(['startup'])
                ->latest()
                ->get();
        } else {
            $startups = collect();
            $fundingRequests = collect();
        }

        return view('dashboards.investor', compact('investor', 'startups', 'fundingRequests'));
    }
}
