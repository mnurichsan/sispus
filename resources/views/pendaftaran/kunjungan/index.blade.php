@extends('layouts.dashboard')
@section('title')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Data Kunjungan</h2>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Kunjungan
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
    <div class="form-group breadcrum-right">
        <a href="" class="btn btn-primary btn-create" data-toggle="modal" data-target="#TambahKunjungan">Tambah Data</a>
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
                        <p class="card-text">Data Kunjungan</p>
                        <div class="table-responsive">
                            <table class="table zero-configuration text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Masuk</th>
                                        <th>No Rekam Medis</th>
                                        <th>Nama Pasien</th>
                                        <th>Poli</th>
                                        <th>Dokter Pemeriksa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kunjungans as $key => $kunjungan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$kunjungan->tanggal_masuk}}</td>
                                        <td>{{$kunjungan->pasien->no_rekammedis}}</td>
                                        <td>{{$kunjungan->pasien->nama_pasien}}</td>
                                        <td>{{$kunjungan->poli->nama_poli}}</td>
                                        <td>{{$kunjungan->dokter->nama_dokter}}</td>
                                        <td>
                                            <a href="{{ route('kunjungan.cetak', $kunjungan->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-print"></i></a>
                                            <button type="button" onclick="alertHapus({{ $kunjungan->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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

@include('pendaftaran.kunjungan.create')

@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('.pasiens').select2({
            dropdownAutoWidth: true,
            width: '100%',
            // allowClear: true,
            placeholder: '--Pilih--',
            ajax: {
                url: "{{ route('pasien.list') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: `${item.nik} - ${item.nama_pasien}`,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });

        $('.dokters').select2({
            dropdownAutoWidth: true,
            width: '100%',
            // allowClear: true,
            placeholder: '--Pilih--',
            ajax: {
                url: "{{ route('dokter.list') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: `${item.nama_dokter} - ${item.spesialis}`,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });

        $('.polis').select2({
            dropdownAutoWidth: true,
            width: '100%',
            // allowClear: true,
            placeholder: '--Pilih--',
            ajax: {
                url: "{{ route('poli.list') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: `${item.nama_poli}`,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });
    });

    const _token = "{{ csrf_token() }}";
   
    function editData(id) {
        $.ajax({
            url: "{{route('kunjungan.edit')}}",
            method: "POST",
            data: {
                _token: _token,
                id: id
            },
            success: function(data) {
                $('#idKunjungan').val(data.id);
                $('#tanggal_masuk').val(data.tanggal_masuk);
                $('#jam_masuk').val(data.jam_masuk);
                $('#keluhan').val(data.keluhan);
                $('#keadaan_pasien').html(data.keadaan_pasien);
                $('#pasien_id').val(data.pasien_id).trigger('change');
                $('#poli_id').val(data.poli_id).trigger('change');
                $('#dokter_id').val(data.dokter_id).trigger('change');

                $('#editKunjungan').modal('show');

            },
            error: function() {}
        })
    }

    function alertHapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menghapus Data Kunjungan",
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
            url: "{{route('kunjungan.destroy')}}",
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