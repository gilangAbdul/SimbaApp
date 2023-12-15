@extends('dashboard.layouts.main')

@section('menu')
    <h1>Riwayat Permintaan Barang</h1>
@endsection

@section('title_card')
    <div class="none w-full">
        <div class="flex items-center justify-between pb-4 mt-5 mb-1">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative right-0">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block py-2 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Cari Permintaan">
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-sm text-gray-700 bg-blue-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Pengguna
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Permintaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ID Permintaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($riwayats->count() >0)
                        @foreach ($riwayats as $riwayat)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="grid-rows-2 px-6 py-4">
                                    <div>{{ $riwayat->pemohon->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $riwayat->pemohon->divisi->nama_divisi }}</div>
                                </td>
                                <td class="grid-rows-2 px-6 py-4">
                                    <div>
                                        {{ $riwayat->barangs->count() }} Barang
                                    </div>
                                    @if ($riwayat->barangs->count() > 0)
                                        <button data-modal-target='static-modal' data-modal-toggle = 'static-modal'
                                            class="text-xs underline text-blue-600 hover:text-blue-400">
                                            Lihat detail
                                        </button>
                                    @endif
                                    <!-- Main modal -->
                                    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-700">
                                                        ID : {{ $riwayat->id }}
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="static-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <table class="w-full text-sm text-left text-gray-500">
                                                        <thead class="text-xs text-gray-700 uppercase rounded-xl bg-blue-50  ">
                                                            <tr>
                                                                <th scope="col"
                                                                    class=" text-xs whitespace-nowrap px-6 py-3 p-6">
                                                                    No
                                                                </th>
                                                                <th scope="col" class="px-6 py-3">
                                                                    Barang
                                                                </th>
                                                                <th scope="col" class="w-3/12 px-10 py-3">
                                                                    <div class="flex place-self-center">
                                                                        Jumlah
                                                                    </div>
                                                                </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($riwayat->barangs as $barang)
                                                                <tr class="bg-white border-b text-gray-500 hover:bg-gray-50">
                                                                    <td class="px-6 py-3">
                                                                        <span>{{ $loop->iteration }}</span>
                                                                    </td>
                                                                    <th scope="row"
                                                                        class="text-left pr-8  px-6 py-3 font-medium whitespace-nowrap">
                                                                        {{ $barang->master_barang->nama_barang }}
                                                                    </th>
                                                                    <td class="text-center px-6 py-3 place-self-center">
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
                                <td class="px-6 py-4">
                                    {{ $riwayat->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $riwayat->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($riwayat->status_persetujuan_id == 1)
                                        <button type="button"
                                            class="py-1.5 px-4 mr-2 mb-2 text-xs text-amber-400 font-semibold focus:outline-none bg-amber-100 rounded-2xl">
                                            Pending
                                        </button>
                                    @elseif ($riwayat->status_persetujuan_id == 2)
                                        <button type="button"
                                            class="py-1.5 px-4 mr-2 mb-2 text-xs
                                            text-green-600 font-semibold focus:outline-none bg-green-100 rounded-2xl">
                                            Disetujui
                                        </button>
                                    @elseif ($riwayat->status_persetujuan_id == 3)
                                        <button type="button"
                                            class="py-1.5 px-4 mr-2 mb-2 text-xs
                                            text-red-400 font-semibold focus:outline-none bg-red-100 rounded-2xl">
                                            Ditolak
                                        </button>
                                    @else
                                        <button type="button"
                                            class="py-1.5 px-4 mr-2 mb-2 text-xs
                                        text-gray-400 font-semibold focus:outline-none bg-gray-100 rounded-2xl">
                                            Permintaan Selesai
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b w-full text-gray-500 hover:bg-gray-50 text-center">
                            <td colspan="6" class="p-6 text-base py-8 font-normal italic">Belum Ada Permintaan Saat Ini</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
