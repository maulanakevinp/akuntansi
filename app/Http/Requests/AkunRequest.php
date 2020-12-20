<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AkunRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = [
            'kelompok_akun_id'                  => ['required','numeric'],
            'kode'                              => ['required','digits:4','unique:akun,kode'],
            'nama'                              => ['required','string','max:128'],
            'post_saldo'                        => ['required','numeric'],
            'post_penyesuaian'                  => ['required','numeric'],
            'post_laporan'                      => ['required','numeric'],
            'kelompok_laporan_posisi_keuangan'  => ['nullable','numeric'],
        ];

        if (request()->isMethod('put')) {
            $akun = $this->akun->id;
            $data['kode'] = ['required','digits:4',"unique:akun,kode,$akun"];
        }

        if (request('kelompok_akun_id') == 1 || request('kelompok_akun_id') == 2) {
            $data['kelompok_laporan_posisi_keuangan'] = ['required','numeric'];
        }

        return $data;
    }
}
