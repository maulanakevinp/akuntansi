<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class NeracaLajurController extends Controller
{
    public function index()
    {
        $akun = Akun::orderBy('kode')->get();
        return view('neraca-lajur.index', compact('akun'));
    }
}
