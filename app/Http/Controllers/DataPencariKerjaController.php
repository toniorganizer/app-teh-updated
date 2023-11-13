<?php

namespace App\Http\Controllers;

use App\Exports\DataIpk1;
use Illuminate\Http\Request;
use App\Exports\CetakLaporanI;
use App\Imports\DataIPK1Import;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataPencariKerjaImport;
use App\Imports\DataIPK1 as ImportsDataIPK1;

class DataPencariKerjaController extends Controller
{
    public function index(){
        $data = DataPencariKerja::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        $excludedNumbers = ['A.', 'B.', 5];
        $datalaporan = DataPencariKerja::where('id_disnaker', Auth::user()->email)->whereNotIn('nmr', $excludedNumbers)->get();

        $users = ['1', '2', '3'];
        foreach($users as $user){
            $lap = DB::table('data_pencari_kerjas')
            ->where('nmr', $user)
            ->select('pencari_kerja', DB::raw('SUM(15_L) as 15_L'), DB::raw('SUM(15_P) as 15_P'), DB::raw('SUM(20_L) as 20_L'), DB::raw('SUM(20_P) as 20_P'))
            ->groupBy('pencari_kerja')
            ->get();

            $lapor[$user] = $lap;
        }

        // dd($lapor);

        // menghitung jumlah untuk disnakerprov
        $jumlahL151 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('15_L');
        $pencari_kerja1 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->first();
        $jumlahL152 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('15_L');
        $pencari_kerja2 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->first();
        $jumlahL153 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('15_L');
        $pencari_kerja3 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->first();
        $jumlahL154 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('15_L');
        $pencari_kerja4 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->first();
        $jumlahP151 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('15_P');
        $jumlahP152 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('15_P');
        $jumlahP153 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('15_P');
        $jumlahP154 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('15_P');
        $jumlahLowonganL1 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_L');
        $jumlahLowonganP1 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_P');

        $jumlahL201 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('20_L');
        $jumlahL202 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('20_L');
        $jumlahL203 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('20_L');
        $jumlahL204 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('20_L');
        $jumlahP201 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('20_P');
        $jumlahP202 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('20_P');
        $jumlahP203 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('20_P');
        $jumlahP204 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('20_P');
        $jumlahLowonganL2 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_L');
        $jumlahLowonganP2 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_P');

        $jumlahL301 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('30_L');
        $jumlahL302 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('30_L');
        $jumlahL303 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('30_L');
        $jumlahL304 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('30_L');
        $jumlahP301 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('30_P');
        $jumlahP302 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('30_P');
        $jumlahP303 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('30_P');
        $jumlahP304 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('30_P');
        $jumlahLowonganL3 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_L');
        $jumlahLowonganP3 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_P');

        $jumlahL451 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('45_L');
        $jumlahL452 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('45_L');
        $jumlahL453 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('45_L');
        $jumlahL454 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('45_L');
        $jumlahP451 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('45_P');
        $jumlahP452 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('45_P');
        $jumlahP453 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('45_P');
        $jumlahP454 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('45_P');
        $jumlahLowonganL4 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_L');
        $jumlahLowonganP4 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('lowongan_P');

        $jumlahL551 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('55_L');
        $jumlahL552 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('55_L');
        $jumlahL553 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('55_L');
        $jumlahL554 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('55_L');
        $jumlahP551 = DataPencariKerja::where('nmr', 1)->whereNotIn('nmr', $excludedNumbers)->sum('55_P');
        $jumlahP552 = DataPencariKerja::where('nmr', 2)->whereNotIn('nmr', $excludedNumbers)->sum('55_P');
        $jumlahP553 = DataPencariKerja::where('nmr', 3)->whereNotIn('nmr', $excludedNumbers)->sum('55_P');
        $jumlahP554 = DataPencariKerja::where('nmr', 4)->whereNotIn('nmr', $excludedNumbers)->sum('55_P');

        // dd($jumlahL15);
        return view('Dashboard.admin.data_laporan_I', [
            'sub_title' => 'Laporan IPK-III-1',
            'title' => 'DataIPK',
            'datalaporan' => $datalaporan,
            'lapor' => $lapor,
            'kab' => $kab,
            'data' => $data,
            'aturan' => $aturan,
            'jumlahL151' => $jumlahL151,
            'jumlahL152' => $jumlahL152,
            'jumlahL153' => $jumlahL153,
            'jumlahL154' => $jumlahL154,
            'jumlahP151' => $jumlahP151,
            'jumlahP152' => $jumlahP152,
            'jumlahP153' => $jumlahP153,
            'jumlahP154' => $jumlahP154,
            'jumlahLowonganL1' => $jumlahLowonganL1,
            'jumlahLowonganP1' => $jumlahLowonganP1,
            'jumlahL201' => $jumlahL201,
            'jumlahL202' => $jumlahL202,
            'jumlahL203' => $jumlahL203,
            'jumlahL204' => $jumlahL204,
            'jumlahP201' => $jumlahP201,
            'jumlahP202' => $jumlahP202,
            'jumlahP203' => $jumlahP203,
            'jumlahP204' => $jumlahP204,
            'jumlahLowonganL2' => $jumlahLowonganL2,
            'jumlahLowonganP2' => $jumlahLowonganP2,
            'jumlahL301' => $jumlahL301,
            'jumlahL302' => $jumlahL302,
            'jumlahL303' => $jumlahL303,
            'jumlahL304' => $jumlahL304,
            'jumlahP301' => $jumlahP301,
            'jumlahP302' => $jumlahP302,
            'jumlahP303' => $jumlahP303,
            'jumlahP304' => $jumlahP304,
            'jumlahLowonganL3' => $jumlahLowonganL3,
            'jumlahLowonganP3' => $jumlahLowonganP3,
            'jumlahL451' => $jumlahL451,
            'jumlahL452' => $jumlahL452,
            'jumlahL453' => $jumlahL453,
            'jumlahL454' => $jumlahL454,
            'jumlahP451' => $jumlahP451,
            'jumlahP452' => $jumlahP452,
            'jumlahP453' => $jumlahP453,
            'jumlahP454' => $jumlahP454,
            'jumlahLowonganL4' => $jumlahLowonganL4,
            'jumlahLowonganP4' => $jumlahLowonganP4,
            'jumlahL551' => $jumlahL551,
            'jumlahL552' => $jumlahL552,
            'jumlahL553' => $jumlahL553,
            'jumlahL554' => $jumlahL554,
            'jumlahP551' => $jumlahP551,
            'jumlahP552' => $jumlahP552,
            'jumlahP553' => $jumlahP553,
            'jumlahP554' => $jumlahP554,
            'pencari_kerja1' => $pencari_kerja1,
            'pencari_kerja2' => $pencari_kerja2,
            'pencari_kerja3' => $pencari_kerja3,
            'pencari_kerja4' => $pencari_kerja4,
            // 'jumlahData' => $jumlahData
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

     public function editLaporanI(Request $request, $id){
         if($request->id_disnaker){
            $data = DataPencariKerja::where('nmr', $id)->where('id_disnaker', $request->id_disnaker)->first();
         }else{
             $data = DataPencariKerja::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->first();
         }

        //  dd($data);
        return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_a', [
            'sub_title' => 'Laporan IPK-III-1',
            'title' => 'DataIPK',
            'data' => $data
        ]);

     }

     public function updateLaporanI(Request $request, $id){
        // dd($request->id_disnaker);
        DataPencariKerja::where('nmr', $id)->where('id_disnaker', $request->id_disnaker)->update([
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
            'lowongan_L' => $request->lowongan_L,
            'lowongan_P' => $request->lowongan_P
        ]);

        if(Auth::user()->email == 'disnaker@gmail.com'){
            return redirect('/detail-laporan-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
        }else{
            return redirect('/laporan-ipk-1')->with('success', 'Update data berhasil dilakukan');
        }
     }

     public function deleteLaporanI($id){
        DataPencariKerja::where('id_disnaker', $id)->delete();
        return redirect('/laporan-ipk-1')->with('success', 'Hapus data berhasil dilakukan');
     }

     public function CetakLaporanI($id){
// dd($id);
        return Excel::download(new CetakLaporanI($id), 'Laporan.xlsx');

     }

     public function detailLaporanKab($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $excludedNumbers = ['A.', 'B.', 5];
        $datalaporan = DataPencariKerja::where('id_disnaker', $id)->whereNotIn('nmr', $excludedNumbers)->get();
        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_a', [
            'sub_title' => 'Laporan IPK-III-1',
            'title' => 'Data Laporan IPK-III-1',
            'datalaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
     }
}
