@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Dokter</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Dokter
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrum-right">
        <a href="" class="btn btn-primary btn-create" data-toggle="modal" data-target="#ModalTambah">Tambah Data</a>
    </div>
</div>
@endsection
@section('content')
<section id="basic-datatable">
    <div class="row">
        @if ($errors->any())
        <div class="col-12">
            <div class="card card-content card-body">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <p class="card-text">Data Dokter</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username Login</th>
                                        <th>Nama Dokter</th>
                                        <th>Spesialis</th>
                                        <th>Dokter Aktif</th>
                                        <th>Dokter Luar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dokters as $key => $dokter)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $dokter->user->name}}</td>
                                        <td>{{ $dokter->nama_dokter}}</td>
                                        <td>{{ $dokter->spesialis}}</td>
                                        <td>{{ $dokter->dokter_aktif ? 'Ya' : 'Tidak' }}</td>
                                        <td>{{ $dokter->dokter_luar ? 'Ya' : 'Tidak' }}</td>
                                        <td>
                                            <a href="#" onclick="editData({{ $dokter->id }})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="alertHapus({{ $dokter->user_id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('master_data.dokter.create')

@include('master_data.dokter.edit')

@endsection

@push('js')
<script>
    let _token = "{{ csrf_token() }}";
    
    function editData(id) {
        $.ajax({
            url: "{{ route('dokter.edit') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(result) {
                $('#idDokter').val(id);
                $('#nama_dokter').val(result.nama_dokter);
                $('#spesialis').val(result.spesialis);
                $('#dokter_aktif').val(result.dokter_aktif).trigger('change');
                $('#dokter_luar').val(result.dokter_luar).trigger('change');
                $('#username').val(result.user.name);

                $('#modalEdit').modal('show');
            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Dokter",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya'
        }).then((result) => {
            if (result.isConfirmed) {
                hapus(id);
            }
        })
    }

    function hapus(id) {
        $.ajax({
            url: "{{ route('dokter.destroy') }}",
            method: "DELETE",
            data: {
                _token: _token,
                id: id
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Mohon Tunggu',
                    icon: 'warning',
                    showCancelButton: false,
                    showConfirmButton: false
                });
            },
            success: function(result) {
                Swal.fire({
                    title: 'Success',
                    text: result.message,
                    icon: 'success',
                });
                setTimeout(() => {
                    location.reload()
                }, 2000);
            },
            error: function() {}
        })
    }
</script>
@endpush