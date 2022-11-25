<?php

namespace App\Models;

use App\Models\User;

use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, HasUuid;


    public $table = 'addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'street',
        'city',
        'phone',
        'country',
        'region',
        'zipcode',
        'user_id',
        'billing',
        'shipping',
    ];


    protected $casts = [
        'billing' => 'boolean',
        'shipping' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id'
        );
    }

    public function fullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function fullAddress()
    {
        return $this->street . " " . $this->city . " " . $this->region . " " . $this->country;
    }
}
