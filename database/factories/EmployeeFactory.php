<?php

namespace Database\Factories;

use App\Helpers\AppHelper;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'code' => AppHelper::generate_code('E',Employee::class),
//            'is_head' => rand(0, 1),
            'id_office' => rand(1, 4),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'created_at' => Carbon::now()->format("M d Y")
        ];
    }
}
