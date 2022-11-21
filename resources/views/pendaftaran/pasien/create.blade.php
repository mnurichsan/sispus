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
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ old('nik') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_pasien" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_pasien') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="0" {{ old('jenis_kelamin') == 0 ? 'selected' : null }}>Perempuan</option>
                                        <option value="1" {{ old('jenis_kelamin') == 1 ? 'selected' : null }}>Laki-laki</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control" name="agama" required>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : null }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : null }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : null }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : null }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : null }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : null }}>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>No KK</label>
                                    <select class="form-control select-form" name="no_kk" required>
                                        <option>--Pilih--</option>
                                        @foreach ($noKartuKeluarga as $id => $kk)
                                            @if(old('no_kk'))
                                                <option value="{{ $id }}" selected>{{ $kk }}</option>
                                            @else   
                                                <option value="{{ $id }}">{{ $kk }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
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