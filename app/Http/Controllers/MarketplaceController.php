<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\StartupCategory;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Startup::with(['user', 'category']);
        
        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }
        
        if ($request->has('category') && $request->category != '') {
            $query->where('startup_category_id', $request->category);
        }
        
        $startups = $query->latest()->paginate(12);
        $categories = StartupCategory::all();
        
        return view('marketplace.index', compact('startups', 'categories'));
    }

    public function show(Startup $startup)
    {
        if (!auth()->check() || auth()->id() !== $startup->user_id) {
            $startup->increment('views_count');
        }
        
        $startup->load(['user', 'category']);
        return view('marketplace.show', compact('startup'));
    }
}
