@extends('layouts.app')
@section('judul','Jurnal Penutup - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <h2 class="mb-0">Jurnal Penutup</h2>
                        <p class="mb-0 text-sm">Kelola Jurnal Penutup</p>
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
                    <tbody>
                        @foreach ($akun->where('kelompok_akun_id', 4) as $item)
                            @php
                                $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                            @endphp
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td class="text-right pendapatan kiri">{{ 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) }}</td>
                                <td class="text-right kanan">-</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td> &nbsp; &nbsp; &nbsp; &nbsp; Iktisar Laba-Rugi</td>
                            <td class="text-right kiri">-</td>
                            <td class="text-right kanan" id="iktisar_laba_rugi_pendapatan"></td>
                        </tr>
                        <tr>
                            <td>Iktisar Laba-Rugi</td>
                            <td class="text-right kiri" id="iktisar_laba_rugi_beban"></td>
                            <td class="text-right kanan">-</td>
                        </tr>
                        @foreach ($akun->where('kelompok_akun_id',6) as $item)
                            @php
                                $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                            @endphp
                            <tr>
                                <td> &nbsp; &nbsp; &nbsp; &nbsp; {{ $item->nama }}</td>
                                <td class="text-right kiri">-</td>
                                <td class="text-right beban kanan">{{ 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td id="judul_modal_laba_rugi"></td>
                            <td class="text-right kiri" id="modal_laba_rugi_kiri">-</td>
                            <td class="text-right kanan" id="modal_laba_rugi_kanan">-</td>
                        </tr>
                        <tr>
                            <td id="judul_laba_rugi_modal"></td>
                            <td class="text-right kiri" id="laba_rugi_modal_kiri">-</td>
                            <td class="text-right kanan" id="laba_rugi_modal_kanan">-</td>
                        </tr>
                        @php
                            $disesuaikan = 0;
                            $prive = App\Models\Akun::where('nama','prive')->first();
                            if ($prive) {
                                $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $prive);
                                $disesuaikan = $data['disesuaikan'];
                            }
                        @endphp
                        <tr>
                            <td>Modal</td>
                            <td class="text-right kiri">{{ 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) }}</td>
                            <td class="text-right kanan">-</td>
                        </tr>
                        <tr>
                            <td> &nbsp; &nbsp; &nbsp; &nbsp; Prive</td>
                            <td class="text-right kiri">-</td>
                            <td class="text-right kanan">{{ 'Rp. ' . substr(number_format($disesuaikan, 2, ',', '.'),0,-3) }}</td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-primary text-white">
                        <tr>
                            <th class="text-right">Total</th>
                            <th class="text-right" id="total_kiri"></th>
                            <th class="text-right" id="total_kanan"></th>
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
        $("#iktisar_laba_rugi_pendapatan").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('pendapatan')));
        $("#iktisar_laba_rugi_beban").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('beban')));

        let laba_rugi = angka($("#iktisar_laba_rugi_pendapatan").html()) - angka($("#iktisar_laba_rugi_beban").html());
        if (laba_rugi > 0) {
            $("#judul_modal_laba_rugi").html(`Iktisar Laba-Rugi`);
            $("#modal_laba_rugi_kiri").html('Rp. ' + new Intl.NumberFormat('id-ID').format(laba_rugi));
            $("#judul_laba_rugi_modal").html(`&nbsp; &nbsp; &nbsp; &nbsp; Modal`);
            $("#laba_rugi_modal_kanan").html('Rp. ' + new Intl.NumberFormat('id-ID').format(laba_rugi));
        } else {
            $("#judul_modal_laba_rugi").html(`Modal`);
            $("#modal_laba_rugi_kiri").html('Rp. ' + new Intl.NumberFormat('id-ID').format(laba_rugi));
            $("#judul_laba_rugi_modal").html(`&nbsp; &nbsp; &nbsp; &nbsp; Iktisar Laba-Rugi`);
            $("#laba_rugi_modal_kanan").html('Rp. ' + new Intl.NumberFormat('id-ID').format(laba_rugi));
        }

        $("#total_kiri").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('kiri')));
        $("#total_kanan").html('Rp. ' + new Intl.NumberFormat('id-ID').format(jumlah('kanan')));

        kriteria();
        $("#kriteria").change(function () {
            kriteria();
        });
    });
</script>
@endpush
