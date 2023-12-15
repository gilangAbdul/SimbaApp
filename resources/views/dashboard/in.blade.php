@extends('dashboard.layouts.main')

@section('menu')
    <h1>Monitoring Barang Masuk</h1>
@endsection

@section('title_card')
    <h3>Ringkasan bulan ini</h3>
@endsection

@section('card')
    <a href="#">
        <div class="w-7/8 p-3 py-5 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
            <img src="{!! asset('img/component/inBox_card.svg') !!}" alt="jumlah_barang" class="p-2 sm:h-14 md:h-16">
            <h5 class="font-semibold tracking-tight text-gray-600 mx-2 sm:text-base md:text-lg" id="total-riwayat_masuk">
                {{ $total_riwayat_bulan }}</h5>
            <div class="flex justify-between mx-2">
                <p class="font-normal text-gray-500 place-items-start text-sm md:text-sm">Transaksi Barang Masuk</p>
                <div class="flex items-center ml-3">
                    <p class="font-semibold text-sm text-green-400" id="stat-riwayat_masuk">
                        {{ number_format($persen_up, 2) }}%</p>
                    <img src="{!! asset('img/component/up_percent.svg') !!}" alt="up" class="inline">
                </div>
            </div>
        </div>
    </a>
@endsection

@section('content')
    <div class="w-full sm:rounded-lg font-inter space-y-6">
        <h3 class="text-gray-600 text-lg font-semibold">Daftar Riwayat Barang Masuk</h3>
        <table class="w-full text-sm text-left text-gray-500 shadow-sm " id="masukbarang_table">
            <thead class="text-xs text-gray-700 uppercase bg-blue-50 rounded-xl">
                <tr>
                    <th scope="col" class="p-4">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Barang
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Petugas Input
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Detail
                    </th>
                </tr>
            </thead>
            <tbody>
            @if ($total_riwayat == 0)
                <tr class="bg-white border-b w-full text-gray-500 hover:bg-gray-50 text-center">
                    <td colspan="6" class="p-6 text-base py-12 font-normal italic">Riwayat Masuk Tidak Ditemukan</td>
                </tr>
            @else
                @foreach ($riwayat_masuks as $riwayat_masuk)
                    <tr class=" border-b hover:bg-gray-50 bg-white">
                        <td class="w-4 p-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-500 whitespace-nowrap">
                            <p class="text-sm font-normal text-gray-700">
                                {{ \Carbon\Carbon::parse($riwayat_masuk->tanggal)->format('j F Y') }}
                            </p>
                            <span class="text-xs font-thin">{{ $riwayat_masuk->created_at->format('H:i:s') }}</span>
                        </th>
                        <td class="px-12 py-4">
                            {{ $riwayat_masuk->barangs->count() }} Barang
                        </td>
                        <td class="px-6 py-4">
                            {{ $riwayat_masuk->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="in/{{ $riwayat_masuk->id }}">
                                <button type="button"
                                    class="px-3 py-2 text-xs font-medium text-center justify-center inline-flex items-center text-blue-700 border border-blue-700 hover:border-white focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg mr-2 mb-2">
                                    Lihat Detail
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
