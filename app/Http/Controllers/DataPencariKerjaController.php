<?php

namespace App\Http\Controllers;

use App\Exports\DataIpk1;
use Illuminate\Http\Request;
use App\Models\DataPencariKerja;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DataPencariKerjaController extends Controller
{
    public function index(){
        $data = DataPencariKerja::get();
        return view('Dashboard.admin.data_laporan_I', [
            'sub_title' => 'Laporan IPK-III-1',
            'title' => 'Data',
            'data' => $data
        ]);
    }

    public function downlaodTemplate1(Request $request){

        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');
 
         return Excel::download(new DataIpk1($bulan1, $bulan2), 'Template-IPK-III-1.xlsx');
     }
}
