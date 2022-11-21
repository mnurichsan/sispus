@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Pegawai</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Pegawai
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrum-right">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah">Tambah Data</a>
    </div>
</div>
@endsection
@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <p class="card-text">Data Pegawai</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nip</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawais as $key => $pegawai)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pegawai->nama }}</td>
                                        <td>{{ $pegawai->nip }}</td>
                                        <td>{{ $pegawai->jenkel ? 'laki-laki' : 'perempuan' }}</td>
                                        <td>{{ $pegawai->alamat }}</td>
                                        <td>
                                            <a href="#" onclick="editData({{ $pegawai->id }})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="alertHapus({{ $pegawai->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

@include('pegawai.create')

@include('pegawai.edit')

@endsection

@push('js')
<script>
   
    function editData(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('pegawai.edit') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(result) {
                $('#idPegawai').val(id);
                $('#nama').val(result.nama);
                $('#nip').val(result.nip);
                $('#tgl_lahir').val(result.tgl_lahir);
                $('#jenkel').val(result.jenkel).trigger('change');
                $('#alamat').html(result.alamat);
                
                $('#modalEdit').modal('show');
            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Pegawai",
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
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('pegawai.destroy') }}",
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