@extends('layouts.app')
@section('judul', $akun->nama . ' - '. $akun->kode .' - Sistem Informasi Akuntansi')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">{{ $akun->nama . ' - '. $akun->kode }}</h2>
                                <p class="mb-0 text-sm">Detail Akun : {{ $akun->nama . ' - '. $akun->kode }}</p>
                            </div>
                            <div class="mb-3">
                                <a href="#laporan" id="btn-laporan" data-toggle="tooltip" class="btn btn-primary" title="Laporan"><i class="fas fa-calendar"></i></a>
                                <a href="{{ URL::previous() }}" class="btn btn-success" title="Kembali" data-toggle="tooltip"><i class="fas fa-arrow-left"></i></a>
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
                    <thead>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Debit</th>
                        <th class="text-center">Kredit</th>
                    </thead>
                    <tbody>
                    @forelse ($jurnal_umum as $item)
                            <tr>
                                <td style="vertical-align: middle; text-align: center">{{ $item->tanggal }}</td>
                                <td style="vertical-align: middle">{{ $item->keterangan }}</td>
                                <td style="vertical-align: middle; text-align: right">{{ $item->akun->post_saldo == 1 ? 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3) : '-' }}</td>
                                <td style="vertical-align: middle; text-align: right">{{ $item->akun->post_saldo == 2 ? 'Rp. ' . substr(number_format($item->nilai, 2, ',', '.'),0,-3) : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" align="center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $jurnal_umum->links('layouts.footers.pagination') }}
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>

<div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-labelledby="laporan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Laporan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body pt-0">
                <form class="d-inline" action="{{ route("akun.laporan", $akun) }}" method="get">
                    <div class="form-group">
                        <label class="form-control-label" for="ditandatangani">Awal</label>
                        <input class="form-control" type="date" name="awal" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="diketahui">Akhir</label>
                        <input class="form-control" type="date" name="akhir" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#btn-laporan').click(function (e) {
            e.preventDefault();
            $("#laporan").modal('show');
        });
    });
</script>
@endpush
