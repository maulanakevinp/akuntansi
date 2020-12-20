@extends('layouts.app')
@section('judul','Akun - Sistem Informasi Akuntansi')

@section('form-search')
    @include('layouts.navbars.form-search')
@endsection

@section('form-search-mobile')
    @include('layouts.navbars.form-search-mobile')
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
                                <h2 class="mb-0">Akun</h2>
                                <p class="mb-0 text-sm">Kelola Akun</p>
                            </div>
                            <div class="mb-3">
                                <button type="button" data-toggle="tooltip" title="Hapus data terpilih" class="btn btn-danger" id="delete" name="delete" >
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a id="btn-import" href="#import" data-toggle="tooltip" class="mb-1 btn btn-info" title="Import"><i class="fas fa-file-import"></i></a>
                                <a href="{{ route('akun.export') }}" data-toggle="tooltip" class="mb-1 btn btn-primary" title="Export"><i class="fas fa-file-export"></i></a>
                                <a href="{{ route('akun.create') }}" class="btn btn-success" title="Tambah" data-toggle="tooltip"><i class="fas fa-plus"></i></a>
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
                <table class="mb-3 table table-hover table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="20px">
                                <input type="checkbox" id="check_all">
                            </th>
                            <th class="text-center" width="20px">Opsi</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Post Saldo</th>
                            <th class="text-center">Post Penyesuaian</th>
                            <th class="text-center">Post Laporan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($akun as $item)
                            <tr>
                                <td style="vertical-align: middle">
                                    <input type="checkbox" class="akun-checkbox" id="delete{{ $item->id }}" name="delete[]" value="{{ $item->id }}">
                                </td>
                                <td style="vertical-align: middle">
                                    <a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Buku Besar"><i class="fas fa-book"></i></a>
                                    <a href="{{ route('akun.edit', $item) }}" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger hapus-data" data-nama="{{ $item->nama }}" data-action="{{ route("akun.destroy", $item) }}" data-toggle="tooltip" title="Hapus" href="#modal-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                                <td style="vertical-align: middle" class="text-center"><a href="{{ url('/buku-besar?kode_akun=' . $item->kode . '&kriteria=periode&periode=1-bulan-terakhir') }}">{{ $item->kode }}</a></td>
                                <td style="vertical-align: middle">{{ $item->nama }}</td>
                                <td style="vertical-align: middle" class="text-center">{{ $item->post_saldo == 1 ? 'Debit' : 'Kredit' }}</td>
                                <td style="vertical-align: middle" class="text-center">{{ $item->post_penyesuaian == 1 ? 'Debit' : 'Kredit' }}</td>
                                <td style="vertical-align: middle" class="text-center">{{ $item->post_laporan == 1 ? 'Neraca' : 'Laba Rugi' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="15" align="center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-delete">Hapus Akun?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!!</h4>
                    <p>Menghapus akun akan menghapus semua data yang dimilikinya</p>
                    <p><strong id="nama-hapus"></strong></p>
                </div>

            </div>

            <div class="modal-footer">
                <form id="form-hapus" action="" method="POST" >
                    @csrf @method('delete')
                    <button type="submit" class="btn btn-white">Yakin</button>
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="import" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-import">Import .xlsx</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route("akun.import") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input accept=".xlsx" type="file" name="xlsx" class="form-control" placeholder="Masukkan File Excel">
                    <div class="mt-5 d-flex justify-content-between">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#btn-import').click(function (e) {
            e.preventDefault();
            $("#import").modal('show');
        });

        $(document).on('click', '#delete', function(){
            let id = [];
            if (confirm("Apakah anda yakin ingin menghapus data ini?")) {
                $(".akun-checkbox:checked").each(function () {
                    id.push($(this).val());
                });
                if (id.length > 0) {
                    $.ajax({
                        url     : "{{ route('akun.destroys') }}",
                        method  : 'delete',
                        data    : {
                            _token  : "{{ csrf_token() }}",
                            id      : id,
                        },
                        success : function(data){
                            alertSuccess(data.message);
                            location.reload();
                        }
                    });
                } else {
                    alertFail('Harap pilih salah satu akun');
                }
            }
        });

        $("#check_all").click(function(){
            if (this.checked) {
                $(".akun-checkbox").prop('checked',true);
            } else {
                $(".akun-checkbox").prop('checked',false);
            }
        });
    });
</script>
@endpush
