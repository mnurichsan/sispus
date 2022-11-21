<div class="modal fade text-left" id="editKunjungan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Data Kepala Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" action="{{route('kunjungan.update')}}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="idKunjungan" name="id" readonly>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" placeholder="Tanggal masuk" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Jam Masuk</label>
                                    <input type="time" id="jam_masuk" name="jam_masuk" class="form-control" placeholder="Jam Masuk" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Pasien</label>
                                    <select class="form-control pasiens" id="pasien_id" name="pasien_id" required>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Poli</label>
                                    <select class="form-control polis" id="poli_id" name="poli_id" required>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Dokter</label>
                                    <select class="form-control dokters" id="dokter_id" name="dokter_id" required>
                                        @if (old('tag', $post->tags))
                                            @foreach (old('tag', $post->tags) as $tag)
                                                <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>    
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