<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostPenyesuaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akun', function (Blueprint $table) {
            $table->boolean('post_penyesuaian')->after('post_saldo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('akun', function (Blueprint $table) {
            $table->dropColumn('post_penyesuaian');
        });
    }
}
