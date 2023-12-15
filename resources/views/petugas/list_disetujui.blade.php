@extends('petugas.layouts.main')

@section('menu')
    <h1>List Permintaan Barang Yang Telah Disetujui</h1>
@endsection

@section('title_card')
    <h1>List Permintaan Yang Butuh Diproses <br>(Pastikan untuk mengecek barang sebelum serah terima)</h1>
@endsection

@section('card')
    <div class="w-5/6 p-5 mt-4 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
        <img src="{!! asset('img/component/box_card.svg') !!}" alt="jumlah_barang" class="h-10 mb-5 md:h-14 ">
        <h5 class="text-base font-semibold tracking-tight text-gray-600 mt-2 md:text-xl">{{ $count_riwayat }}</h5>
        <div class="flex justify-between">
            <p class="font-normal text-gray-500 place-items-start text-sm md:text-sm">Permintaan Telah Disetujui</p>
        </div>
    </div>
@endsection


@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-blue-50 rounded-xl">
                <tr>
                    <th scope="col" class=" text-xs whitespace-nowrap px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class=" text-xs whitespace-nowrap px-6 py-3 pr-8">
                        Nama
                    </th>
                    <th scope="col" class=" text-xs whitespace-nowrap px-6 py-3 ">
                        Jumlah Jenis Barang
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
                @if ($count_riwayat == 0)
                    <tr class="bg-white border-b w-full text-gray-500 hover:bg-gray-50 text-center">
                        <td colspan="6" class="px-6 text-base py-6 font-normal italic">Belum Ada Permintaan Saat Ini</td>
                    </tr>
                @else
                    @foreach ($riwayats_acc as $riwayat)
                        <tr class="bg-white border-b text-gray-500 hover:bg-gray-50">
                            <form action="/petugas/list_approve/{{ $riwayat->id }}" method="get">
                                @csrf
                                <td scope="col" class=" text-xs whitespace-nowrap px-6 py-3">
                                    {{ $riwayat->id }}
                                </td>
                                <td class= "pr-8 py-3 px-6">
                                    {{ $riwayat->pemohon->name }} <br/>
                                    <span class="text-xs text-gray-400">{{ $riwayat->pemohon->divisi->nama_divisi }}</span>
                                </td>
                                <td scope="row" class="px-6 pr-6 py-3 font-medium whitespace-nowrap">
                                    {{ $riwayat->barangs->count() }} Barang
                                </td>
                                <td class="px-6 py-4 place-self-center text-center">
                                    <button type="submit"
                                        class="py-2 px-4 mr-2 mb-2 text-xs
                                        text-white font-semibold focus:outline-none bg-blue-500 rounded-md">
                                        Proses Barang
                                    </button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
