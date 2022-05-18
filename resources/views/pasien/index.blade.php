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
@endsection
@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahPasien">Tambah Data</a>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <p class="card-text">Data Pasien Untuk Rekam Medis</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nomor Rekam Medis</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{$d->no_rekammedis}}</td>
                                        <td>{{$d->nik}}</td>
                                        <td>{{$d->nama_kk}}</td>
                                        <td>{{$d->tanggal_lahir}}</td>
                                        <td>{{$d->jenis_kelamin}}</td>
                                        <td>{{$d->no_hp}}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary">Show</a>
                                            <a href="#" onclick="editData({{$d->id}})" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" onclick="alertHapus({{$d->id}})" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nomor Rekam Medis</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade text-left" id="tambahPasien" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{route('pasien.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="first-name-column" name="nik" class="form-control" placeholder="NIK" required>
                                    <label for="first-name-column">NIK</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="last-name-column" name="nama_kk" class="form-control" placeholder="Nama Lengkap" required>
                                    <label for="last-name-column">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="date" id="city-column" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                                    <label for="city-column">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="Laki-Laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="country-floating">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <select class="form-control" name="agama" required>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                    <label for="company-column">Agama</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" id="email-id-column" class="form-control" name="no_hp" placeholder="Nomor HP" required>
                                    <label for="email-id-column">Nomor HP</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group">
                                    <textarea id="email-id-column" class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                                    <label for="email-id-column">Alamat</label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="editPasien" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{route('pasien.update')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="hidden" id="id" name="id" readonly>
                                    <input type="text"  name="nik" id="nik" class="form-control" placeholder="NIK" required>
                                    <label for="first-name-column">NIK</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" name="nama_kk" id="nama_kk" class="form-control" placeholder="Nama Lengkap" required>
                                    <label for="last-name-column">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="date" id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                                    <label for="city-column">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="Laki-Laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="country-floating">Jenis Kelamin</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <select class="form-control" id="agama" name="agama" required>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                    <label for="company-column">Agama</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
                                    <label for="email-id-column">Nomor HP</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-label-group">
                                    <textarea  class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                                    <label for="email-id-column">Alamat</label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Reset</button>
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
                $('#nama_kk').val(data.nama_kk);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#agama').val(data.agama);
                $('#no_hp').val(data.no_hp);
                $('#alamat').val(data.alamat);
                $('#editPasien').modal('show');

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
        var _token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{route('pasien.delete')}}",
            method: "POST",
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
                console.log(data);
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