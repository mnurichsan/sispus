@php
    $lahir = new DateTime($kunjungan->pasien->tanggal_lahir);
    $today = new DateTime();
    $umur  = $today->diff($lahir);
@endphp
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
<body style="background-color:#f7fee7;">
    <header style="width:6.5in;">
        <p style="float:left;transform: translate(4rem, 2rem);font-weight: 600;font-size: 25px;">Logo</p>
        <div style="float: right;line-height: 10px;transform: translateY(25px);">
            <h1 style="font-size: 24px;text-align:center;">PUSKESMAS TANRUTEDONG</h1>
            <p style="text-align:center;">Jl. Andi Cammi No.8 Tanrutedong</p>
            <p style="text-align:center;">Telp. (0421) 721009</p>
        </div>
        <div style="clear:both;">
    </header>
    <section style="width:6.5in;margin-top:1rem;">
        <h1 style="text-align:center;border:1px solid black;background-color:#c7d2fe;font-size:18px;margin-left:2rem;width:100%;">IDENTITAS PASIEN</h1>
        <table style="width:100%;margin-left:2rem;">
            <tbody>
                <tr>
                    <td style="width:20%;">No. Kartu</td>
                    <td style="width:80%;">: {{ $kunjungan->pasien->no_rekammedis }}</td>
                </tr>
                <tr>
                    <td style="width:20%;">Nama</td>
                    <td style="width:80%;">: {{ $kunjungan->pasien->nama_pasien }}</td>
                </tr>
                <tr>
                    <td style="width:20%;">Umur</td>
                    <td style="width:80%;">: {{ $umur->y }} Tahun</td>
                </tr>
                <tr>
                    <td style="width:20%;">Alamat</td>
                    <td style="width:80%;">: {{  $kunjungan->pasien->alamat }}</td>
                </tr>
                <tr>
                    <td style="width:20%;">No. Hp</td>
                    <td style="width:80%;">: {{ $kunjungan->pasien->no_hp }}</td>
                </tr>
            </tbody>
        </table>
    </section>
    <section style="width:6.5in;margin-top:1rem;">
        <table style="width:100%;margin-left:2rem;border-collapse: collapse;border:1px solid black;">
            <thead style="background-color:#c7d2fe;">
                <tr style="border-collapse: collapse;border:1px solid black;">
                    <th style="border-collapse: collapse;border:1px solid black;">No.</th>
                    <th style="border-collapse: collapse;border:1px solid black;">TGL</th>
                    <th style="border-collapse: collapse;border:1px solid black;">AMNESIA HASIL PEMERIKSAAN</th>
                    <th style="border-collapse: collapse;border:1px solid black;">SARAN/THERAPI</th>
                </tr>
            </thead>    
            <tbody>
                <tr style="border-collapse: collapse;border:1px solid black;">
                    <td style="border-collapse: collapse;border:1px solid black;">1</td>
                    <td style="border-collapse: collapse;border:1px solid black;">12-maret-2000</td>
                    <td style="border-collapse: collapse;border:1px solid black;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque, assumenda.</td>
                    <td style="border-collapse: collapse;border:1px solid black;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, ab.</td>
                </tr>
            </tbody>
        </table>    
    </section>
</body>
</html>