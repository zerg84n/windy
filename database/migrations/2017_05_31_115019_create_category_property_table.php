<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           if(! Schema::hasTable('category_property')) {
            Schema::create('category_property', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->integer('property_id')->unsigned()->nullable();
                $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
                
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
        //
    }
}
