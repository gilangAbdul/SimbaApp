@extends('petugas.layouts.main')

@section('menu')
    <h1>Proses Barang Keluar</h1>
@endsection

@section('title_card')
    <h2>Pastikan melakukan pengecekan NIP Pegawai yang menerima barang</h2>
    <table class="table-auto font-medium mt-5">
        <tbody class="text-gray-500">
            <tr>
                <td class="text-gray-500">Pemohon Barang</td>
                <td class="text-gray-500 px-4">:</td>
                <td class="text-gray-500">{{ $riwayat->pemohon->name }}</td>
            </tr>
            <tr>
                <td class="text-gray-500">Tanggal</td>
                <td class="text-gray-500 px-4">:</td>
                <td class="text-gray-500">{{ $riwayat->created_at }}</td>
            </tr>
            <tr>
                <td class="text-gray-500">Disetujui Oleh</td>
                <td class="text-gray-500 px-4">:</td>
                <td class="text-gray-500">{{ $riwayat->approve->name }}</td>
            </tr>
            <tr>
                <td class="text-gray-500">Jumlah Barang</td>
                <td class="text-gray-500 px-4">:</td>
                <td class="text-gray-500">{{ $riwayat->barangs->count() }} barang</td>
            </tr>
        </tbody>
    </table>
@endsection

@section('card')
    <h2 class="text-gray-500">Detail Barang : </h2>
@endsection

@section('content')
    <div class="flex-row text-center w-full">
        <div class="relative overflow-x-auto w-full pb-8">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kode Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah Permintaan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat->barangs as $barang)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $barang->master_barang->kode_barang }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $barang->master_barang->nama_barang }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $barang->stok_request }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="/petugas/process_out/{{ $riwayat->id }}" method="post" enctype="multipart/form-data">
        @csrf
            <div>
                <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                    class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button">
                    TTD Petugas
                </button>
                @error('signed')
                    <small class=" text-xs text-red-700 m-2">{{ $message }}</small>
                @enderror

                <!-- Main modal -->
                <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-8 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-700">
                                    Masukkan Tanda Tangan Petugas
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="static-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="col-md-12">
                                <div class="mt-3 mb-3" id="sig"></div>
                                <br/>
                                <button id="clear"
                                    class="mt-3 py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-red-500 rounded-lg border border-gray-200 hover:bg-red-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-200">
                                    Bersihkan</button>
                                <button type="button" data-modal-hide="static-modal"
                                    class="mt-3 focus:outline-none text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                    Simpan
                                </button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 w-full text-right">
                <a id="confirm" data-modal-target="confirmModal" data-modal-toggle="confirmModal" name="confirm"
                class="focus:outline-none px-10 cursor-pointer text-white bg-green-600 hover:bg-green-300 hover:text-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm py-2.5 me-2 mb-2">
                    Konfirmasi Barang Keluar
                </a>
                <div id="confirmModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full md:h-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirmModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Pastikan Stok yang diberikan sesuai!</h3>
                                <button data-modal-hide="confirmModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Batalkan</button>
                                <button type="submit"  class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Ya, Saya Yakin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
@endsection
