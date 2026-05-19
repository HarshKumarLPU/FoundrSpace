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
        
        if ($request->has('category') && $request->category != '') {
            $query->where('startup_category_id', $request->category);
        }
        
        $startups = $query->latest()->paginate(12);
        $categories = StartupCategory::all();
        
        return view('marketplace.index', compact('startups', 'categories'));
    }

    public function show(Startup $startup)
    {
        $startup->load(['user', 'category']);
        return view('marketplace.show', compact('startup'));
    }
}
