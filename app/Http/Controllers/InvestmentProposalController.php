<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\InvestmentProposal;
use Illuminate\Http\Request;

class InvestmentProposalController extends Controller
{
    public function store(Request $request, Startup $startup)
    {
        $request->validate([
            'proposed_amount' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if (auth()->user()->role !== 'investor' || !auth()->user()->investor) {
            return back()->with('error', 'Only registered investors can propose investments.');
        }

        // Prevent duplicate pending proposals
        $existingProposal = InvestmentProposal::where('startup_id', $startup->id)
            ->where('investor_id', auth()->user()->investor->id)
            ->first();

        if ($existingProposal) {
            return back()->with('error', 'You already have a pending proposal for this startup.');
        }

        InvestmentProposal::create([
            'startup_id' => $startup->id,
            'investor_id' => auth()->user()->investor->id,
            'proposed_amount' => $request->proposed_amount,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your investment proposal has been submitted successfully.');
    }

    public function accept(InvestmentProposal $proposal)
    {
        if ($proposal->startup->user_id !== auth()->id()) {
            abort(403);
        }

        $proposal->update(['status' => 'accepted']);

        return back()->with('success', 'Investment proposal accepted. The investor will be notified.');
    }

    public function reject(InvestmentProposal $proposal)
    {
        if ($proposal->startup->user_id !== auth()->id()) {
            abort(403);
        }

        $proposal->update(['status' => 'rejected']);

        return back()->with('success', 'Investment proposal rejected.');
    }
}
