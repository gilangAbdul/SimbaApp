<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMasterBarangRequest;
use App\Http\Requests\UpdateMasterBarangRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $count_barangs = MasterBarang::all()->count();
        $barangs = MasterBarang::with('satuan')->sortable()->paginate(15);
        if($request->search!= ''){
            $barangs = MasterBarang::with('satuan')->sortable()->where('nama_barang','LIKE','%'.$request->search.'%')
                                    ->orWhere('kode_barang','LIKE','%'.$request->search.'%')->paginate(15);
        }
        return view('dashboard.list_barang',compact('count_barangs', 'barangs'));
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
    public function store(StoreMasterBarangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterBarang $masterBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterBarang $masterBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasterBarangRequest $request, MasterBarang $masterBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = $request->checkbox;
        // dd($ids);
        MasterBarang::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Barang Berhasil Dihapus');
        // return redirect('dashboard/list')->with('success', 'Barang Berhasil Dihapus');
    }

    public function list_petugas(Request $request)
    {
        $hasil = MasterBarang::with('satuan')->sortable()->paginate(15);
        if($request->search!= ''){
            $hasil = MasterBarang::with('satuan')->sortable()->where('nama_barang','LIKE','%'.$request->search.'%')
                                    ->orWhere('kode_barang','LIKE','%'.$request->search.'%')->paginate(15);
        }
        $count_barangs = MasterBarang::all()->count();
        $barangs = $hasil;
        return view('petugas.list_barang',compact('barangs','count_barangs'));
    }

}
