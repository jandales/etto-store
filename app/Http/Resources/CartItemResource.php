<?php

namespace App\Http\Resources;

use App\Action\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'id' => $this->id,
            'product' => [
                'id' => $this->whenLoaded('product')->id,
                'uuid' => $this->whenLoaded('product')->uuid,
                'name' => $this->whenLoaded('product')->name, 
                'price' => $this->whenLoaded('product')->regular_price,
                'image' => [
                    'src' => $this->whenLoaded('product')->images[0]->path,
                    'alt' => $this->whenLoaded('product')->images[0]->alt,
                ]
            ],            
            "qty" => $this->qty,        
            "attributes" =>  $this->attributes,
            'subtotal' => $this->qty * ($this->whenLoaded('product')->regular_price ?? 0),           
        ];
    }
}
