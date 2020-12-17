@extends('layouts.app')
@section('judul','Edit Jurnal Umum - Sistem Informasi Akuntansi')

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
                                <h2 class="mb-0">Edit Jurnal Umum</h2>
                                <p class="mb-0 text-sm">Kelola Jurnal Umum</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("jurnal-umum.index") }}" class="btn btn-success" data-toggle="tooltip" title="Kembali"><i class="fas fa-arrow-left"></i></a>
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
            <form autocomplete="off" action="{{ route('jurnal-umum.update', $jurnal_umum) }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="akun_id">Akun</label>
                    <div class="col-md-9">
                        <select class="form-control" name="akun_id">
                            @foreach (App\Models\Akun::all() as $item)
                                <option value="{{ $item->id }}" {{ old('akun_id', $jurnal_umum->akun_id) == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="tanggal">Tanggal</label>
                    <div class="col-md-9">
                        <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal ..." value="{{ old('tanggal', $jurnal_umum->tanggal)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="keterangan">Keterangan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan ..." value="{{ old('keterangan', $jurnal_umum->keterangan)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="bukti">
                        Bukti
                        @if($jurnal_umum->bukti)
                            <a href="{{ route('jurnal-umum.show', $jurnal_umum) }}" data-toggle="tooltip" title="Download Bukti">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="{{ route('jurnal-umum.delete', $jurnal_umum) }}" data-toggle="tooltip" title="Hapus Bukti" onclick="event.preventDefault(); document.getElementById('delete-bukti').submit();">
                                <i class="fas fa-trash text-danger"></i>
                            </a>
                        @endif
                    </label>
                    <div class="col-md-9">
                        <input type="file" class="form-control" name="bukti" placeholder="Masukkan Bukti ..." value="{{ old('bukti', $jurnal_umum->bukti)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="nilai">Nilai</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="nilai" placeholder="Masukkan Nilai ..." value="{{ old('nilai', $jurnal_umum->nilai)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
            </form>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<form id="delete-bukti" action="{{ route('jurnal-umum.delete', $jurnal_umum) }}" method="POST" style="display: none;">
    @csrf @method('delete')
</form>
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
    });
</script>
@endpush
