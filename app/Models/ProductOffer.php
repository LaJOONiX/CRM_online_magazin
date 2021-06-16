<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $guarded = [];

    public function product() {
      return $this->belongsTo(Product::class,'id_product','id');
    }

    public function delivery() {
      return $this->belongsTo(Delivery::class, 'id_delivery','id');
    }

    public function receipt() {
      return $this->belongsTo(Receipt::class,'id_receipt','id');
    }

    // Посчитать на сколько времени мы быстрее доставили подписку
}
