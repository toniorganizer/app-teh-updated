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

    public function editLaporanII(Request $request, $id){
        if($request->id_disnaker){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataJenisPendidikan::where('nmr', $id)->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataJenisPendidikan::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }

        // dd($data);

        //  dd($data);
        return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_b', [
            'sub_title' => 'Laporan IPK-III-2',
            'title' => 'DataIPK',
            'data' => $data
        ]);

    }

    public function updateLaporanII(Request $request, $id){
        // dd($request->id_disnaker);
        $notIn = ['BH & TIDAK TAMAT SD','SD'];
        DataJenisPendidikan::where('nmr', $id)->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->update([
            'sisa_l' => $request->{'sisa_l'},
            'sisa_p' => $request->{'sisa_p'},
            'terdaftar_l' => $request->{'terdaftar_l'},
            'terdaftar_p' => $request->{'terdaftar_p'},
            'penempatan_l' => $request->{'penempatan_l'},
            'penempatan_p' => $request->{'penempatan_p'},
            'hapus_l' => $request->{'hapus_l'},
            'hapus_p' => $request->{'hapus_p'},
        ]);

        if(Auth::user()->email == 'disnaker@gmail.com'){
            return redirect('/detail-laporan-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
        }else{
            return redirect('/laporan-ipk-2')->with('success', 'Update data berhasil dilakukan');
        }
     }

    
     public function detailLaporanKabII($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        // dd($nama);
        $excludedNumbers = ['Sub Total', 'BH & TIDAK TAMAT SD', 'SD', 'SLTP UMUM','SLTP KEJURUAN', 'SETINGKAT SLTP','PENDIDIKAN MENENGAH ATAS','SMK - TEKNOLOGI DAN REKAYASA','SMK - TEKNOLOGI INFORMASI DAN KOMUNIKASI','SMK - KESEHATAN','SMK - SENI, KERAJINAN DAN PARIWISATA','SMK - AGRIBISNIS DAN AGROTEKNOLOGI','SMK - BISNIS DAN MANAJEMEN','SETINGKAT SMU LAINNYA','DIPLOMA I / AKTA I / DIPLOMA II / AKTA II','DIPLOMA III / AKTA III/ AKADEMI/S.MUDA','SARJANA ( S1 )','SARJANA ( S2 )', '0'];
        $datalaporan = DataJenisPendidikan::where('id_disnaker', $id)->whereNotIn('judul', $excludedNumbers)->paginate(20);
        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_b', [
            'sub_title' => 'Laporan IPK-III-2',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
     }
}
