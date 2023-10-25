<?php

namespace App\Http\Controllers;

use App\Exports\DataIpk1;
use Illuminate\Http\Request;
use App\Imports\DataIPK1Import;
use App\Models\DataPencariKerja;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataIPK1 as ImportsDataIPK1;
use App\Imports\DataPencariKerjaImport;
use App\Models\PemangkuKepentingan;

class DataPencariKerjaController extends Controller
{
    public function index(){
        $data = DataPencariKerja::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $datalaporan = DataPencariKerja::where('id_disnaker', Auth::user()->email)->get();
        return view('Dashboard.admin.data_laporan_I', [
            'sub_title' => 'Laporan IPK-III-1',
            'title' => 'Data',
            'datalaporan' => $datalaporan,
            'kab' => $kab,
            'data' => $data
        ]);
    }

    public function downlaodTemplate1(Request $request){

        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');
 
         return Excel::download(new DataIpk1($bulan1, $bulan2), 'Template-IPK-III-1.xlsx');
     }

     public function importDataIPK1(Request $request){

        // $data = DataPencariKerja::where('id_disnaker', Auth::user()->email)->first();

        // if($data == null){
            $bulan1 = $request->input('tgl1');
            $bulan2 = $request->input('tgl2');      
    
            Excel::import(new DataPencariKerjaImport($bulan1, $bulan2), $request->file('file'));
            
            return redirect('/laporan-ipk-1')->with('success', 'Import data berhasil dilakukan!');
        
     }

     public function editLaporanI($id){
        $data = DataPencariKerja::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->first();
        
        return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_a', [
            'sub_title' => 'Laporan IPK-III-1',
            'title' => 'Data Laporan IPK-III-1',
            'data' => $data
        ]);

     }

     public function updateLaporanI(Request $request, $id){
        // dd($request->{'15_L'});
        DataPencariKerja::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->update([
            '15_L' => $request->{'15_L'},
            '15_P' => $request->{'15_P'},
            '20_L' => $request->{'20_L'},
            '20_P' => $request->{'20_P'},
            '30_L' => $request->{'30_L'},
            '30_P' => $request->{'30_P'},
            '45_L' => $request->{'45_L'},
            '45_P' => $request->{'45_P'},
            '55_L' => $request->{'55_L'},
            '55_P' => $request->{'55_P'},
        ]);
        return redirect('/laporan-ipk-1')->with('success', 'Update data berhasil dilakukan');
     }
}
