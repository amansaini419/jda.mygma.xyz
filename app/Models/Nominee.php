<?php

namespace App\Models;

use App\Casts\ImageCast;
use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nominee extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = [];

    protected $casts = [
		'name' => NameCast::class,
		//'image' => ImageCast::class,
	];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
