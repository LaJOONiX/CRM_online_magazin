<?php

namespace Database\Factories;

use App\Helpers\AppHelper;
use App\Models\Publication;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $max_count = rand(20,100);
        return [
            'title' => $this->faker->sentence,
            'count' => rand(2,$max_count),
            'price' => rand(100, 400),
            "created_at" => Carbon::now()->format("M d Y")
        ];
    }
}
