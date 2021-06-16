<?php

namespace Database\Factories;

use App\Helpers\AppHelper;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receipt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => AppHelper::generate_code('R',Receipt::class),
            'payment_code' => !rand(0,3) ? AppHelper::generate_code('PY',Receipt::class) : null,
            'id_employee' => rand(1,3),
            'id_client' => rand(1, 5),
            'created_at' => Carbon::now()->format("M d Y"),
        ];
    }
}
