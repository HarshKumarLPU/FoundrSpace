<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['startup_id', 'amount_needed', 'equity_offered', 'pitch_deck', 'description', 'status'])]
class FundingRequest extends Model
{
    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }
}

