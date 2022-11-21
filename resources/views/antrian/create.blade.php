<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <form action="" method="post">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Antrian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h1><i class="fa fa-user mr-2 text-success"></i>Nomor Antrian</h1>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body m-auto">
                            <div class="d-flex flex-column align-items-center justify-content-center border" style="padding: 3rem 11rem;">
                                <h2>Antrian</h2>
                                <h3 id="antrian" class="text-success" style="    font-size: 5rem;
    font-weight: bold;"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('antrian.cetak') }}" target="_blank" class="btn btn-success cetak-antrian">Cetak</a>
                    <button type="button" class="btn btn-primary create-antrian">Ambil Nomor</button>
                </div>
            </div>
        </div>
    </form>
</div>