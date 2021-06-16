<?php

namespace App\Http\Resources;

use App\Helpers\AppHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class Client extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $output_array = array(
        'id' => $this->id,
        'name' => $this->name,
        'code' => $this->code,
        'email' => $this->email,
        'created_at' => $this->created_at->format('M d Y')
      );
      return $output_array;
    }
}
