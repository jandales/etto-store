<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */    
    protected $fillable = [
        'cart_id',
        'product_id',
        'qty',
        'price',
        'attributes',
    ];
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'attributes' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(related: Product::class, foreignKey: 'product_id');
    }

    public function cart()
    {
        return $this->belongsTo(related: Cart::class, foreignKey: 'cart_id');
    }

  

  

    

   
   
    
}
