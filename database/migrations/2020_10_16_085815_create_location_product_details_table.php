<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_product_details', function (Blueprint $table) {
            $table->id();
            $table->integer('location_product_list_id');
            $table->string('code');
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->tinyInteger('status');
            $table->integer('dealer_id');
            $table->string('sku', 50)->nullable();
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
        Schema::dropIfExists('location_product_details');
    }
}
