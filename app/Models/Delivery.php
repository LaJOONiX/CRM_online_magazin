<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public const UPDATED_AT = null; // выключение updated_at, однако created_at будет существовать
    protected $guarded = [];

    public function product_offers() {
        return $this->hasMany(ProductOffer::class);
    }


}
