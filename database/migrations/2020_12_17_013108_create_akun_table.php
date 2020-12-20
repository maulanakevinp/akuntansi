<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_akun_id')->constrained('kelompok_akun')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode', 4)->unique();
            $table->string('nama', 128);
            $table->boolean('post_saldo');
            $table->boolean('post_penyesuaian');
            $table->boolean('post_laporan');
            $table->boolean('kelompok_laporan_posisi_keuangan')->nullable();
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
        Schema::dropIfExists('akun');
    }
}
