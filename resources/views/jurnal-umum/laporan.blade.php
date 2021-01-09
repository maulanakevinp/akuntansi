@extends('layouts.app')
@section('judul','Laporan Jurnal Umum - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Laporan Jurnal Umum</h2>
                                <p class="mb-0 text-sm">Kelola Laporan Jurnal Umum</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('jurnal-umum.index') }}" class="btn btn-success" title="Kembali" data-toggle="tooltip"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="card-header font-weight-bold">Laporan Jurnal Umum Per ({{ date('d F Y',strtotime(request('awal'))) }} s/d {{ date('d F Y',strtotime(request('akhir'))) }})</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped table-bordered">
                    <thead class="bg-success text-white">
                        <tr>
                            <th class="text-center"><a href="{{ request('tanggal') == 1 ? url()->full() . '&tanggal=0' : url()->full() . '&tanggal=1' }}">Tanggal {!! request('tanggal') == 1 ? '<i class="fas fa-caret-up"></i>' : '<i class="fas fa-caret-down"></i>' !!}</a></th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Akun</th>
                            <th class="text-center">Debit</th>
                            <th class="text-center">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $debit = 0; $kredit = 0;
                        @endphp
                        @forelse ($jurnal_umum as $item)
                            <tr>
                                <td class="text-center">{{ tgl($item->tanggal) }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td class="text-center"><a href="{{ url('/buku-besar?kode_akun=' . $item->akun->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}" data-toggle="tooltip" title="{{ $item->akun->nama }}">{{ $item->akun->kode }}</a></td>
                                <td class="text-right">
                                    @php
                                        if ($item->debit_atau_kredit == 1) {
                                            $debit += $item->nilai;
                                            echo 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3);
                                        } else {
                                            echo '-';
                                        }
                                    @endphp
                                </td>
                                <td class="text-right">
                                    @php
                                        if ($item->debit_atau_kredit == 2) {
                                            $kredit += $item->nilai;
                                            echo 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3);
                                        } else {
                                            echo '-';
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" align="center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-success text-white">
                        <tr>
                            <th colspan="3" class="text-right">Total</th>
                            <th class="text-right font-weight-bolder">Rp. {{ substr(number_format($debit, 2, ',', '.'),0,-3) }}</th>
                            <th class="text-right font-weight-bolder">Rp. {{ substr(number_format($kredit, 2, ',', '.'),0,-3) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

