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
        Schema::table('user_info', function (Blueprint $table) {
            //
            $table->string('citizen_id_number', 20)->nullable()->after('branch');
            $table->string('front_image')->nullable()->after('citizen_id_number');
            $table->string('back_image')->nullable()->after('front_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_info', function (Blueprint $table) {
            //
            $table->dropColumn('citizen_id_number');
            $table->dropColumn('front_image');
            $table->dropColumn('back_image');
        });
    }
};
