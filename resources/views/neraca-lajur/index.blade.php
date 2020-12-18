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
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="">
                                <h2 class="mb-0">Neraca Lajur</h2>
                                <p class="mb-0 text-sm">Kelola Neraca Lajur</p>
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
                    <thead class="bg-primary text-white">
                        <tr>
                            <th rowspan="2" style="vertical-align: middle; text-align: center">Kode</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center">Nama</th>
                            <th colspan="2" style="vertical-align: middle; text-align: center">Neraca Saldo</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($akun as $item)
                            <tr>
                                <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-right">
                                    @php
                                        $nilai = 0;
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            $nilai += $jurnal_umum->nilai;
                                        }
                                    @endphp
                                    {{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) : '-' }}
                                </td>
                                <td class="text-right">
                                    @php
                                        $nilai = 0;
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            $nilai += $jurnal_umum->nilai;
                                        }
                                    @endphp
                                    {{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) : '-' }}
                                </td>
                                <td class="text-right">-</td>
                                <td class="text-right">-</td>
                                <td class="text-right">-</td>
                                <td class="text-right">-</td>
                                <td class="text-right">-</td>
                                <td class="text-right">-</td>
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
                            <th class="text-right">
                                @php
                                    $nilai = 0;
                                    foreach ($akun as $item) {
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            if ($jurnal_umum->akun->post_saldo == 1) {
                                                $nilai += $jurnal_umum->nilai;
                                            }
                                        }
                                    }
                                @endphp
                                {{ 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) }}
                            </th>
                            <th class="text-right">
                                @php
                                    $nilai = 0;
                                    foreach ($akun as $item) {
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            if ($jurnal_umum->akun->post_saldo == 2) {
                                                $nilai += $jurnal_umum->nilai;
                                            }
                                        }
                                    }
                                @endphp
                                {{ 'Rp. ' . substr(number_format($nilai, 2, ',', '.'),0,-3) }}
                            </th>
                            <th class="text-right">-</th>
                            <th class="text-right">-</th>
                            <th class="text-right">-</th>
                            <th class="text-right">-</th>
                            <th class="text-right">-</th>
                            <th class="text-right">-</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-right">Selisih</th>
                            <th colspan="2" class="text-right">
                                @php
                                    $debit = 0;
                                    $kredit = 0;
                                    foreach ($akun as $item) {
                                        foreach ($item->jurnal_umum as $jurnal_umum) {
                                            if ($jurnal_umum->akun->post_saldo == 1) {
                                                $debit += $jurnal_umum->nilai;
                                            } else {
                                                $kredit += $jurnal_umum->nilai;
                                            }
                                        }
                                    }
                                @endphp
                                {{ 'Rp. ' . substr(number_format($kredit - $debit, 2, ',', '.'),0,-3) }}
                            </th>
                            <th colspan="2" class="text-right">-</th>
                            <th colspan="2" class="text-right">-</th>
                            <th colspan="2" class="text-right">-</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
