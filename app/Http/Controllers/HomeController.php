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

    public function reset_data()
    {
        $conn = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));

        $templine = '';
        $lines = file(public_path('db/akuntansi.sql'));
        foreach ($lines as $key => $line) {
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;
            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                $conn->query($templine);
                $templine = '';
            }
        }

        mysqli_close($conn);
        return back()->with('success', 'Data berhasil direset');
    }

    public function pengaturan()
    {
        return view('pengaturan');
    }
}
