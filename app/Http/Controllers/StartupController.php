<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\StartupCategory;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function create()
    {
        $categories = StartupCategory::all();
        return view('startups.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'startup_category_id' => 'nullable|exists:startup_categories,id',
            'description' => 'required|string',
            'stage' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:2048',
            'pitch_deck' => 'nullable|mimes:pdf|max:10240',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('startups/logos', 'public');
        }

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('startups/banners', 'public');
        }
        
        $pitchDeckPath = null;
        if ($request->hasFile('pitch_deck')) {
            $pitchDeckPath = $request->file('pitch_deck')->store('startups/pitch_decks', 'public');
        }

        $request->user()->startup()->create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'startup_category_id' => $request->startup_category_id,
            'description' => $request->description,
            'stage' => $request->stage,
            'logo' => $logoPath,
            'banner' => $bannerPath,
            'pitch_deck' => $pitchDeckPath,
            'status' => 'pending',
            'is_verified' => false,
            'views_count' => 0,
        ]);

        return redirect()->route('startup.dashboard')->with('success', 'Startup profile created successfully and is pending approval.');
    }

    public function dashboard(Request $request)
    {
        $startup = $request->user()->startup;

        if (!$startup) {
            return redirect()->route('startups.create')->with('info', 'Welcome! Please create your Startup profile to access the dashboard.');
        }

        $startup->load(['category']);
        $products = \App\Models\Product::where('startup_id', $startup->id)->latest()->get();
        $services = \App\Models\Service::where('startup_id', $startup->id)->latest()->get();
        $jobPostings = $startup->jobPostings()->latest()->get();
            
            $jobPostingIds = $jobPostings->pluck('id');
            $applications = \App\Models\Application::with(['jobPosting', 'user'])
                ->whereIn('job_posting_id', $jobPostingIds)
                ->latest()
                ->get();

        return view('dashboards.startup', compact('startup', 'products', 'services', 'jobPostings', 'applications'));
    }
}
