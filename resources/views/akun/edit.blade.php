@extends('layouts.app')
@section('judul','Edit Akun - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Edit Akun</h2>
                                <p class="mb-0 text-sm">Kelola Akun</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("akun.index") }}" class="btn btn-success" data-toggle="tooltip" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="card bg-secondary shadow h-100">
        <div class="card-body">
            <form autocomplete="off" action="{{ route('akun.update', $akun) }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-4" for="kelompok_akun_id">Kelompok Akun</label>
                    <div class="col-md-8">
                        <select class="form-control" name="kelompok_akun_id">
                            @foreach (App\Models\KelompokAkun::all() as $item)
                                <option value="{{ $item->id }}" {{ old('kelompok_akun_id', $akun->kelompok_akun_id) == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div id="kelompok_laporan">
                    @if ($akun->kelompok_akun_id == 1)
                        <div class="form-group row">
                            <label class="form-control-label col-form-label col-md-4" for="kelompok_laporan_posisi_keuangan">Kelompok Laporan Posisi Keuangan</label>
                            <div class="col-md-8">
                                <select class="form-control" name="kelompok_laporan_posisi_keuangan" id="kelompok_laporan_posisi_keuangan">
                                    <option value="1" {{ $akun->kelompok_laporan_posisi_keuangan == 1 ? 'selected' : '' }}>Aktiva Lancar</option>
                                    <option value="2" {{ $akun->kelompok_laporan_posisi_keuangan == 2 ? 'selected' : '' }}>Aktiva Tetap</option>
                                </select>
                                <span class="invalid-feedback font-weight-bold"></span>
                            </div>
                        </div>
                    @endif

                    @if ($akun->kelompok_akun_id == 2)
                        <div class="form-group row">
                            <label class="form-control-label col-form-label col-md-4" for="kelompok_laporan_posisi_keuangan">Kelompok Laporan Posisi Keuangan</label>
                            <div class="col-md-8">
                                <select class="form-control" name="kelompok_laporan_posisi_keuangan" id="kelompok_laporan_posisi_keuangan">
                                    <option value="3" {{ $akun->kelompok_laporan_posisi_keuangan == 3 ? 'selected' : '' }}>Hutang Lancar</option>
                                    <option value="4" {{ $akun->kelompok_laporan_posisi_keuangan == 4 ? 'selected' : '' }}>Hutang Tetap</option>
                                </select>
                                <span class="invalid-feedback font-weight-bold"></span>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-4" for="kode">Kode</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="kode" placeholder="Masukkan Kode ..." value="{{ old('kode', $akun->kode)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-4" for="nama">Nama</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama ..." value="{{ old('nama', $akun->nama)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-4" for="post_saldo">Post Saldo</label>
                    <div class="col-md-8">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="post_saldo1" name="post_saldo" class="custom-control-input" value="1" {{ old('post_saldo', $akun->post_saldo) == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="post_saldo1">Debit</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="post_saldo2" name="post_saldo" class="custom-control-input" value="2" {{ old('post_saldo', $akun->post_saldo) == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="post_saldo2">Kredit</label>
                        </div>
                        <span class="invalid-feedback font-weight-bold d-block"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-4" for="post_penyesuaian">Post Penyesuaian</label>
                    <div class="col-md-8">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="post_penyesuaian1" name="post_penyesuaian" class="custom-control-input" value="1" {{ old('post_penyesuaian', $akun->post_penyesuaian) == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="post_penyesuaian1">Debit</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="post_penyesuaian2" name="post_penyesuaian" class="custom-control-input" value="2" {{ old('post_penyesuaian', $akun->post_penyesuaian) == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="post_penyesuaian2">Kredit</label>
                        </div>
                        <span class="invalid-feedback font-weight-bold d-block"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-4" for="post_laporan">Post Laporan</label>
                    <div class="col-md-8">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="post_laporan1" name="post_laporan" class="custom-control-input" value="1" {{ old('post_laporan', $akun->post_laporan) == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="post_laporan1">Neraca</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="post_laporan2" name="post_laporan" class="custom-control-input" value="2" {{ old('post_laporan', $akun->post_laporan) == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="post_laporan2">Laba Rugi</label>
                        </div>
                        <span class="invalid-feedback font-weight-bold d-block"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
            </form>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#kelompok_akun_id").change(function () {
            if ($(this).val() == 1) {
                $("#kelompok_laporan").html(`
                    <div class="form-group row">
                        <label class="form-control-label col-form-label col-md-4" for="kelompok_laporan_posisi_keuangan">Kelompok Laporan Posisi Keuangan</label>
                        <div class="col-md-8">
                            <select class="form-control" name="kelompok_laporan_posisi_keuangan" id="kelompok_laporan_posisi_keuangan">
                                <option value="1">Aktiva Lancar</option>
                                <option value="2">Aktiva Tetap</option>
                            </select>
                            <span class="invalid-feedback font-weight-bold"></span>
                        </div>
                    </div>
                `);
            } else if ($(this).val() == 2) {
                $("#kelompok_laporan").html(`
                    <div class="form-group row">
                        <label class="form-control-label col-form-label col-md-4" for="kelompok_laporan_posisi_keuangan">Kelompok Laporan Posisi Keuangan</label>
                        <div class="col-md-8">
                            <select class="form-control" name="kelompok_laporan_posisi_keuangan" id="kelompok_laporan_posisi_keuangan">
                                <option value="3">Hutang Lancar</option>
                                <option value="4">Hutang Tetap</option>
                            </select>
                            <span class="invalid-feedback font-weight-bold"></span>
                        </div>
                    </div>
                `);
            } else {
                $("#kelompok_laporan").html(``);
            }
        });
    });
</script>
@endpush
