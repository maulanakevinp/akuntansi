<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurnalPenyesuaianRequest;
use App\Models\JurnalPenyesuaian;
use Illuminate\Http\Request;

class JurnalPenyesuaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurnal_penyesuaian = JurnalPenyesuaian::orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->paginate(10);

        if ($request->cari) {
            $jurnal_penyesuaian = JurnalPenyesuaian::where('keterangan','like',"%{$request->cari}%")
                            ->orWhere('tanggal','like',"%{$request->cari}%")
                            ->orWhereHas('akun', function ($jurnal_penyesuaian) use ($request) {
                                $jurnal_penyesuaian->where('nama','like',"%{$request->cari}%");
                                $jurnal_penyesuaian->orWhere('kode','like',"%{$request->cari}%");
                            })
                            ->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->paginate(10);
        }

        $jurnal_penyesuaian->appends($request->all());

        return view('jurnal-penyesuaian.index', compact('jurnal_penyesuaian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurnal-penyesuaian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JurnalPenyesuaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurnalPenyesuaianRequest $request)
    {
        $data = $request->validated();

        if($request->bukti) {
            $data['bukti']  = $request->bukti->store('public/bukti');
        }

        JurnalPenyesuaian::create($data);

        return response()->json([
            'message'   => 'Jurnal penyesuaian berhasil ditambahkan',
            'redirect'  => route('jurnal-penyesuaian.index')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JurnalPenyesuaian  $jurnal_penyesuaian
     * @return \Illuminate\Http\Response
     */
    public function show(JurnalPenyesuaian $jurnal_penyesuaian)
    {
        return response()->download(storage_path('app/' . $jurnal_penyesuaian->bukti),$jurnal_penyesuaian->keterangan.'.'.substr(strrchr(storage_path('app/'.$jurnal_penyesuaian->bukti),'.'),1));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JurnalPenyesuaian  $jurnal_penyesuaian
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalPenyesuaian $jurnal_penyesuaian)
    {
        return view('jurnal-penyesuaian.edit', compact('jurnal_penyesuaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JurnalPenyesuaianRequest  $request
     * @param  \App\JurnalPenyesuaian  $jurnal_penyesuaian
     * @return \Illuminate\Http\Response
     */
    public function update(JurnalPenyesuaianRequest $request, JurnalPenyesuaian $jurnal_penyesuaian)
    {
        $data = $request->validated();

        if($request->bukti) {
            if ($jurnal_penyesuaian->bukti) {
                unlink(storage_path('app/' . $jurnal_penyesuaian->bukti));
            }

            $data['bukti']  = $request->bukti->store('public/bukti');
        }

        $jurnal_penyesuaian->update($data);

        return response()->json([
            'message'   => 'Jurnal penyesuaian berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalPenyesuaian  $jurnal_penyesuaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalPenyesuaian $jurnal_penyesuaian)
    {
        if ($jurnal_penyesuaian->bukti) {
            unlink(storage_path('app/' . $jurnal_penyesuaian->bukti));
        }

        $jurnal_penyesuaian->delete();
        return back()->with('success','Jurnal penyesuaian berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalPenyesuaian  $jurnal_penyesuaian
     * @return \Illuminate\Http\Response
     */
    public function destroys(Request $request)
    {
        foreach ($request->id as $item) {
            $jurnal_penyesuaian = JurnalPenyesuaian::find($item);

            if ($jurnal_penyesuaian->bukti) {
                unlink(storage_path('app/' . $jurnal_penyesuaian->bukti));
            }

            $jurnal_penyesuaian->delete();
        }

        return response()->json([
            'message'   => 'Jurnal penyesuaian berhasil dihapus'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JurnalPenyesuaian  $jurnal_penyesuaian
     * @return \Illuminate\Http\Response
     */
    public function delete(JurnalPenyesuaian $jurnal_penyesuaian)
    {
        if ($jurnal_penyesuaian->bukti) {
            unlink(storage_path('app/' . $jurnal_penyesuaian->bukti));
        }

        $jurnal_penyesuaian->bukti = null;
        $jurnal_penyesuaian->save();
        return back()->with('success','Bukti berhasil dihapus');
    }

    public function laporan(Request $request)
    {
        $request->validate([
            'awal'  => ['required','date'],
            'akhir' => ['required','date'],
        ]);

        if (!$request->awal || !$request->akhir) {
            return redirect()->route('jurnal-penyesuaian.index');
        }

        $from = $request->awal;
        $to = $request->akhir;
        $jurnal_penyesuaian = JurnalPenyesuaian::whereBetween('tanggal', [$from, $to])->orderBy('tanggal', $request->tanggal == 1 ? 'desc' : 'asc')->get();

        return view('jurnal-penyesuaian.laporan', compact('jurnal_penyesuaian'));
    }
}
