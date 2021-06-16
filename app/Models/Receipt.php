<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product_offers() {
        return $this->hasMany(ProductOffer::class, 'id_receipt','id');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class,'id_employee','id');
    }

    public function calculateFullSum() {
      $sum = 0;

      foreach ($this->subscriptions as $subscription) {
        $sum += $subscription->publication->price * $subscription->count;
      }

      $this->sum = $sum;
      $this->save();

      return $sum;
    }

    public function countProductOffers() {
      return $this->product_offers()->count();
    }

    public function hasCoupon() {
      return $this->coupon;
    }

    public function getRouteKeyName()
    {
      return 'code';
    }
}
