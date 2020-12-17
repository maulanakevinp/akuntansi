@extends('layouts.app')
@section('judul', $akun->nama . ' - '. $akun->kode .' - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">{{ $akun->nama . ' - '. $akun->kode }}</h2>
                                <p class="mb-0 text-sm">Detail Akun : {{ $akun->nama . ' - '. $akun->kode }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ URL::previous() }}" class="btn btn-success" title="Kembali" data-toggle="tooltip"><i class="fas fa-arrow-left"></i></a>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped table-bordered">
                    <thead>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Debit</th>
                        <th class="text-center">Kredit</th>
                    </thead>
                    <tbody>
                    @forelse ($jurnal_umum as $item)
                            <tr>
                                <td style="vertical-align: middle; text-align: center">{{ $item->tanggal }}</td>
                                <td style="vertical-align: middle">{{ $item->keterangan }}</td>
                                <td style="vertical-align: middle; text-align: right">{{ $item->akun->post_saldo == 1 ? 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td style="vertical-align: middle; text-align: right">{{ $item->akun->post_saldo == 2 ? 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3) : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" align="center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
