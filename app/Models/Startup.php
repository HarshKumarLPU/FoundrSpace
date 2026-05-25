<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'startup_category_id', 'name', 'slug', 'description', 'logo', 'banner', 'stage', 'status', 'pitch_deck', 'is_verified', 'views_count', 'funding_goal', 'funding_raised'])]
class Startup extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(StartupCategory::class, 'startup_category_id');
    }

    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function investmentProposals()
    {
        return $this->hasMany(InvestmentProposal::class);
    }
}
