<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop592d350445304592d350443e11CategorySpecificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('category_specification');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('category_specification')) {
            Schema::create('category_specification', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id', 'fk_p_40978_40986_specific_592d32cdc5410')->references('id')->on('categories');
                $table->integer('specification_id')->unsigned()->nullable();
            $table->foreign('specification_id', 'fk_p_40986_40978_category_592d32cdc5bb8')->references('id')->on('specifications');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
