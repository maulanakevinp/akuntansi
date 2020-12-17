<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelompokAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('kelompok_akun')->truncate();
        DB::table('kelompok_akun')->insert(['nama' => 'Asset']);
        DB::table('kelompok_akun')->insert(['nama' => 'Kewajiban']);
        DB::table('kelompok_akun')->insert(['nama' => 'Ekuitas']);
        DB::table('kelompok_akun')->insert(['nama' => 'Pendapatan']);
        DB::table('kelompok_akun')->insert(['nama' => 'Belanja']);
        DB::table('kelompok_akun')->insert(['nama' => 'Pembiayaan']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
