
<div class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dokter.update') }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="id" id="idDokter" readonly />
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nama_dokter">Nama Dokter</label>
                                    <input type="text" id="nama_dokter" name="nama_dokter" class="form-control" placeholder="Masukkan nama dokter" value="{{ old('nama_dokter') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="spesialis">Spesialis</label>
                                    <input type="text" id="spesialis" name="spesialis" class="form-control" placeholder="Masukkan spesialis" value="{{ old('spesialis') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="dokter_aktif">Dokter Aktif</label>
                                    <select id="dokter_aktif" name="dokter_aktif" class="form-control" required>
                                        <option value="0" {{ old('dokter_aktif') == 0 ? 'selected' : null }}>Tidak</option>
                                        <option value="1" {{ old('dokter_aktif') == 1 ? 'selected' : null }}>Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="dokter_luar">Dokter Luar</label>
                                    <select id="dokter_luar" name="dokter_luar" class="form-control" required>
                                        <option value="0" {{ old('dokter_aktif') == 0 ? 'selected' : null }}>Tidak</option>
                                        <option value="1" {{ old('dokter_aktif') == 1 ? 'selected' : null }}>Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Username Login</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" id="password" class="form-control" placeholder="Masukkan password" value="{{ old('password') }}">
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