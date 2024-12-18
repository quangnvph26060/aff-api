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
        Schema::create('aff_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['enabled', 'disabled', 'custom'])->default('enabled'); // Trạng thái của hệ thống tiếp thị liên kết
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
        Schema::dropIfExists('aff_settings');
    }
};
