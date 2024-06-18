<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('zip_code')->nullable();   
            $table->string('name')->nullable();
            $table->string('phone')->nullable();  
            $table->unsignedBigInteger('total_money')->nullable();
            $table->boolean('status')->default(1)->index();
            $table->string('note')->nullable();
            $table->string('receive_address')->nullable();
            $table->unsignedBigInteger('user_id');
        
            $table->timestamps();
        });
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
};
