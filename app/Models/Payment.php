<?php

namespace App\Models;

use Domains\Shared\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',    
        'order_id',
        'shipping_id',
        'shipping_method_id',
        'shipping_amount',
        'reference_number',
        'provider',
        'amount',    
        'status'  
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    public function shippingMethod()
    {
        return $this->hasOne(
            related: ShippingMethod::class,
            foreignKey: 'id',
            localKey: 'shipping_method_id',
        );
    }
}
