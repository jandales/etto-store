<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'uuid' => $this->uuid,
            'body' => $this->body,
            'rate' => $this->rate,
            'date' =>  $this->created_at->format('m/d/Y'),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
