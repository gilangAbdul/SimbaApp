<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;
use App\Models\BarangPermintaan;
use App\Models\RiwayatPermintaan;
use Livewire\Attributes\Validate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRiwayatPermintaanRequest;
use App\Http\Requests\UpdateRiwayatPermintaanRequest;
use PDF;

class RiwayatPermintaanController extends Controller
{

    public function generate_pdf($id)
    {
        $riwayat = RiwayatPermintaan::with('barangs', 'pemohon', 'approve', 'petugas')->find($id);
        // dd($riwayat);
        $data = [
            'title' => 'Laporan Barang Keluar',
            'date' => $riwayat->created_at->format('d M Y'),
            'riwayat' => $riwayat
        ];

        $filename = 'laporan/'.$riwayat->id.'.pdf';
        $pdf = PDF::loadView('pdf_template', $data);

        $content = $pdf->download()->getOriginalContent();

        Storage::put($filename, $content);

        $riwayat->filename_laporan = $filename;
        $riwayat->save();

        $filename = public_path().'\\storage\\ttd'.'\\'.$riwayat->fname_ttd_pemohon;
        File::delete($filename);
        $filename = public_path().'\\storage\\ttd'.'\\'.$riwayat->fname_ttd_petugas;
        File::delete($filename);

        return 1;

    }
    /**
     * Display a listing of the resource.
     */

    // Acc Permintaan
    public function dashboard_req()
    {
        $riwayat_not_acc = RiwayatPermintaan::where('status_persetujuan_id', 1)->with('pemohon', 'barangs.master_barang')->latest()->get();
        return view('dashboard.req_barang', compact('riwayat_not_acc'));

    }

    // Tampilkan Seluruh Permintaan
    public function all_permintaan()
    {
        $riwayats = RiwayatPermintaan::with('pemohon', 'barangs.master_barang', 'status')->latest()->get();
        return view('dashboard.list_req', compact('riwayats'));
    }

    public function show_approve()
    {
        $riwayats_acc = RiwayatPermintaan::where('status_persetujuan_id', 2)->paginate(15);
        $count_riwayat = RiwayatPermintaan::count();
        return view('petugas.list_disetujui', compact('riwayats_acc', 'count_riwayat'));
    }

    public function home_petugas()
    {
        $riwayats = RiwayatPermintaan::where('status_persetujuan_id', 2);
        $riwayats = $riwayats->with('pemohon','barangs.master_barang','petugas', 'approve')->latest()->get();
        return view('petugas.index', compact('riwayats'));
    }

    public function proses($id)
    {
        $riwayat = RiwayatPermintaan::with('pemohon', 'barangs.master_barang', 'status')->find($id);
        // dd($riwayat);
        return view('petugas.proses_barang', compact('riwayat'));
    }

    public function proses_out($id, Request $request)
    {
        $validated = $request->validate([
            'signed' => 'required',
        ]);

        $riwayat = RiwayatPermintaan::with('barangs.master_barang')->find($id);

        $data = $validated['signed'];

        $base64 = explode(";base64,", $data);

        $img = base64_decode($base64[1]);

        $filename = 'ttd/petugas/' .bin2hex(random_bytes(10)).'.'.'png';

        Storage::put($filename, $img);

        $riwayat->fname_ttd_petugas = $filename;
        $riwayat->nip_petugas = Auth::user()->nip;
        $riwayat->status_persetujuan_id = 4;
        $riwayat->save();

        if($this->generate_pdf($id) == 1){
            foreach ($riwayat->barangs as $barang){
                if ($barang->stok < 10){
                    $url = '/send-warning-stok'.'/'.$barang->master_barang_id;
                    return redirect($url);
                }
            }
            return redirect('/petugas')->with('success', 'Berhasil Memproses Barang Keluar');
        };

    }

    public function home_pegawai()
    {
        $user = Auth::user();
        $riwayats = RiwayatPermintaan::where('nip_pemohon', $user->nip)->with('pemohon', 'barangs.master_barang', 'status')->latest()->limit(10)->get();
        // dd($riwayats);
        return view('pegawai.index', compact('riwayats'));
    }

