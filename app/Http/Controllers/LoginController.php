<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BursaKerja;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use App\Models\PemberiInformasi;
use App\Models\InformasiLowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            // if ($user->level == 1) {
            //     return redirect()->intended('dashboard-admin');
            // } elseif ($user->level == 2) {
            //     return redirect()->intended('dashboard-pekerja');
            // }
            return redirect()->intended('/home');
        }

        return view('dashboard/auth/login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        
        $username = $request->input('username');
        $password = $request->input('password');
        
        $user = User::where('username', $username)->first();
        
        if (!$user) {
            return back()->with('not-registered', 'Akun belum terdaftar, Silahkan lakukan pendaftaran');
        }
        
        $credentials = compact('username', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        
        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function lupaPassword(){
        return view('dashboard.auth.lupa-password');
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required',
            'password_baru' => 'required|same:ulangi_password',
            'ulangi_password' => 'required|same:password_baru',
        ], [
            'email.required' => 'E-mail tidak boleh kosong',
            'password_baru.required' => 'Password tidak boleh kosong',
            'ulangi_password.required' => 'Password tidak boleh kosong',
            'password_baru.same' => 'Password harus sama dengan ulangi password',
            'ulangi_password.same' => 'Konfirmasi password harus sama dengan password baru',
        ]);
        
        $email = $request->input('email');
        $ulangi_password = $request->input('ulangi_password');

        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return back()->with('not-registered', 'E-mail yang anda masukan belum terdaftar. Gunakan E-mail yang anda gunakan dalam proses registrasi!');
        }

        if($user){
            User::where('email',$request->email)->update([
                'password' => Hash::make($ulangi_password)
            ]);
            return redirect('/lupa-password')->with('success', 'Reset Password berhasil dilakukan');
        }
        
        return back()->with('error', 'Reset Password gagal');
    }


    public function detail_lowongan($id){

        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();
        $item = InformasiLowongan::join('users','users.id_user','=','informasi_lowongans.pemberi_informasi_id')
        ->join('pemberi_informasis', 'pemberi_informasis.email_instansi','=','users.email')->where('id_user',$data->pemberi_informasi_id)->first();
        return view('halaman-utama.detail-informasi', [
            'data' => $data,
            'item' => $item
        ]);

    }

    public function register_pekerja(Request $request){
        $this->validate($request, [
            'username' => 'required|min:5',
            'name' => 'required|min:5',
            'email' => 'required|min:5|unique:users|email',
            'password' => 'required|same:ulangi_password|min:6',
            'ulangi_password' => 'required|same:password'
        ]);


        PencariKerja::create([
            'nama_lengkap' => $request->name,
            'email_pk' => $request->email,
            'alamat' => '-',
            'pendidikan_terakhir' => '-',
            'keterampilan' => '-',
            'tentang' => '-',
            'no_hp' => '-',
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'bkk_id' => 0,
            'tgl_expired' => now()->addMonth(6)->format('Y-m-d'),
            'status_ak1' => 'Belum Bekerja',
            'foto_pencari_kerja' => 'default.jpg',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'level' => 2,
            'status_tracer' => 0,
            'icon' => 0,
            'password' => Hash::make($request->password),
            'foto_user' => 'default.jpg',
        ]);

        return redirect('/user-register')->with('success', 'Data Berhasil Disimpan, Silahkan lakukan login!');
    }

    public function register_perusahaan(Request $request){
        $this->validate($request, [
            'username' => 'required|min:5|unique:users',
            'nama_perusahaan' => 'required|min:5',
            'email' => 'required|min:5|unique:users|email',
            'password' => 'required|same:ulangi_password|min:6',
            'ulangi_password' => 'required|same:password'
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'username.min' => 'Username minimal berisi 5 karakter',
                'username.unique' => 'Username yang anda masukan sudah terdaftar',
                'nama_perusahaan.required' => 'Nama Perusahaan tidak boleh kosong',
                'nama_perusahaan.min' => 'Nama Perusahaan minimal berisi 5 karakter',
                'email.required' => 'Email Perusahaan tidak boleh kosong',
                'email.unique' => 'Email Perusahaan yang anda masukan sudah terdaftar',
                'nama-perusahaan.min' => 'Email Perusahaan minimal berisi 5 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal berisi 6 karakter',
                'password.same' => 'Password harus sama dengan konfirmasi password',
                'ulangi_password.same' => 'Konfirmasi password harus sama dengan password',
            ]
        );

        PemberiInformasi::create([
            'nama_instansi' => $request->nama_perusahaan,
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
            'name' => $request->nama_perusahaan,
            'email' => $request->email,
            'level' => 4,
            'status_tracer' => 0,
            'icon' => 0,
            'password' => Hash::make($request->password),
            'foto_user' => 'default.jpg',
        ]);

        return redirect('/perusahaan-register')->with('success', 'Data Berhasil Disimpan, Silahkan lakukan login!');
    }

    public function register_bkk(Request $request){
        $this->validate($request, [
            'username' => 'required|min:5|unique:users',
            'nama_sekolah' => 'required|min:5',
            'email' => 'required|min:5|unique:users|email',
            'password' => 'required|same:ulangi_password|min:6',
            'ulangi_password' => 'required|same:password'
        ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'username.min' => 'Username minimal berisi 5 karakter',
                'username.unique' => 'Username yang anda masukan sudah terdaftar',
                'nama_sekolah.required' => 'Nama Sekolah tidak boleh kosong',
                'nama_sekolah.min' => 'Nama Sekolah minimal berisi 5 karakter',
                'email.required' => 'Email Sekolah tidak boleh kosong',
                'email.unique' => 'Email Sekolah yang anda masukan sudah terdaftar',
                'email.min' => 'Email Sekolah minimal berisi 5 karakter',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal berisi 6 karakter',
                'password.same' => 'Password harus sama dengan konfirmasi password',
                'ulangi_password.same' => 'Konfirmasi password harus sama dengan password',
            ]
        );

        BursaKerja::create([
            'nama_sekolah' => $request->nama_sekolah,
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
            'name' => $request->nama_sekolah,
            'email' => $request->email,
            'level' => 5,
            'status_tracer' => 0,
            'icon' => 0,
            'password' => Hash::make($request->password),
            'foto_user' => 'default.jpg',
        ]);

        return redirect('/bkk-register')->with('success', 'Data Berhasil Disimpan, Silahkan lakukan login!');
    }

    public function searching(Request $request){
        $request->session()->flash('lowongan', $request->input('lowongan'));
        $data = InformasiLowongan::where('judul_lowongan','like','%'.$request->lowongan.'%')->paginate(20);

        return view('halaman-utama.lowongan-home', ['data' => $data]);
    }

    public function searchingLokasi(Request $request){
        $request->session()->flash('lokasi', $request->input('lokasi'));

        $data = InformasiLowongan::where('lokasi','like','%'.$request->lokasi.'%')->paginate(20);

        return view('halaman-utama.lowongan-home', ['data' => $data]);
    }

    public function searchingBidang(Request $request){
        $request->session()->flash('bidang', $request->input('bidang'));
        if($request->bidang == "Lainnya"){
            $data = InformasiLowongan::paginate(20);
        }
        else{
            $data = InformasiLowongan::where('bidang','like','%'.$request->bidang.'%')->paginate(20);
        }
        
        return view('halaman-utama.lowongan-home', ['data' => $data]);
    }

    public function searchJob(Request $request){
        $judulLowongan = $request->input('judul');
        $bidang = $request->input('bidang');
        $query = DB::table('informasi_lowongans')->join('users','users.id_user','=','informasi_lowongans.pemberi_informasi_id');
        if ($bidang !== null || !empty($judulLowongan)) {
            $query->where(function ($query) use ($bidang) {
                if ($bidang !== null && $bidang !== '') {
                    $query->orWhere('bidang', 'like', '%' . $bidang . '%');
                }
            });
        }
        if (!empty($judulLowongan)) {
            $query->where('judul_lowongan', 'like', '%' . $judulLowongan . '%');
        }
        $data = $query->get();
        return view('halaman-utama.search-index', [
            'data' => $data
        ]);
    }
}
