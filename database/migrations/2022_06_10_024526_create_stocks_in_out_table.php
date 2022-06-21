<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockSInOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_in_out', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transitions', 20)->notnull();
            $table->integer('transition_id')->notnull();
            $table->integer('product_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('stocks_in_out');
    }
}
