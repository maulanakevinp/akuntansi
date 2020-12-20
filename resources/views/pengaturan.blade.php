@extends('layouts.app')
@section('judul','Reset Data - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Reset Data</h2>
                                <p class="mb-0 text-sm">Kelola Reset Data</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("reset-data") }}" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('reset-data').submit();"><i class="fas fa-undo"></i> Reset Data</a>
                                <form id="reset-data" action="{{ route('reset-data') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--1">
    @include('layouts.footers.auth')
</div>
@endsection
