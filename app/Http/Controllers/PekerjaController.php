<?php

namespace App\Http\Controllers;

use App\Models\BKK;
use App\Models\User;
use App\Models\Lamar;
use App\Models\Alumni;
use App\Models\BursaKerja;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use App\Models\PemberiInformasi;
use App\Models\InformasiLowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InformasiLowongan::leftJoin('lamars','lamars.id_informasi','=','informasi_lowongans.id_informasi_lowongan')->select('id_informasi', 'judul_lowongan','status_lowongan','id_informasi_lowongan','perusahaan','foto_lowongan', 'verifikasi', DB::raw('count(id_informasi) as jumlah_pelamar'))->groupBy('id_informasi', 'judul_lowongan','status_lowongan','id_informasi_lowongan','perusahaan','foto_lowongan', 'verifikasi')->where('status_lowongan', 1)->orWhere('status_lowongan', 3)->orWhere('status_lowongan', 0)->get();

        return view('dashboard.pencari_kerja.data-lowongan', [
            'sub_title' => 'Data Lowongan',
            'title' => 'Data',
            // 'datainfo' => $datainfo,
            'data' => $data,
            // 'items' => $item
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PencariKerja::join('lamars', 'lamars.id_pelamar','=','pencari_kerjas.email_pk')
                ->join('informasi_lowongans','informasi_lowongans.id_informasi_lowongan','=','lamars.id_informasi')
                ->where('email_pk',$id)->get();
        return view('dashboard.pencari_kerja.status-daftar', [
            'sub_title' => 'Status Daftar',
            'title' => 'Data',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = PencariKerja::where('email_pk', $request->email_pk)->first();
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $foto->storeAs('public/user', $foto->hashName());

            Storage::delete('public/user/' . $data->foto_pencari_kerja);

        PencariKerja::where('email_pk', $request->email_pk)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'pendidikan_terakhir' => $request->pendidikan,
            'keterampilan' => $request->keterampilan,
            'tentang' => $request->tentang,
            'no_hp' => $request->no_hp,
            'foto_pencari_kerja' => $foto->hashName(),
        ]);

        User::where('email', $request->email_pk)->update([
            'name' => $request->nama_lengkap,
            'foto_user' => $foto->hashName(),
        ]);
        }else{
            PencariKerja::where('email_pk', $request->email_pk)->update([
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'pendidikan_terakhir' => $request->pendidikan,
                'keterampilan' => $request->keterampilan,
                'tentang' => $request->tentang,
                'jenis_kelamin' => $request->jenis_kelamin,
                'umur' => $request->umur,
                'no_hp' => $request->no_hp
            ]);
    
            User::where('email', $request->email_pk)->update([
                'name' => $request->nama_lengkap,
            ]);
        }

        return redirect('profil-tenaga-kerja/'. $request->email_pk)->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function DetailLowongan($id){
        $data = InformasiLowongan::where('id_informasi_lowongan',$id)->first();
        $item = InformasiLowongan::join('users', 'users.id_user','=','informasi_lowongans.pemberi_informasi_id')->join('pemberi_informasis', 'pemberi_informasis.email_instansi','=', 'users.email')->where('id_informasi_lowongan', $id)->first();

        $exists = DB::table('lamars')
        ->where('id_pelamar', Auth::user()->email)
        ->where('id_informasi', $data->id_informasi_lowongan)
        ->exists();

        return view('dashboard.pencari_kerja.detail-lowongan',[
            'data' => $data,
            'item' => $item,
            'exists' => $exists, 
            'sub_title' => 'Data Lowongan',
            'title' => 'Data',
        ]);
    }

    public function lamarPekerjaan($id){
        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();
        return view('dashboard.pencari_kerja.lamar-lowongan',[
            'data' => $data,
            'sub_title' => 'Lamar Lowongan',
            'title' => 'Data',
        ]);
    }

    public function lamarLowonganPekerjaan(Request $request){
        $this->validate($request, [
            'pesan' => 'required|min:15',
            'cv' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ijazah' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nilai' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'portofolio' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'cv.required' => 'CV tidak boleh kosong',
            'pesan.required' => 'Jelaskan tentang diri anda',
            'ijazah.required' => 'Ijazah tidak boleh kosong',
        ]);

        if($request->hasFile('cv') && $request->hasFile('portofolio') && $request->hasFile('ijazah') && $request->hasFile('nilai')){
            $foto_cv = $request->file('cv');
            $foto_cv->storeAs('public/syarat', $foto_cv->hashName());

            $foto_ijazah = $request->file('ijazah');
            $foto_ijazah->storeAs('public/syarat', $foto_ijazah->hashName());

            $foto_nilai = $request->file('nilai');
            $foto_nilai->storeAs('public/syarat', $foto_nilai->hashName());

            $foto_portofolio = $request->file('portofolio');
            $foto_portofolio->storeAs('public/syarat', $foto_portofolio->hashName());

            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => $foto_cv->hashName(),
                'ijazah' => $foto_ijazah->hashName(),
                'portofolio' => $foto_portofolio->hashName(),
                'nilai' => $foto_nilai->hashName(),
                'status' => 0,
                'pesan' => $request->pesan
            ]);

        }elseif($request->hasFile('cv') && $request->hasFile('ijazah') && $request->hasFile('nilai')){
            $foto_cv = $request->file('cv');
            $foto_cv->storeAs('public/syarat', $foto_cv->hashName());

            $foto_ijazah = $request->file('ijazah');
            $foto_ijazah->storeAs('public/syarat', $foto_ijazah->hashName());

            $foto_nilai = $request->file('nilai');
            $foto_nilai->storeAs('public/syarat', $foto_nilai->hashName());


            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => $foto_cv->hashName(),
                'ijazah' => $foto_ijazah->hashName(),
                'nilai' => $foto_nilai->hashName(),
                'portofolio' => '-',
                'status' => 0,
                'pesan' => $request->pesan
            ]);
        }elseif($request->hasFile('cv') && $request->hasFile('portofolio')){
            $foto_cv = $request->file('cv');
            $foto_cv->storeAs('public/syarat', $foto_cv->hashName());

            $foto_portofolio = $request->file('portofolio');
            $foto_portofolio->storeAs('public/syarat', $foto_portofolio->hashName());


            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => $foto_cv->hashName(),
                'portofolio' => $foto_portofolio->hashName(),
                'ijazah' => '-',
                'nilai' => '-',
                'status' => 0,
                'pesan' => $request->pesan
            ]);
        }
        elseif($request->hasFile('cv') && $request->hasFile('ijazah')){
            $foto_cv = $request->file('cv');
            $foto_cv->storeAs('public/syarat', $foto_cv->hashName());

            $foto_ijazah = $request->file('ijazah');
            $foto_ijazah->storeAs('public/syarat', $foto_ijazah->hashName());

            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => $foto_cv->hashName(),
                'ijazah' => $foto_ijazah->hashName(),
                'portofolio' => '-',
                'nilai' => '-',
                'status' => 0,
                'pesan' => $request->pesan
            ]);
        }
        elseif($request->hasFile('cv')){
            $foto_cv = $request->file('cv');
            $foto_cv->storeAs('public/syarat', $foto_cv->hashName());
            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => $foto_cv->hashName(),
                'ijazah' => '-',
                'portofolio' => '-',
                'nilai' => '-',
                'status' => 0,
                'pesan' => $request->pesan
            ]);
        }elseif($request->hasFile('ijazah')){

            $foto_ijazah = $request->file('ijazah');
            $foto_ijazah->storeAs('public/syarat', $foto_ijazah->hashName());


            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => '-',
                'ijazah' => $foto_ijazah->hashName(),
                'portofolio' => '-',
                'nilai' => '-',
                'status' => 0,
                'pesan' => $request->pesan
            ]);
        }else{
            $foto_portofolio = $request->file('portofolio');
            $foto_portofolio->storeAs('public/syarat', $foto_portofolio->hashName());


            Lamar::create([
                'id_informasi' => $request->id_informasi,
                'id_pelamar' => $request->id_pelamar,
                'cv' => '-',
                'ijazah' => '-',
                'nilai' => '-',
                'portofolio' => $foto_portofolio->hashName(),
                'status' => 0,
                'pesan' => $request->pesan
            ]);
        }

        return redirect('/pekerja/'.$request->id_pelamar)->with('success', 'Selamat anda berhasil melakukan lamaran kerja');
    }

    public function tracerStudy(){
        $bkk = BursaKerja::get();

        return view('dashboard.pencari_kerja.tracer-study',[
            'bkk' => $bkk,
            'sub_title' => 'Tracer Study',
            'title' => 'Data',
        ]);

    }

    public function updateTracerStudy(Request $request){
        $this->validate($request, [
            'tahun_lulus' => 'required',
            'jurusan' => 'required',
            'id_bkk' => 'required|numeric|not_in:0',
            'status_bekerja' => 'required',
            'tempat_kerja' => 'required',
        ], [
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'tahun_lulus.required' => 'Tahun lulus tidak boleh kosong',
            'id_bkk.required' => 'Sekolah harus dipilih.',
            'id_bkk.numeric' => 'Format data sekolah tidak valid.',
            'id_bkk.not_in' => 'Sekolah harus dipilih.',
            'status_bekerja.required' => 'Silahkan pilih status bekerja',
            'tempat_kerja.required' => 'Silahkan isi dengan "-" jika belum bekerja',
        ]);
        Alumni::create([
            'pencari_kerja_id' => $request->email_pk,
            'bkk_id' => $request->id_bkk,
            'jurusan' => $request->jurusan,
            'status_bekerja' => $request->status_bekerja,
            'tempat_kerja' => $request->tempat_kerja,
            'tahun_lulus' => $request->tahun_lulus,
        ]);

        User::where('id_user', $request->id_user)->update([
            'status_tracer' => $request->status
        ]);

        PencariKerja::where('email_pk', $request->email_pk)->update([
            'bkk_id' => $request->id_bkk
        ]);

        return redirect('/tracer-study')->with('success', 'Terima kasih, telah ikut serta dalam pendataan alumni.');

    }

    public function editDataTracer($id){
        $data = Alumni::where('pencari_kerja_id', $id)->first();
        $bkk = BursaKerja::get();

        return view('dashboard.pencari_kerja.edit-data-tracer',[
            'data' => $data,
            'bkk' => $bkk,
            'sub_title' => 'Edit Data Tracer Study',
            'title' => 'Data',
        ]);
    }

    public function updateDataTracer(Request $request){
        $this->validate($request, [
            'tahun_lulus' => 'required',
            'jurusan' => 'required',
            'id_bkk' => 'required|numeric|not_in:0',
            'status_bekerja' => 'required',
            'tempat_kerja' => 'required',
        ], [
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'tahun_lulus.required' => 'Tahun lulus tidak boleh kosong',
            'id_bkk.required' => 'Sekolah harus dipilih.',
            'id_bkk.numeric' => 'Format data sekolah tidak valid.',
            'id_bkk.not_in' => 'Sekolah harus dipilih.',
            'status_bekerja.required' => 'Silahkan pilih status bekerja',
            'tempat_kerja.required' => 'Silahkan isi dengan "-" jika belum bekerja',
        ]);
        Alumni::where('pencari_kerja_id', $request->email_pk)->update([
            'jurusan' => $request->jurusan,
            'status_bekerja' => $request->status_bekerja,
            'tempat_kerja' => $request->tempat_kerja,
            'bkk_id' => $request->id_bkk,
            'tahun_lulus' => $request->tahun_lulus,
        ]);

        User::where('id_user', $request->id_user)->update([
            'status_tracer' => $request->status
        ]);

        if($request->status_bekerja == 'Sudah Bekerja'){
            $status_kerja = 'Bekerja';
        }else{
            $status_kerja = 'Belum Bekerja';
        }

        PencariKerja::where('email_pk', $request->email_pk)->update([
            'bkk_id' => $request->id_bkk,
            'status_ak1' => $status_kerja,

        ]);

        return redirect('/tracer-study')->with('success', 'Data berhasil diupdate.');

    }

    public function perpanjangKartu(Request $request){
        PencariKerja::where('id_pencari_kerja', $request->id)->update([
            'status_ak1' => $request->status,
            'tgl_expired' => now()->addMonth(6)
        ]);

        return redirect('/home')->with('success', 'Data kartu berhasil diperpanjang.');
    }
}
