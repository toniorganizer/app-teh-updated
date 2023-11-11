<?php

use GuzzleHttp\Psr7\Request;
use App\Models\PemberiInformasi;
use App\Models\InformasiLowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\BursaKerjaController;
use App\Http\Controllers\DataPencariKerjaController;
use App\Http\Controllers\JenisPendidikanController;
use App\Http\Controllers\KepentinganController;
use Illuminate\Http\Request as IlluminateRequest;
use App\Http\Controllers\PemberiInformasiController;
use App\Models\DataPencariKerja;
use App\Models\JenisPendidikan;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = InformasiLowongan::join('users','users.id_user','=','informasi_lowongans.pemberi_informasi_id')->where('status_lowongan', 0)->get();
    return view('halaman-utama.index', [
        'data' => $data
    ]);
});

Route::get('/hubungi', function () {
    return view('halaman-utama.hubungi');
});

Route::get('/lowongan-home', function () {
    $data = InformasiLowongan::join('users','users.id_user','=','informasi_lowongans.pemberi_informasi_id')->where('status_lowongan', 0)->paginate(7);
    return view('halaman-utama.lowongan-home', ['data' => $data]);
});

Route::get('/user-faq', function () {
    return view('dashboard.admin.user_faq');
});

Route::group(['middleware' => 'check', 'controller' => AdminController::class], function () {
    Route::get('/home', 'index');
    Route::get('/profil-tenaga-kerja/{id}', 'profilTenagaKerja');
    Route::get('/edit-deskripsi/{id}', 'edit_deskripsi_lowongan');
    Route::post('/update-deskripsi-lowongan', 'update_deskripsi_lowongan');
    Route::get('/pekerjaan-data', 'pekerjaanData');
    Route::get('/tenaga-kerja-data', 'tenagaKerjaData');
    Route::get('/pemangku-kepentingan-data', 'pemangkuKepentinganData');
});

// auth
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login_action', 'login_action')->name('login_action');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/detail-informasi-lowongan/{id}', 'detail_lowongan');
    Route::post('/register', 'register_pekerja');
    Route::post('/register_perusahaan', 'register_perusahaan');
    Route::post('/register_bkk', 'register_bkk');
    Route::get('/searching-lowongan', 'searching');
    Route::get('/searching-lokasi', 'searchingLokasi');
    Route::get('/search-job', 'searchJob');
    Route::get('/search-bidang', 'searchingBidang');
});

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['CekUser:1,3,5']], function () {
        Route::resource('/user', AdminController::class);
            Route::controller(AdminController::class)->group(function () {
                Route::get('/dashboard', 'index');
                Route::get('/user', 'index');
                Route::get('/user-data', 'userData');
                Route::post('/addTenagaKerja', 'tambahTenagaKerja');
                Route::post('/register_user', 'registerUser');
                Route::post('/register_lembaga', 'registerLembaga');
                Route::get('/deleteTenagaKerja/{id}', 'hapusTenagaKerja');
                Route::get('/uji-laporan', 'testLaporan')->name('uji-laporan');
                Route::get('/cetak-laporan-semester', 'cetakLaporan')->name('cetak-laporan-semester');
                Route::get('/laporan', 'Laporan')->name('laporan');
                Route::get('/search-semester', 'searchSemester')->name('search-semester');
            });
        Route::resource('/pemerintah', KepentinganController::class);
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(DataPencariKerjaController::class)->group(function () {
            Route::get('laporan-ipk-1', 'index');
            Route::get('export-ipk-1', 'downlaodTemplate1');
            Route::post('import', 'importDataIPK1');
            Route::get('/edit-laporan-i/{id}', 'editLaporanI');
            Route::get('/delete-laporan-i/{id}', 'deleteLaporanI');
            Route::post('/update-laporan-i/{id}', 'updateLaporanI');
            Route::get('/cetak-laporan-i/{id}','CetakLaporanI');
            Route::get('/detail-laporan-kab/{id}', 'DetailLaporanKab');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(JenisPendidikanController::class)->group(function () {
            Route::get('laporan-ipk-2', 'index');
            Route::get('export-ipk-2', 'downlaodTemplate1');
            Route::post('importIPKII', 'importDataIPK2');
            // Route::get('/edit-laporan-i/{id}', 'editLaporanI');
            Route::get('/delete-laporan-ii/{id}', 'deleteLaporanII');
            // Route::post('/update-laporan-i/{id}', 'updateLaporanI');
            // Route::get('/cetak-laporan-i/{id}','CetakLaporanI');
            // Route::get('/detail-laporan-kab/{id}', 'DetailLaporanKab');
        });
    });

    Route::resource('/pekerja', PekerjaController::class);
    Route::resource('/lowongan', LowonganController::class);
    Route::resource('/sumber', PemberiInformasiController::class);
    Route::resource('/bursa', BursaKerjaController::class);

    Route::post('/lowongan/{id_informasi_lowongan?}/verifikasi', [LowonganController::class, 'verifikasiLowongan'])->name('lowongan.verifikasi');
    Route::controller(PekerjaController::class)->group(function () {
        Route::get('/data-lowongan-pekerja', 'index');
        Route::get('/detail-lowongan-pekerja/{id}', 'DetailLowongan');
        Route::get('/lamar-pekerjaan/{id}', 'lamarPekerjaan');
        Route::get('/tracer-study', 'tracerStudy');
        Route::post('/update-tracer-study', 'updateTracerStudy');
        Route::get('/edit-data-tracer/{id}', 'editDataTracer');
        Route::post('/update-data-tracer', 'updateDataTracer');
        Route::post('/lamar-lowongan-pekerjaan', 'lamarLowonganPekerjaan');
        Route::post('/perpanjangKartu', 'perpanjangKartu');
    });

    Route::controller(PemberiInformasiController::class)->group(function () {
        Route::get('/lowongan-data', 'data_lowongan');
        Route::get('/detail-pendaftar/{id}', 'data_pelamar');
        Route::get('/detail-data-pendaftar/{id}', 'detail_data_pelamar');
        Route::get('/lengkapi-data-lowongan/{id}', 'lengkapi_data_lowongan');
        Route::post('/sumber/{id_informasi_lowongan?}/update_informasi', 'updateInformasi')->name('sumber.update_informasi');
        Route::post('/sumber/{id_lamar?}/verifikasi', 'verifikasiPelamar')->name('sumber.verifikasi');
    });


    Route::controller(BursaKerjaController::class)->group(function (){
        Route::get('/tracer-data', 'dataTracer');
    });

});


// user register
Route::get('/user-register', function () {
    return view('dashboard.auth.register');
});

Route::get('/perusahaan-register', function () {
    return view('dashboard.auth.register_perusahaan');
});

Route::get('/bkk-register', function () {
    return view('dashboard.auth.register_bkk');
});

Route::get('/error-akses', function () {
    return view('dashboard.error_akses');
});

Route::get('log-viewers', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
