<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsToProductsRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           if(! Schema::hasTable('product_product')) {
            Schema::create('product_product', function (Blueprint $table) {
                $table->integer('owner_id')->unsigned()->nullable();
               
                $table->integer('child_id')->unsigned()->nullable();
               
                
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
       Schema::dropIfExists('product_product');
    }
}
