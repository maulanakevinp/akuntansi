@extends('layouts.app')
@section('judul','Neraca Lajur - Sistem Informasi Akuntansi')

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
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-2 mb-2" role="presentation">
                    <a class="nav-link active" id="pills-neraca-saldo-tab" data-toggle="pill" href="#pills-neraca-saldo" role="tab" aria-controls="pills-neraca-saldo" aria-selected="true">Neraca Saldo</a>
                </li>
                <li class="nav-item mr-2 mb-2" role="presentation">
                    <a class="nav-link" id="pills-penyesuaian-tab" data-toggle="pill" href="#pills-penyesuaian" role="tab" aria-controls="pills-penyesuaian" aria-selected="false">Penyesuaian</a>
                </li>
                <li class="nav-item mr-2 mb-2" role="presentation">
                    <a class="nav-link" id="pills-disesuaikan-tab" data-toggle="pill" href="#pills-disesuaikan" role="tab" aria-controls="pills-disesuaikan" aria-selected="false">Neraca Saldo Disesuaikan</a>
                </li>
                <li class="nav-item mr-2 mb-2" role="presentation">
                    <a class="nav-link" id="pills-laba-rugi-tab" data-toggle="pill" href="#pills-laba-rugi" role="tab" aria-controls="pills-laba-rugi" aria-selected="false">Laporan Laba Rugi</a>
                </li>
                <li class="nav-item mr-2 mb-2" role="presentation">
                    <a class="nav-link" id="pills-neraca-tab" data-toggle="pill" href="#pills-neraca" role="tab" aria-controls="pills-neraca" aria-selected="false">Neraca</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-neraca-saldo" role="tabpanel" aria-labelledby="pills-neraca-saldo-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Kode</th>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Nama</th>
                                    <th colspan="2" class="text-center">Neraca Saldo</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($akun as $item)
                                    @php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    @endphp
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-right neraca_saldo_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['saldo'], 2, ',', '.'),0,-3) : '-' }}</td>
                                        <td class="text-right neraca_saldo_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['saldo'], 2, ',', '.'),0,-3) : '-' }}</td>
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
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Selisih</th>
                                    <th colspan="2" class="text-right" id="selisih_neraca_saldo"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-penyesuaian" role="tabpanel" aria-labelledby="pills-penyesuaian-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Kode</th>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Nama</th>
                                    <th colspan="2" class="text-center">Penyesuaian</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($akun as $item)
                                    @php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    @endphp
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-right penyesuaian_debit">{{ $item->post_penyesuaian == 1 ? 'Rp. ' . substr(number_format($data['penyesuaian'], 2, ',', '.'),0,-3) : '-' }}</td>
                                        <td class="text-right penyesuaian_kredit">{{ $item->post_penyesuaian == 2 ? 'Rp. ' . substr(number_format($data['penyesuaian'], 2, ',', '.'),0,-3) : '-' }}</td>
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
                                    <th class="text-right" id="jumlah_penyesuaian_debit"></th>
                                    <th class="text-right" id="jumlah_penyesuaian_kredit"></th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Selisih</th>
                                    <th colspan="2" class="text-right" id="selisih_penyesuaian"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-disesuaikan" role="tabpanel" aria-labelledby="pills-disesuaikan-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Kode</th>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Nama</th>
                                    <th colspan="2" class="text-center">Neraca Saldo Disesuaikan</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($akun as $item)
                                    @php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    @endphp
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-right disesuaikan_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-' }}</td>
                                        <td class="text-right disesuaikan_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-' }}</td>
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
                                    <th class="text-right" id="jumlah_disesuaikan_debit"></th>
                                    <th class="text-right" id="jumlah_disesuaikan_kredit"></th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Selisih</th>
                                    <th colspan="2" class="text-right" id="selisih_disesuaikan"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-laba-rugi" role="tabpanel" aria-labelledby="pills-laba-rugi-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Kode</th>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Nama</th>
                                    <th colspan="2" class="text-center">Laporan Laba Rugi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($akun as $item)
                                    @php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    @endphp
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                        <td>{{ $item->nama }}</td>
                                        @if ($item->post_laporan == 2)
                                            <td class="text-right laba_rugi_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-' }}</td>
                                            <td class="text-right laba_rugi_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-' }}</td>
                                        @else
                                            <td class="text-right laba_rugi_debit">-</td>
                                            <td class="text-right laba_rugi_kredit">-</td>
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
                                    <th class="text-right" id="jumlah_laba_rugi_debit"></th>
                                    <th class="text-right" id="jumlah_laba_rugi_kredit"></th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Selisih</th>
                                    <th colspan="2" class="text-right" id="selisih_laba_rugi"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-neraca" role="tabpanel" aria-labelledby="pills-neraca-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Kode</th>
                                    <th rowspan="2" style="vertical-align: middle" class="text-center">Nama</th>
                                    <th colspan="2" class="text-center">Neraca</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($akun as $item)
                                    @php
                                        $data = neraca(request('kriteria'), request('periode'), request('tanggal_awal'), request('tanggal_akhir'), request('bulan'), $item);
                                    @endphp
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                        <td>{{ $item->nama }}</td>
                                        @if ($item->post_laporan == 2)
                                            <td class="text-right neraca_debit">-</td>
                                            <td class="text-right neraca_kredit">-</td>
                                        @else
                                            <td class="text-right neraca_debit">{{ $item->post_saldo == 1 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-' }}</td>
                                            <td class="text-right neraca_kredit">{{ $item->post_saldo == 2 ? 'Rp. ' . substr(number_format($data['disesuaikan'], 2, ',', '.'),0,-3) : '-' }}</td>
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
                                    <th class="text-right" id="jumlah_neraca_debit"></th>
                                    <th class="text-right" id="jumlah_neraca_kredit"></th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">Selisih</th>
                                    <th colspan="2" class="text-right" id="selisih_neraca"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
</script>
@endpush
