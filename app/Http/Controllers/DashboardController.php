<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BarangPermintaan;
use App\Models\RiwayatPermintaan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Card Permintaan Barang
        $role_id = auth()->user()->role_id;
        $now = Carbon::now();
        $riwayat_permintaans = RiwayatPermintaan::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->get();

        $jumlahRiwayatPermintaanBlnIni = count($riwayat_permintaans ?? []);

        $riwayat_bulan_ini = RiwayatPermintaan::whereMonth('created_at', now()->month)->count();
        $riwayat_bulan_lalu = RiwayatPermintaan::whereMonth('created_at', now()->subMonth()->month)->count();

        $persen_up = 100;
        if ($riwayat_bulan_lalu > 0) {
            $persen_up = (($riwayat_bulan_ini - $riwayat_bulan_lalu) / $riwayat_bulan_lalu) * 100;
        }

        // Card Total Barang Keluar
        $startDateBulanSebelumnya = Carbon::now()->subMonth()->startOfMonth();
        $endDateBulanSebelumnya = Carbon::now()->subMonth()->endOfMonth();

        $startDateBulanIni = Carbon::now()->startOfMonth();
        $endDateBulanIni = Carbon::now()->endOfMonth();

        $idRiwayatPermintaanBulanSebelumnya = RiwayatPermintaan::where('status_persetujuan_id', 4)
            ->whereBetween('created_at', [$startDateBulanSebelumnya, $endDateBulanSebelumnya])
            ->pluck('id');

        $barangPermintaansBulanSebelumnya = BarangPermintaan::whereIn('riwayat_permintaan_id', $idRiwayatPermintaanBulanSebelumnya)
            ->with('master_barang')
            ->get();

        $totalStokRequestBulanSebelumnya = $barangPermintaansBulanSebelumnya->sum('stok_request');

        $idRiwayatPermintaanBulanIni = RiwayatPermintaan::where('status_persetujuan_id', 4)
            ->whereBetween('created_at', [$startDateBulanIni, $endDateBulanIni])
            ->pluck('id');

        $barangPermintaansBulanIni = BarangPermintaan::whereIn('riwayat_permintaan_id', $idRiwayatPermintaanBulanIni)
            ->with('master_barang')
            ->get();

        $totalStokRequestBulanIni = $barangPermintaansBulanIni->sum('stok_request');

        $persentaseKenaikanRequest = 100;
        if ($totalStokRequestBulanSebelumnya > 0) {
            $persentaseKenaikanRequest = (($totalStokRequestBulanIni - $totalStokRequestBulanSebelumnya) / $totalStokRequestBulanSebelumnya);
        }


        // Card Pengguna Aktif
        $totalPenggunaAktifBulanIni = RiwayatPermintaan::whereBetween('created_at', [$startDateBulanIni, $endDateBulanIni])
            ->whereNotNull('nip_pemohon')
            ->distinct('nip_pemohon')
            ->count('nip_pemohon');

        $totalPenggunaAktifBulanSebelumnya = RiwayatPermintaan::whereBetween('created_at', [$startDateBulanSebelumnya, $endDateBulanSebelumnya])
            ->whereNotNull('nip_pemohon')
            ->distinct('nip_pemohon')
            ->count('nip_pemohon');

        $persentaseKenaikanPengguna = 100;
        if ($totalPenggunaAktifBulanSebelumnya > 0){
            $persentaseKenaikanPengguna = (($totalPenggunaAktifBulanIni - $totalPenggunaAktifBulanSebelumnya) / $totalPenggunaAktifBulanSebelumnya)*100;
        }

        // Chart
        $riwayatPermintaanIds = RiwayatPermintaan::where('status_persetujuan_id', 4)
            ->whereBetween('created_at', [$startDateBulanIni, $endDateBulanIni])
            ->pluck('id');

        if($riwayatPermintaanIds){
            $barangPermintaans = BarangPermintaan::whereIn('riwayat_permintaan_id', $riwayatPermintaanIds)
                ->with('master_barang')
                ->get();


            $groupedData = $barangPermintaans->groupBy('master_barang_id')
                ->map(function ($group) {
                    return $group->sum('stok_request');
                });

            $sortedData = $groupedData->sort();
            $top5Data = $sortedData->take(5);
            $otherData = $sortedData->slice(5)->sum();
            $labels =[];
            // dd($top5Data[2]);
            $series = $top5Data->values()->toArray();
            foreach ($top5Data as $key => $data){
                $namabarang = $barangPermintaans->firstWhere('master_barang_id', $key);
                $namabarang = $namabarang->master_barang->nama_barang;
                $labels[]= $namabarang;
            }

            $data = array_combine($labels, $series);
            $data = json_encode($data);
        }


        $riwayats = RiwayatPermintaan::with('pemohon','barangs.master_barang','petugas', 'approve')->latest()->limit(10)->get();

        return view('dashboard.index', [
        'jumlahRiwayatPermintaanBlnIni' => $jumlahRiwayatPermintaanBlnIni,
         'persen_up' => $persen_up,
         'totalStokRequestBulanIni' => $totalStokRequestBulanIni,
         'persentaseKenaikanRequest' => $persentaseKenaikanRequest,
         'totalPenggunaAktifBulanIni' => $totalPenggunaAktifBulanIni,
         'persentaseKenaikanPengguna' => $persentaseKenaikanPengguna,
         'data' => ($data),
         'riwayats' => $riwayats,
        ]);
        // Send Data
    }
}
