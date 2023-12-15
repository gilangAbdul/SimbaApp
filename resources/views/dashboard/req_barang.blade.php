@extends('dashboard.layouts.main')

@section('menu')
    @if (session()->has('success'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        </div>
    @elseif (session()->has('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        </div>
    @endif
    <h1>Permintaan Barang</h1>
@endsection

@section('title_card')
    <div class="w-full">
        <h2 class="ml-1 text-base text-gray-500 mb-5">Daftar Permintaan Barang yang memerlukan persetujuan</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-xl w-full">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-blue-50 p-2">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Pemohon
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Banyak Jenis Barang
                        </th>
                        <th scope="col" class="px-6 py-4 justify-center">
                            Persetujuan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($riwayat_not_acc->count() > 0)
                        @foreach ($riwayat_not_acc as $req)
                            {{-- {{ dd($req) }} --}}
                            <tr class="bg-white border-b text-gray-500 hover:bg-gray-50">
                                <td class= "px-6 pr-8 py-4">
                                    <div>{{ $req->pemohon->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $req->pemohon->divisi->nama_divisi }}</div>
                                </td>
                                <td>
                                    <div>{{ $req->created_at->format('d M Y') }}</div>
                                    <div>{{ $req->created_at->format('H:i:s') }}</div>
                                </td>
                                <td scope="row" class="px-6 pr-6 py-4 whitespace-nowrap">
                                    {{ $req->barangs->count() }} Barang <br>
                                    @if ($req->barangs->count() > 0)
                                        <button data-modal-target='{{ $req->id }}' data-modal-toggle = '{{ $req->id }}' data-target='#{{ $req->id }}'
                                            class="text-xs text-blue-500 hover:text-blue-400">
                                            Lihat detail
                                        </button>
                                        <!-- Main modal -->
                                        <div id="{{ $req->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-700">
                                                            ID : {{ $req->id }}
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="{{ $req->id }}">
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
                                                            <thead
                                                                class="text-xs text-gray-700 uppercase rounded-xl bg-blue-50  ">
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
                                                                @foreach ($req->barangs as $barang)
                                                                    <tr
                                                                        class="bg-white border-b text-gray-500 hover:bg-gray-50">
                                                                        <td class="px-6 py-3">
                                                                            <span>{{ $barang->master_barang->kode_barang }}</span>
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
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="grid grid-rows-2 gap-2 justify-start">
                                        <form action="/dashboard/out/{{ $req->id }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <input type="text" name="status" class="hidden" value="2">
                                            <button type="submit"
                                                class="py-1.5 px-8 mr-2 mb-2 text-sm font-normal
                                                        text-white focus:outline-none bg-green-500 rounded-lg border border-gray-200 hover:bg-green-200 hover:text-green-500 focus:z-10 focus:ring-4 focus:ring-gray-200 ">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="/dashboard/out/{{ $req->id }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <input type="text" name="status" class="hidden" value="3">
                                            <button type="submit"
                                                class="py-1.5 px-4 mr-2 mb-2 text-sm font-normal
                                                    text-white focus:outline-none bg-red-500 rounded-lg border border-gray-200 hover:bg-red-200 hover:text-red-500 focus:z-10 focus:ring-4 focus:ring-gray-200 ">
                                                Tidak Setujui
                                            </button>
                                        </form>
                                    </div>
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
