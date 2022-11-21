<div class="modal fade text-left" id="TambahKunjungan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Tambah Data Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{route('kunjungan.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" name="tanggal_masuk" class="form-control" placeholder="Tanggal masuk" value="{{ old('tanggal_masuk') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Jam Masuk</label>
                                    <input type="time" name="jam_masuk" class="form-control" placeholder="Jam Masuk" value="{{ old('jam_masuk') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Pasien</label>
                                    <select class="form-control pasiens" name="pasien_id" required>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Poli</label>
                                    <select class="form-control polis" name="poli_id" required>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Dokter</label>
                                    <select class="form-control dokters" name="dokter_id" required>
                                        
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