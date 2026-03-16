<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Stores the hashed 6-digit code
        $table->string('reset_token_hash')->nullable();
        // Stores when the code expires
        $table->timestamp('reset_token_expires_at')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['reset_token_hash', 'reset_token_expires_at']);
    });
}
}
