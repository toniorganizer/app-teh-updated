<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lamar;
use App\Models\Alumni;
use App\Models\BursaKerja;
use App\Exports\UjiLaporan;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use App\Charts\CountJobChart;
use App\Charts\MonhtlyJobArea;
use App\Charts\MonthlyJobChart;
use App\Exports\CetakLaporan;
use App\Exports\exportData;
use App\Models\PemberiInformasi;
use App\Models\InformasiLowongan;
use Illuminate\Support\Facades\DB;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(MonhtlyJobArea $chart, CountJobChart $jobcount)
    {
        if(Auth::user()->email != null){
            $data = InformasiLowongan::where('status_lowongan', 1)->orWhere('status_lowongan', 3)->orWhere('status_lowongan', 0)->count();
            $lamar = Lamar::where('id_pelamar', Auth::user()->email)->count();
            $alumni = Alumni::join('users', 'users.email','=','alumnis.pencari_kerja_id')
            ->join('bursa_kerjas', 'bursa_kerjas.id_bkk','=','alumnis.bkk_id')
            ->where('email_sekolah', Auth::user()->email)->count();
            $alumni_bekerja = Alumni::join('users', 'users.email','=','alumnis.pencari_kerja_id')
            ->join('bursa_kerjas', 'bursa_kerjas.id_bkk','=','alumnis.bkk_id')
            ->where('email_sekolah', Auth::user()->email)
            ->where('status_bekerja', 'Sudah Bekerja')->count();
            $user = User::count();
            $pencari_kerja = PencariKerja::count();
            $ak1 = PencariKerja::where('email_pk', Auth::user()->email)->first();
            $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        }else{
            echo 'Silahkan lakukan login terlebih dahulu';
        }
        
        if(Auth::user()->level == 2){
            $tglSaatIni = new DateTime();
            $tgldatabase = new DateTime($ak1->tgl_expired);
            $tgl = $tgldatabase->modify('-3 days');
            return view('dashboard.admin.index_admin', [
                'chart' => $chart->build(), 
                'jobcount' => $jobcount->build(),
                'title' => 'Dashboard',
                'sub_title' => 'Dashboard',
                'jumlah_loker' => $data,
                'jumlah_alumni' => $alumni,
                'alumni_bekerja' => $alumni_bekerja,
                'user' => $user,
                'pencari_kerja' => $pencari_kerja,
                'jumlah_lamaran' => $lamar,
                'status_ak1' => $ak1,
                'tgl' => $tgl,
                'tglSaatIni' => $tglSaatIni
            ]);
        }else{
            return view('dashboard.admin.index_admin', [
                'chart' => $chart->build(), 
                'jobcount' => $jobcount->build(),
                'title' => 'Dashboard',
                'sub_title' => 'Dashboard',
                'jumlah_loker' => $data,
                'jumlah_alumni' => $alumni,
                'alumni_bekerja' => $alumni_bekerja,
                'user' => $user,
                'pencari_kerja' => $pencari_kerja,
                'jumlah_lamaran' => $lamar,
                'sidebar_data' => $sidebar_data,
                'status_ak1' => $ak1
            ]);
        }
    
    }

    public function show()
    {
        echo "Ini halaman data pada admin";
    }

    public function userData(){
        $data = User::get();
        return view('dashboard.admin.user_data', [
            'sub_title' => 'Data User',
            'title' => 'Data',
            'data' => $data
        ]);
    }

    public function tenagaKerjaData(){
        $data = PencariKerja::where('status_ak1', 'Aktif')->orWhere('status_ak1', 'Belum Bekerja')->get();
        $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        return view('dashboard.admin.tenaga_kerja_data', [
            'sub_title' => 'Data Tenaga Kerja',
            'sidebar_data' => $sidebar_data,
            'title' => 'Data',
            'data' => $data
        ]);
    }

    public function pemangkuKepentinganData(){
        $data = PemangkuKepentingan::get();
        return view('dashboard.admin.pemangku_kepentingan_data', [
            'sub_title' => 'Data Pemangku Kepentingan',
            'title' => 'Data',
            'data' => $data
        ]);
    }

    // Yang diuji coba
    public function pekerjaanData(){
        $data = InformasiLowongan::get();
        $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        return view('dashboard.admin.pekerjaan_data', [
            'sub_title' => 'Data Pekerjaan',
            'sidebar_data' => $sidebar_data,
            'title' => 'Data',
            'data' => $data
        ]);
    }

    public function tambahTenagaKerja(Request $request){

        $this->validate($request, [
            'username' => 'required|min:5',
            'nama' => 'required|min:5',
            'email' => 'required|min:5|unique:users|email',
            'alamat' => 'required|min:5',
            'pendidikan' => 'required|min:5',
            'umur' => 'required',
            'keterampilan' => 'required|min:5',
            'no_hp' => 'required|min:5',
            'password' => 'required|same:password_confirmation|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        PencariKerja::create([
            'nama_lengkap' => $request->nama,
            'email_pk' => $request->email,
            'bkk_id' => 0,
            'alamat' => $request->alamat,
            'pendidikan_terakhir' => $request->pendidikan,
            'keterampilan' => $request->keterampilan,
            'tentang' => '-',
            'no_hp' => $request->no_hp,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_expired' => now()->addMonth(6),
            'status_ak1' => 'Aktif',
            'foto_pencari_kerja' =>'default.jpg',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->nama,
            'email' => $request->email,
            'level' => 2,
            'status_tracer' => 0,
            'icon' => 0,
            'password' => Hash::make($request->password),
            'foto_user' => 'default.jpg',
        ]);

        return redirect('/tenaga-kerja-data')->with('success', 'Data Berhasil Disimpan!');
        
    }
    
    public function deleteUser($id){
        $id_user = DB::table('users')->where('email',$id)->first();
        $data = InformasiLowongan::where('pemberi_informasi_id', $id_user->id_user)->first();
        User::where('email', $id)->delete();
        if($id_user->level == 2){
            Storage::delete('public/user/' . $id_user->foto_user);
            PencariKerja::where('email_pk', $id)->delete();
        }elseif($id_user->level == 3){
            Storage::delete('public/user/' . $id_user->foto_user);
            PemangkuKepentingan::where('email_lembaga', $id)->delete();
        }elseif($id_user->level == 4){
            Storage::delete('public/user/' . $id_user->foto_user);
            PemberiInformasi::where('email_instansi', $id)->delete();
            InformasiLowongan::where('pemberi_informasi_id', $id_user->id_user)->delete();
            if(isset($data->id_informasi_lowongan)){
                Lamar::where('id_informasi', $data->id_informasi_lowongan)->delete();
            }
            Storage::delete('public/informasi-lowongan/'. $data->foto_lowongan);
        }else{
            Storage::delete('public/user/' . $id_user->foto_user);
            BursaKerja::where('email_sekolah', $id)->delete();
        }
        return redirect('/user-data')->with('success', 'Data Berhasil Dihapus!');
    }

    public function detailUser($id){
        $id_user = DB::table('users')->where('email',$id)->first();
        if($id_user->level == 2){
            $data = PencariKerja::join('users','users.email','=','pencari_kerjas.email_pk')->join('alumnis', 'alumnis.pencari_kerja_id','=','pencari_kerjas.email_pk')->where('email_pk', $id)->first();

            if(is_null($data)){
                $data = PencariKerja::join('users','users.email','=','pencari_kerjas.email_pk')->where('email_pk', $id)->first();
            }

            return view('dashboard.admin.profil_tenaga_kerja', [
                'sub_title' => 'Profile',
                'title' => 'Profile',
                'data' => $data
            ]);
        }elseif($id_user->level == 3){
            $data = PemangkuKepentingan::join('users','users.email','=','pemangku_kepentingans.email_lembaga')->where('email_lembaga', $id)->first();
            return view('Dashboard.pemangku-kepentingan.profile-pemangku', [
                'sub_title' => 'Profile',
                'title' => 'Profile',
                'data' => $data
            ]);
        }elseif($id_user->level == 4){
           $data = PemberiInformasi::where('email_instansi', $id)->first();
            return view('Dashboard.pemberi_informasi.detail_instansi', [
                'sub_title' => 'Data Detail Instansi',
                'title' => 'Data',
                'data' => $data
            ]);
        }else{
            $data = BursaKerja::join('users','users.email','=','bursa_kerjas.email_sekolah')->where('email_sekolah', $id)->first();

        return view('Dashboard.bkk.profil-sekolah', [
            'sub_title' => 'Profil',
            'title' => 'Data',
            'data' => $data,
        ]);
        }
    }

    public function hapusTenagaKerja($id){
        $id_user = DB::table('pencari_kerjas')->where('email_pk',$id)->first();
        $data = DB::table('pencari_kerjas')->where('id_pencari_kerja', $id_user->id_pencari_kerja)->first();
        // dd($id_user->id_pencari_kerja);
        Storage::delete('public/user/' . $data->foto_pencari_kerja);
        PencariKerja::where('id_pencari_kerja', $id_user->id_pencari_kerja)->delete();
        User::where('email',$id)->delete();

        return redirect('/tenaga-kerja-data')->with('success', 'Data Berhasil Dihapus!');

    }

    public function profilTenagaKerja($id){
        $data = PencariKerja::join('users','users.email','=','pencari_kerjas.email_pk')->join('alumnis', 'alumnis.pencari_kerja_id','=','pencari_kerjas.email_pk')->where('email_pk', $id)->first();

        if(is_null($data)){
            $data = PencariKerja::join('users','users.email','=','pencari_kerjas.email_pk')->where('email_pk', $id)->first();
        }

        return view('dashboard.admin.profil_tenaga_kerja', [
            'sub_title' => 'Profile',
            'title' => 'Profile',
            'data' => $data
        ]);
    }

    public function editTenagaKerja($id){
        $data = PencariKerja::where('id_pencari_kerja', $id)->first();
        return view('dashboard.admin.tenaga_kerja_data', [
            'sub_title' => 'Data Tenaga Kerja',
            'title' => 'Data',
            'data' => $data
        ]);
    }

    
    public function edit_deskripsi_lowongan($id)
    {
        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();
        return view('dashboard.admin.edit-deskripsi-lowongan', [
            'sub_title' => 'Edit Deskripsi Lowongan',
            'title' => 'Data',
            'data' => $data
        ]);
    }

    public function update_deskripsi_lowongan(Request $request){

        InformasiLowongan::where('id_informasi_lowongan', $request->id)->update([
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('edit-deskripsi/'. $request->id)->with('success', 'Data Berhasil Disimpan!');
    }


    public function registerLembaga(Request $request){
        $this->validate($request, [
            'username' => 'required|min:5|unique:users',
            'nama_lembaga' => 'required|min:5',
            'email' => 'required|min:5|unique:users|email',
            'password' => 'required|same:ulangi_password|min:6',
            'ulangi_password' => 'required|same:password'
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'username.min' => 'Username minimal berisi 5 karakter',
                'username.unique' => 'Username yang anda masukan sudah terdaftar',
                'nama_lembaga.required' => 'Nama lembaga tidak boleh kosong',
                'nama_lembaga.min' => 'Nama lembaga minimal berisi 5 karakter',
                'email.required' => 'Email lembaga tidak boleh kosong',
                'email.unique' => 'Email lembaga yang anda masukan sudah terdaftar',
                'email_lembaga.min' => 'Email lembaga minimal berisi 5 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal berisi 6 karakter',
                'password.same' => 'Password harus sama dengan konfirmasi password',
                'ulangi_password.same' => 'Konfirmasi password harus sama dengan password',
            ]
        );

        PemangkuKepentingan::create([
            'nama_lembaga' => $request->nama_lembaga,
            'bidang_lembaga' => '-',
            'status_lembaga' => $request->status_lembaga,
            'role_acc' => 0,
            'id_disnaker_kab' => $request->id_disnaker_kab,
            'email_lembaga' =>  $request->email,
            'website_lembaga' => '-',
            'instagram_lembaga' => '-',
            'facebook_lembaga' => '-',
            'telepon_lembaga' => '-',
            'alamat_lembaga' => '-',
            'foto_lembaga' => 'default.jpg',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->nama_lembaga,
            'email' => $request->email,
            'level' => 3,
            'icon' => 0,
            'status_tracer' => 0,
            'password' => Hash::make($request->password),
            'foto_user' => 'default.jpg',
        ]);

        return redirect('/pemangku-kepentingan-data')->with('success', 'Data Berhasil Disimpan!');

    }



    public function registerUser(Request $request){
        $this->validate($request, [
            'username' => 'required|min:5|unique:users',
            'nama_user' => 'required|min:5',
            'email' => 'required|min:5|unique:users|email',
            'password' => 'required|same:ulangi_password|min:6',
            'ulangi_password' => 'required|same:password'
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'username.min' => 'Username minimal berisi 5 karakter',
                'username.unique' => 'Username yang anda masukan sudah terdaftar',
                'nama_user.required' => 'Nama User tidak boleh kosong',
                'nama_user.min' => 'Nama User minimal berisi 5 karakter',
                'email.required' => 'Email User tidak boleh kosong',
                'email.unique' => 'Email User yang anda masukan sudah terdaftar',
                'email_user.min' => 'Email User minimal berisi 5 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal berisi 6 karakter',
                'password.same' => 'Password harus sama dengan konfirmasi password',
                'ulangi_password.same' => 'Konfirmasi password harus sama dengan password',
            ]
        );

        if($request->level == 2){
            PencariKerja::create([
                'nama_lengkap' => $request->nama_user,
                'email_pk' => $request->email,
                'bkk_id' => 0,
                'alamat' => '-',
                'pendidikan' => '-',
                'keterampilan' => '-',
                'tentang' => '-',
                'umur' => '-',
                'jenis_kelamin' => '-',
                'no_hp' => '-',
                'tgl_expired' => now()->addMonth(6),
                'status_ak1' => 'Aktif',
                'foto_pencari_kerja' => 'default.jpg',
            ]);
    
            User::create([
                'username' => $request->username,
                'name' => $request->nama_user,
                'email' => $request->email,
                'level' => 2,
                'status_tracer' => 0,
                'icon' => 0,
                'password' => Hash::make($request->password),
                'foto_user' => 'default.jpg',
            ]);
        }elseif($request->level == 3){
            PemangkuKepentingan::create([
                'nama_lembaga' => $request->nama_user,
                'bidang_lembaga' => '-',
                'status_lembaga' => 0,
                'role_acc' => 0,
                'id_disnaker_kab' =>  $request->id_disnaker_kab,
                'email_lembaga' =>  $request->email,
                'website_lembaga' => '-',
                'instagram_lembaga' => '-',
                'facebook_lembaga' => '-',
                'telepon_lembaga' => '-',
                'alamat_lembaga' => '-',
                'foto_lembaga' => 'default.jpg',
            ]);
    
            User::create([
                'username' => $request->username,
                'name' => $request->nama_user,
                'email' => $request->email,
                'level' => 3,
                'status_tracer' => 0,
                'icon' => 0,
                'password' => Hash::make($request->password),
                'foto_user' => 'default.jpg',
            ]);
        }elseif($request->level == 4){
            PemberiInformasi::create([
                'nama_instansi' => $request->nama_user,
                'bidang_instansi' => '-',
                'email_instansi' =>  $request->email,
                'website_instansi' => '-',
                'instagram_instansi' => '-',
                'facebook_instansi' => '-',
                'telepon_instansi' => '-',
                'alamat' => '-',
                'deskripsi' => '-',
                'foto_instansi' => 'default.jpg',
            ]);
    
            User::create([
                'username' => $request->username,
                'name' => $request->nama_user,
                'email' => $request->email,
                'level' => 4,
                'status_tracer' => 0,
                'icon' => 0,
                'password' => Hash::make($request->password),
                'foto_user' => 'default.jpg',
            ]);
        }else{
            BursaKerja::create([
                'nama_sekolah' => $request->nama_user,
                'email_sekolah' =>  $request->email,
                'website_sekolah' => '-',
                'instagram_sekolah' => '-',
                'facebook_sekolah' => '-',
                'telepon_sekolah' => '-',
                'alamat_sekolah' => '-',
                'foto_sekolah' => 'default.jpg',
            ]);
    
            User::create([
                'username' => $request->username,
                'name' => $request->nama_user,
                'email' => $request->email,
                'level' => 5,
                'status_tracer' => 0,
                'icon' => 0,
                'password' => Hash::make($request->password),
                'foto_user' => 'default.jpg',
            ]);
        }

        return redirect('/user-data')->with('success', 'Data Berhasil Disimpan!');
    }

    public function Laporan(){

        // PencariKerja::where('email_pk', 'wery@gmail.com')->restore();
        // PencariKerja::where('email_pk', 'wery@gmail.com')->delete();

       

        // mengambil tahun saat ini
        $StartDateYear = date("Y") . "-01-01";
        $endDateYear = date("Y") . "-12-01";

        // mengambil data tahun sebelumnya
        $startDateSebelumnya = date("Y", strtotime("-20 year")). "-01-01";
        $endDateSebelumnya = date("Y", strtotime("-1 year")). "-12-31";
        // dd($endDateSebelumnya);

        $jmlPSebelumnya = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlLSebelumnya = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlNow = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlSebelumnya = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlP_terdaftar = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlL_terdaftar = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $jmlP_ditempatkan = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('deleted_at', null)
            ->where('status_ak1', 'Bekerja')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlL_ditempatkan = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('deleted_at', null)
            ->where('status_ak1', 'Bekerja')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $jumlahPA = $jmlPSebelumnya + $jmlP_terdaftar;
        $jumlahLA = $jmlLSebelumnya + $jmlL_terdaftar;
        $jumlahA = $jumlahPA + $jumlahLA;
        $jmlDitempatkkan = $jmlL_ditempatkan + $jmlP_ditempatkan;

        $jml_terdaftar = DB::table('pencari_kerjas')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $deleteUserNowL = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])->count();

        $deleteUserNowP = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])->count();

        $deleteUserNow = $deleteUserNowL + $deleteUserNowP;
        $jumlahPB = $deleteUserNowP + $jmlP_ditempatkan;
        $jumlahLB = $deleteUserNowL + $jmlL_ditempatkan;
        $jumlahB = $jumlahPB + $jumlahLB;
        $jumlahMale5 = $jumlahLA - $jumlahLB;
        $jumlahFemale5 = $jumlahPA - $jumlahPB;
        $jumlahAkhirPekerja = $jumlahMale5 + $jumlahFemale5;

        $ageRanges = [
            [15, 19],
            [20, 29],
            [30, 44],
            [45, 54],
            [55, null]
        ];

        $genderAgeCounts = [];
    
        foreach ($ageRanges as $range) {
            $startAge = $range[0];
            $endAge = $range[1];
    
            $maleCount = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCount = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

            $maleCountDelete = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
    
            $femaleCountDelete = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
            
            $maleCountDitempatkan = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('status_ak1', 'Bekerja')
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
    
            $femaleCountDitempatkan = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('status_ak1', 'Bekerja')
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
            
            $maleCountSebelumnya = DB::table('pencari_kerjas')
                ->where('status_ak1', 'Belum Bekerja')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
    
            $femaleCountSebelumnya = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum Bekerja')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('deleted_at', null)
            ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

            $maleCountTerdaftar = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('umur', [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCountTerdaftar = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('umur', [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

            $jumlahMaleA =  $maleCountSebelumnya + $maleCount;
            $jumlahFemaleA =  $femaleCountSebelumnya + $femaleCount;
            $jumlahMaleB =  $maleCountDelete + $maleCountDitempatkan;
            $jumlahFemaleB =  $femaleCountDelete + $femaleCountDitempatkan;
            $jumlahMale = $jumlahMaleA - $jumlahMaleB;
            $jumlahFemale = $jumlahFemaleA - $jumlahFemaleB;

            Laporan::updateOrCreate(
                [
                    'start_age' => $startAge,
                    'end_age' => $endAge ?: '+',
                ],
                [
                    'male_count_terdaftar' => $maleCountSebelumnya,
                    'female_count_terdaftar' => $femaleCountSebelumnya,
                ]
            );
    
            $genderAgeCounts[] = [
                'start_age' => $startAge,
                'end_age' => $endAge ?: '+',
                'male_count' => $maleCount,
                'female_count' => $femaleCount,
                'male_count_delete' => $maleCountDelete,
                'female_count_delete' => $femaleCountDelete,
                'male_count_ditempatkan' => $maleCountDitempatkan,
                'female_count_ditempatkan' => $femaleCountDitempatkan,
                'male_count_sebelumnya' => $maleCountSebelumnya,
                'female_count_sebelumnya' => $femaleCountSebelumnya,
                'male_count_terdaftar' => $maleCountTerdaftar,
                'female_count_terdaftar' => $femaleCountTerdaftar,
                'jumlahMaleA' => $jumlahMaleA,
                'jumlahFemaleA' => $jumlahFemaleA,
                'jumlahMaleB' => $jumlahMaleB,
                'jumlahFemaleB' => $jumlahFemaleB,
                'jumlahMale' => $jumlahMale,
                'jumlahFemale' => $jumlahFemale,
            ];
        }

        $data = Laporan::get();

        // laporan informasi lowongan
        $maleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->Where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
        
        $femaleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Perempuan')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();

        $malefemaleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki/Perempuan')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
        
            $maleCountInformasiTerdaftar =  DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
        
        $femaleCountInformasiTerdaftar = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

        $malefemaleCountInformasiTerdaftar = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki/Perempuan')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
        

        $jumlahInformasibelumlalu = $maleCountInformasiBelum + $femaleCountInformasiBelum + $malefemaleCountInformasiBelum;
        $jumlahInformasiterdaftarnow = $maleCountInformasiTerdaftar + $femaleCountInformasiTerdaftar + $malefemaleCountInformasiTerdaftar;

        $jumlahInformasiMaleA = $maleCountInformasiBelum + $maleCountInformasiTerdaftar;
        $jumlahInformasiFemaleA = $femaleCountInformasiBelum + $femaleCountInformasiTerdaftar;
        $jumlahInformasiMaleFemaleA = $malefemaleCountInformasiBelum + $malefemaleCountInformasiTerdaftar;

        $jumlahInformasiA = $jumlahInformasiMaleA + $jumlahInformasiFemaleA + $jumlahInformasiMaleFemaleA;


        $informasiTerpenuhiMale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $informasiTerpenuhiFemale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiTerpenuhiMaleFemale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki/Perempuan')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiMaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiFemaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiMaleFemaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki/Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();
  
        $jumlahInformasiTerpenuhi = $informasiTerpenuhiMale + $informasiTerpenuhiFemale + $informasiTerpenuhiMaleFemale;
        $jumlahInformasiDelete = $informasiMaleDelete + $informasiFemaleDelete + $informasiMaleFemaleDelete;

        $jumlahInformasiMaleB = $informasiTerpenuhiMale + $informasiMaleDelete;
        $jumlahInformasiFemaleB = $informasiTerpenuhiFemale + $informasiFemaleDelete;
        $jumlahInformasiMaleFemaleB = $informasiTerpenuhiMaleFemale + $informasiMaleFemaleDelete;

        $jumlahInformasiB = $jumlahInformasiMaleB + $jumlahInformasiFemaleB + $jumlahInformasiMaleFemaleB;

        $jumlahInformasiMale = $jumlahInformasiMaleA - $jumlahInformasiMaleB;
        $jumlahInformasiFemale = $jumlahInformasiFemaleA - $jumlahInformasiFemaleB;
        $jumlahInformasiMaleFemale = $jumlahInformasiMaleFemaleA - $jumlahInformasiMaleFemaleB;

        $jumlahInformasi = $jumlahInformasiMale + $jumlahInformasiFemale + $jumlahInformasiMaleFemale;

        return view('dashboard.admin.laporan', [
            'genderAgeCounts' => $genderAgeCounts,
            'jmlPSebelumnya' => $jmlPSebelumnya,
            'jmlLSebelumnya' => $jmlLSebelumnya,
            'jmlNow' => $jmlNow,
            'deleteUserNowL' => $deleteUserNowL,
            'deleteUserNowP' => $deleteUserNowP,
            'deleteUserNow' => $deleteUserNow,
            'jmlSebelumnya' => $jmlSebelumnya,
            'jmlP_terdaftar' => $jmlP_terdaftar,
            'jmlL_terdaftar' => $jmlL_terdaftar,
            'jmlP_ditempatkan' => $jmlP_ditempatkan,
            'jmlL_ditempatkan' => $jmlL_ditempatkan,
            'jmlDitempatkan' => $jmlDitempatkkan,
            'jml_terdaftar' => $jml_terdaftar,
            'jumlahPA' => $jumlahPA,
            'jumlahLA' => $jumlahLA,
            'jumlahPB' => $jumlahPB,
            'jumlahLB' => $jumlahLB,
            'jumlahA' => $jumlahA,
            'jumlahB' => $jumlahB,
            'jumlahMale5' => $jumlahMale5,
            'jumlahFemale5' => $jumlahFemale5,
            'jumlahAkhirPekerja' => $jumlahAkhirPekerja,
            'laporan' => $data,
            'male_informasi_belum' => $maleCountInformasiBelum,
            'female_informasi_belum' => $femaleCountInformasiBelum,
            'male_female_informasi_belum' => $malefemaleCountInformasiBelum,
            'jumlah_informasi_belum_lalu' => $jumlahInformasibelumlalu,
            'male_informasi_terdaftar' => $maleCountInformasiTerdaftar,
            'female_informasi_terdaftar' => $femaleCountInformasiTerdaftar,
            'male_female_informasi_terdaftar' => $malefemaleCountInformasiTerdaftar,
            'jumlah_informasi_terdaftar_now' => $jumlahInformasiterdaftarnow,
            'jumlah_informasi_male_a' => $jumlahInformasiMaleA,
            'jumlah_informasi_female_a' => $jumlahInformasiFemaleA,
            'jumlah_informasi_male_female_a' => $jumlahInformasiMaleFemaleA,
            'jumlah_informasi_a' => $jumlahInformasiA,
            'informasi_terpenuhi_male' => $informasiTerpenuhiMale,
            'informasi_terpenuhi_female' => $informasiTerpenuhiFemale,
            'informasi_terpenuhi_male_female' => $informasiTerpenuhiMaleFemale,
            'jumlah_informasi_terpenuhi' => $jumlahInformasiTerpenuhi,
            'informasi_male_delete' => $informasiMaleDelete,
            'informasi_female_delete' => $informasiFemaleDelete,
            'informasi_male_female_delete' => $informasiMaleFemaleDelete,
            'jumlah_informasi_delete' => $jumlahInformasiDelete,
            'jumlah_informasi_male_b' => $jumlahInformasiMaleB,
            'jumlah_informasi_female_b' => $jumlahInformasiFemaleB,
            'jumlah_informasi_male_female_b' => $jumlahInformasiMaleFemaleB,
            'jumlah_informasi_b' => $jumlahInformasiB,
            'jumlah_informasi_male' => $jumlahInformasiMale,
            'jumlah_informasi_female' => $jumlahInformasiFemale,
            'jumlah_informasi_male_female' => $jumlahInformasiMaleFemale,
            'jumlah_informasi' => $jumlahInformasi,
            'sub_title' => 'Laporan',
            'title' => 'Data Laporan'
        ]);
    }


    public function searchSemester(Request $request){

        $request->session()->flash('bulan1', $request->input('bulan1'));
        $request->session()->flash('bulan2', $request->input('bulan2'));

        if($request->bulan1 == 01 && $request->bulan2 == 06){
            $StartDateYear = date("Y") . "-" . $request->bulan1 . "-01";
            $endDateYear = date("Y") . "-" . $request->bulan2 . "-01";

            $todayStartSebelumnya = date("Y") . "-" . $request->bulan1 . "-01";
            $todayEndSebelumnya = date("Y") . "-" . $request->bulan1 . "-31";


            $startInformasiDateSebelumnya = date("Y-m-d",strtotime("-20 year", strtotime("-6 months", strtotime($todayStartSebelumnya))));
            $endInformasiDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya)));

            $startDateSebelumnya = date("Y-m-d", strtotime("-6 months", strtotime($todayStartSebelumnya))); 
            $endDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya))); 

        }else{
            $StartDateYear = date("Y") . "-" . $request->bulan1 . "-01";
            $endDateYear = date("Y") . "-" . $request->bulan2 . "-01";

            $todayStartSebelumnya = date("Y") . "-" . $request->bulan1 . "-01";
            $todayEndSebelumnya = date("Y") . "-" . $request->bulan1 . "-31";

            $startDateSebelumnya = date("Y-m-d", strtotime("-6 months", strtotime($todayStartSebelumnya)));
            $endDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya))); 

            $startInformasiDateSebelumnya = date("Y-m-d",strtotime("-20 year", strtotime("-6 months", strtotime($todayStartSebelumnya))));
            $endInformasiDateSebelumnya = date("Y-m-d", strtotime("-1 months", strtotime($todayEndSebelumnya)));
        }

        $jmlPSebelumnya = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlLSebelumnya = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

        $jmlNow = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum bekerja')
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
  
        $jmlSebelumnya = $jmlPSebelumnya + $jmlLSebelumnya;

        $jmlP_terdaftar = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlL_terdaftar = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $jmlP_ditempatkan = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('deleted_at', null)
            ->where('status_ak1', 'Bekerja')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $jmlL_ditempatkan = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('deleted_at', null)
            ->where('status_ak1', 'Bekerja')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $jumlahPA = $jmlPSebelumnya + $jmlP_terdaftar;
        $jumlahLA = $jmlLSebelumnya + $jmlL_terdaftar;
        // dd($jumlahPA);
        $jumlahA = $jumlahPA + $jumlahLA;
        $jmlDitempatkkan = $jmlL_ditempatkan + $jmlP_ditempatkan;

        $jml_terdaftar = DB::table('pencari_kerjas')
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $deleteUserNowL = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])->count();

        $deleteUserNowP = DB::table('pencari_kerjas')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])->count();

        $deleteUserNow = $deleteUserNowL + $deleteUserNowP;
        $jumlahPB = $deleteUserNowP + $jmlP_ditempatkan;
        $jumlahLB = $deleteUserNowL + $jmlL_ditempatkan;
        $jumlahB = $jumlahPB + $jumlahLB;
        $jumlahMale5 = $jumlahLA - $jumlahLB;
        $jumlahFemale5 = $jumlahPA - $jumlahPB;
        $jumlahAkhirPekerja = $jumlahMale5 + $jumlahFemale5;

        $ageRanges = [
            [15, 19],
            [20, 29],
            [30, 44],
            [45, 54],
            [55, null]
        ];

        $genderAgeCounts = [];
    
        foreach ($ageRanges as $range) {
            $startAge = $range[0];
            $endAge = $range[1];
    
            $maleCount = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCount = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
                
                // dd($femaleCount);
            $maleCountDelete = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
    
            $femaleCountDelete = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->count();
            
            $maleCountDitempatkan = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('status_ak1', 'Bekerja')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCountDitempatkan = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('status_ak1', 'Bekerja')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
            
            $maleCountSebelumnya = DB::table('pencari_kerjas')
                ->where('status_ak1', 'Belum Bekerja')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
    
            $femaleCountSebelumnya = DB::table('pencari_kerjas')
            ->where('status_ak1', 'Belum Bekerja')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('deleted_at', null)
            ->whereBetween(DB::raw('umur'), [$startAge, $endAge])
            ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
            ->count();

            $maleCountTerdaftar = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where('deleted_at', null)
                ->whereBetween('umur', [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
    
            $femaleCountTerdaftar = DB::table('pencari_kerjas')
                ->where('jenis_kelamin', 'Perempuan')
                ->where('deleted_at', null)
                ->whereBetween('umur', [$startAge, $endAge])
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

            $jumlahMaleA =  $maleCountSebelumnya + $maleCount;
            $jumlahFemaleA =  $femaleCountSebelumnya + $femaleCount;
            $jumlahMaleB =  $maleCountDelete + $maleCountDitempatkan;
            $jumlahFemaleB =  $femaleCountDelete + $femaleCountDitempatkan;
            $jumlahMale = $jumlahMaleA - $jumlahMaleB;
            $jumlahFemale = $jumlahFemaleA - $jumlahFemaleB;
    
            $genderAgeCounts[] = [
                'start' => $StartDateYear,
                'end' => $endDateYear,
                'start_age' => $startAge,
                'end_age' => $endAge ?: '+',
                'male_count' => $maleCount,
                'female_count' => $femaleCount,
                'male_count_delete' => $maleCountDelete,
                'female_count_delete' => $femaleCountDelete,
                'male_count_ditempatkan' => $maleCountDitempatkan,
                'female_count_ditempatkan' => $femaleCountDitempatkan,
                'male_count_sebelumnya' => $maleCountSebelumnya,
                'female_count_sebelumnya' => $femaleCountSebelumnya,
                'male_count_terdaftar' => $maleCountTerdaftar,
                'female_count_terdaftar' => $femaleCountTerdaftar,
                'jumlahMaleA' => $jumlahMaleA,
                'jumlahFemaleA' => $jumlahFemaleA,
                'jumlahMaleB' => $jumlahMaleB,
                'jumlahFemaleB' => $jumlahFemaleB,
                'jumlahMale' => $jumlahMale,
                'jumlahFemale' => $jumlahFemale,
            ];
        }

        // dd($genderAgeCounts);

        $data = Laporan::get();

        // laporan informasi lowongan
        $maleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->Where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
        
        $femaleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Perempuan')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();

        $malefemaleCountInformasiBelum = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki/Perempuan')
                ->where(function ($query) {
                    $query->where('status_lowongan', 0)
                        ->orWhere('status_lowongan', 1);
                })
                ->where('deleted_at', null)
                ->whereBetween('created_at', [$startDateSebelumnya, $endDateSebelumnya])
                ->count();
        
            $maleCountInformasiTerdaftar =  DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();
        
        $femaleCountInformasiTerdaftar = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Perempuan')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

        $malefemaleCountInformasiTerdaftar = DB::table('informasi_lowongans')
                ->where('jenis_kelamin', 'Laki-laki/Perempuan')
                ->whereBetween('created_at', [$StartDateYear, $endDateYear])
                ->count();

        $jumlahInformasibelumlalu = $maleCountInformasiBelum + $femaleCountInformasiBelum + $malefemaleCountInformasiBelum;
        $jumlahInformasiterdaftarnow = $maleCountInformasiTerdaftar + $femaleCountInformasiTerdaftar + $malefemaleCountInformasiTerdaftar;

        $jumlahInformasiMaleA = $maleCountInformasiBelum + $maleCountInformasiTerdaftar;
        $jumlahInformasiFemaleA = $femaleCountInformasiBelum + $femaleCountInformasiTerdaftar;
        $jumlahInformasiMaleFemaleA = $malefemaleCountInformasiBelum + $malefemaleCountInformasiTerdaftar;

        $jumlahInformasiA = $jumlahInformasiMaleA + $jumlahInformasiFemaleA + $jumlahInformasiMaleFemaleA;

        $informasiTerpenuhiMale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();
        
        $informasiTerpenuhiFemale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Perempuan')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiTerpenuhiMaleFemale = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki/Perempuan')
            ->where('status_lowongan', 2)
            ->where('deleted_at', null)
            ->whereBetween('created_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiMaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiFemaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();

        $informasiMaleFemaleDelete = DB::table('informasi_lowongans')
            ->where('jenis_kelamin', 'Laki-laki/Perempuan')
            ->whereBetween('deleted_at', [$StartDateYear, $endDateYear])
            ->count();
  
        $jumlahInformasiTerpenuhi = $informasiTerpenuhiMale + $informasiTerpenuhiFemale + $informasiTerpenuhiMaleFemale;
        $jumlahInformasiDelete = $informasiMaleDelete + $informasiFemaleDelete + $informasiMaleFemaleDelete;

        $jumlahInformasiMaleB = $informasiTerpenuhiMale + $informasiMaleDelete;
        $jumlahInformasiFemaleB = $informasiTerpenuhiFemale + $informasiFemaleDelete;
        $jumlahInformasiMaleFemaleB = $informasiTerpenuhiMaleFemale + $informasiMaleFemaleDelete;

        $jumlahInformasiB = $jumlahInformasiMaleB + $jumlahInformasiFemaleB + $jumlahInformasiMaleFemaleB;

        $jumlahInformasiMale = $jumlahInformasiMaleA - $jumlahInformasiMaleB;
        $jumlahInformasiFemale = $jumlahInformasiFemaleA - $jumlahInformasiFemaleB;
        $jumlahInformasiMaleFemale = $jumlahInformasiMaleFemaleA - $jumlahInformasiMaleFemaleB;

        $jumlahInformasi = $jumlahInformasiMale + $jumlahInformasiFemale + $jumlahInformasiMaleFemale;

        return view('dashboard.admin.laporan-semester', [
            'genderAgeCounts' => $genderAgeCounts,
            'jmlPSebelumnya' => $jmlPSebelumnya,
            'jmlLSebelumnya' => $jmlLSebelumnya,
            'jmlNow' => $jmlNow,
            'deleteUserNowL' => $deleteUserNowL,
            'deleteUserNowP' => $deleteUserNowP,
            'deleteUserNow' => $deleteUserNow,
            'jmlSebelumnya' => $jmlSebelumnya,
            'jmlP_terdaftar' => $jmlP_terdaftar,
            'jmlL_terdaftar' => $jmlL_terdaftar,
            'jmlP_ditempatkan' => $jmlP_ditempatkan,
            'jmlL_ditempatkan' => $jmlL_ditempatkan,
            'jmlDitempatkan' => $jmlDitempatkkan,
            'jml_terdaftar' => $jml_terdaftar,
            'jumlahPA' => $jumlahPA,
            'jumlahLA' => $jumlahLA,
            'jumlahPB' => $jumlahPB,
            'jumlahLB' => $jumlahLB,
            'jumlahA' => $jumlahA,
            'jumlahB' => $jumlahB,
            'jumlahMale5' => $jumlahMale5,
            'jumlahFemale5' => $jumlahFemale5,
            'jumlahAkhirPekerja' => $jumlahAkhirPekerja,
            'laporan' => $data,
            'male_informasi_belum' => $maleCountInformasiBelum,
            'female_informasi_belum' => $femaleCountInformasiBelum,
            'male_female_informasi_belum' => $malefemaleCountInformasiBelum,
            'jumlah_informasi_belum_lalu' => $jumlahInformasibelumlalu,
            'male_informasi_terdaftar' => $maleCountInformasiTerdaftar,
            'female_informasi_terdaftar' => $femaleCountInformasiTerdaftar,
            'male_female_informasi_terdaftar' => $malefemaleCountInformasiTerdaftar,
            'jumlah_informasi_terdaftar_now' => $jumlahInformasiterdaftarnow,
            'jumlah_informasi_male_a' => $jumlahInformasiMaleA,
            'jumlah_informasi_female_a' => $jumlahInformasiFemaleA,
            'jumlah_informasi_male_female_a' => $jumlahInformasiMaleFemaleA,
            'jumlah_informasi_a' => $jumlahInformasiA,
            'informasi_terpenuhi_male' => $informasiTerpenuhiMale,
            'informasi_terpenuhi_female' => $informasiTerpenuhiFemale,
            'informasi_terpenuhi_male_female' => $informasiTerpenuhiMaleFemale,
            'jumlah_informasi_terpenuhi' => $jumlahInformasiTerpenuhi,
            'informasi_male_delete' => $informasiMaleDelete,
            'informasi_female_delete' => $informasiFemaleDelete,
            'informasi_male_female_delete' => $informasiMaleFemaleDelete,
            'jumlah_informasi_delete' => $jumlahInformasiDelete,
            'jumlah_informasi_male_b' => $jumlahInformasiMaleB,
            'jumlah_informasi_female_b' => $jumlahInformasiFemaleB,
            'jumlah_informasi_male_female_b' => $jumlahInformasiMaleFemaleB,
            'jumlah_informasi_b' => $jumlahInformasiB,
            'jumlah_informasi_male' => $jumlahInformasiMale,
            'jumlah_informasi_female' => $jumlahInformasiFemale,
            'jumlah_informasi_male_female' => $jumlahInformasiMaleFemale,
            'jumlah_informasi' => $jumlahInformasi,
            'sub_title' => 'Laporan',
            'title' => 'Data'
        ]);  
    }

    public function testLaporan(){
        try{
            return Excel::download(new UjiLaporan, 'Laporan-tahun-ini.xlsx');
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    public function cetakLaporan(Request $request){

       $bulan1 = $request->input('bulan1');
       $bulan2 = $request->input('bulan2');

        return Excel::download(new CetakLaporan($bulan1, $bulan2), 'Laporan-semester.xlsx');
    }
    

}
