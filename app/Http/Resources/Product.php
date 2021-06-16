<?php

namespace App\Http\Resources;

use App\Helpers\AppHelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
      'title' => $this->title,
      'count' => $this->count,
      'sold_month' => $this->product_offers->filter(function ($item) {
        return $item->created_at > Carbon::now()->startOfMonth();
      })->count(),
      'price' => $this->price,
      'purchased_count' => $this->purchased_count(),
      'created_at' => $this->created_at->format('M d Y'),
    );

    $this->unsetRelation('product_offers');
    $this->unsetRelation('receipt');

    if (AppHelper::check_employee()) {
      $output_array['product_offers'] = ProductOffer::collection($this->whenLoaded('product_offers'));
    }

    return $output_array;

  }
}
