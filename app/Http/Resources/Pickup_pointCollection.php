<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Pickup_pointCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
  public function toArray($request)
  {
    $total = $this->total();
    $current_page = $this->currentPage();
    return [
      'data' => $this->collection,
      'links' => [
        'first' => '/api/pickup_points/1',
        'last' => 'api/pickup_points/'. $total,
        'prev' => $current_page > 1 ? '/api/pickup_points?page=' : null,
        'next' => $current_page < $total ? '/api/pickup_points?page=2' : null,
      ],
      'meta' => [
        'current_page' => $current_page,
        'from' => $current_page,
        'last_page' => ceil($total/3),
        'per_page' => 3,
        'to' => $current_page + 1,
        'total' => $total,
      ],
    ];
  }
}
