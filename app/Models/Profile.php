<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    // public $timestamps = false;


    protected $fillable = [
        'avatar',
        'phone',
        'birth_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //     2022-11-17 15:02:11
}
