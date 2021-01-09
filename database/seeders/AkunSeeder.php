<?php

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1110",
            "nama" => "Kas",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 1,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1120",
            "nama" => "Piutang",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 1,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1130",
            "nama" => "Asuransi Dibayar Dimuka",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 1,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1140",
            "nama" => "Perlengkapan Toko",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 1,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1150",
            "nama" => "Perlengkapan Kantor",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 1,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1210",
            "nama" => "Peralatan Toko",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1211",
            "nama" => "Akumulasi Penyusutan Peralatan Toko",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1220",
            "nama" => "Peralatan Kantor",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1221",
            "nama" => "Akumulasi Penyusutan Peralatan Kantor",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1230",
            "nama" => "Gedung",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1231",
            "nama" => "Akumulasi Penyusutan Gedung",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 1,
            "kode" => "1240",
            "nama" => "Tanah",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 2,
        ]);

        Akun::create([
            "kelompok_akun_id" => 2,
            "kode" => "2110",
            "nama" => "Utang Usaha",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 3,
        ]);

        Akun::create([
            "kelompok_akun_id" => 2,
            "kode" => "2120",
            "nama" => "Utang Gaji",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => 4,
        ]);

        Akun::create([
            "kelompok_akun_id" => 3,
            "kode" => "3110",
            "nama" => "Modal",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 3,
            "kode" => "3120",
            "nama" => "Prive",
            "post_saldo" => 1,
            "post_penyesuaian" => 2,
            "post_laporan" => 1,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 4,
            "kode" => "4110",
            "nama" => "Pendapatan Toko",
            "post_saldo" => 2,
            "post_penyesuaian" => 2,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6110",
            "nama" => "Beban Asuransi",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6120",
            "nama" => "Beban Perlengkapan Toko",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6140",
            "nama" => "Beban Penyusutan Peralatan Toko",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6150",
            "nama" => "Beban Penyusutan Peralatan Kantor",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6160",
            "nama" => "Beban Penyusutan Gedung",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6170",
            "nama" => "Beban Listrik, Air dan Telepon",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

        Akun::create([
            "kelompok_akun_id" => 6,
            "kode" => "6180",
            "nama" => "Beban Gaji",
            "post_saldo" => 1,
            "post_penyesuaian" => 1,
            "post_laporan" => 2,
            "kelompok_laporan_posisi_keuangan" => null,
        ]);

    }
}
