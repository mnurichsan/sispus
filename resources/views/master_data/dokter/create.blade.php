
<div class="modal fade text-left" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dokter.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Nama Dokter</label>
                                    <input type="text" name="nama_dokter" class="form-control" placeholder="Masukkan nama dokter" value="{{ old('nama_dokter') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Spesialis</label>
                                    <input type="text" name="spesialis" class="form-control" placeholder="Masukkan spesialis" value="{{ old('spesialis') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Dokter Aktif</label>
                                    <select name="dokter_aktif" class="form-control" required>
                                        <option value="0" {{ old('dokter_aktif') == 0 ? 'selected' : null }}>Tidak</option>
                                        <option value="1" {{ old('dokter_aktif') == 1 ? 'selected' : null }}>Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Dokter Luar</label>
                                    <select name="dokter_luar" class="form-control" required>
                                        <option value="0" {{ old('dokter_aktif') == 0 ? 'selected' : null }}>Tidak</option>
                                        <option value="1" {{ old('dokter_aktif') == 1 ? 'selected' : null }}>Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Username Login</label>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" placeholder="Masukkan password" value="{{ old('password') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>