<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (Receipt::all() as $receipt) {
        $receipt->sum = 0;
        foreach ($receipt->product_offers as $product_offer) {
          $receipt->sum += $product_offer->product->price * $product_offer->count;
        }
        $receipt->save();
      }
    }
}
