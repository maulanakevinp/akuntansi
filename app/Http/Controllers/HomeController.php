<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return redirect('/akun');
    }

    public function pengaturan()
    {
        return view('pengaturan');
    }
}
