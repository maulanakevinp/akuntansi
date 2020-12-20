<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalPenyesuaian extends Model
{
    protected $table    = 'jurnal_penyesuaian';
    protected $guarded  = [];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
