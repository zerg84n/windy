<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('reviews')) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->nullable();
                $table->integer('score')->nullable()->unsigned();
                $table->text('text')->nullable();
                $table->tinyInteger('published')->default(0);
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', '44052_593a914674791')->references('id')->on('products')->onDelete('cascade');
                $table->integer('session_id')->nullable()->unsigned();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('reviews');
    }
}