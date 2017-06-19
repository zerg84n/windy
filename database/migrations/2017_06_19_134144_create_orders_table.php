<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        if(! Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('delivery');
                $table->string('address')->nullable();
                $table->time('time')->nullable();
                $table->string('payment_type')->nullable();
                $table->tinyInteger('is_ur')->nullable()->default(0);
                $table->string('attachment')->nullable();
                $table->string('ur_name')->nullable();
                $table->string('ur_inn')->nullable();
                $table->string('ur_nls')->nullable();
                $table->enum('status', ["waiting","success","failed"])->default('waiting');
                
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
        Schema::dropIfExists('orders');
    }
}
