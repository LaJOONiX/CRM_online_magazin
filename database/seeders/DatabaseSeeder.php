<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $data = require_once "data.php";


        $this->call([
            DeliveriesSeeder::class,
            PickupPointsSeeder::class,
            EmployeesSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            ClientsSeeder::class,
            ReceiptsSeeder::class,
            ProductOffersSeeder::class,
            FakeSeeder::class,
        ],false, compact('data'));
    }
}
