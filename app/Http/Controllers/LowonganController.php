<?php

namespace App\Http\Controllers;

use App\Models\Sumber;
use Illuminate\Http\Request;
use App\Models\InformasiLowongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\View\Components\Info;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InformasiLowongan::get();
        return view('Dashboard.admin.pekerjaan_data', [
            'sub_title' => 'Data Pekerjaan',
            'title' => 'Data',
            'data' => $data
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
        // dd($request);
        
        $this->validate($request, [
            'pemberi_id' => 'required',
            'informasi' => 'required|min:5',
            'perusahaan' => 'required',
            'salary' => 'required',
            'bidang' => 'required',
            'jurusan' => 'required',
            'jenis_lowongan' => 'required',
            'pendidikan' => 'required',
            'pengalaman' => 'required',
            'keterampilan' => 'required',
            'deskripsi' => 'required',
            'tgl_buka' => 'required|date',
            'tgl_tutup' => 'required|date',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $foto = $request->file('foto');
        $foto->storeAs('public/informasi-lowongan', $foto->hashName());


        InformasiLowongan::create([
            'pemberi_informasi_id' => $request->pemberi_id,
            'judul_lowongan' => $request->informasi,
            'perusahaan' => $request->perusahaan,
            'salary' => $request->salary,
            'bidang' => $request->bidang,
            'jurusan' => $request->jurusan,
            'jenis_lowongan' => $request->jenis_lowongan,
            'pendidikan' => $request->pendidikan,
            'pengalaman' => $request->pengalaman,
            'keterampilan' => $request->keterampilan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'deskripsi' => $request->deskripsi,
            'tgl_buka' => $request->tgl_buka,
            'tgl_tutup' => $request->tgl_tutup,
            'verifikasi' => 0,
            'status_lowongan' => 0,
            'lokasi' => $request->lokasi,
            'foto_lowongan' => $foto->hashName(),
        ]);

        Sumber::create([
            'pemberi_informasi_id' => $request->pemberi_id,
            'pemangku_kepentingan_id' => $request->pemberi_id,
            'tgl_buka' => $request->tgl_buka,
            'tgl_tutup' => $request->tgl_tutup,
        ]);

        if($request->pemberi_id == 2){
            return redirect('/lowongan')->with('success', 'Data Berhasil Disimpan!');
        }else{
            return redirect('/lowongan-data')->with('success', 'Data Berhasil Disimpan!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();
        return view('Dashboard.admin.detail_informasi_lowongan', [
            'sub_title' => 'Data Informasi Lowongan',
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
        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();
        // dd($data->verifikasi);

        if($request->hasFile('foto')){

            $foto = $request->file('foto');
            $foto->storeAs('public/informasi-lowongan', $foto->hashName());
            Storage::delete('public/informasi-lowongan/'. $data->foto_lowongan);

            InformasiLowongan::where('id_informasi_lowongan', $id)->update([
                'judul_lowongan' => $request->informasi,
                'perusahaan' => $request->perusahaan,
                'salary' => $request->salary,
                'bidang' => $request->bidang,
                'jurusan' => $request->jurusan,
                'jenis_lowongan' => $request->jenis_lowongan,
                'pendidikan' => $request->pendidikan,
                'pengalaman' => $request->pengalaman,
                'keterampilan' => $request->keterampilan,
                'tgl_buka' => $request->tgl_buka,
                'tgl_tutup' => $request->tgl_tutup,
                'lokasi' => $request->lokasi,
                'foto_lowongan' => $foto->hashName(),
            ]);
        }else{
            InformasiLowongan::where('id_informasi_lowongan', $id)->update([
                'judul_lowongan' => $request->informasi,
                'perusahaan' => $request->perusahaan,
                'salary' => $request->salary,
                'bidang' => $request->bidang,
                'jurusan' => $request->jurusan,
                'jenis_lowongan' => $request->jenis_lowongan,
                'pendidikan' => $request->pendidikan,
                'pengalaman' => $request->pengalaman,
                'lokasi' => $request->lokasi,
                'tgl_buka' => $request->tgl_buka,
                'tgl_tutup' => $request->tgl_tutup,
                'keterampilan' => $request->keterampilan
            ]);
        }
        
        return redirect('/lowongan/' . $id)->with('success', 'Data Berhasil Disimpan!');
    }

    public function verifikasiLowongan(Request $request, $id){

        // $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();

        InformasiLowongan::where('id_informasi_lowongan', $id)->update([
            'verifikasi' => $request->verifikasi,
         ]);

        return redirect('/lowongan/' . $id)->with('success', 'Data Berhasil Diverifikasi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = InformasiLowongan::where('id_informasi_lowongan', $id)->first();
        Storage::delete('public/informasi-lowongan/'. $data->foto);
        InformasiLowongan::where('id_informasi_lowongan', $id)->delete();
        return redirect('/lowongan')->with('success', 'Data Berhasil Dihapus!');
    }

    // public function search(Request $request){
    //     $data = InformasiLowongan::search('search')->get();


    // }

}
