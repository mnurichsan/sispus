@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Poli</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Poli
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
                        <p class="card-text">Data Poli</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Poli</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($polis as $key => $poli)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$poli->nama_poli}}</td>
                                        <td>
                                            <a href="#" onclick="editData({{$poli->id}})" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="alertHapus({{$poli->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

<div class="modal fade text-left" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Poli</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{route('poli.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group">
                                    <input type="text" id="namaPoli" name="nama_poli" class="form-control" placeholder="Masukkan nama poli" required>
                                    <label for="namaPoli">Nama Poli</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Data Poli</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{route('poli.update')}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label-group">
                                    <input type="text" id="namaPoli" name="nama_poli" class="form-control" placeholder="Masukkan nama poli" required>
                                    <label for="namaPoli">Nama Poli</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
   
    function editData(id) {
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{route('poli.edit')}}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(result) {
                $('#namaPoli').val(result.nama_poli);
                $('#modalEdit').modal('show');

            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Poli",
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
            url: "{{ route('poli.destroy') }}",
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