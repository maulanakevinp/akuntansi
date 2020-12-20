<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table    = 'akun';
    protected $guarded  = [];

    public function jurnal_umum()
    {
        return $this->hasMany(JurnalUmum::class);
    }

    public function jurnal_penyesuaian()
    {
        return $this->hasMany(JurnalPenyesuaian::class);
    }
}
