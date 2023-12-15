<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Keluar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center my-6">{{ $title }}</h1>
    <p class="text-center">BPS DKI JAKARTA</p>
    <p class="text-center">{{ $riwayat->pemohon->divisi->nama_divisi }}</p>
    <p>Daftar barang yang dibutuhkan</p>

    <table class="table table-bordered">
        <thead class="">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
        </thead>
        @foreach($riwayat->barangs as $barang)
        <tbody>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $barang->master_barang->nama_barang }}</td>
            <td>{{ $barang->stok_request }}</td>
            <td>{{ $barang->master_barang->satuan->jenis_satuan }}</td>
        </tbody>
        @endforeach
    </table>

    <div class="content-between" >
        <table class="table table-borderless">
            <tr>
                <td>Mengetahui</td>
                <td class="text-right"><p>Jakarta, {{ $date }}</p></td>
            </tr>
            <tr>
                <td class="text-left">Kepala Bagian Umum</td>
                <td class="text-right"> Kepala {{ $riwayat->pemohon->divisi->nama_divisi }}</td>
            </tr>
            <tr>
                <td class="text-left"><img src="{{ public_path('storage/ttd/atasan/4.png') }}" style='width:45%' alt=""></td>
                {{-- {{ dd($riwayat->pemohon->divisi_id) }} --}}
                <td class="text-right"><img src="{{ public_path('storage/ttd/atasan/'.$riwayat->pemohon->divisi_id.'.png') }}" style='width:45%' alt=""></td>
            </tr>
            <tr>
                <td class="text-left">Pak Suryana</td>
                <td class="text-right">{{ $riwayat->approve->name  }}</td>
            </tr>
            <tr>
                <td class="text-left">1268846383947383938</td>
                <td class="text-right">{{ $riwayat->approve->nip  }}</td>
            </tr>
        </table>
        <h3 class="text-center">Pemproses Barang</h3>
        <table class="table table-borderless">
            <tr>
                <td class="text-left">Petugas Barang</td>
                <td class="text-right">Penerima Barang</td>
            </tr>
            <tr>
                {{-- {{ asset('storage/'.$riwayat->fname_ttd_pemohon) }}; --}}
                <td class="text-left"><img src="{{ public_path('storage/'.$riwayat->fname_ttd_petugas) }}" style="width:40%" alt=""></td>
                <td class="text-right"><img src="{{ public_path('storage/'.$riwayat->fname_ttd_pemohon) }}" style="width:40%" alt=""></td>
            </tr>
            <tr>
                <td class="text-left">{{ $riwayat->petugas->name }}</td>
                <td class="text-right">{{ $riwayat->pemohon->name  }}</td>
            </tr>
            <tr>
                <td class="text-left">{{ $riwayat->petugas->nip }}</td>
                <td class="text-right">{{ $riwayat->pemohon->nip  }}</td>
            </tr>
        </table>
    </div>
    <div></div>

    <div class=" content-between">
        <p></p>
        <p></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
