<div class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Data Pegawai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update') }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idUser" name="id" />
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="name" class="form-control" placeholder="Masukkan username" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" id="role">
                                        <option>--PILIH--</option>
                                        <option value="staf">Staf</option>
                                        <option value="perawat">Perawat</option>
                                        <option value="kepala">Kepala Puskesmas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="text" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pegawai">Pegawai</label>
                                    <select id="pegawai" name="pegawai" class="form-control pegawais">
                                    </select>
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