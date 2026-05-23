<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['startup_id', 'investor_id', 'proposed_amount', 'message', 'status'])]
class InvestmentProposal extends Model
{
    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class);
    }
}
