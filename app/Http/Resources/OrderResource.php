<?php

namespace App\Http\Resources;

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
            'order_placed' =>  $this->created_at,
            'amount' => $this->gross_total,                
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
            'shipped_at' => $this->shipped_at,
            'cancelled_at' => $this->cancelled_at,
            'returned_at' => $this->returned_at,
            'completed_at'=> $this->completed,                
        ];
    }
}
