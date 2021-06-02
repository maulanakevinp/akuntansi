<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JurnalUmum;
use App\Models\JurnalPenyesuaian;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request)
    {
        $akun = Akun::whereKode($request->kode_akun)->first();

        $jurnal_umum = null;
        $url = Akun::orderBy('kode')->first() ? '?kode_akun=' . Akun::orderBy('kode')->first()->kode . '&kriteria=periode&periode=1-bulan-terakhir' : '';

        if ($akun) {
            $jurnal_umum = JurnalUmum::where('akun_id', $akun->id)->get();

            switch ($request->kriteria) {
                case 'periode':
                    $request->validate([
                        'periode' => ['required'],
                    ]);

                    switch ($request->periode) {
                        case 'hari-ini':
                            $jurnal_umum = JurnalUmum::where('akun_id', $akun->id)->whereDate('tanggal', date('Y-m-d'))->get();
                            $jurnal_penyesuaian = JurnalPenyesuaian::where('akun_id', $akun->id)->whereDate('tanggal', date('Y-m-d'))->get();
                            break;

                        case '1-minggu-terakhir':
                            $jurnal_umum = JurnalUmum::where('akun_id', $akun->id)->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')])->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                            $jurnal_penyesuaian = JurnalPenyesuaian::where('akun_id', $akun->id)->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')])->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                            break;

                        case '1-bulan-terakhir':
                            $jurnal_umum = JurnalUmum::where('akun_id', $akun->id)->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                            $jurnal_penyesuaian = JurnalPenyesuaian::where('akun_id', $akun->id)->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                            break;

                        default:
                            return redirect('/buku-besar'.$url);
                            break;
                    }
                    break;

                case 'rentang-waktu':
                    $request->validate([
                        'tanggal_awal'  => ['required','date'],
                        'tanggal_akhir' => ['required','date'],
                    ]);

                    $jurnal_umum = JurnalUmum::where('akun_id', $akun->id)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                    $jurnal_penyesuaian = JurnalPenyesuaian::where('akun_id', $akun->id)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                    break;

                case 'bulan':
                    $request->validate([
                        'bulan' => ['required','date_format:Y-m'],
                    ]);
                    $jurnal_umum = JurnalUmum::where('akun_id', $akun->id)->whereMonth('tanggal', date('m',strtotime($request->bulan)))->whereYear('tanggal', date('Y',strtotime($request->bulan)))->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                    $jurnal_penyesuaian = JurnalPenyesuaian::where('akun_id', $akun->id)->whereMonth('tanggal', date('m',strtotime($request->bulan)))->whereYear('tanggal', date('Y',strtotime($request->bulan)))->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();
                    break;

                default:
                    return redirect($url);
                    break;
            }
        }

        $jurnal = [];

        foreach($jurnal_umum as $item) {
            $jurnal[] = [
                'debit_atau_kredit' => $item->debit_atau_kredit,
                'akun_post_saldo' => $item->akun->post_saldo,
                'nilai' => $item->nilai,
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
            ];
        }

        foreach($jurnal_penyesuaian as $item) {
            $jurnal[] = [
                'debit_atau_kredit' => $item->debit_atau_kredit,
                'akun_post_saldo' => $item->akun->post_saldo,
                'nilai' => $item->nilai,
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
            ];
        }

        usort($jurnal, function($a, $b) use ($request) {
            return $request->tanggal == 1 ? $a['tanggal'] < $b['tanggal'] : $a['tanggal'] > $b['tanggal'];
        });

        return view('buku-besar.index', compact('akun','jurnal'));
    }
}
