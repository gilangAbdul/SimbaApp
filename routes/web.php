<?php

use Illuminate\Support\Str;
use App\Models\MasterBarang;
use Illuminate\Http\Request;
use App\Models\RiwayatPermintaan;
use App\Models\RiwayatMasukBarang;
use App\Http\Controllers\InputBarang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InputBarangController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PDFGeneratorController;
use App\Http\Controllers\RiwayatKeluarController;
use App\Http\Controllers\BarangPermintaanController;
use App\Http\Controllers\RiwayatPermintaanController;
use App\Http\Controllers\RiwayatMasukBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Bagian Dashboard
Route::get('/', function () {
    if (auth()->user()){
        return redirect('/check');
    }
    return view('auth.login');
});

Route::get('/check', function () {
    // Periksa role_id pengguna dan arahkan ke route yang sesuai
    $role_id = auth()->user()->role_id;
    if ($role_id == 1) {
        return redirect('/pegawai');
    } elseif ($role_id == 2) {
        return redirect('/petugas');
    } else {
        return redirect('/dashboard');
    }
})->name('check');


Route::middleware(['role.check:3,4,5'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/dashboard/list', MasterBarangController::class)->middleware(['auth', 'verified']);

    Route::resource('/dashboard/out', RiwayatPermintaanController::class)->middleware(['auth', 'verified']);

    Route::resource('/dashboard/in', RiwayatMasukBarangController::class)->middleware(['auth', 'verified']);

    Route::get('dashboard/out/{path}/{id}', function($path, $id){
        $filename = Storage::path($path.'/'.$id);
        // dd($filename);
        return response()->file($filename);
    })->middleware(['auth', 'verified'])->name('view-laporan');

    Route::get('/view/{nota}/{id}', function($nota,$id){
        $filename = Storage::path($nota.'/'.$id);
        return response()->file($filename);
    });

    Route::middleware(['role.check: 4,5'])->group(function(){
        Route::get('/dashboard/req', [RiwayatPermintaanController::class, 'dashboard_req']);
    })->middleware(['auth', 'verified']);

    Route::get('/dashboard/list_req', [RiwayatPermintaanController::class, 'all_permintaan'])->middleware(['auth', 'verified']);

    Route::post('/dashboard/import', function (Request $request) {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        foreach ($fileContents as $line) {
            $data = str_getcsv($line, ';');
            // dd($data);
            MasterBarang::create([
                'kode_barang' => $data[0],
                'nama_barang' => Str::limit($data[1], 50),
                'stok' => $data[2],
                'satuan_id'=>$data[3],
            ]);
        }
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    });
});



Route::middleware(['role.check:1,3,4,5'])->group(function () {
    // Route Bagian Pegawai
    Route::get('/pegawai', [RiwayatPermintaanController::class,'home_pegawai'])->middleware(['auth', 'verified'])->name('Pegawai-Dashboard');

    Route::get('/pegawai/req_barang', [RiwayatPermintaanController::class, 'req_barang'])->middleware(['auth', 'verified'])->name('Pegawai-req');

    Route::post('/pegawai/req_barang/input', [RiwayatPermintaanController::class, 'store'])->middleware(['auth', 'verified'])->name('input.req_barang');
    Route::delete('/pegawai/req_barang/{id}', [RiwayatPermintaanController::class, 'destroy'])->middleware(['auth', 'verified']);
    Route::get('/pegawai/riwayat', [RiwayatPermintaanController::class, 'show_hist'])->middleware(['auth', 'verified']);
});


Route::middleware(['role.check:2,3'])->group(function () {
// Route Bagian Petugas
    Route::get('/petugas', [RiwayatPermintaanController::class, 'home_petugas'])->middleware(['auth', 'verified'])->name('petugas');

    Route::get('/petugas/list_approve', [RiwayatPermintaanController::class, 'show_approve'])->middleware(['auth', 'verified']);
    Route::get('/petugas/list_approve/{id}', [RiwayatPermintaanController::class, 'proses'])->middleware(['auth', 'verified']);
    Route::post('/petugas/process_out/{id}', [RiwayatPermintaanController::class, 'proses_out'])->middleware(['auth', 'verified']);



    Route::resource('/petugas/input', InputBarangController::class)->middleware(['auth', 'verified']);

    Route::get('/petugas/list_barang', [MasterBarangController::class, 'list_petugas'])->middleware(['auth', 'verified']);
    // Route::get('/petugas/list', [MasterBarangController::class, 'list_petugas'])->middleware(['auth', 'verified']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Notif
Route::get('/send-notifications-in/{id}',[NotificationController::class, 'sendBarangMasukNotif']);
Route::get('/send-notifications-newRequest/{id}',[NotificationController::class, 'newRequestNotif']);
Route::get('/send-warning-stok/{id}',[NotificationController::class, 'stokWarning']);
Route::get('/send-req-acc/{id}',[NotificationController::class, 'req_acc']);



require __DIR__.'/auth.php';
