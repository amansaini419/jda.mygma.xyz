<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Users\UserTypeEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@jda.mygma.xyz');
        //return in_array($this->email, ['admin@jda.mygma.xyz', 'jdaec@jda.mygma.xyz']);
    }
    /*
    jdaec@jda.mygma.xyz
    Streetz99
    */

    public function voter(): HasOne{
        return $this->hasOne(Voter::class);
    }

    public function nominees(): BelongsToMany{
        return $this->belongsToMany(
            Nominee::class,
            'votes',
        );
    }

    /* public function nominee(): HasOneThrough{
        return $this->hasOneThrough(
            Nominee::class,
            Vote::class,
            'use1r_id',
            'id',
            'id',
            'nominee_id'
        );
    } */
}
