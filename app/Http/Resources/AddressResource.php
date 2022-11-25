<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
             'name'     => [
                'firstname' => $this->firstname,
                'lastname'  => $this->lastname,
                'fullname' => $this->fullname(),
             ],
            'street'    => $this->street,
            'city'      => $this->city,
            'phone'     => $this->phone,
            'country'   => $this->country,
            'region'    => $this->region,
            'zipcode'   => $this->zipcode,
            'user_id'   => $this->whenLoaded('user'),         
            'address' => $this->fullAddress(),
        ];
    }
}
