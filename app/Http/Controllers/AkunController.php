<?php

namespace App\Http\Controllers;

use App\Http\Requests\AkunRequest;
use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $akun = Akun::orderBy('kode')->paginate(10);

        if ($request->cari) {
            $akun = Akun::where('nama','like',"%{$request->cari}%")
                            ->orWhere('kode','like',"%{$request->cari}%")
                            ->orderBy('kode')->paginate(10);
            if ($request->cari == 'debit') {
                $akun = Akun::where('post_saldo', 1)->orderBy('kode')->paginate(10);
            }

            if ($request->cari == 'kredit') {
                $akun = Akun::where('post_saldo', 2)->orderBy('kode')->paginate(10);
            }

            if ($request->cari == 'neraca') {
                $akun = Akun::where('post_laporan', 1)->orderBy('kode')->paginate(10);
            }

            if ($request->cari == 'laba rugi') {
                $akun = Akun::where('post_laporan', 2)->orderBy('kode')->paginate(10);
            }
        }

        $akun->appends($request->only('cari'));

        return view('akun.index', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AkunRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AkunRequest $request)
    {
        Akun::create($request->all());

        return response()->json([
            'message'   => 'Akun berhasil ditambahkan',
            'redirect'  => route('akun.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AkunRequest  $request
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(AkunRequest $request, Akun $akun)
    {
        $akun->update($request->all());

        return response()->json([
            'message'   => 'Akun berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();
        return back()->with('success','Akun berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroys(Request $request)
    {
        Akun::whereIn('id', $request->id)->delete();
        return response()->json([
            'message'   => 'Akun berhasil dihapus'
        ]);
    }
}
