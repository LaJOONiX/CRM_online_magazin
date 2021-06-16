<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductOfferCollection extends ResourceCollection
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
      $per_page = $this->perPage();
      return [
        'data' => $this->collection,
        'links' => [
          'first' => '/api/product_offers/1',
          'last' => 'api/product_offers/'. $total,
          'prev' => $current_page > 1 ? '/api/product_offers?page=' : null,
          'next' => $current_page < $total ? '/api/product_offers?page=2' : null,
        ],
        'meta' => [
          'current_page' => $current_page,
          'from' => $current_page,
          'last_page' => ceil($total/$per_page),
          'per_page' => $per_page,
          'to' => $current_page + 1,
          'total' => $total,
        ],
      ];
    }
}