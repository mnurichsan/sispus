<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu</title>
    <style>
        html,body{
            margin:0;
            padding:0;
            border:1px solid black;
        }
        body{
            padding: 0 4rem;
        }
    </style>
</head>
<body>
    <header style="width:3.5in;">
        <h1 style="font-size: 24px;text-align:center;">PUSKESMAS TANRUTEDONG</h1>
        <p style="text-align:center;line-height:10px;">Jl. Andi Cammi No.8 Tanrutedong</p>
        <p style="text-align:center;line-height:10px;">Telp. (0421) 721009</p>
    </header>
    <main style="width:3.5in;text-align: center; margin-top:-1rem;">
        <h1>Nomor Antrian</h1>
        <h2 style="font-size:4rem;margin-top: -1rem;">{{ $antrianSekarang }}</h2>
    </main>
    <footer style="width:3.5in;text-align: center;margin-top: -3rem;">
        <p>Terima Kasih Atas <br /> Kunjungan Anda</p>
    </footer>
</body>
</html>