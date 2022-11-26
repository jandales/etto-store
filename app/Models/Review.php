<?php

namespace App\Models;

use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'rate',
    ];


    public function product()
    {
        return $this->belongsTo(
            related : Product::class,
            foreignKey:'product_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            related : User::class,
            foreignKey: 'user_id'
        );
    }

   


}
