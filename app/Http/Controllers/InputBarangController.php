<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\MasterBarang;
use App\Models\RiwayatMasukBarang;
use App\Models\RiwayatPermintaan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Logger\ConsoleLogger;

class InputBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('petugas.input_barang',[
            "barangs" => MasterBarang::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = Auth::user();
        $request->validate([
            'stok_masuk' => ['required'],
            'fname_nota'=>['required', 'mimes:png,jpg,pdf', 'max:2048']
        ]);

        // dd(file('fname_nota'));

        // dd($request->file('fname_nota')->store('nota_masuk'));'
        $file_name = bin2hex(random_bytes(10));
        $file_name .='.'.$request->file('fname_nota')->extension();
        $data_valid['fname_nota'] = $request->file('fname_nota')->storeAs('nota_masuk', $file_name);
        $data_valid['nip_petugas']= auth()->user()->nip;
        $data_valid['platform_beli']= 'Tokopedia';

        $barangs_masuk = $request['id_barang'];
        $stok_masuk = $request['stok_masuk'];

        $barangs_masuks = array_combine($barangs_masuk, $stok_masuk);
        // dd($barangs_masuks);
        $id = RiwayatMasukBarang::create($data_valid)->id;
        if($id){
            foreach($barangs_masuks as $key => $value){
                $barang = MasterBarang::find($key);
                $barang->stok += $value;
                // dd($barang);
                $barang->save();
                BarangMasuk::create([
                    "riwayat_masuk_barang_id" => $id,
                    "master_barang_id" => $key,
                    "stok_input" => $value,
                ]);
            }
            $url = '/send-notifications-in'.'/'.$id;

            return redirect($url);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
