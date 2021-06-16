<?php

namespace Database\Factories;

use App\Helpers\AppHelper;
use App\Models\ProductOffer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'code' => AppHelper::generate_code('POF',ProductOffer::class),
          'address' => $this->faker->address,
          'id_product' => rand(1, 5),
          'id_delivery' => rand(1, 2),
          'id_receipt' => rand(1, 5),
          'count' => rand(1,4),
          'start_at' => Carbon::now()->addDays(rand(3,10)),
          'end_at' => Carbon::now()->addWeeks(rand(2,11))
        ];
    }
}
