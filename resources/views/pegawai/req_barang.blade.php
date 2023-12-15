@extends('pegawai.layouts.main')

@section('menu')
    <h1>Permintaan Barang</h1>
@endsection

@section('title_card')
    <h2>Buat Permintaan Barang Baru</h2>
@endsection

@section('content')
    <div class="w-full">
        <form method="POST" action="{{ route('input.req_barang') }}" enctype="multipart/form-data">
            @csrf
            <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                <table id="tablePermintaan"
                    class="w-full text-sm text-left rtl:text-right text-yellow-500 dark:text-gray-400">
                    <thead class="text-xs text-yellow-600 uppercase bg-gray-50 dark:bg-gray-700 dark:text-yellow-500">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-4/9 bg-yellow-100">
                                <div class="flex items-center">
                                    Nama Barang
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 w-3/9 bg-yellow-100">
                                <div class="flex items-center">
                                    Jumlah
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/9 bg-yellow-100">
                                <span class="sr-only"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">
                                <select class="js-example-basic-single" name="barang_id[]">
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }} || Tersedia:
                                            {{ $barang->stok }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4">
                                <input type="number" name="jumlah[]" placeholder="Jumlah" id="Jumlah"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button type="button" onclick="deleteRowPermintaan(this)"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline bg-transparent">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-5 w-full text-center">
                <div class="w-full">
                    <button type="button" onclick="addRowPermintaan()"
                        class="mt-2 w-full text-yellow-600 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah
                        Barang</button>
                </div>

                <!-- Modal toggle -->
                <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                    class="w-full text-yellow-600 bg-white hover:bg-yellow-200 focus:ring-4 focus:outline-none focus:ring-yellow-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button">
                    Insert Signature
                </button>

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
                                    Insert Signature
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
                                <br />
                                <button id="clear"
                                    class="mt-3 py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-red-600 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Clear
                                    Signature</button>
                                <button type="button" data-modal-hide="static-modal"
                                    class="mt-3 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Save
                                    Signature</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 w-full text-right">
                <a id="confirm" data-modal-target="confirmModal" data-modal-toggle="confirmModal" name="confirm"
                class="focus:outline-none px-10 cursor-pointer text-white bg-green-600 hover:bg-green-300 hover:text-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm py-2.5 me-2 mb-2">
                    Buat Permintaan
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
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Konfirmasi Permintaan Barang Baru!</h3>
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

        @if ($errors->any())
            <div class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center"
                id="my-modal">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-middle bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div>
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Error
                                </h3>
                                <div class="mt-2">
                                    <ul>
                                        @if ($errors->has('barang_id.*'))
                                            <li>Barang yang anda pilih harus berbeda.</li>
                                        @endif
                                        @if ($errors->has('jumlah.*'))
                                            <li>Jumlah harus diisi dan lebih dari 0</li>
                                        @endif
                                        @if ($errors->has('signed'))
                                            <li>Signature harus diisi</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm"
                                onclick="closeModal()">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('vendor/sign-pad/sign-pad.min.js') }}"></script>                   --}}
    <script>
        function closeModal() {
            document.getElementById('my-modal').classList.add('hidden');
        }
    </script>
    <script>
        function addRowPermintaan() {
            var table = document.getElementById("tablePermintaan");
            var row = table.insertRow(table.rows.length);
            row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700'
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.outerHTML =
                '<td class="px-6 py-4"><select class="js-example-basic-single" name="barang_id[]"> @foreach ($barangs as $barang) <option value="{{ $barang->id }}">{{ $barang->nama_barang }} || Tersedia : {{ $barang->stok }}</option> @endforeach </select> </td>';
            cell2.outerHTML =
                '<td class="px-6 py-4"> <input type="number" name="jumlah[]" placeholder="Jumlah" id="Jumlah" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500"> </td>';
            cell3.outerHTML =
                '<td class="px-6 py-4 text-center"> <button type="button" onclick="deleteRowPermintaan(this)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline bg-transparent">Hapus</button> </td>';
            $('.js-example-basic-single').select2();
        }

        function deleteRowPermintaan(button) {
            // Traverse the DOM to find the closest parent tr element
            button.closest('tr').remove();
        }
    </script>
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
    <script>
        $('.js-example-basic-single').select2();
    </script>
    <script>
        $(document).ready(function() {
            // Event handler for change event on all dropdowns with class 'js-example-basic-single'
            $('.js-example-basic-single').on('change', function() {
                // Get the selected value
                var selectedValue = $(this).val();
                // console.log('test');
                // Loop through all other dropdowns with the same class
                $('.js-example-basic-single').not(this).each(function() {
                    // If the selected value is the same as in any other dropdown, show an alert and reset the value
                    if ($(this).val() == selectedValue) {
                        alert('Each dropdown must have a different value!');
                        $(this).val('').trigger(
                            'change.select2'
                            ); // Reset the value and trigger change event for select2
                    }
                });
            });
        });
    </script>
@endsection
