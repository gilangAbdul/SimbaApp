@extends('petugas.layouts.main')

@section('menu')
    <h1>List Barang</h1>
@endsection

@section('title_card')
    <h1>Monitoring Jumlah Barang di dalam gudang <br>(Direkomendasikan untuk melakukan pengecekan berkala ke Gudang)</h1>
@endsection

@section('card')
    <div class="w-5/6 p-5 mt-4 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
        <img src="{!! asset('img/component/box_card.svg') !!}" alt="jumlah_barang" class="h-10 mb-5 md:h-14 ">
        <h5 class="text-base font-semibold tracking-tight text-gray-600 mt-2 md:text-xl">{{ $count_barangs }}</h5>
        <div class="flex justify-between">
            <p class="font-normal text-gray-500 place-items-start text-xs md:text-sm">Jenis Barang</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="w-full sm:rounded-lg font-inter space-y-6">
        <h3 class="text-gray-600 text-lg font-semibold">Daftar Master Barang</h3>
        <div class="flex items-center justify-between pb-4 mt-5">
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
                <form action="">
                    @csrf
                    <input type="text" id="table-search" name="search"
                        class="block py-2 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Cari Barang" value={{ request('search') }}>
                </form>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 rounded-xl">
                    <tr>
                        <th scope="col" class=" text-xs whitespace-nowrap w-1/12 p-6">
                            No
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
                        <th scope="col" class="px-6 py-3 text-center">
                            <div class="flex place-self-center text-center items-center">
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
                                        {{ $loop->iteration }}
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
    </div>
@endsection

@section('desk_content')
    {{ $barangs->links('pagination::tailwind') }}
@endsection

@section('script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
