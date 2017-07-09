<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5934ff7680be2ItemMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('item_menu')) {
            Schema::create('item_menu', function (Blueprint $table) {
                $table->integer('item_id')->unsigned()->nullable();
                $table->foreign('item_id', 'fk_p_42570_42569_menu_ite_5934ff7680cb6')->references('id')->on('items')->onDelete('cascade');
                $table->integer('menu_id')->unsigned()->nullable();
                $table->foreign('menu_id', 'fk_p_42569_42570_item_men_5934ff7680d47')->references('id')->on('menus')->onDelete('cascade');
                
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
        Schema::dropIfExists('item_menu');
    }
}
