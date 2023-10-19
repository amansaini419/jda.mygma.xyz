<?php

namespace App\Models;

use App\Casts\DateTimeCast;
use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voting extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $casts = [
		'title' => NameCast::class,
        'start_date' => DateTimeCast::class,
        'end_date' => DateTimeCast::class,
    ];
}
