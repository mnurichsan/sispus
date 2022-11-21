@extends('layouts.dashboard')
@section('content')
<section id="basic-datatable">
    <div class="row firstRow">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h1><span class="btn btn-success mr-2"><i class="fa fa-microphone"></i></span> Panggilan Antrian</h1>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary modal-create" data-toggle="modal" data-target="#modelId">
                          Tambah Antrian
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- menampilkan informasi jumlah antrian -->
        <div class="col-md-3 mb-1">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-start">
                        <div class="feature-icon-3 me-4" style="    font-size: 50px;
    margin-right: 20px;">
                            <i class="fa fa-users text-warning"></i>
                        </div>
                        <div>
                            <p id="jumlah-antrian" class="fs-3 text-warning mb-1" style="font-size: 3rem;
    transform: translateX(40px);
    margin-top: 1rem;
    font-weight: bold;"></p>
                            <p class="mb-0">Jumlah Antrian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- menampilkan informasi nomor antrian yang sedang dipanggil -->
        <div class="col-md-3 mb-1">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-start">
                        <div class="feature-icon-3 me-4" style="    font-size: 50px;
    margin-right: 20px;">
                            <i class="fa fa-user text-success"></i>
                        </div>
                        <div>
                            <p id="antrian-sekarang" class="fs-3 text-success mb-1" style="font-size: 3rem;
    transform: translateX(40px);
    margin-top: 1rem;
    font-weight: bold;"></p>
                            <p class="mb-0">Antrian Sekarang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- menampilkan informasi nomor antrian yang akan dipanggil selanjutnya -->
        <div class="col-md-3 mb-1">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-start">
                        <div class="feature-icon-3 me-4" style="    font-size: 50px;
    margin-right: 20px;">
                            <i class="fa fa-user-plus text-info"></i>
                        </div>
                        <div>
                            <p id="antrian-selanjutnya" class="fs-3 text-info mb-1" style="font-size: 3rem;
    transform: translateX(40px);
    margin-top: 1rem;
    font-weight: bold;"></p>
                            <p class="mb-0">Antrian Selanjutnya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- menampilkan informasi jumlah antrian yang belum dipanggil -->
        <div class="col-md-3 mb-1">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-start">
                        <div class="feature-icon-3 me-4" style="    font-size: 50px;
    margin-right: 20px;">
                            <i class="fa fa-user text-danger"></i>
                        </div>
                        <div>
                            <p id="sisa-antrian" class="fs-3 text-danger mb-1" style="font-size: 3rem;
    transform: translateX(40px);
    margin-top: 1rem;
    font-weight: bold;"></p>
                            <p class="mb-0">Sisa Antrian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="tabel-antrian" class="table table-bordered table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nomor Antrian</th>
                                        <th>Panggil</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@includeIf('antrian.create')

<audio id="tingtung" src="{{ asset('audio/tingtung.mp3') }}"></audio>
@endsection

@push('js')
<script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#antrian').load('{{ route("antrian.jumlah") }}');
        $('#jumlah-antrian').load('{{ route("antrian.jumlah") }}');
        $('#antrian-sekarang').load('{{ route("antrian.sekarang") }}')
        $('#antrian-selanjutnya').load('{{ route("antrian.selanjutnya") }}')
        $('#sisa-antrian').load('{{ route("antrian.sisa") }}');

        // getJmAntrian();
        // menampilkan data antrian menggunakan DataTables
        var table = $('#tabel-antrian').DataTable({
            "lengthChange": false, // non-aktifkan fitur "lengthChange"
            "searching": false, // non-aktifkan fitur "Search"
            "ajax": "{{ route('antrian.list') }}", // url file proses tampil data dari database
            // menampilkan data
            "columns": [{
                "data": "no_antrian",
                "width": '250px',
                "className": 'text-center'
            },
            {
                "data": "status",
                "width": '100px',
                "className": 'text-center'
            }],
            "order": [
                [0, "desc"] // urutkan data berdasarkan "no_antrian" secara descending
            ],
            "iDisplayLength": 10, // tampilkan 10 data per halaman
        });

        // panggilan antrian dan update data
        $('#tabel-antrian tbody').on('click', 'button', function() {
            // ambil data dari datatables 
            var data = table.row($(this).parents('tr')).data();
            // buat variabel untuk menampilkan data "id"
            var id = data["id"];
            console.log(id);
            // buat variabel untuk menampilkan audio bell antrian
            var bell = document.getElementById('tingtung');

            // mainkan suara bell antrian
            bell.pause();
            bell.currentTime = 0;
            bell.play();

            // set delay antara suara bell dengan suara nomor antrian
            durasi_bell = bell.duration * 770;

            // mainkan suara nomor antrian
            setTimeout(function() {
                responsiveVoice.speak("Nomor Antrian, " + data["no_antrian"] + ", menuju, loket, 1", "Indonesian Female", {
                    rate: 0.9,
                    pitch: 1,
                    volume: 1
                });
            }, durasi_bell);

            // proses update data
            $.ajax({
                type: "POST", // mengirim data dengan method POST
                url: "{{ route('antrian.update') }}", // url file proses update data
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                } // tentukan data yang dikirim
            });
        });

        $(".create-antrian").on('click', function(){
            $.post("{{ route('antrian.store') }}", {_token:"{{ csrf_token(); }}"}, function(data){
                $('#antrian').load('{{ route("antrian.jumlah") }}').fadeIn("slow");
            });
        });

        // auto reload data antrian setiap 1 detik untuk menampilkan data secara realtime
        setInterval(function() {
            $('#antrian').load('{{ route("antrian.jumlah") }}').fadeIn("slow");
            $('#jumlah-antrian').load('{{ route("antrian.jumlah") }}').fadeIn("slow");
            $('#antrian-sekarang').load('{{ route("antrian.sekarang") }}').fadeIn("slow");
            $('#antrian-selanjutnya').load('{{ route("antrian.sekarang") }}').fadeIn("slow");
            $('#sisa-antrian').load('{{ route("antrian.sisa") }}').fadeIn("slow");
            table.ajax.reload(null, false);
        }, 1000);
    });

    $('#maximize').on('click', function(){
        $('.dropdown-user, .dropdown-notification, .modal-create, .horizontal-menu-wrapper').toggle('d-none');
    });
</script>
@endpush