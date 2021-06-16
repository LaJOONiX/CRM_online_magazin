<?php

namespace Database\Factories;

use App\Helpers\AppHelper;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => AppHelper::generate_code('S',Subscription::class),
            'id_publication' => rand(1, 4),
            'id_delivery' => rand(1, 2),
            'id_receipt' => rand(1, 5),
            'count' => rand(1, 20),
            'start_at' => Carbon::now()->addWeeks(rand(1,11)),
            'end_at' => Carbon::now()->addMonths(rand(3,6))
        ];
    }
}
