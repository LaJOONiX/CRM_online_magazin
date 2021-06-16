<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55);
            $table->string('username', 50)->unique();
            $table->string('code', 10);
            $table->string('password');
            $table->string('email', 70);
//            $table->tinyInteger('is_head')->default(0);
//            $table->tinyInteger('is_general')->default(0);
//            $table->tinyInteger('is_english')->default(0);
            $table->string("api_token")->nullable();
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
