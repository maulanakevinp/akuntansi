<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class NeracaLajurController extends Controller
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
                return redirect('neraca-lajur?kriteria=periode&periode=1-bulan-terakhir');
                break;
        }
        return view('neraca-lajur.index', compact('akun'));
    }
}
