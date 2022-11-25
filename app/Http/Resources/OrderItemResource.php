<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'order_id' => $this->order_id,
            'product' => [                
                'uuid' => $this->whenLoaded('product')->uuid,
                'name' => $this->whenLoaded('product')->name,
                'description' => $this->whenLoaded('product')->description,
                'image' => [
                    'src' => $this->whenLoaded('product')->images[0]->path,
                    'alt' => $this->whenLoaded('product')->images[0]->alt
                ],                
            ],
            'qty' => $this->qty,
            'price' => $this->price,
            'properties' => $this->properties,
        ];
    }
}
