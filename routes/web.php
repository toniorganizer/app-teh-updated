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
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\GolonganUsahaController;
use App\Http\Controllers\JenisPendidikanController;
use App\Http\Controllers\KelompokJabatanController;
use App\Http\Controllers\KepentinganController;
use App\Http\Controllers\LampiranLaporanController;
use App\Http\Controllers\lowonganJabatanController;
use App\Http\Controllers\lowonganPendidikanController;
use Illuminate\Http\Request as IlluminateRequest;
use App\Http\Controllers\PemberiInformasiController;
use App\Http\Controllers\PencariPenerimaController;
use App\Models\DataPencariKerja;
use App\Models\JenisPendidikan;
use Illuminate\Auth\Notifications\ResetPassword;
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
    Route::get('/lupa-password', 'lupaPassword');
});

Route::controller(ForgetPasswordController::class)->group(function (){
    Route::post('/forget-password', 'submitForgetPasswordForm');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    Route::get('reset-password/{token}','showResetPasswordForm')->name('reset.password.get');
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
        Route::controller(KepentinganController::class)->group(function (){
            Route::get('/deletePemangkuKepentingan/{id}', 'destroy');
            Route::post('/verifikasi-laporan', 'verifikasiLaporan');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(DataPencariKerjaController::class)->group(function () {
            Route::get('laporan-ipk-1', 'index');
            Route::get('export-ipk-1', 'downlaodTemplate1');
            Route::post('import', 'importDataIPK1');
            Route::get('/edit-laporan-i/{id}', 'editLaporanI');
            Route::get('/detail-lampiran-kab/edit-laporan-i/{id}', 'editLaporanI');
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
            Route::get('/edit-laporan-ii/{id}', 'editLaporanII');
            Route::get('/detail-lampiran-kab/edit-laporan-ii/{id}', 'editLaporanII');
            Route::get('/delete-laporan-ii/{id}', 'deleteLaporanII');
            Route::post('/update-laporan-ii/{id}', 'updateLaporanII');
            Route::get('/cetak-laporan-ii/{id}','CetakLaporanII');
            Route::get('/detail-laporan-kab-ii/{id}', 'DetailLaporanKabII');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(KelompokJabatanController::class)->group(function () {
            Route::get('laporan-ipk-3', 'index');
            Route::get('export-ipk-3', 'downlaodTemplate1');
            Route::post('importIPKIII', 'importDataIPK3');
            Route::get('/edit-laporan-iii/{id}', 'editLaporanIII');
            Route::get('/detail-lampiran-kab/edit-laporan-iii/{id}', 'editLaporanIII');
            Route::get('/delete-laporan-iii/{id}', 'deleteLaporanIII');
            Route::post('/update-laporan-iii/{id}', 'updateLaporanIII');
            Route::get('/cetak-laporan-iii/{id}','CetakLaporanIII');
            Route::get('/detail-laporan-kab-iii/{id}', 'DetailLaporanKabIII');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(lowonganPendidikanController::class)->group(function () {
            Route::get('laporan-ipk-4', 'index');
            Route::get('export-ipk-4', 'downlaodTemplate1');
            Route::post('importIPKIV', 'importDataIPK4');
            Route::get('/edit-laporan-iv/{id}', 'editLaporanIV');
            Route::get('/detail-lampiran-kab/edit-laporan-iv/{id}', 'editLaporanIV');
            Route::get('/delete-laporan-iv/{id}', 'deleteLaporanIV');
            Route::post('/update-laporan-iv/{id}', 'updateLaporanIV');
            Route::get('/cetak-laporan-iv/{id}','CetakLaporanIV');
            Route::get('/detail-laporan-kab-iv/{id}', 'DetailLaporanKabIV');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(lowonganJabatanController::class)->group(function () {
            Route::get('laporan-ipk-5', 'index');
            Route::get('export-ipk-5', 'downlaodTemplate1');
            Route::post('importIPKV', 'importDataIPK5');
            Route::get('/edit-laporan-v/{id}', 'editLaporanV');
            Route::get('/detail-lampiran-kab/edit-laporan-v/{id}', 'editLaporanV');
            Route::get('/delete-laporan-v/{id}', 'deleteLaporanV');
            Route::post('/update-laporan-v/{id}', 'updateLaporanV');
            Route::get('/cetak-laporan-v/{id}','CetakLaporanV');
            Route::get('/detail-laporan-kab-v/{id}', 'DetailLaporanKabV');
        });
    });

    
    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(GolonganUsahaController::class)->group(function () {
            Route::get('laporan-ipk-6', 'index');
            Route::get('export-ipk-6', 'downlaodTemplate1');
            Route::post('importIPKVI', 'importDataIPK6');
            Route::get('/edit-laporan-vi/{id}', 'editLaporanVI');
            Route::get('/detail-lampiran-kab/edit-laporan-vi/{id}', 'editLaporanVI');
            Route::get('/delete-laporan-vi/{id}', 'deleteLaporanVI');
            Route::post('/update-laporan-vi/{id}', 'updateLaporanVI');
            Route::get('/cetak-laporan-vi/{id}','CetakLaporanVI');
            Route::get('/detail-laporan-kab-vi/{id}', 'DetailLaporanKabVI');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(PencariPenerimaController::class)->group(function () {
            Route::get('laporan-ipk-8', 'index');
            Route::get('export-ipk-8', 'downlaodTemplate1');
            Route::post('importIPKVIII', 'importDataIPK8');
            Route::get('/edit-laporan-viii/{id}', 'editLaporanVIII');
            Route::get('/detail-lampiran-kab/edit-laporan-viii/{id}', 'editLaporanVIII');
            Route::get('/delete-laporan-viii/{id}', 'deleteLaporanVIII');
            Route::post('/update-laporan-viii/{id}', 'updateLaporanVIII');
            Route::get('/cetak-laporan-viii/{id}','CetakLaporanVIII');
            Route::get('/detail-laporan-kab-viii/{id}', 'DetailLaporanKabVIII');
        });
    });

    Route::group(['middleware' => ['CekUser:1,3']], function () {
        Route::controller(LampiranLaporanController::class)->group(function () {
            Route::get('lampiran', 'index');
            Route::post('importLampiran', 'importLampiran');
            Route::get('/edit-lampiran-kab-kota/{id}', 'editLampiranKabKota');
            Route::get('/detail-lampiran-kab/edit-lampiran-kab-kota/{id}', 'editLampiranKabKota');
            Route::get('/delete-lampiran/{id}', 'deleteLampiran');
            Route::post('/update-lampiran-kab-kota/{id}', 'updateLampiranKabKota');
            Route::get('/cetak-lampiran/{id}','CetakLampiran');
            Route::get('/detail-lampiran-kab/{id}', 'DetailLampiranKab');
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
        Route::post('/detail-data-pendaftar/{id}', 'detail_data_pelamar');
        Route::get('/lengkapi-data-lowongan/{id}', 'lengkapi_data_lowongan');
        Route::post('/sumber/{id_informasi_lowongan?}/update_informasi', 'updateInformasi')->name('sumber.update_informasi');
        Route::post('/sumber/{id_lamar?}/verifikasi', 'verifikasiPelamar')->name('sumber.verifikasi');
    });


    Route::controller(BursaKerjaController::class)->group(function (){
        Route::get('/tracer-data', 'dataTracer');
    });

    Route::controller(PemberiInformasiController::class)->group(function (){
        Route::get('/tenaga-kerja-list', 'tenagaKerjaList');
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
