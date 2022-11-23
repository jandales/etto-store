<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Builder\UserBuilder;
use Domains\Shared\Concerns\HasUuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
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
    ];


    public function profile()
    {
        return $this->hasOne(
            related: Profile::class,
            foreignKey: 'user_id'
        );
    }

    public function address()
    {
        return $this->hasMany(
            related: Address::class,
            foreignKey: 'user_id',
            localKey: 'id'
        );
    }

    public function newEloquentBuilder($query)
    {
        return new UserBuilder($query);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function fullName()
    {
        return $this->firstname . " " . $this->lastname;
    }


    public function defaultShipping()
    {
        return $this->address->where('shipping', 1);
    }

    public function defaultBilling()
    {
        return $this->address->where('billing', 1);
    }
}
