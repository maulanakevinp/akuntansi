<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    protected $table    = 'jurnal_umum';
    protected $guarded  = [];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
