@extends('layouts.app')
@section('judul','Edit Jurnal Penyesuaian - Sistem Informasi Akuntansi')

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
                                <h2 class="mb-0">Edit Jurnal Penyesuaian</h2>
                                <p class="mb-0 text-sm">Kelola Jurnal Penyesuaian</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("jurnal-penyesuaian.index") }}?page={{ request('page') }}" class="btn btn-success" data-toggle="tooltip" title="Kembali"><i class="fas fa-arrow-left"></i></a>
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
            <form autocomplete="off" action="{{ route('jurnal-penyesuaian.update', $jurnal_penyesuaian) }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="akun_id">Akun</label>
                    <div class="col-md-9">
                        <select class="form-control" name="akun_id">
                            @foreach (App\Models\Akun::orderBy('kode')->get() as $item)
                                <option value="{{ $item->id }}" {{ old('akun_id', $jurnal_penyesuaian->akun_id) == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="tanggal">Tanggal</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="tanggal" placeholder="Masukkan Tanggal ..." value="{{ old('tanggal', $jurnal_penyesuaian->tanggal)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="keterangan">Keterangan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan ..." value="{{ old('keterangan', $jurnal_penyesuaian->keterangan)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="bukti">
                        Bukti
                        @if($jurnal_penyesuaian->bukti)
                            <a href="{{ route('jurnal-penyesuaian.show', $jurnal_penyesuaian) }}" data-toggle="tooltip" title="Download Bukti">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="{{ route('jurnal-penyesuaian.delete', $jurnal_penyesuaian) }}" data-toggle="tooltip" title="Hapus Bukti" onclick="event.preventDefault(); document.getElementById('delete-bukti').submit();">
                                <i class="fas fa-trash text-danger"></i>
                            </a>
                        @endif
                    </label>
                    <div class="col-md-9">
                        <input type="file" class="form-control" name="bukti" placeholder="Masukkan Bukti ..." value="{{ old('bukti', $jurnal_penyesuaian->bukti)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-md-3" for="debit_atau_kredit">Debit/Kredit</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="debit_atau_kredit1" name="debit_atau_kredit" class="custom-control-input" value="1" {{ old('debit_atau_kredit', $jurnal_penyesuaian->debit_atau_kredit) == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="debit_atau_kredit1">Debit</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="debit_atau_kredit2" name="debit_atau_kredit" class="custom-control-input" value="2" {{ old('debit_atau_kredit', $jurnal_penyesuaian->debit_atau_kredit) == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="debit_atau_kredit2">Kredit</label>
                        </div>
                        <span class="invalid-feedback font-weight-bold d-block"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-control-label col-form-label col-md-3" for="nilai">Nilai</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Masukkan Nilai ..." value="{{ old('nilai', $jurnal_penyesuaian->nilai)}}">
                        <span class="invalid-feedback font-weight-bold"></span>
                    </div>
                    <div class="col-md-4 col-form-label" id="rupiah">Rp. {{ substr(number_format($jurnal_penyesuaian->nilai, 2, ',', '.'),0,-3) }}</div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
            </form>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<form id="delete-bukti" action="{{ route('jurnal-penyesuaian.delete', $jurnal_penyesuaian) }}" method="POST" style="display: none;">
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

        $("#nilai").on('keyup',function () {
            $("#rupiah").html('Rp. ' + new Intl.NumberFormat('id-ID').format($(this).val()));
        });
    });
</script>
@endpush
