<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create592d35408acd6ProductSpecificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('product_specification')) {
            Schema::create('product_specification', function (Blueprint $table) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', 'fk_p_40977_40986_specific_592d35408add0')->references('id')->on('products')->onDelete('cascade');
                $table->integer('specification_id')->unsigned()->nullable();
                $table->foreign('specification_id', 'fk_p_40986_40977_product__592d35408ae4f')->references('id')->on('specifications')->onDelete('cascade');
                
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
        Schema::dropIfExists('product_specification');
    }
}
