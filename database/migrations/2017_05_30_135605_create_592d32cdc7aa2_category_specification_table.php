<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create592d32cdc7aa2CategorySpecificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('category_specification')) {
            Schema::create('category_specification', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_40978_40986_specific_592d32cdc7ba9')->references('id')->on('categories')->onDelete('cascade');
                $table->integer('specification_id')->unsigned()->nullable();
                $table->foreign('specification_id', 'fk_p_40986_40978_category_592d32cdc7c2a')->references('id')->on('specifications')->onDelete('cascade');
                
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
        Schema::dropIfExists('category_specification');
    }
}
