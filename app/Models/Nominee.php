<?php

namespace App\Models;

use App\Casts\DateTimeCast;
use App\Casts\ImageCast;
use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nominee extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];

    protected $casts = [
		'name' => NameCast::class,
        'created_at' => DateTimeCast::class,
        'updated_at' => DateTimeCast::class,
        'deleted_at' => DateTimeCast::class,
		//'image' => ImageCast::class,
	];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function voters(): BelongsToMany{
        return $this->belongsToMany(
            User::class,
            'votes',
        );
    }

    public function selectedCandidates(): HasMany
    {
        return $this->hasMany(SelectedCandidate::class);
    }
}
