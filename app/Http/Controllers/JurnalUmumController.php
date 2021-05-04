<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurnalUmumRequest;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurnal_umum = JurnalUmum::orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->paginate(10);

        if ($request->cari) {
            $jurnal_umum = JurnalUmum::where('keterangan','like',"%{$request->cari}%")
                            ->orWhere('tanggal','like',"%{$request->cari}%")
                            ->orWhereHas('akun', function ($jurnal_umum) use ($request) {
                                $jurnal_umum->where('nama','like',"%{$request->cari}%");
                                $jurnal_umum->orWhere('kode','like',"%{$request->cari}%");
                            })
                            ->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->paginate(10);
        }

        $jurnal_umum->appends($request->all());

        return view('jurnal-umum.index', compact('jurnal_umum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurnal-umum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JurnalUmumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurnalUmumRequest $request)
    {
        $data = $request->validated();

        if($request->bukti) {
            $data['bukti']  = $request->bukti->store('public/bukti');
        }

        JurnalUmum::create($data);

        return response()->json([
            'message'   => 'Jurnal umum berhasil ditambahkan',
            'redirect'  => route('jurnal-umum.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JurnalUmum  $jurnal_umum
     * @return \Illuminate\Http\Response
     */
    public function show(JurnalUmum $jurnal_umum)
    {
        $judul = $jurnal_umum->keterangan.'.'.substr(strrchr(storage_path('app/'.$jurnal_umum->bukti),'.'),1);
        return response()->file(storage_path('app/' . $jurnal_umum->bukti),[
            'Content-Disposition'   => 'inline; filename="'.$judul.'"'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JurnalUmum  $jurnal_umum
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalUmum $jurnal_umum)
    {
        return view('jurnal-umum.edit', compact('jurnal_umum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JurnalUmumRequest  $request
     * @param  \App\JurnalUmum  $jurnal_umum
     * @return \Illuminate\Http\Response
     */
    public function update(JurnalUmumRequest $request, JurnalUmum $jurnal_umum)
    {
        $data = $request->validated();

        if($request->bukti) {
            if ($jurnal_umum->bukti) {
                unlink(storage_path('app/' . $jurnal_umum->bukti));
            }

            $data['bukti']  = $request->bukti->store('public/bukti');
        }

        $jurnal_umum->update($data);

        return response()->json([
            'message'   => 'Jurnal umum berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalUmum  $jurnal_umum
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalUmum $jurnal_umum)
    {
        if ($jurnal_umum->bukti) {
            unlink(storage_path('app/' . $jurnal_umum->bukti));
        }

        $jurnal_umum->delete();
        return back()->with('success','Jurnal umum berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalUmum  $jurnal_umum
     * @return \Illuminate\Http\Response
     */
    public function destroys(Request $request)
    {
        foreach ($request->id as $item) {
            $jurnal_umum = JurnalUmum::find($item);

            if ($jurnal_umum->bukti) {
                unlink(storage_path('app/' . $jurnal_umum->bukti));
            }

            $jurnal_umum->delete();
        }

        return response()->json([
            'message'   => 'Jurnal umum berhasil dihapus'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalUmum  $jurnal_umum
     * @return \Illuminate\Http\Response
     */
    public function delete(JurnalUmum $jurnal_umum)
    {
        if ($jurnal_umum->bukti) {
            unlink(storage_path('app/' . $jurnal_umum->bukti));
        }

        $jurnal_umum->bukti = null;
        $jurnal_umum->save();
        return back()->with('success','Bukti berhasil dihapus');
    }

    public function laporan(Request $request)
    {
        $request->validate([
            'awal'  => ['required','date'],
            'akhir' => ['required','date'],
        ]);

        if (!$request->awal || !$request->akhir) {
            return redirect()->route('jurnal-umum.index');
        }

        $from = $request->awal;
        $to = $request->akhir;
        $jurnal_umum = JurnalUmum::whereBetween('tanggal', [$from, $to])->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();

        return view('jurnal-umum.laporan', compact('jurnal_umum'));
    }
}
