<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_category_id');
            $table->integer('stock_branch_id');
            $table->string('name', 100)->unique();
            $table->integer('quantity');
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
        Schema::dropIfExists('stock_parts');
    }
}
