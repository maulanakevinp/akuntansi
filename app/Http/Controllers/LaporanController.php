<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function posisi_keuangan(Request $request)
    {
        $akun = Akun::orderBy('kode')->get();
        switch ($request->kriteria) {
            case 'periode':
                $request->validate([
                    'periode' => ['required'],
                ]);
                break;

            case 'rentang-waktu':
                $request->validate([
                    'tanggal_awal'  => ['required','date'],
                    'tanggal_akhir' => ['required','date'],
                ]);
                break;

            case 'bulan':
                $request->validate([
                    'bulan' => ['required','date_format:Y-m'],
                ]);
                break;

            default:
                return redirect('laporan/posisi-keuangan?kriteria=periode&periode=1-bulan-terakhir');
                break;
        }
        return view('laporan.posisi-keuangan', compact('akun'));
    }

    public function laba_rugi(Request $request)
    {
        $akun = Akun::orderBy('kode')->get();
        switch ($request->kriteria) {
            case 'periode':
                $request->validate([
                    'periode' => ['required'],
                ]);
                break;

            case 'rentang-waktu':
                $request->validate([
                    'tanggal_awal'  => ['required','date'],
                    'tanggal_akhir' => ['required','date'],
                ]);
                break;

            case 'bulan':
                $request->validate([
                    'bulan' => ['required','date_format:Y-m'],
                ]);
                break;

            default:
                return redirect('laporan/laba-rugi?kriteria=periode&periode=1-bulan-terakhir');
                break;
        }
        return view('laporan.laba-rugi', compact('akun'));
    }

    public function perubahan_ekuitas(Request $request)
    {
        $akun = Akun::orderBy('kode')->get();
        switch ($request->kriteria) {
            case 'periode':
                $request->validate([
                    'periode' => ['required'],
                ]);
                break;

            case 'rentang-waktu':
                $request->validate([
                    'tanggal_awal'  => ['required','date'],
                    'tanggal_akhir' => ['required','date'],
                ]);
                break;

            case 'bulan':
                $request->validate([
                    'bulan' => ['required','date_format:Y-m'],
                ]);
                break;

            default:
                return redirect('laporan/perubahan-ekuitas?kriteria=periode&periode=1-bulan-terakhir');
                break;
        }
        return view('laporan.perubahan-ekuitas', compact('akun'));
    }
}
