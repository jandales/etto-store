<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cart_id',
        'expired_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    public function items()
    {
        return $this->hasMany(related : CartItem::class, foreignKey : 'cart_id');
    }

    public function hasThisProduct($id)
    {
        $item = $this->items->where('product_id', $id)->firstOrFail();
       
    }

    public function subtotal()
    {
        $subtotals =  $this->items->map(function($item){
            return $item->product->regular_price * $item->qty;
        });

        $total = 0;

        foreach($subtotals as $subtotal)
        {
            $total += $subtotal;    
        }

        return $total;

    }
}
