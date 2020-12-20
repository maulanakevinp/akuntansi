<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;

class JurnalPenutupController extends Controller
{
    public function index(Request $request)
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
                return redirect('jurnal-penutup?kriteria=periode&periode=1-bulan-terakhir');
                break;
        }
        return view('jurnal-penutup.index', compact('akun'));
    }
}
