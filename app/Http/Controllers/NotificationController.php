<?php

namespace App\Http\Controllers;
use Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RiwayatPermintaan;
use App\Models\RiwayatMasukBarang;
use App\Notifications\BarangMasuk;
use App\Http\Controllers\Controller;
use App\Models\MasterBarang;
use App\Notifications\newRequest;
use App\Notifications\reqApprove;
use App\Notifications\stokWarning;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendBarangMasukNotif($id) {
        $riwayat = RiwayatMasukBarang::with('barangs')->find($id);
        $jumlah = $riwayat->barangs->count();
        $atasans = User::whereIn('role_id', [3,5])->get();
        if($atasans->count() > 0){
            foreach($atasans as $atasan){
                $data = [
                    'name' => $atasan->name,
                    'jumlah' => $jumlah
                ];
                $notif = new BarangMasuk($data);
                $atasan->notify($notif);
            }
            return redirect('/petugas')->with('success', 'Berhasil Menambahkan Barang');
        }
        return redirect('/petugas')->with('error');
    }

    public function newRequestNotif($id) {
        $req = RiwayatPermintaan::with('pemohon', 'barangs')->find($id);
        $divisi_id_pemohon = $req->pemohon->divisi_id;
        $atasan = User::where('divisi_id', $divisi_id_pemohon);
        $atasan = $atasan->where('role_id', 4)->get();
        $atasans = User::where('role_id', 5)->get();
        // dd($atasan);
        if($atasan->count() > 0){
            $atasans->push($atasan[0]);
        }

        foreach($atasans as $atasan){
            $data = [
                'nama' => $atasan->name,
                'jumlah' => $req->barangs->count(),
                'pemohon_nama' => $req->pemohon->name,
                'divisi_pemohon' => $req->pemohon->divisi->nama_divisi,
                'atasan' => $atasan->name,
            ];
            $notif = new newRequest($data);
            $atasan->notify($notif);
        }
        return redirect('/pegawai')->with('success', 'Permintaan Baru Berhasil Diajukan Silahkan Menunggu Persetujuan');
    }

    public function stokWarning($id_barang)
    {
        $users = User::whereIn('role_id', [3,5])->get();
        $barang = MasterBarang::find($id_barang);
        // dd($users);
        foreach($users as $user){
            $data = [
                'nama' => $user->name,
                'stok' => $barang->stok,
                'pesan' => $barang->nama_barang. ' sisa stok '. $barang->stok,
            ];
            $notif = new stokWarning($data);
            $user->notify($notif);
        }
        return redirect('/petugas')->with('success', 'Berhasil Memproses Barang Keluar');
    }

    public function req_acc($id)
    {
        $riwayat = RiwayatPermintaan::with('pemohon')->find($id);
        $pegawai = $riwayat->pemohon;
        $status = $riwayat->status_persetujuan_id;
        $users = User::whereIn('role_id', [2,3])->get();
        // dd($users);
        if($users->count() > 0){
            if($status == 3){
                $data = [
                    'nama' => $pegawai->name,
                    'pesan_notif' => 'Permintaan Anda Ditolak',
                    'pesan' => 'Mohon maaf permintaan barang Anda tidak disetujui, segera hubungin kepala bagian Anda atau lakukan permintaan barang kembali',
                    'url' => '/pegawai',
                    'to'=>'pegawai'
                ];
                $notif = new reqApprove($data);
                $pegawai->notify($notif);
                // dd('tertolak');
                return redirect('/dashboard/req')->with('success', 'Permintaan Barang Berhasil Ditolak');
            } else{
                $data = [
                    'nama' => $pegawai->name,
                    'pesan_notif' => 'Permintaan Anda Disetujui',
                    'pesan' => 'Permintaan Barang Anda Telah Disetujui, Segera Ambil Barang yang Anda minta ke bagian Gudang',
                    'url' => '/pegawai',
                    'to'=>'pegawai'
                ];
                $notif = new reqApprove($data);
                $pegawai->notify($notif);
                foreach($users as $user){
                    $data = [
                        'nama' => $user->name,
                        'id_request' => $id,
                        'pesan_notif' => 'Permintaan Perlu Diproses',
                        'pesan' => 'Terdapat permintaan barang yang perlu diproses',
                        'url' => 'petugas/list_approve/'.$id,
                        'to'=>'petugas'
                    ];
                    $notif = new reqApprove($data);
                    $user->notify($notif);
                }
                // dd('diterima');
                return redirect('/dashboard/req')->with('success', 'Permintaan Barang Berhasil Disetujui');
            }
            return redirect()->back()->with('error');

        }
    }

}
