<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Startup $startup)
    {
        $user = auth()->user();
        
        $bookmark = Bookmark::where('user_id', $user->id)
            ->where('startup_id', $startup->id)
            ->first();
            
        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Startup removed from saved list.');
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'startup_id' => $startup->id,
            ]);
            return back()->with('success', 'Startup saved successfully!');
        }
    }
}
