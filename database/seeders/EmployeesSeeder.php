<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($data)
    {
        DB::table('employees')->insert($data['employees']);

       // \App\Models\Employee::factory(46)->create();
    }
}
