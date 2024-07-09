<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempOtpAndOtpExpiredToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('temp_otp')->nullable()->after('email');
            $table->timestamp('expired_at')->nullable()->after('temp_otp');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('temp_otp');
            $table->dropColumn('expired_at');
        });
    }
};
