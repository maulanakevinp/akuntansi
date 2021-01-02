@extends('layouts.app')
@section('judul','Tambah Jurnal Umum - Sistem Informasi Akuntansi')

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
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Tambah Jurnal Umum</h2>
                                <p class="mb-0 text-sm">Kelola Jurnal Umum</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("jurnal-umum.index") }}?page={{ request('page') }}" class="btn btn-success" data-toggle="tooltip" title="Kembali"><i class="fas fa-arrow-left"></i></a>
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
            <form autocomplete="off" action="{{ route('jurnal-umum.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="form-control-label col-md-3" for="akun_id">Akun</label>
                    <div class="col-md-9">
                        <select class="form-control" name="akun_id" id="akun_id">
                            @foreach (App\Models\Akun::orderBy('kode')->get() as $item)
                                <option value="{{ $item->id }}" {{ old('akun_id') == $item->id ? 'selected' : '' }}>{{ $item->kode }} - {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="tanggal">Tanggal</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal ..." value="{{ old('tanggal')}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="keterangan">Keterangan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan ..." value="{{ old('keterangan')}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="bukti">Bukti</label>
                    <div class="col-md-9">
                        <input type="file" class="form-control" name="bukti" placeholder="Masukkan Bukti ..." value="{{ old('bukti')}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-md-3" for="debit_atau_kredit">Debit/Kredit</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="debit_atau_kredit1" name="debit_atau_kredit" class="custom-control-input" value="1" {{ old('debit_atau_kredit') == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="debit_atau_kredit1">Debit</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="debit_atau_kredit2" name="debit_atau_kredit" class="custom-control-input" value="2" {{ old('debit_atau_kredit') == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="debit_atau_kredit2">Kredit</label>
                        </div>
                        <span class="invalid-feedback font-weight-bold d-block"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="nilai">Nilai</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Masukkan Nilai ..." value="{{ old('nilai')}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                    <div class="col-md-4 col-form-label" id="rupiah"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
            </form>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#akun_id').select2({
            placeholder: "Pilih Akun",
            allowClear: true
        });

        $("#nilai").on('keyup',function () {
            $("#rupiah").html('Rp. ' + new Intl.NumberFormat('id-ID').format($(this).val()));
        });
    });
</script>
@endpush
