<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product_offers() {
      return $this->hasMany(ProductOffer::class,'id_product','id');
    }

    public function category() {
      return $this->belongsTo(Category::class,'id_category','id');
    }


    public function purchased_count() {
      $initial_relations = $this->getRelations();
      $count = $this->product_offers->count();
      $this->setRelations($initial_relations);
      return $count;
    }

  //    public function left_count() {
//        $initial_relations = $this->getRelations();
//        $left_count =  $this->subscriptions ? $this->subscriptions->reduce( function ($carry, $subscription) {
//            $subscription_created_at = $subscription->receipt->created_at;
//            if ($subscription_created_at->addMonths($subscription->months) > Carbon::now() && $subscription->delivery->name !== "Онлайн-покупка") {
//                return --$carry;
//            }
//            return $carry;
//        }, $this->count) : $this->count;
//        $this->setRelations($initial_relations);
//        return $left_count;
//    }
}
