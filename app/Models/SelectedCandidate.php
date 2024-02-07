<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SelectedCandidate extends Model
{
    use HasFactory, HasUuids;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function nominee(): BelongsTo
    {
        return $this->belongsTo(Nominee::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
