<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lamar;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use App\Models\PemberiInformasi;
use App\Models\InformasiLowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemberiInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(String $id)
    {
        // $data = PemberiInformasi::findOrFail($id);
        $data = PemberiInformasi::where('email_instansi', $id)->first();
        return view('Dashboard.pemberi_informasi.detail_instansi', [
            'sub_title' => 'Data Detail Instansi',
            'title' => 'Data',
            'data' => $data
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
        $data = PemberiInformasi::where('id_pemberi_informasi',$id)->first();
        return view('Dashboard.pemberi_informasi.edit-instansi', [
            'sub_title' => 'Edit data Instansi',
            'title' => 'Data',
            'data' => $data
        ]);
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
        $this->validate($request, [
            'foto_instansi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = PemberiInformasi::where('id_pemberi_informasi', $id)->first();

        if($request->hasFile('foto_instansi')){

            $foto = $request->file('foto_instansi');
            $foto->storeAs('public/user', $foto->hashName());
            Storage::delete('public/user/'. $data->foto);

            // dd($data);

            PemberiInformasi::where('id_pemberi_informasi', $id)->update([
                'nama_instansi' => $request->nama_instansi,
                'bidang_instansi' => $request->bidang,
                'website_instansi' => $request->website_instansi,
                'instagram_instansi' => $request->instagram_instansi,
                'facebook_instansi' => $request->facebook_instansi,
                'telepon_instansi' => $request->telepon_instansi,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'foto_instansi' => $foto->hashName(),
            ]);

            User::where('email', $request->email_instansi)->update([
                'name' => $request->nama_instansi,
                'foto_user' => $foto->hashName(),
            ]);

        }else{
            PemberiInformasi::where('id_pemberi_informasi', $id)->update([
                'nama_instansi' => $request->nama_instansi,
                'bidang_instansi' => $request->bidang,
                'website_instansi' => $request->website_instansi,
                'instagram_instansi' => $request->instagram_instansi,
                'facebook_instansi' => $request->facebook_instansi,
                'telepon_instansi' => $request->telepon_instansi,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi
            ]);

            User::where('email', $request->email_instansi)->update([
                'name' => $request->nama_instansi
            ]);
        }
        
        return redirect('/sumber/'. $request->email_instansi)->with('success', 'Data Berhasil Disimpan!');
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

    public function data_lowongan()
    {
        $data = InformasiLowongan::join('users', 'users.id_user', '=', 'informasi_lowongans.pemberi_informasi_id')
        ->leftJoin('lamars', 'informasi_lowongans.id_informasi_lowongan', '=', 'lamars.id_informasi')
        ->select(
            'id_informasi_lowongan',
            'judul_lowongan',
            'status_lowongan',
            'foto_lowongan',
            'verifikasi',
            DB::raw('count(id_pelamar) as jumlah_pelamar')
        )
        ->where('id_user', Auth::user()->id_user)
        ->groupBy(
            'id_informasi_lowongan',
            'judul_lowongan',
            'status_lowongan',
            'foto_lowongan',
            'verifikasi',
        )->get();

        // dd(Auth::user()->id_user);

        return view('Dashboard.pemberi_informasi.data-lowongan', [
            'sub_title' => 'Data Lowongan',
            'title' => 'Data',
            'data' => $data
        ]);
    }


    public function data_pelamar($id){
      $data = InformasiLowongan::join('lamars','lamars.id_informasi','=','informasi_lowongans.id_informasi_lowongan')
            ->join('pencari_kerjas','pencari_kerjas.email_pk','=','lamars.id_pelamar')->where('id_informasi', $id)->get();

            return view('Dashboard.pemberi_informasi.detail_pendaftar', [
                'sub_title' => 'Detail Pendaftar',
                'title' => 'Data',
                'data' => $data
            ]);
    }

    public function detail_data_pelamar(Request $request, $id){

        // dd($request->id_informasi);
        $data = PencariKerja::join('lamars','lamars.id_pelamar','=','pencari_kerjas.email_pk')->join('informasi_lowongans','informasi_lowongans.id_informasi_lowongan','=','lamars.id_informasi')->where('email_pk', $id)->where('id_informasi', $request->id_informasi)->first();
        // dd($data);
  
              return view('Dashboard.pemberi_informasi.detail_data_pendaftar', [
                  'sub_title' => 'Detail Data Pendaftar',
                  'title' => 'Data',
                  'data' => $data
              ]);
      }

      public function verifikasiPelamar(Request $request, $id){

        // $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();

        Lamar::where('id_lamar', $id)->update([
            'status' => $request->status,
         ]);

         InformasiLowongan::where('id_informasi_lowongan', $request->id_informasi)->update([
            'status_lowongan' => $request->status,
         ]);

        return redirect('/lowongan-data')->with('success', 'Data Berhasil Diverifikasi!');
    }

    public function lengkapi_data_lowongan($id){
        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();

        return view('Dashboard.pemberi_informasi.lengkapi-data-lowongan', [
            'sub_title' => 'Detail Data Informasi Lowongan',
            'title' => 'Data',
            'data' => $data
        ]);
    }

    public function updateInformasi(Request $request, $id){

         $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();

        if($request->hasFile('foto')){

            $foto = $request->file('foto');
            $foto->storeAs('public/informasi-lowongan', $foto->hashName());
            Storage::delete('public/informasi-lowongan/'. $data->foto_lowongan);

            InformasiLowongan::where('id_informasi_lowongan', $id)->update([
                'pemberi_informasi_id' => $request->pemberi_id,
                'judul_lowongan' => $request->judul_lowongan,
                'perusahaan' => $request->perusahaan,
                'salary' => $request->salary,
                'bidang' => $request->bidang,
                'jenis_lowongan' => $request->jenis_lowongan,
                'pendidikan' => $request->pendidikan,
                'pengalaman' => $request->pengalaman,
                'keterampilan' => $request->keterampilan,
                'lokasi' => $request->lokasi,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_tutup' => $request->tgl_tutup,
                'deskripsi' => $request->deskripsi,
                'foto_lowongan' => $foto->hashName(),
            ]);
        }else{
            InformasiLowongan::where('id_informasi_lowongan', $id)->update([
                'pemberi_informasi_id' => $request->pemberi_id,
                'judul_lowongan' => $request->judul_lowongan,
                'salary' => $request->salary,
                'bidang' => $request->bidang,
                'jenis_lowongan' => $request->jenis_lowongan,
                'pendidikan' => $request->pendidikan,
                'pengalaman' => $request->pengalaman,
                'lokasi' => $request->lokasi,
                'tgl_buka' => $request->tgl_buka,
                'tgl_tutup' => $request->tgl_tutup,
                'deskripsi' => $request->deskripsi,
                'keterampilan' => $request->keterampilan
            ]);
        }

        return redirect('lowongan-data')->with('success', 'Data Berhasil Disimpan!');
    }
}
