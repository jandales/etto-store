<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $profile = $this->load('profile')->profile;

        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'display_name' => $this->fullName(),
            'email' => $this->email,
            'avatar' => $profile->avatar ?? null,
            'birth_date' => $profile->birth_date ?? null,
            'phone' => $profile->phone ?? null,
        ];
    }
}
