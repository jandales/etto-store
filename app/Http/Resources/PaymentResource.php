<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'reference_number' => $this->reference_number,
            'provider' => $this->provider,
            'amount'=> $this->amount,
            'status'  => $this->status,
            'date' => $this->created_at->isoFormat('YYYY, M, DDDD'),
        ];
    }
}
