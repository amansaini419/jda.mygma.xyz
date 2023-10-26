<?php

namespace App\Models;

use App\Casts\NameCast;
use App\Services\VoterService;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Voter extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $hidden = [
        'login_code',
        '2fa_code',
    ];

    protected $casts = [
        'first_name' => NameCast::class,
        'last_name' => NameCast::class,
        'other_name' => NameCast::class,
        'gender' => NameCast::class,
        'login_code' => 'hashed',
        '2fa_code' => 'hashed',
    ];

    public function setLoginCodeAttribute($value)
    {
        $this->attributes['login_code'] = Hash::make($value);
    }

    public function set2faCodeAttribute($value)
    {
        $this->attributes['2fa_code'] = Hash::make($value);
    }

    public function getFullnameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* public static function boot() {
        parent::boot();

        static::created(function($item) {
            $voterService = new VoterService;
            $voterService->sendLoginCode($item);
        });
    } */
}
