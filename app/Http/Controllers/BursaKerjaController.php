<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BursaKerja;
use App\Models\PencariKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BursaKerjaController extends Controller
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
    public function show($id)
    {

        $data = BursaKerja::join('users','users.email','=','bursa_kerjas.email_sekolah')->where('email_sekolah', $id)->first();

        return view('Dashboard.bkk.profil-sekolah', [
            'sub_title' => 'Profil Sekolah',
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
        $data = BursaKerja::where('email_sekolah',$id)->first();
        return view('Dashboard.bkk.edit-profil-sekolah', [
            'sub_title' => 'Edit Profil Sekolah',
            'title' => 'Data',
            'data' => $data,
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
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = BursaKerja::where('email_sekolah', $id)->first();
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $foto->storeAs('public/user', $foto->hashName());

            Storage::delete('public/user/' . $data->foto_sekolah);

        BursaKerja::where('email_sekolah', $id)->update([
            'nama_sekolah' => $request->nama_sekolah,
            'alamat_sekolah' => $request->alamat,
            'telepon_sekolah' => $request->telepon,
            'website_sekolah' => $request->website,
            'instagram_sekolah' => $request->instagram,
            'facebook_sekolah' => $request->facebook,
            'foto_sekolah' => $foto->hashName(),
        ]);

        User::where('email', $id)->update([
            'name' => $request->nama_sekolah,
            'foto_user' => $foto->hashName(),
        ]);
        }else{
            BursaKerja::where('email_sekolah', $id)->update([
                'nama_sekolah' => $request->nama_sekolah,
                'alamat_sekolah' => $request->alamat,
                'telepon_sekolah' => $request->telepon,
                'website_sekolah' => $request->website,
                'instagram_sekolah' => $request->instagram,
                'facebook_sekolah' => $request->facebook
            ]);
    
            User::where('email', $id)->update([
                'name' => $request->nama_sekolah,
            ]);
        }

        return redirect('/bursa/'. $id)->with('success', 'Data Berhasil Disimpan!');
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


    public function dataTracer(){
        
        $data = BursaKerja::join('alumnis', 'alumnis.bkk_id','=','bursa_kerjas.id_bkk')->join('users','users.email','=','alumnis.pencari_kerja_id')->join('pencari_kerjas', 'pencari_kerjas.email_pk','=','alumnis.pencari_kerja_id')->where('email_sekolah', Auth::user()->email)->get();
        return view('Dashboard.bkk.data-tracer', [
            'sub_title' => 'Data Tracer',
            'title' => 'Data',
            'data' => $data
        ]);
    }
}
