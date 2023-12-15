@extends('dashboard.layouts.main')

@section('menu')
    <h1>Detail Barang Masuk</h1>
    {{-- {{ dd($riwayat_masuk) }} --}}
@endsection

@section('title_card')
    <table class="table-auto text-gray-600">
        <tbody>
            <tr>
                <td class="pt-1.5">Petugas Input</td>
                <td class="pt-1.5 px-3">:</td>
                <td class="pt-1.5 px-2"> {{  $riwayat_masuk->User->name  }}</td>
            </tr>
            <tr>
                <td class="pt-1.5">Tanggal</td>
                <td class="pt-1.5 px-3">:</td>
                <td class="pt-1.5 px-2">{{ \Carbon\Carbon::parse($riwayat_masuk->tanggal)->format('j F Y') }}</td>
            </tr>
            <tr>
                <td class="pt-1.5">Jam</td>
                <td class="pt-1.5 px-3">:</td>
                <td class="pt-1.5 px-2">{{ $riwayat_masuk->created_at->format('H:i:s') }}</td>
            </tr>
            <tr>
                <td class="pt-1.5">Pembelian Melalui</td>
                <td class="pt-1.5 px-3">:</td>
                <td class="pt-1.5 px-2"> {{ $riwayat_masuk->platform_beli }}</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('content')
    <div class="w-full">
        <p class="text-xm text-gray-600 mb-3"><b>Detail Barang</b></p>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-gray-700 bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Satuan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Jumlah Barang Masuk
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat_masuk->barangs as $barang)
                        {{-- {{ dd($barang) }} --}}
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $barang->master_barang->nama_barang }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $barang->master_barang->satuan->jenis_satuan }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $barang->stok_input }}
                            </td>
                            <td class="px-6 py-4 text-left">
                                {{ $barang->keterangan }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('desk_content')
    <div class="w-full flex place-content-center mt-4">
        <a target="_blank" href="/view/{{ $riwayat_masuk->fname_nota }}"
            class="px-4 py-2.5 text-xs font-medium text-center place-self-center justify-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <img class="w-4 h-4 text-white mr-2" src="{!! asset('img/component/lihat_nota_icon.svg') !!}" alt="Icon Nota">
            Lihat Nota
        </a>
    </div>
@endsection
