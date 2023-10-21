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
        // dd($request->file('file'));  
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');      

        Excel::import(new DataPencariKerjaImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/laporan-ipk-1')->with('success', 'All good!');
     }
}
