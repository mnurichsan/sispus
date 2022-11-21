@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Obat</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Obat
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
                        <p class="card-text">Data Obat</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Obat</th>
                                        <th>Keterangan</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($obats as $key => $obat)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $obat->nama_obat }}</td>
                                        <td>{{ $obat->keterangan }}</td>
                                        <td>{{ $obat->satuan }}</td>
                                        <td>{{ $obat->harga }}</td>
                                        <td>
                                            <a href="#" onclick="editData({{ $obat->id }})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="alertHapus({{ $obat->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

@include('apoteker.obat.create')

@include('apoteker.obat.edit')

@endsection

@push('js')
<script>
   
    function editData(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('obat.edit') }}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(result) {
                $('#idObat').val(id);
                $('#nama_obat').val(result.nama_obat);
                $('#harga').val(result.harga);
                $('#satuan').val(result.satuan);
                $('#keterangan').html(result.keterangan);
                
                $('#modalEdit').modal('show');
            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Obat",
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
            url: "{{ route('obat.destroy') }}",
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