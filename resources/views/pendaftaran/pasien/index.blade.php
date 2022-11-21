@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Pasien</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Pasien
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrum-right">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahPasien">Tambah Data</a>
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
                        <p class="card-text">Data Pasien Untuk Rekam Medis</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nomor Rekam Medis</th>
                                        <th>NIK</th>
                                        <th>No KK</th>
                                        <th>Nama Pasien</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasiens as $pasien)
                                    <tr>
                                        <td>{{$pasien->no_rekammedis}}</td>
                                        <td>{{$pasien->nik}}</td>
                                        <td>{{$pasien->kepalaKeluarga->no_kk}}</td>
                                        <td>{{$pasien->nama_pasien}}</td>
                                        <td>{{$pasien->tanggal_lahir}}</td>
                                        <td>{{$pasien->jenis_kelamin ? 'Laki-Laki' : 'Perempuan'}}</td>
                                        <td>{{$pasien->no_hp}}</td>
                                        <td>
                                            <a href="#" onclick="editData({{$pasien->id}})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="alertHapus({{$pasien->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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


@include('pendaftaran.pasien.create')

@include('pendaftaran.pasien.edit')

@endsection

@push('js')
<script>
   
    const _token = "{{ csrf_token() }}";

    // $.ajax({
    //     url: "{{ route('kepalaKeluarga.list') }}",
    //     method: "GET",
    //     processData : false,
    //     dataType : 'json',
    //     contentType : false,
    //     success: function(result){
    //         console.log(result);
    //         $.each(result, (prefix, value)=> {
    //             $('#no_kk').append(`<option value="${prefix}">${value}</option>`);
    //         });
    //         $.each(data.errors, (prefix, val) => {
    //             $(form).find(`[name="${prefix}"]`).addClass('is-invalid');
    //             $(form).find(`span.${prefix}-error`).text(val[0]);
    //         });
    //     }
    // })

    function editData(id) {
        $.ajax({
            url: "{{route('pasien.edit')}}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#nik').val(data.nik);
                $('#nama_pasien').val(data.nama_pasien);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#jenis_kelamin').val(data.jenis_kelamin).trigger('change');
                $('#no_kk').val(data.kepala_keluarga.id).trigger('change');
                $('#agama').val(data.agama);
                $('#no_hp').val(data.no_hp);
                $('#pekerjaan').val(data.pekerjaan);
                $('#alamat').html(data.alamat);
                $('#editPasien').modal('show');

            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Kepala Keluarga",
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
            url: "{{route('pasien.destroy')}}",
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

    $(".select-form").select2({
        dropdownAutoWidth: true,
        width: '100%',
    });
</script>
@endpush