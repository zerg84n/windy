<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCEOToItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('items', function (Blueprint $table) {
            
                $table->string('ceo_title')->nullable();
                $table->string('ceo_description')->nullable();
                $table->text('ceo_head_text')->nullable();
                  $table->text('ceo_foot_text')->nullable();
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('items', function (Blueprint $table) {
           $table->dropColumn('ceo_title');
                $table->dropColumn('ceo_description');
                $table->dropColumn('ceo_head_text');
                  $table->dropColumn('ceo_foot_text');
            
            
        });
    }
}
