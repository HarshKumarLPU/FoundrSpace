<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index(Request $request)
    {
        $query = Investor::with('user');

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('organization', 'like', $searchTerm)
                  ->orWhere('bio', 'like', $searchTerm)
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', $searchTerm);
                  });
            });
        }

        $investors = $query->latest()->paginate(12);

        return view('investors.index', compact('investors'));
    }

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

            $investmentProposals = $investor->investmentProposals()->with('startup')->latest()->get();
        } else {
            $startups = collect();
            $fundingRequests = collect();
            $investmentProposals = collect();
        }

        return view('dashboards.investor', compact('investor', 'startups', 'fundingRequests', 'investmentProposals'));
    }

    public function show(Investor $investor)
    {
        // Load the associated user for contact information
        $investor->load('user');
        
        // Mocking some related past investments/dealflow for the UI
        $pastInvestments = collect([
            (object)['name' => 'Acme Corp', 'round' => 'Seed', 'amount' => '$500k'],
            (object)['name' => 'Nexus AI', 'round' => 'Pre-Seed', 'amount' => '$250k'],
        ]);

        return view('investors.show', compact('investor', 'pastInvestments'));
    }
}
