<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'properties'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'properties' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(related : Product::class, foreignKey: 'product_id');
    }

    public function total()
    {
        return $this->qty * $this->price;
    } 
    
}
