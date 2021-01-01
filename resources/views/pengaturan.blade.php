@extends('layouts.app')
@section('judul','Pengaturan - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Pengaturan</h2>
                                <p class="mb-0 text-sm">Kelola Pengaturan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card bg-secondary shadow h-100">
                <div class="card-header font-weight-bold">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                        <span class="mb-1">DATABASE</span>
                        <a href="{{ route("database.backup") }}" class="btn btn-success btn-sm" title="download file backup (sql)"><i class="fas fa-download"></i> Backup Database</a>
                    </div>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('database.restore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="sql">File (sql)</label>
                            <input type="file" accept=".sql" class="form-control @error('sql') is-invalid @enderror" name="sql" placeholder="Masukkan File sql ...">
                            @error('sql')<span class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                        </div>
                        <p class="text-sm mb-3 text-danger">*Pastikan file yang dimasukkan adalah hasil backupan dari backup database</p>
                        <button type="submit" class="btn btn-primary btn-block" id="simpan"><i class="fas fa-sync"></i> Restore Database</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
