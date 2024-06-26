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
        Schema::table('products', function (Blueprint $table) {
            //
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('brands_id')->nullable(); // brands_id là kiểu unsigned big integer, cho phép null

                // Khai báo foreign key với bảng brands
                $table->foreign('brands_id')->references('id')->on('brands')->onDelete('set null');
            });
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
            //
        });
    }
};
