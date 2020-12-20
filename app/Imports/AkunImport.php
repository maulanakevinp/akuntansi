<?php

namespace App\Imports;

use App\Models\Akun;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class AkunImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        try {
            unset($collection[0]);
            set_time_limit(0);

            foreach ($collection as $key => $item) {

                preg_match_all('/\d+/', $item[1], $matches);
                $kode = implode('',$matches[0]);

                $validator[1] = [
                    ['required','numeric'],
                    ['required','digits:4'],
                    ['required','string','max:128'],
                    ['required','string','max:16'],
                    ['required','string','max:16'],
                    ['required','string','max:16'],
                    ['nullable','numeric'],
                ];

                $validator[2] = [
                    '0.required'    => 'kelompok akun (kolom A) wajib diisi.',
                    '0.numeric'     => 'kelompok akun (kolom A) harus berupa angka.',
                    '1.required'    => 'kode (kolom B) wajib diisi.',
                    '1.digits:4'    => 'kode (kolom B) harus 4 digit.',
                    '2.required'    => 'nama (kolom C) wajib diisi.',
                    '2.max:128'     => 'nama (kolom C) maksimum 128 karakter',
                    '3.required'    => 'post saldo (kolom D) wajib diisi.',
                    '3.max:16'      => 'post saldo (kolom D) maksimum 16 karakter.',
                    '4.required'    => 'post penyesuaian (kolom E) wajib diisi.',
                    '4.max:16'      => 'post penyesuaian (kolom E) maksimum 16 karakter.',
                    '5.required'    => 'post laporan (kolom F) wajib diisi.',
                    '5.max:16'      => 'post laporan (kolom F) maksimum 16 karakter.',
                    '6.numeric'     => 'kelompok laporan posisi keuangan (kolom G) harus berupa angka.',
                ];

                if ($item[0] == 1 || $item[0] == 1) {
                    $validator[1][6]            = ['required','numeric'];
                    $validator[2]['6.required'] = 'kelompok laporan posisi keuangan (kolom G) wajib diisi.';
                }

                Validator::make($item->toArray(), $validator[1],$validator[2])->validate();

                $data = [
                    'kelompok_akun_id'                  => $item[0],
                    'kode'                              => $kode,
                    'nama'                              => $item[2],
                    'post_saldo'                        => $item[3] == 'Debit' ? 1 : 2,
                    'post_penyesuaian'                  => $item[4] == 'Debit' ? 1 : 2,
                    'post_laporan'                      => $item[5] == 'Neraca' ? 1 : 2,
                    'kelompok_laporan_posisi_keuangan'  => $item[6],
                ];

                $akun = Akun::where('kode', $kode)->first();

                if ($akun) {
                    $akun->update($data);
                } else {
                    Akun::create($data);
                }
            }
            return back()->with('success', 'File xlsx berhasil di import');
        } catch (\Throwable $th) {
            return back()->with('error',"File xlsx gagal di import");
        }
    }
}
