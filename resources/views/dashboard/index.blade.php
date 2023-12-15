@extends('dashboard.layouts.main')

@section('menu')
    <h1>Dashboard</h1>
@endsection

@section('title_card')
    <h1>Ringkasan Bulan ini </h1>
@endsection

@section('card')
    <a href="dashboard/out">
        <div class="w-5/6 p-5 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
            <img src="{!! asset('img/component/cart_card.svg') !!}" alt="barang_keluar" class="h-10 mb-5 md:h-14 ">
            <h5 class="text-base font-semibold tracking-tight text-gray-600 mt-2 md:text-xl">{{ $totalStokRequestBulanIni }}
            </h5>
            <div class="flex justify-between">
                <p class="font-normal text-gray-500 place-items-start text-sm md:text-sm">Total Barang Keluar</p>
                <div class=" flex items-center gap-1">
                    <p class="font-normal text-sm md:text-base text-green-400 place-items-end">
                        {{ $persentaseKenaikanRequest }}%</p>
                    <img src="{!! asset('img/component/up_percent.svg') !!}" alt="up" class="inline">
                </div>
            </div>
        </div>
    </a>
    <div class="w-5/6 p-5 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
        <img src="{!! asset('img/component/user_card.svg') !!}" alt="pengguna_aktif" class="h-10 mb-5 md:h-14 ">
        <h5 class="text-base font-semibold tracking-tight text-gray-600 mt-2 md:text-xl">{{ $totalPenggunaAktifBulanIni }}
        </h5>
        <div class="flex justify-between">
            <p class="font-normal text-gray-500 place-items-start text-sm md:text-sm">Pengguna Aktif</p>
            <div class=" flex items-center gap-1">
                <p class="font-normal text-sm md:text-base text-green-400 place-items-end">
                    {{ $persentaseKenaikanPengguna }}%</p>
                <img src="{!! asset('img/component/up_percent.svg') !!}" alt="up" class="inline">
            </div>
        </div>
    </div>
    <a href="dashboard/req">
        <div class="w-5/6 p-5 bg-white border border-gray-200 rounded-lg shadow space-y-2 max-w-xs">
            <img src="{!! asset('img/component/req_card.svg') !!}" alt="permintaan_barang" class="h-10 mb-5 md:h-14 ">
            <h5 class="text-base font-semibold tracking-tight text-gray-600 mt-2 md:text-xl">
                {{ $jumlahRiwayatPermintaanBlnIni }}</h5>
            <div class="flex justify-between">
                <p class="font-normal text-gray-500 place-items-start text-sm md:text-sm">Permintaan Barang</p>
                <div class=" flex items-center gap-1">
                    <p class="font-normal text-sm md:text-base text-green-400 place-items-end">{{ $persen_up }}%</p>
                    <img src="{!! asset('img/component/up_percent.svg') !!}" alt="up" class="inline">
                </div>
            </div>
        </div>
    </a>
@endsection

@section('content')
    <div class="w-full">
        <div class="max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center me-3">
                        <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 19">
                            <path
                                d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                            <path
                                d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="leading-none text-2xl font-bold text-gray-700">{{ $totalPenggunaAktifBulanIni }}</h5>
                        <p class="text-sm font-normal text-gray-500">Total Pengguna Bulan Ini</p>
                    </div>
                </div>
                @if ($persen_up > 0)
                    <div>
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            {{ $persen_up }}%
                        </span>
                    </div>
                @else
                    <div>
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            {{ $persen_up }}%
                        </span>
                    </div>
                @endif
            </div>

            <div id="column-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a href="/dashboard/out"
                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700-500  hover:bg-gray-100-700-700 px-3 py-2">
                        Monitoring Barang Keluar
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="w-full">
            {{-- Table --}}
            <h1 class="text-lg font-semibold text-gray-700 mt-5">Permintaan Baru</h1>
            <div class="flex justify-between pr-6">
                <h1 class="text-xs font-medium text-gray-500 mb-6">Daftar permintaan baru yang dibuat</h1>
                <a href="/dashboard/list_req" class="underline text-blue-600">Lihat Semua</a>
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
                        @if($riwayats->count() > 0)
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
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-700">
                                                            ID : {{ $riwayat->id }}
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="{{ $riwayat->id }}">
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
    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // ApexCharts options and config
        const inputObject = JSON.parse('{!! $data !!}');

        const resultArray = Object.entries(inputObject).map(([key, value]) => {
            return {
                x: key,
                y: value
            };
        });


        window.addEventListener("load", function() {
            const options = {
                colors: ["#1A56DB", "#FDBA8C"],
                series: [{
                    name: "Jumlah Keluar",
                    color: "#3460d9",
                    data: resultArray,
                }, ],
                chart: {
                    type: "bar",
                    height: "320px",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "70%",
                        borderRadiusApplication: "end",
                        borderRadius: 8,
                    },
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                states: {
                    hover: {
                        filter: {
                            type: "darken",
                            value: 1,
                        },
                    },
                },
                stroke: {
                    show: true,
                    width: 0,
                    colors: ["transparent"],
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -14
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                xaxis: {
                    floating: false,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: 'text-xs font-normal fill-gray-500'
                        }
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                },
            }

            if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("column-chart"), options);
                chart.render();
            }
        });
    </script>
@endsection
