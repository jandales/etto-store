<?php

namespace App\Models;

use Domains\Shared\Concerns\HasNumber;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use HasNumber;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'number',    
        'gross_total',        
        'tax_total',
        'net_total',
        'shipped_at',
        'cancelled_at',
        'returned_at',
        'completed_at',
        'coupon_id',
        'coupon_amount',
        'shipping_method_id',
        'shipping_charge',
        'status',
        'user_id',
        'shipping_id',
        'billing_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    public function user()
    {
        return $this->belongsTo(
            related : User::class,
            foreignKey: 'user_id',
        );
    }

 

    public function items()
    {
        return $this->hasMany(
            related : OrderItem::class, 
            foreignKey: 'order_id'
        );
    }

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }
    public function payment()
    {
        return $this->hasOne(
            related : Payment::class, 
            foreignKey : 'reference_number',
            localKey : 'number'
        );
    }

    public function billing()
    {
        return $this->hasOne(
            related : Address::class,
            foreignKey: 'id',
            localKey: 'billing_id',       
        );
    }

    public function shipping()
    {
        return $this->hasOne(
            related : Address::class,          
            foreignKey: 'id',
            localKey: 'shipping_id',
        );
    }

    public function couponUsed()
    {
        return $this->hasOne(CouponUsed::class);
    }

 

    public function shippingMethod()
    {
        return $this->hasOne(
            related :ShippingMethod::class, 
            foreignKey: 'id',
            localKey : 'shipping_method_id',
        );
    }

    public function totalItems()
    {
        return $this->items->sum('qty');
    }

    public function subtotal()
    {
        return $this->items->sum('price');
    }

    public function amount()
    {
        return $this->payment->amount;
    }

    public function total()
    {
        $coupon = 0;
        if ($this->couponUsed) $coupon = $this->couponUsed->amount;
        return 0 + $this->subtotal() - $coupon;
    }  
   

    public function scopeSearch($query, $keyword)
    {
        return $query->whereHas('user', function ($q) use ($keyword) {
            return $q->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        })->orWhere('order_number', $keyword);
    }

    public function scopeByAuthUser($query)
    {
        return $query->where('user_id', auth()->user()->id)
            ->with('payment_detail', 'items', 'items.product', 'shipping', 'billing', 'payment', 'couponUsed')
            ->orderBy('id', 'desc');
    }


 
}
