<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           if(! Schema::hasTable('menu_item')) {
            Schema::create('menu_item', function (Blueprint $table) {
                $table->integer('item_id')->unsigned()->nullable();
               
                $table->integer('menu_id')->unsigned()->nullable();
               
                
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
