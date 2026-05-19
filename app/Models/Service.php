<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['startup_id', 'title', 'description', 'price', 'delivery_days'])]
class Service extends Model
{
    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }
}

