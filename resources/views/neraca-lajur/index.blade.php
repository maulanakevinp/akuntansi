@extends('layouts.app')
@section('judul','Neraca Lajur - Sistem Informasi Akuntansi')

@section('css')
<style>
    .card .table td, .card .table th {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>
@endsection

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Neraca Lajur</h2>
                        <p class="mb-0 text-sm">Kelola Neraca Lajur</p>
                        <form class="mt-3" action="{{ url()->current() }}" method="get">
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
<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th rowspan="2" style="vertical-align: middle; text-align: center">Kode</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center">Nama</th>
                            <th colspan="2" style="vertical-align: middle; text-align: center">Neraca Saldo</th>
                            <th colspan="2" style="vertical-align: middle; text-align: center">Penyesuaian</th>
                            <th colspan="2" style="vertical-align: middle; text-align: center">Neraca Saldo Disesuaikan</th>
                            <th colspan="2" style="vertical-align: middle; text-align: center">Laporan Laba Rugi</th>
                            <th colspan="2" style="vertical-align: middle; text-align: center">Neraca</th>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: center">Debit</th>
                            <th style="vertical-align: middle; text-align: center">Kredit</th>
                            <th style="vertical-align: middle; text-align: center">Debit</th>
                            <th style="vertical-align: middle; text-align: center">Kredit</th>
                            <th style="vertical-align: middle; text-align: center">Debit</th>
                            <th style="vertical-align: middle; text-align: center">Kredit</th>
                            <th style="vertical-align: middle; text-align: center">Debit</th>
                            <th style="vertical-align: middle; text-align: center">Kredit</th>
                            <th style="vertical-align: middle; text-align: center">Debit</th>
                            <th style="vertical-align: middle; text-align: center">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($akun as $item)
                            @php
                                $saldo= 0; $penyesuaian = 0;
                                switch (request('kriteria')) {
                                    case 'periode':
                                        switch (request('periode')) {
                                            case '1-bulan-terakhir':
                                                foreach ($item->jurnal_umum as $jurnal_umum) {
                                                    if (date('Y-m',strtotime($jurnal_umum->tanggal)) == date('Y-m')) {
                                                        if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
                                                            $saldo += $jurnal_umum->nilai;
                                                        } else {
                                                            $saldo -= $jurnal_umum->nilai;
                                                        }
                                                    }
                                                }

                                                foreach ($item->jurnal_penyesuaian as $jurnal_penyesuaian) {
                                                    if (date('Y-m',strtotime($jurnal_penyesuaian->tanggal)) == date('Y-m')) {
                                                        $penyesuaian += $jurnal_penyesuaian->nilai;
                                                    }
                                                }

                                                break;

                                            case '1-minggu-terakhir':
                                                foreach ($item->jurnal_umum->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')]) as $jurnal_umum) {
                                                    if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
                                                        $saldo += $jurnal_umum->nilai;
                                                    } else {
                                                        $saldo -= $jurnal_umum->nilai;
                                                    }
                                                }

                                                foreach ($item->jurnal_penyesuaian->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')]) as $jurnal_penyesuaian) {
                                                    $penyesuaian += $jurnal_penyesuaian->nilai;
                                                }

                                                break;
                                        }
                                        break;

                                    case 'rentang-waktu':
                                        foreach ($item->jurnal_umum->whereBetween('tanggal', [request('tanggal_awal'), request('tanggal_akhir')]) as $jurnal_umum) {
                                            if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
                                                $saldo += $jurnal_umum->nilai;
                                            } else {
                                                $saldo -= $jurnal_umum->nilai;
                                            }
                                        }

                                        foreach ($item->jurnal_penyesuaian->whereBetween('tanggal', [request('tanggal_awal'), request('tanggal_akhir')]) as $jurnal_penyesuaian) {
                                            $penyesuaian += $jurnal_penyesuaian->nilai;
                                        }

                                        break;

                                    case 'bulan':
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            if (date('Y-m',strtotime($jurnal_umum->tanggal)) == date('Y-m', strtotime(request('bulan')))) {
                                                if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
                                                    $saldo += $jurnal_umum->nilai;
                                                } else {
                                                    $saldo -= $jurnal_umum->nilai;
                                                }
                                            }
                                        }

                                        foreach ($item->jurnal_penyesuaian as $jurnal_penyesuaian) {
                                            if (date('Y-m',strtotime($jurnal_penyesuaian->tanggal)) == date('Y-m', strtotime(request('bulan')))) {
                                                $penyesuaian += $jurnal_penyesuaian->nilai;
                                            }
                                        }

                                        break;

                                    default:
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
                                                $saldo += $jurnal_umum->nilai;
                                            } else {
                                                $saldo -= $jurnal_umum->nilai;
                                            }
                                        }

                                        foreach ($item->jurnal_penyesuaian as $jurnal_penyesuaian) {
                                            $penyesuaian += $jurnal_penyesuaian->nilai;
                                        }

                                        break;
                                }

                                if ($item->post_saldo == $item->post_penyesuaian) {
                                    $disesuaikan = $saldo + $penyesuaian;
                                } else {
                                    $disesuaikan = $saldo - $penyesuaian;
                                }
                            @endphp
                            <tr>
                                <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-right neraca_saldo_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($saldo, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td class="text-right neraca_saldo_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($saldo, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td class="text-right penyesuaian_debit">{{ $item->post_penyesuaian == 1 ? 'Rp. ' . substr(number_format($penyesuaian, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td class="text-right penyesuaian_kredit">{{ $item->post_penyesuaian == 2 ? 'Rp. ' . substr(number_format($penyesuaian, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td class="text-right disesuaikan_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td class="text-right disesuaikan_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) : '-' }}</td>
                                @if ($item->post_laporan == 2)
                                    <td class="text-right laba_rugi_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) : '-' }}</td>
                                    <td class="text-right laba_rugi_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) : '-' }}</td>
                                    <td class="text-right neraca_debit">-</td>
                                    <td class="text-right neraca_kredit">-</td>
                                    @else
                                    <td class="text-right laba_rugi_debit"></td>
                                    <td class="text-right laba_rugi_kredit"></td>
                                    <td class="text-right neraca_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) : '-' }}</td>
                                    <td class="text-right neraca_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) : '-' }}</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" align="center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-primary text-white">
                        <tr>
                            <th colspan="2" class="text-right">Jumlah</th>
                            <th class="text-right" id="jumlah_neraca_saldo_debit"></th>
                            <th class="text-right" id="jumlah_neraca_saldo_kredit"></th>
                            <th class="text-right" id="jumlah_penyesuaian_debit"></th>
                            <th class="text-right" id="jumlah_penyesuaian_kredit"></th>
                            <th class="text-right" id="jumlah_disesuaikan_debit"></th>
                            <th class="text-right" id="jumlah_disesuaikan_kredit"></th>
                            <th class="text-right" id="jumlah_laba_rugi_debit"></th>
                            <th class="text-right" id="jumlah_laba_rugi_kredit"></th>
                            <th class="text-right" id="jumlah_neraca_debit"></th>
                            <th class="text-right" id="jumlah_neraca_kredit"></th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-right">Selisih</th>
                            <th colspan="2" class="text-right" id="selisih_neraca_saldo"></th>
                            <th colspan="2" class="text-right" id="selisih_penyesuaian"></th>
                            <th colspan="2" class="text-right" id="selisih_disesuaikan"></th>
                            <th colspan="2" class="text-right" id="selisih_laba_rugi"></th>
                            <th colspan="2" class="text-right" id="selisih_neraca"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $("#jumlah_neraca_saldo_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('neraca_saldo_debit')));
        $("#jumlah_neraca_saldo_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('neraca_saldo_kredit')));
        $("#selisih_neraca_saldo").html('Rp. ' + new Intl.NumberFormat('id-ID').format(Math.abs(angka($("#jumlah_neraca_saldo_kredit").html()) - angka($("#jumlah_neraca_saldo_debit").html()))));

        $("#jumlah_penyesuaian_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('penyesuaian_debit')));
        $("#jumlah_penyesuaian_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('penyesuaian_kredit')));
        $("#selisih_penyesuaian").html('Rp. ' + new Intl.NumberFormat('id-ID').format(Math.abs(angka($("#jumlah_penyesuaian_kredit").html()) - angka($("#jumlah_penyesuaian_debit").html()))));

        $("#jumlah_disesuaikan_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('disesuaikan_debit')));
        $("#jumlah_disesuaikan_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('disesuaikan_kredit')));
        $("#selisih_disesuaikan").html('Rp. ' + new Intl.NumberFormat('id-ID').format(Math.abs(angka($("#jumlah_disesuaikan_kredit").html()) - angka($("#jumlah_disesuaikan_debit").html()))));

        $("#jumlah_laba_rugi_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('laba_rugi_debit')));
        $("#jumlah_laba_rugi_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('laba_rugi_kredit')));
        $("#selisih_laba_rugi").html('Rp. ' + new Intl.NumberFormat('id-ID').format(angka($("#jumlah_laba_rugi_kredit").html()) - angka($("#jumlah_laba_rugi_debit").html())));

        $("#jumlah_neraca_debit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('neraca_debit')));
        $("#jumlah_neraca_kredit").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('neraca_kredit')));
        $("#selisih_neraca").html('Rp. ' + new Intl.NumberFormat('id-ID').format(Math.abs(angka($("#jumlah_neraca_kredit").html()) - angka($("#jumlah_neraca_debit").html()))));
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

    function angka(str){
        let res = str.replace('Rp. ','');
        let angka = res.replaceAll('.','');
        let nilai = parseFloat(angka);
        if (isNaN(nilai)) {
            nilai = 0;
        }
        return nilai;
    }

    function jumlah(nama){
        let nilai = 0;
        $(`.${nama}`).each(function () {
            nilai += angka($(this).html());
        });
        return nilai;
    }
</script>
@endpush
