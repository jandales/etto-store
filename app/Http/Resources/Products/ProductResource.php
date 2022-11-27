<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\ImageResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,            
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'imagePath' => $this->imagePath,
            'long_description' => $this->long_description,
            'sku' => $this->sku,
            'barcode' => $this->barcode,
            'tags' => $this->tags,
            'sale_price' => $this->sale_price,
            'regular_price' => $this->regular_price,
            'status' => $this->status,
            'is_taxable' => $this->is_taxable,
            'featured' => $this->featured,
            'link' =>  url("/collections/{$this->whenLoaded('category')->slug}/{$this->slug}"),
            'category' => ProductCategoryResource::make($this->whenLoaded('category')),
            'images' => ImageResource::collection($this->whenLoaded('images')),   
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')), 
        ];
    }
}
