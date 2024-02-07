<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];

    protected $casts = [
		'name' => NameCast::class,
	];

    public function nominees(): HasMany{
        return $this->hasMany(Nominee::class);
    }

    public function selectedCandidates(): HasMany
    {
        return $this->hasMany(SelectedCandidate::class);
    }
}
