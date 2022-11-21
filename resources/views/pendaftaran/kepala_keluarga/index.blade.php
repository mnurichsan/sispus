@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Kepala Keluarga</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Kepala Keluarga
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrum-right">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahKepalaKeluarga">Tambah Data</a>
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
                        <p class="card-text">Data Kepala Keluarga</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration w-100">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>No KK</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kepalaKeluargas as $key => $kepalaKeluarga)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$kepalaKeluarga->no_kk}}</td>
                                        <td>{{$kepalaKeluarga->nama_kk}}</td>
                                        <td>{{$kepalaKeluarga->tempat_lahir}}, {{ date('d-m-y', strtotime($kepalaKeluarga->tanggal_lahir)) }}</td>
                                        <td>{{ $kepalaKeluarga->jenis_kelamin ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{$kepalaKeluarga->pekerjaan}}</td>
                                        <td>{{$kepalaKeluarga->alamat}}</td>
                                        <td>
                                            <a href="#" onclick="editData({{$kepalaKeluarga->id}})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="alertHapus({{$kepalaKeluarga->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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


@include('pendaftaran.kepala_keluarga.create')

@include('pendaftaran.kepala_keluarga.edit')

@endsection

@push('js')
<script>
    const _token = "{{ csrf_token() }}";
   
    function editData(id) {
        $.ajax({
            url: "{{route('kepalaKeluarga.edit')}}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(data) {
                $('#id').val(data.id);
                $('#no_kk').val(data.no_kk);
                $('#nama_kk').val(data.nama_kk);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#jenis_kelamin').val(data.jenis_kelamin).trigger('change');
                $('#pekerjaan').val(data.pekerjaan);
                $('#alamat').html(data.alamat);

                $('#editKepalaKeluarga').modal('show');

            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Pasien",
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
            url: "{{route('kepalaKeluarga.destroy')}}",
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
            success: function(data) {
                Swal.fire({
                    title: 'Success',
                    text: data.message,
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