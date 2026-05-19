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
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('startups/logos', 'public');
        }

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('startups/banners', 'public');
        }

        $request->user()->startup()->create([
            'name' => $request->name,
            'startup_category_id' => $request->startup_category_id,
            'description' => $request->description,
            'stage' => $request->stage,
            'logo' => $logoPath,
            'banner' => $bannerPath,
            'status' => 'pending',
        ]);

        return redirect()->route('startup.dashboard')->with('success', 'Startup profile created successfully and is pending approval.');
    }
}
