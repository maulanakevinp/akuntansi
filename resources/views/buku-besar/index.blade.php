@extends('layouts.app')
@section('judul', 'Buku Besar - Sistem Informasi Akuntansi')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endsection

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Buku Besar</h2>
                        <p class="mb-0 text-sm">Kelola Buku Besar</p>
                        <form class="mt-3" action="{{ route("buku-besar.index") }}" method="get">
                            <div class="form-group row">
                                <label class="form-control-label col-md-3" for="kode_akun">Akun</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="kode_akun" id="kode_akun">
                                        @foreach (App\Models\Akun::all() as $item)
                                            <option value="{{ $item->kode }}" {{ request('kode_akun') == $item->kode ? 'selected' : '' }}>{{ $item->kode }} - {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback font-weight-bold"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label col-md-3 col-form-label" for="kriteria">Kriteria</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="kriteria" id="kriteria">
                                        <option value="periode" {{ request('kriteria') == 'periode' ? 'selected' : '' }}>Periode</option>
                                        <option value="rentang-waktu" {{ request('kriteria') == 'rentang-waktu' ? 'selected' : '' }}>Rentang Waktu (tanggal awal s/d tanggal akhir)</option>
                                        <option value="bulan" {{ request('kriteria') == 'bulan' ? 'selected' : '' }}>Bulan</option>
                                    </select>
                                    <span class="invalid-feedback font-weight-bold"></span>
                                </div>
                            </div>
                            <div id="periode" class="form-group row">
                                <label class="form-control-label col-md-3 col-form-label" for="periode">Periode</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="periode" id="periode">
                                        <option value="1-bulan-terakhir" {{ request('periode') == '1-bulan-terakhir' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                                        <option value="1-minggu-terakhir" {{ request('periode') == '1-minggu-terakhir' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                                        <option value="hari-ini" {{ request('periode') == 'hari-ini' ? 'selected' : '' }}>Hari Ini</option>
                                    </select>
                                    <span class="invalid-feedback font-weight-bold"></span>
                                </div>
                            </div>
                            <div id="rentang-waktu">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-3 col-form-label" for="tanggal_awal">Tanggal Awal</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-control-label col-md-3 col-form-label" for="tanggal_akhir">Tanggal Akhir</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                                    </div>
                                </div>
                            </div>
                            <div id="bulan" class="form-group row">
                                <label class="form-control-label col-md-3 col-form-label" for="bulan">Bulan</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="month" name="bulan" value="{{ request('bulan') }}">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($akun && $jurnal)
    <div class="container-fluid mt--7">
        <div class="card shadow">
            <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                <span class="font-weight-900">Nama Akun : {{ $akun->nama }}</span>
                <span class="font-weight-900">Kode Akun : {{ $akun->kode }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-striped table-bordered mb-3">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;" width="100px"><a href="{{ request('tanggal') == 1 ? url()->full() . '&tanggal=0' : url()->full() . '&tanggal=1' }}">Tanggal {!! request('tanggal') == 1 ? '<i class="fas fa-caret-up"></i>' : '<i class="fas fa-caret-down"></i>' !!}</a></th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Keterangan</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Debit</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">Kredit</th>
                                <th colspan="2" style="text-align: center;">Saldo</th>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle; text-align: center;">Debit</th>
                                <th style="vertical-align: middle; text-align: center;">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nilai = 0;
                            @endphp
                            @forelse ($jurnal as $item)
                                @php
                                    if ($item['debit_atau_kredit'] == $item['akun_post_saldo']) {
                                        $nilai += $item['nilai'];
                                    } else {
                                        $nilai -= $item['nilai'];
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ tgl($item['tanggal']) }}</td>
                                    <td>{{ $item['keterangan'] }}</td>
                                    <td class="text-right">{{ $item['debit_atau_kredit'] == 1 ? 'Rp. ' . substr(number_format($item['nilai'], 2, ',', '.'),0,-3) : '-' }}</td>
                                    <td class="text-right">{{ $item['debit_atau_kredit'] == 2 ? 'Rp. ' . substr(number_format($item['nilai'], 2, ',', '.'),0,-3) : '-' }}</td>
                                    <td class="text-right">{{ $item['akun_post_saldo'] == 1 ? 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) : '-' }}</td>
                                    <td class="text-right">{{ $item['akun_post_saldo'] == 2 ? 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) : '-' }}</td>
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
@endif
@endsection

@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#btn-cari').click(function (e) {
            e.preventDefault();
            $("#cari").modal('show');
        });

        $('#kode_akun').select2({
            placeholder: "Pilih Akun",
            allowClear: true
        });

        kriteria();

        $("#kriteria").change(function () {
            kriteria();
        });
    });

    function kriteria(){
        switch ($("#kriteria").val()) {
            case 'periode':
                $("#periode").show();
                $("#rentang-waktu").hide();
                $("#bulan").hide();
                break;
            case 'rentang-waktu':
                $("#periode").hide();
                $("#rentang-waktu").show();
                $("#bulan").hide();
                break;
            case 'bulan':
                $("#periode").hide();
                $("#rentang-waktu").hide();
                $("#bulan").show();
                break;
        }
    }
</script>
@endpush
