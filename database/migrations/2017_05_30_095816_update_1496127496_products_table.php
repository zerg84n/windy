<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1496127496ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price_original', 15, 2)->nullable();
                $table->decimal('price_sale', 15, 2)->nullable();
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '40977_592d1807b19f2')->references('id')->on('categories')->onDelete('cascade');
                $table->integer('status')->nullable()->unsigned();
                $table->integer('amount')->nullable()->unsigned();
                $table->tinyInteger('popular')->default(0);
                
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
            $table->dropColumn('price_original');
            $table->dropColumn('price_sale');
            $table->dropForeign('40977_592d1807b19f2');
            $table->dropIndex('40977_592d1807b19f2');
            $table->dropColumn('category_id');
            $table->dropColumn('status');
            $table->dropColumn('amount');
            $table->dropColumn('popular');
            
        });

    }
}
