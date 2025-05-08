<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWatchlistLikesAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('watchlist')->nullable()->after('password');
            $table->string('likes')->nullable()->after('watchlist');
            $table->string('roles')->default('user')->after('likes');
            $table->string('phone_no')->nullable()->after('roles');
            $table->string('subscribe')->default('no')->after('phone_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('watchlist');
            $table->dropColumn('likes');
            $table->dropColumn('roles');
            $table->dropColumn('phone_no');
            $table->dropColumn('subscribe');
        });
    }
}
