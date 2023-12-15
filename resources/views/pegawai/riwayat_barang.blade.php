@extends('pegawai.layouts.main')

@section('menu')
    <h1>Riwayat Barang</h1>
@endsection

@section('title_card')
    <h1>Riwayat Permintaan Barang Anda</h1>
@endsection

@section('content')
    <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
        <table id="tablePermintaan" class="w-full text-sm text-left rtl:text-right text-gray-700">
            <thead class="text-sm text-gray-600 bg-yellow-100">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID Permintaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Permintaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($riwayats->count() == 0)
                    <tr class="bg-white border-b w-full text-gray-500 hover:bg-gray-50 text-center">
                        <td colspan="6" class="p-6 text-base py-8 font-normal italic">Anda belum pernah melakukan permintaan barang</td>
                    </tr>
                @else
                    @foreach ($riwayats as $riwayat)
                        <tr class="bg-white border-b text-gray-500 hover:bg-gray-50">
                            <td class="px-6 py-3">
                                <span>{{ $riwayat->id }}</span>
                            </td>
                            <td class="px-6 py-3">
                                {{ $riwayat->barangs->count() }} Barang <br/>
                                @if ($riwayat->barangs->count() > 0 )
                                    <button data-modal-target='{{ $riwayat->id }}' data-modal-toggle = '{{ $riwayat->id }}'
                                        class="text-xs underline text-blue-600 hover:text-blue-400">
                                        Lihat detail
                                    </button>
                                @endif
                                    <!-- Main modal -->
                                <div id="{{ $riwayat->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    ID : {{ $riwayat->id }}
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="{{ $riwayat->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <table class="w-full text-sm text-left text-gray-500">
                                                    <thead class="text-xs text-gray-700 uppercase rounded-xl bg-yellow-100  ">
                                                        <tr>
                                                            <th scope="col" class=" text-xs whitespace-nowrap w-1/12 p-6">
                                                                No
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Nama Barang
                                                            </th>
                                                            <th scope="col" class="w-3/12 px-10 py-3">
                                                                <div class="flex place-self-center">
                                                                    Jumlah
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($riwayat->barangs as $barang)
                                                            {{-- {{ dd($barang->master_barang->all()) }} --}}
                                                            <tr class="bg-white border-b text-gray-500 hover:bg-gray-50">
                                                                <td class="px-6 py-3">
                                                                    <span>{{ $loop->iteration }}</span>
                                                                </td>
                                                                <th scope="row" class="text-left px-6 py-3 font-medium whitespace-nowrap">
                                                                    {{ $barang->master_barang->nama_barang }}
                                                                </th>
                                                                <td class="text-center px-10 py-3 place-self-center">
                                                                    <span>{{ $barang->stok_request }}</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <th scope="row" class=" py-3 px-6 font-normal whitespace-nowrap">
                                {{ $riwayat->created_at->format('d M Y') }} <br>
                                {{ $riwayat->created_at->format('H:i:s') }} <br>
                            </th>
                            <td class="px-6 py-3">
                                @if ($riwayat->status_persetujuan_id == 1)
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                            text-amber-400 font-semibold focus:outline-none bg-amber-100 rounded-2xl whitespace-nowrap">
                                        Pending
                                    </button>
                                @elseif ($riwayat->status_persetujuan_id == 3)
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                        text-red-400 font-semibold focus:outline-none bg-red-100 rounded-2xl whitespace-nowrap">
                                        Ditolak
                                    </button>
                                @elseif ($riwayat->status_persetujuan_id == 2)
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                        text-green-600 font-semibold focus:outline-none bg-green-100 rounded-2xl whitespace-nowrap">
                                        Disetujui
                                    </button>
                                @else
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                text-gray-600 font-semibold focus:outline-none bg-gray-100 rounded-2xl">
                                        Diterima
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
