<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\RiwayatMasukBarang;
use Vish4395\LaravelFileViewer\LaravelFileViewer;
use App\Http\Requests\StoreRiwayatMasukBarangRequest;
use App\Http\Requests\UpdateRiwayatMasukBarangRequest;

class RiwayatMasukBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayat_masuks = RiwayatMasukBarang::with(['barangs', 'User'])->get();
        $total_riwayat = count($riwayat_masuks);

        $riwayat_bulan_ini = count(RiwayatMasukBarang::whereMonth('created_at', now()->month)->get());
        $riwayat_bulan_lalu =count(RiwayatMasukBarang::whereMonth('created_at', now()->subMonth()->month)->get());

        $persen_up = 100;
        if ($riwayat_bulan_lalu > 0) {
            $persen_up = (($riwayat_bulan_ini - $riwayat_bulan_ini) / ($riwayat_bulan_ini)) * 100;
        }

        return view('dashboard.in', [
            'riwayat_masuks' => $riwayat_masuks,
            'total_riwayat' => $total_riwayat,
            'total_riwayat_bulan'=>$riwayat_bulan_ini,
            'persen_up' => $persen_up,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatMasukBarangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $riwayat_masuk = RiwayatMasukBarang::with('barangs.master_barang', 'User')->where('id','=',$id)->get();
        $riwayat_masuk = $riwayat_masuk[0];
        // dd($riwayat_masuk);
        return view('dashboard.detail_masuk', compact('riwayat_masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatMasukBarang $riwayatMasukBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatMasukBarangRequest $request, RiwayatMasukBarang $riwayatMasukBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatMasukBarang $riwayatMasukBarang)
    {
        //
    }
}
