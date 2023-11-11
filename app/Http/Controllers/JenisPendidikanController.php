<?php

namespace App\Http\Controllers;

use App\Exports\CetakLaporanII;
use App\Exports\CetakLaporanIIPusat;
use Illuminate\Http\Request;
use App\Models\DataJenisPendidikan;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JenisPendidikanImport;

class JenisPendidikanController extends Controller
{

    public function index(){
        $data = DataJenisPendidikan::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        // dd($aturan);
        $excludedNumbers = ['Sub Total', 'BH & TIDAK TAMAT SD', 'SD', 'SLTP UMUM','SLTP KEJURUAN', 'SETINGKAT SLTP','PENDIDIKAN MENENGAH ATAS','SMK - TEKNOLOGI DAN REKAYASA','SMK - TEKNOLOGI INFORMASI DAN KOMUNIKASI','SMK - KESEHATAN','SMK - SENI, KERAJINAN DAN PARIWISATA','SMK - AGRIBISNIS DAN AGROTEKNOLOGI','SMK - BISNIS DAN MANAJEMEN','SETINGKAT SMU LAINNYA','DIPLOMA I / AKTA I / DIPLOMA II / AKTA II','DIPLOMA III / AKTA III/ AKADEMI/S.MUDA','SARJANA ( S1 )','SARJANA ( S2 )', '0'];
        $datalaporan = DataJenisPendidikan::where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $excludedNumbers)->paginate(20);

        return view('Dashboard.admin.data_laporan_II', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'dataLaporan' => $datalaporan,
            'sub_title' => 'Laporan IPK-III-2',
            'title' => 'DataIPK',
        ]);
    }

    public function importDataIPK2(Request $request){

        // $data = DataPencariKerja::where('id_disnaker', Auth::user()->email)->first();

        // if($data == null){
            $bulan1 = $request->input('tgl1');
            $bulan2 = $request->input('tgl2');   
            
            // $import = new DataJenisPendidikan($bulan1, $bulan2);
            // $import->onlySheets('Worksheet 1', 'Worksheet 3');
    
            Excel::import(new JenisPendidikanImport($bulan1, $bulan2), $request->file('file'));
            
            return redirect('/laporan-ipk-2')->with('success', 'Import data berhasil dilakukan!');
        
     }

     public function deleteLaporanII($id){
        DataJenisPendidikan::where('id_disnaker', $id)->delete();
        return redirect('/laporan-ipk-2')->with('success', 'Hapus data berhasil dilakukan');
     } 

     public function CetakLaporanII($id){
        // dd($id);
        return Excel::download(new CetakLaporanIIPusat($id), 'Laporan-IPK-2.xlsx');

        }
}
