<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_offers', function (Blueprint $table) {
          $table->id();
          $table->string('code', 12);
          $table->integer('count');
          $table->string('address')->nullable();
          $table->foreignId('id_product')->constrained('products');
          $table->foreignId('id_delivery')->constrained('deliveries');
          $table->foreignId('id_receipt')->constrained('receipts');
          $table->date('start_at')->nullable();
          $table->date('delivered_at')->nullable();
          $table->date('end_at')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_offers');
    }
}