    public function show_hist()
    {
        $user = Auth::user();
        $riwayats = RiwayatPermintaan::where('nip_pemohon', $user->nip)->with('pemohon', 'barangs.master_barang', 'status')->get();
        return view('pegawai.riwayat_barang', compact('riwayats'));
    }




    public function index()
    {
        $riwayats = RiwayatPermintaan::where('status_persetujuan_id', 4)->with('pemohon', 'barangs.master_barang')->latest()->get();
        $count_acc = $riwayats->count();

        $riwayat_bulan_ini = count(RiwayatPermintaan::whereMonth('created_at', now()->month)->get());
        $riwayat_bulan_lalu =count(RiwayatPermintaan::whereMonth('created_at', now()->subMonth()->month)->get());

        $persen_up = 100;
        if ($riwayat_bulan_lalu > 0) {
            $persen_up = (($riwayat_bulan_ini - $riwayat_bulan_lalu) / ($riwayat_bulan_lalu)) * 100;
        }

        return view('dashboard.keluar_barang', compact('riwayats', 'count_acc', 'persen_up'));
    }


    public function req_barang()
    {
        $barangs = MasterBarang::with('satuan')->get();
        return view('pegawai.req_barang', compact('barangs'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id.*' => 'required|distinct|max:255',
            'jumlah.*' => 'required',
            'signed' => 'required',
        ]);
        $barang_id = $validated['barang_id'];
        $jumlah = $validated['jumlah'];

        $barangs_reqs = array_combine($barang_id, $jumlah);

        foreach ($barangs_reqs as $key => $value) {
            $barang = MasterBarang::find($key);
            if ($value > $barang->stok) {
                return redirect()->back()->with('error', 'Stok tidak cukup');
            }
        }

        $data = $validated['signed'];

        $base64 = explode(";base64,", $data);

        $img = base64_decode($base64[1]);

        $filename = 'ttd/pemohon/'.bin2hex(random_bytes(10)).'.'.'png';

        Storage::put($filename, $img);

        $data_valid['nip_pemohon'] = auth()->user()->nip;

        $data_valid['fname_ttd_pemohon'] = $filename;

        $data_valid['status_persetujuan_id'] = 1;

        $id = RiwayatPermintaan::create($data_valid)->id;

        if ($id) {
            foreach ($barangs_reqs as $key => $value) {
                BarangPermintaan::create([
                    'riwayat_permintaan_id' => $id,
                    'master_barang_id'=> $key,
                    'stok_request'=> $value,
                ]);
            }
        }

        $url = '/send-notifications-newRequest'.'/'.$id;

        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $riwayat = RiwayatPermintaan::with('pemohon','approve', 'barangs.master_barang', 'status')->find($id);
        return view('dashboard.detail_keluar', compact('riwayat'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPermintaan $riwayatPermintaan)
    {
        dd($riwayatPermintaan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $riwayat = RiwayatPermintaan::with('barangs.master_barang')->find($id);
        if($request->status == 2){
            foreach ($riwayat->barangs as $barang) {
                $master = MasterBarang::find($barang->master_barang_id);
                if($master->stok < $barang->stok_request){
                    return redirect()->back()->with('error', 'Stok barang tidak tersedia, Harap tidak setujui permintaan');
                }
                $master->stok = $master->stok - $barang->stok_request;
                $master->save();
            }
        }
        $riwayat->status_persetujuan_id = $request->status;
        $riwayat->nip_penyetuju = Auth::user()->nip;
        $riwayat->save();
        $url = '/send-req-acc'.'/'.$id;
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $riwayat = RiwayatPermintaan::with('barangs')->find($id);
        $filename = public_path().'\\storage\\ttd'.'\\'.$riwayat->fname_ttd_pemohon;
        File::delete($filename);
        BarangPermintaan::where('riwayat_permintaan_id', $riwayat->id)->delete();
        $riwayat->delete();
        return redirect()->back()->with('success', 'Permintaan Berhasil Dihapus');

    }
}
