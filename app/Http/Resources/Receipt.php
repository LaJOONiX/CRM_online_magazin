<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Receipt extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id" => $this->id,
            "code" => $this->code,
            "product_offers" => ProductOffer::collection($this->whenLoaded('product_offers')),
            "employee" => new Employee($this->whenLoaded('employee')),
            "client" => new Client($this->whenLoaded('client')),
            "sum" => $this->sum,
            "payment_code" => $this->payment_code,
            "created_at" => $this->created_at->format("M d Y")
        ];
    }
}
