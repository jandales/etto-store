<?php

namespace App\Http\Resources;

use App\Action\Currency;
use App\Http\Resources\AddressResource;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\ShippingMethodResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     
        return [
            'number' => $this->number,
            'order_placed' =>  $this->created_at->isoformat('MMMM D Y'),
            'total' => Currency::format($this->total),
            'discount' => Currency::format($this->discount),
            'taxes' =>  Currency::format($this->taxes),
            'shipped_at' => $this->shipped_at,
            'cancelled_at' => $this->cancelled_at,
            'returned_at' => $this->returned_at,
            'completed_at'=> $this->completed,
            'status' => $this->status,
            'items' => OrderItemResource::collection($this->whenLoaded('items')),           
            'shipping' => AddressResource::make($this->whenLoaded('shipping')),
            'billing' => AddressResource::make($this->whenLoaded('shipping')),
            'payment' => PaymentResource::make($this->whenLoaded('payment')),
            
        ];
    }
}
