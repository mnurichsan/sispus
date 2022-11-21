<div class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Data Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('obat.update') }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idObat" name="id" />
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Nama Obat</label>
                                    <input type="text" id="nama_obat" name="nama_obat" class="form-control" placeholder="Masukkan nama obat" value="{{ old('nama_obat') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="number" id="satuan" name="satuan" class="form-control" placeholder="Masukkan satuan" value="{{ old('satuan') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" id="harga" name="harga" class="form-control" placeholder="Masukkan harga" value="{{ old('harga') }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="4" class="form-control" required>{{ old('keterangan') }}</textarea>
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