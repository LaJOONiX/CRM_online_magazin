<?php

namespace Database\Factories;

use App\Helpers\AppHelper;
use App\Models\Office;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Office::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => AppHelper::generate_code('O',Office::class),
            'address' => Str::random(20),
            'created_at' => Carbon::now()->format("M d Y"),
        ];
    }
}
