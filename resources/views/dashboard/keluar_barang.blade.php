@extends('dashboard.layouts.main')

@section('menu')
    <h1>Monitoring Barang Keluar</h1>
@endsection

@section('title_card')
    <h1 class="mb-5">Ringkasan Bulan Ini</h1>
@endsection

@section('card')
    <a href="/dashboard/list_req">
        <div class="w-5/6 p-5 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
            <img src="{!! asset('img/component/req_card.svg') !!}" alt="permintaan_barang" class="h-10 mb-5 md:h-14 ">
            <h5 class="text-base font-semibold tracking-tight text-gray-600 mt-2 md:text-xl" id="total-riwayatkeluar">
                {{ $count_acc }}
            </h5>
            <div class="flex justify-between">
                <p class="font-normal text-gray-500 place-items-start text-xs md:text-sm">Total Permintaan Barang</p>
                <div class=" flex items-center gap-1">
                    <p class="font-normal text-sm md:text-base text-green-400 place-items-end">{{ number_format($persen_up, 2) }}%</p>
                    <img src="{!! asset('img/component/up_percent.svg') !!}" alt="up" class="inline">
                </div>
            </div>
        </div>
    </a>
@endsection

@section('content')
    <div class="none w-full">
        <h1 class="text-xm my-9 font-medium text-gray-500">Daftar Riwayat Barang Keluar</h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-sm text-gray-700 bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pemohon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Petugas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Detail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Laporan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($count_acc == 0)
                        <tr class="bg-white border-b w-full text-gray-500 hover:bg-gray-50 text-center">
                            <td colspan="6" class="p-6 text-base py-8 font-normal italic">Riwayat Permintaan Tidak Ditemukan 😞</td>
                        </tr>
                    @else
                        @foreach ($riwayats as $riwayat)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration}}
                                </td>
                                <td class="grid-rows-2 px-6 py-4">
                                    <div>{{ $riwayat->pemohon->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $riwayat->pemohon->divisi->nama_divisi }}</div>
                                </td>
                                <td class="grid-rows-2 px-6 py-4">
                                    <div>{{ $riwayat->petugas->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $riwayat->petugas->divisi->nama_divisi }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($riwayat->created_at)->format('j F Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $riwayat->barangs->count() }} Barang
                                </td>
                                <td class="px-6 py-4">
                                    <a href="out/{{ $riwayat->id }}">
                                        <button type="button"
                                            class="px-3 py-2 text-xs font-medium text-center justify-center inline-flex items-center text-blue-700 border border-blue-700 hover:border-white focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg mr-2 mb-2">
                                            Lihat Detail
                                        </button>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/dashboard/out/{{ $riwayat->filename_laporan }}" target="_blank">
                                        <button type="button"
                                            class="px-3 py-2 text-xs font-medium text-center justify-center inline-flex items-center text-red-700 bg-red-200 border border-red-700 hover:border-white focus:ring-4 focus:outline-none focus:ring-red-300  rounded-lg mr-2 mb-2">
                                            <img class="w-4 h-4 text-white mr-2" src="{!! asset('img/component/pdf_report_icon.svg') !!}" alt="PDF Report">
                                            PDF Report
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
