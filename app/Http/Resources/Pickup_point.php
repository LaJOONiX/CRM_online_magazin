<?php

namespace App\Http\Resources;

use App\Helpers\AppHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class Pickup_point extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $output_array = array('id' => $this->id, 'address' => $this->address, 'created_at' => $this->created_at, 'hours' => $this->hours);
//
//      if (AppHelper::check_employee()) {
//        array_push($output_array, Employee::collection($this->whenLoaded('employees')));
//      }

      $output_array['created_at'] = $this->created_at;

      return $output_array;
    }
}
