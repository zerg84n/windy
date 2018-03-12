<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrandIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('products', function (Blueprint $table) {
              if(!Schema::hasColumn('products', 'brand_id')) {
       $table->integer('brand_id')->unsigned()->nullable();
              }
     //  $table->foreign('brand_id')->references('id')->on('brands');
          });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('brand_id');
         });
    }
}
