<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['startup_id', 'title', 'description', 'price', 'type'])]
class Product extends Model
{
    public function startup(): BelongsTo
    {
        return $this->belongsTo(Startup::class);
    }
}

