@extends('pegawai.layouts.main')

@section('menu')
    @if ((session()->has('success')))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        </div>
    @elseif ((session()->has('error')))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        </div>
    @endif
@endsection

@section('card')
    <div class=" gap-10">
        <a href="/pegawai/req_barang">
            <div class="flex items-center rounded-lg w-full py-10 px-8  bg-white h-max dark:bg-gray-700 gap-6">
                <img src="{{ asset('img/component/req_barang_card_pegawai.svg') }}" alt="req_pegawai" class="h-20 w-20">
                <div>
                    <p class="text-lg font-bold text-gray-800  whitespace-nowrap">Permintaan Barang</p>
                    <p class=" text-sm md:text-sm text-gray-500 mt-2">Ajukan permintaan barang</p>
                </div>
            </div>
        </a>
    </div>
    <div>
        <a href="/pegawai/riwayat">
            <div class="flex items-center rounded-lg py-10 px-8 bg-white h-max w-max dark:bg-gray-700 gap-6">
                <img src="{{ asset('img/component/history_rerq_card_pegawai.svg') }}" alt="hist_pegawai" class="h-20 w-20">
                <div>
                    <p class="text-lg font-bold text-gray-800 whitespace-nowrap">Riwayat Permintaan Barang</p>
                    <p class="text-sm md:text-sm text-gray-500 mt-2">Melihat list permintaan barang Anda</p>
                </div>
            </div>
        </a>
    </div>
@endsection

@section('content')
<div class="flex flex-col w-full gap-6">
    <h1 class="text-base font-semibold text-gray-700">Daftar permintaan baru terbaru</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-sm bg-yellow-50 text-gray-700">
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
                    <<th scope="col" class="px-6 py-3">
                        Keterangan
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
                                <span id="kode{{ $riwayat->id }}">{{ $riwayat->id }}</span>
                            </td>
                            <td class="px-6 py-3">
                                {{ $riwayat->barangs->count() }} Barang</p>
                                @if ($riwayat->barangs->count() > 0)
                                    <button data-modal-target='{{ $riwayat->id }}' data-modal-toggle = '{{ $riwayat->id }}'
                                        class="text-xs text-blue-600 hover:text-blue-400">
                                        Lihat detail
                                    </button>
                                        <!-- Main modal -->
                                    <div id="{{ $riwayat->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-3 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-700">
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
                                                                <th scope="col" class=" text-xs whitespace-nowrap px-6 py-3 p-6">
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
                                                                        <span>{{ $loop->iteration}}</span>
                                                                    </td>
                                                                    <th scope="row" class="text-left pr-8  px-6 py-3 font-medium whitespace-nowrap">
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
                            <td scope="row" class=" py-3 font-medium whitespace-nowrap">
                                {{ $riwayat->created_at }}
                            </td>
                                @if ($riwayat->status_persetujuan_id == 1)
                                <td class="px-6 py-3">
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                            text-gray-600 font-semibold focus:outline-none bg-amber-100 rounded-2xl whitespace-nowrap">
                                        Pending
                                    </button>
                                </td>
                                <td>
                                    Menunggu Proses Persetujuan Atasan
                                </td>
                                @elseif ($riwayat->status_persetujuan_id == 3)
                                <td class="px-6 py-4">
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                        text-red-400 font-semibold focus:outline-none bg-red-100 rounded-2xl whitespace-nowrap">
                                        Ditolak
                                    </button>
                                </td>
                                <td>

                                </td>
                                @elseif ($riwayat->status_persetujuan_id == 2)
                                <td class="px-6 py-4">
                                    <button type="button"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                        text-green-600 font-semibold focus:outline-none bg-green-100 rounded-2xl whitespace-nowrap">
                                        Disetujui
                                    </button>
                                </td>
                                <td>
                                    Permintaanmu telah disetujui harap segera <br/> mengambil barang ke bagian gudang
                                </td>
                                @else
                                    <td class="px-6 py-4">
                                        <button type="button"
                                            class="py-1.5 px-4 mr-2 mb-2 text-xs
                                            text-gray-600 font-semibold focus:outline-none bg-gray-100 rounded-2xl">
                                            Diterima
                                        </button>
                                    </td>
                                    <td>Permintaan Barang Telah Selesai</td>
                                @endif
                            </td>
                            <td>
                                @if ($riwayat->status_persetujuan_id == 1)
                                    <form action="/pegawai/req_barang/{{ $riwayat->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="button" data-modal-toggle="deleteModal" data-modal-target="deleteModal"
                                        class="py-1.5 px-4 mr-2 mb-2 text-xs
                                        text-red-400 font-semibold focus:outline-none bg-red-100 rounded-2xl whitespace-nowrap">
                                        Batalkan Pengajuan
                                        </button>
                                        <!-- Main modal -->
                                        <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] lg:h-full">
                                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                    <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                    <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda Yakin Ingin Membatalkan Pengajuan?</p>
                                                    <div class="flex justify-center items-center space-x-4">
                                                        <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                            Tidak, Batalkan
                                                        </button>
                                                        <button id='submit_delete' type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                            Ya, Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
