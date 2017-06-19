<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('order_product')) {
            Schema::create('order_product', function (Blueprint $table) {
                $table->integer('product_id')->unsigned()->nullable();
                 $table->integer('count')->unsigned()->default(1);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->integer('order_id')->unsigned()->nullable();
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('order_product');
    }
}
