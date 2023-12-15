@extends('dashboard.layouts.main')

@section('menu')
    {{ header("Access-Control-Allow-Origin: *") }}
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
    {{-- {{ dd($barangs) }} --}}
    <h1>List Barang</h1>
@endsection

@section('title_card')
    <h1>Monitoring Jumlah Barang di dalam gudang <br>(Direkomendasikan untuk melakukan pengecekan berkala ke Gudang)</h1>
@endsection

@section('card')
    <div class="w-7/8 p-3 py-5 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
        <img src="{!! asset('img/component/box_card.svg') !!}" alt="jumlah_barang" class="p-2 sm:h-14 md:h-16">
        <h5 class="font-semibold tracking-tight text-gray-600 mx-2 sm:text-base md:text-lg">{{ $count_barangs }}</h5>
        <div class="flex justify-between mx-2">
            <p class="font-normal text-gray-500 place-items-start text-sm md:text-sm">Jenis Barang</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="w-full">
        <div class="w-full sm:rounded-lg font-inter space-y-6">
            <h3 class="text-gray-600 text-lg font-semibold">Daftar Master Barang</h3>
            <form action="/dashboard/import" method="POST" enctype="multipart/form-data" class="flex flex-nowrap md:justify-between md:content-between">
                @csrf
                <input type="file" class="bg-white border-gray-800" required name="file" accept=".csv">
                <button type="submit" class="px-3.5 py-1.5 hover:bg-blue-400 bg-blue-600 whitespace-nowrap sm:py-0.5 text-sm text-white ml-8 rounded-md ">Import CSV</button>
            </form>
        </div>
        <div class="flex justify-between content-between sm:flex-wrap gap-4 pb-4 mt-5 mb-1">
            <form action="">
            @csrf
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
                    <input type="text" id="table-search" name="search"
                        class="block py-2 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Cari Permintaan" value="{{ request('search') }}">
                </div>
            </form>
            <a id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" name="delete"
                class="py-2 px-3 mb-2 text-xs text-center text-white cursor-pointer rounded-md font-semibold focus:outline-none bg-red-500">
                Hapus Barang
            </a>
        </div>
            <form action="/dashboard/list/delete" method="POST">
                @method('delete')
                @csrf
                <div id="deleteModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full md:h-auto">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>

                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Pastikan Input Stok Barang Sesuai!</h3>
                                <button data-modal-hide="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Batalkan</button>
                                <button type="submit"  class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Ya, Saya Yakin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <!-- Main modal -->
                <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full lg:inset-0 h-modal lg:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda Yakin Ingin Menghapus Barang Ini?</p>
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
                </div> --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-blue-50 rounded-xl">
                            <tr>
                                <th scope="col" class=" text-xs whitespace-nowrap w-1/12 p-6">
                                </th>
                                <th scope="col" class=" text-xs whitespace-nowrap w-1/12 pr-8">
                                    Kode Barang
                                </th>
                                <th scope="col" class="px-6 pr-6 py-3">
                                    <span>@sortablelink('nama_barang')</span>
                                    <a class=" inline-block"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                    </svg></a class="flex">
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Satuan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex place-self-center items-center">
                                        @sortablelink('stok')
                                            <a><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if ($barangs->count() == 0)
                                <tr class="bg-white border-b w-full text-gray-500 hover:bg-gray-50 text-center">
                                    <td colspan="6" class="p-6 text-base py-8 font-normal italic">Barang Tidak Ditemukan 😞</td>
                                </tr>
                            @else
                                @foreach ($barangs as $barang)
                                    <tr class="bg-white border-b text-gray-500 hover:bg-gray-50" id="kode_barang{{ $barang->kode_barang }}">
                                        <td scope="col" class=" text-xs whitespace-nowrap px-6">
                                            <div class="flex items-center">
                                                <label for="checkbox" class="sr-only">checkbox</label>
                                                <input id="checkbox" name="checkbox[]" type="checkbox" value="{{ $barang->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            </div>
                                        </td>
                                        <td class= "pr-8 py-4">
                                            <span id="kode{{ $barang->id }}">{{ $barang->kode_barang }}</span>
                                        </td>
                                        <td scope="row" class="px-6 pr-6 py-4 font-medium whitespace-nowrap">
                                            {{ $barang->nama_barang }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                            {{ $barang->satuan->jenis_satuan }}
                                        </td>
                                        <td class="px-6 py-4 place-self-center text-center">
                                            <span id="stokValue{{ $barang->id }}">{{ $barang->stok }}</span>
                                            <input type="number" id="stokInput{{ $barang->id }}"
                                            class="bg-gray-50 border hidden border-gray-300 text-gray-600 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                                            value="{{ $barang->stok }}" required>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($barang->stok < 20 && $barang->stok > 0)
                                                <button type="button"
                                                    class="py-1.5 px-4 mr-2 mb-2 text-xs
                                                        text-amber-400 font-semibold focus:outline-none bg-amber-100 rounded-2xl whitespace-nowrap">
                                                    Stok Menipis
                                                </button>
                                            @elseif ($barang->stok == 0)
                                                <button type="button"
                                                    class="py-1.5 px-4 mr-2 mb-2 text-xs
                                                    text-red-400 font-semibold focus:outline-none bg-red-100 rounded-2xl whitespace-nowrap">
                                                    Habis
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="py-1.5 px-4 mr-2 mb-2 text-xs
                                            text-green-600 font-semibold focus:outline-none bg-green-100 rounded-2xl">
                                                    Tersedia
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>

            <div id="page" class="mt-8 ">
                {{ $barangs->links('pagination::tailwind') }}
            </div>
    </div>
@endsection

@section('script')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        function editStok(id) {
            const Value = "stokValue"+id;
            const Input = "stokInput"+id;
            console.log(Value);

            document.getElementById("ubah"+id).classList.add('hidden');
            document.getElementById("simpan"+id).classList.remove('hidden');
            document.getElementById("kode"+id).classList.add('hidden');
            document.getElementById("delete"+id).classList.remove('hidden');
            document.getElementById("delete"+id).classList.add('block');


            document.getElementById(Value).classList.add('hidden');
            const stokInput = document.getElementById(Input);
            stokInput.classList.remove('hidden');
        }
    </script>
@endsection
