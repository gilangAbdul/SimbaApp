@extends('petugas.layouts.main')

@section('menu')
<div class="p-10 mt-5 h-full w-full">
    <h1 class="mb-10 font-bold text-3xl text-gray-600 justify-center text-center">
        Input Barang Masuk
    </h1>
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="mb-5">
            <tr>
                <td class="p-2"><label for="platform" class="text-base">Pembelian </label></td>
                <td class="px-3"><label for="platform" class="text-sm">: </label></td>
                <td><input type="text" id="platform" class="bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block" placeholder="Toko Offline" required></td>
            </tr>
        </table>
        <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
            <table id="tableMasuk" class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-3/6">
                            <div class="flex">
                                Nama Barang
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/6">
                            <div class="flex text-center self-center place-content-center">
                                Jumlah
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 w-2/6">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4" id="row_input">
                            {{-- <select class="js-example-basic-multiple js-states form-control" id="id_label_multiple" multiple="multiple"></select> --}}
                            <select class="js-example-basic-single w-full"
                             name="id_barang[]"
                             id="js-example-basic-single">
                             @if ($barangs->count() == 0)
                                <option class="text-gray-700">Gagal Memuat Barang</option>
                             @else
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }} || {{ $barang->stok }}</option>
                                @endforeach
                             @endif
                            </select>
                            @error('id_barang')
                                <span class=" inline-flex text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" min="0" id="stok_masuk" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                             required placeholder="Stok Masuk" name="stok_masuk[]">
                                @error('stok_masuk')
                                    <span class=" inline-flex text-sm text-red-600">{{ $message }}</span>
                                @enderror
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button type="button" onclick="deleteRowMasuk(this)"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline bg-transparent">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5 w-full text-center">
            <div class="w-full">
                <button type="button" onclick="addRowMasuk()"
                    class="mt-2 w-2/6 text-gray-800 bg-gray-400 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Tambah Barang
                </button>
            </div>
            <p class="text-left text-base mt-10 mb-4">Nota Barang : </p>
            <div class="flex text-center items-center place-self-center w-1/3 mb-7 rounded">
                <div class="flex items-center  text-center place-self-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-3 pb-2">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 " id="display"><span class="font-semibold">Click to upload</span></p>
                            <p class="text-xs text-gray-500">SVG, PNG, JPG or PDF (MAX. 2 MB)</p>
                        </div>
                    </label>
                    <input name="fname_nota" id="dropzone-file" accept=".pdf,.jpg,.jpeg,.png" type="file" class="hidden" onchange="handleFileUpload(this)"/>
                </div>
                @error('fname_nota')
                    <small class=" text-xs text-red-700 m-2">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mt-5 w-full text-right">
            <a id="confirm" data-modal-target="confirmModal" data-modal-toggle="confirmModal" name="confirm"
            class="focus:outline-none px-10 cursor-pointer text-white bg-green-600 hover:bg-green-300 hover:text-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm py-2.5 me-2 mb-2">
                Submit Barang
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
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Pastikan Input Stok Barang Sesuai!</h3>
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
    <script>
        function handleFileUpload(input) {
            const file = input.files[0];
            if (file) {
                // console.log(file);
                document.getElementById("display").innerHTML = `${file.name}`;
                    // Lakukan sesuatu dengan file PDF, misalnya mengunggahnya ke server atau menampilkan di halaman.
            }
        }

        function addRowMasuk() {
            var table = document.getElementById("tableMasuk");
            var row = table.insertRow(table.rows.length);
            let input_row = document.getElementById('row_input');
            row.className ='bg-white border-b';
            // row.data-select2-id='select-data-5-ryxw';
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.outerHTML =
                '<td class="px-6 py-4"> <select name="id_barang[]" class="js-example-basic-single"> @foreach ($barangs as $barang) <option value="{{ $barang->id }}">{{ $barang->nama_barang }} || Stok : {{ $barang->stok }}</option> @endforeach </select> </td>'
            cell2.outerHTML =
                '<td class="px-6 py-4"> <input type="number" min="0" id="stok_masuk" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required placeholder="Stok Masuk" name="stok_masuk[]"> </td>';
            cell3.outerHTML =
                '<td class="px-6 py-4 text-center"> <button type="button" onclick="deleteRowMasuk(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline bg-transparent">Hapus</button> </td>';
            $('.js-example-basic-single').select2();
        }

        function deleteRowMasuk(button) {
            button.closest('tr').remove();
        }
    </script>

    <script>
        $('.js-example-basic-single').select2();
    </script>


@endsection
