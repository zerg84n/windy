<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1496127018CategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            if(Schema::hasColumn('categories', 'photo')) {
                $table->dropColumn('photo');
            }
            
        });
Schema::table('categories', function (Blueprint $table) {
            $table->string('title')->nullable();
                $table->string('description')->nullable();
                
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
            
        });
Schema::table('categories', function (Blueprint $table) {
                        
        });

    }
}
