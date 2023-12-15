@extends('dashboard.layouts.main')

@section('menu')
    <h1>Detail Barang Keluar</h1>
@endsection

@section('title_card')
    <table class="table-auto text-gray-600">
        <tbody>
            <tr>
                <td class="pt-3">Pemohon</td>
                <td class="pt-3 px-3">:</td>
                <td class="pt-3 px-2"> {{  $riwayat->pemohon->name  }}</td>
            </tr>
            <tr>
                <td class="pt-3">Petugas Barang</td>
                <td class="pt-3 px-3">:</td>
                <td class="pt-3 px-2"> {{  $riwayat->petugas->name  }}</td>
            </tr>
            <tr>
                <td class="pt-3">Tanggal</td>
                <td class="pt-3 px-3">:</td>
                <td class="pt-3 px-2">{{ \Carbon\Carbon::parse($riwayat->created_at)->format('j F Y') }}</td>
            </tr>
            <tr>
                <td class="pt-3">Menyetujui</td>
                <td class="pt-3 px-3">:</td>
                <td class="pt-3 px-2">{{ $riwayat->approve->name }}</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('content')
    <div class="w-full">
        <p class="text-xm text-gray-600 mb-3"><b>Detail Barang</b></p>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-sm text-gray-700 bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat->barangs as $barang)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $barang->master_barang->nama_barang }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $barang->stok_request }}
                            </td>
                            <td class="px-6 py-4">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('desk_content')
    <div class="w-full justify-center text-center">
        <a href="/dashboard/out/{{ $riwayat->filename_laporan }}" target="_blank">
            <button type="button"
                class="px-3 py-2 text-xs font-medium text-center justify-center inline-flex items-center text-red-700 bg-red-200 border border-red-700 hover:border-white focus:ring-4 focus:outline-none focus:ring-red-300  rounded-lg mr-2 mb-2">
                <img class="w-4 h-4 text-white mr-2" src="{!! asset('img/component/pdf_report_icon.svg') !!}" alt="PDF Report">
                PDF Report
            </button>
        </a>
    </div>
@endsection
