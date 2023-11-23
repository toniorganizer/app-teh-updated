<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataGolonganUsaha;
use Illuminate\Support\Facades\DB;
use App\Models\PemangkuKepentingan;
use App\Exports\CetakLaporanVIPusat;
use App\Http\Controllers\Controller;
use App\Imports\GolonganUsahaImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class GolonganUsahaController extends Controller
{
    public function index(){
        $data = DataGolonganUsaha::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        $excludedNumbers = ['Sub Total','Total'];
        $datalaporan = DataGolonganUsaha::where('id_disnaker', Auth::user()->email)->whereNotIn('judul_gu', $excludedNumbers)->paginate(20);

        $lap = DB::table('data_golongan_usahas')
            ->whereNotIn('judul_gu', $excludedNumbers)
            ->select('nmr', 'judul_gu', DB::raw('SUM(sisa_l_gu) as sisa_l'), DB::raw('SUM(sisa_p_gu) as sisa_p'), DB::raw('SUM(terdaftar_l_gu) as terdaftar_l'), DB::raw('SUM(terdaftar_p_gu) as terdaftar_p'), DB::raw('SUM(penempatan_l_gu) as penempatan_l'), DB::raw('SUM(penempatan_p_gu) as penempatan_p'), DB::raw('SUM(hapus_l_gu) as hapus_l'), DB::raw('SUM(hapus_p_gu) as hapus_p'))
            ->groupBy('nmr', 'judul_gu')
            ->oldest('id')
            ->paginate(20);

        return view('Dashboard.admin.data_laporan_vi', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'dataLaporanKab' => $datalaporan,
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }

    public function importDataIPK6(Request $request){
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');   

        Excel::import(new GolonganUsahaImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/laporan-ipk-6')->with('success', 'Import data berhasil dilakukan!');
    }

    public function deleteLaporanVI($id){
        DataGolonganUsaha::where('id_disnaker', $id)->delete();
        return redirect('/laporan-ipk-6')->with('success', 'Hapus data berhasil dilakukan');
     } 

    
     public function editLaporanVI(Request $request, $id){
        if($request->id_disnaker){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataGolonganUsaha::where('nmr', $id)->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_gu', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataGolonganUsaha::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->whereNotIn('judul_gu', $notIn)->first();
        }

        return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_f', [
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'data' => $data
        ]);

    }

    public function updateLaporanVI(Request $request, $id){
        $notIn = ['BH & TIDAK TAMAT SD','SD'];
        DataGolonganUsaha::where('nmr', $id)->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_gu', $notIn)->update([
            'sisa_l_gu' => $request->{'sisa_l'},
            'sisa_p_gu' => $request->{'sisa_p'},
            'terdaftar_l_gu' => $request->{'terdaftar_l'},
            'terdaftar_p_gu' => $request->{'terdaftar_p'},
            'penempatan_l_gu' => $request->{'penempatan_l'},
            'penempatan_p_gu' => $request->{'penempatan_p'},
            'hapus_l_gu' => $request->{'hapus_l'},
            'hapus_p_gu' => $request->{'hapus_p'},
        ]);

        if(Auth::user()->email == 'disnaker@gmail.com'){
            return redirect('/detail-laporan-kab-vi/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
        }else{
            return redirect('/laporan-ipk-6')->with('success', 'Update data berhasil dilakukan');
        }
     }

     public function CetakLaporanVI($id){
        $item = DataGolonganUsaha::where('id_disnaker', $id)->first();
        if($id == 'disnaker@gmail.com'){
            $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
            $fileName = 'Laporan-IPK-6-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakLaporanVIPusat($id), $fileName);
        }elseif($item == null){
            return redirect('/laporan-ipk-6')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
        $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $fileName = 'Laporan-IPK-6-'. $data->nama_lembaga .'.xlsx';
        return Excel::download(new CetakLaporanVIPusat($id), $fileName);
        }
    }

    
    public function detailLaporanKabVI($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $excludedNumbers = ['Sub Total','Total', 'BH & TIDAK TAMAT SD', 'SD', 'SLTP UMUM','SLTP KEJURUAN', 'SETINGKAT SLTP','PENDIDIKAN MENENGAH ATAS','SMK - TEKNOLOGI DAN REKAYASA','SMK - TEKNOLOGI INFORMASI DAN KOMUNIKASI','SMK - KESEHATAN','SMK - SENI, KERAJINAN DAN PARIWISATA','SMK - AGRIBISNIS DAN AGROTEKNOLOGI','SMK - BISNIS DAN MANAJEMEN','SETINGKAT SMU LAINNYA','DIPLOMA I / AKTA I / DIPLOMA II / AKTA II','DIPLOMA III / AKTA III/ AKADEMI/S.MUDA','SARJANA ( S1 )','SARJANA ( S2 )', 'SETINGKAT SLTP', '0'];
        $datalaporan = DataGolonganUsaha::where('id_disnaker', $id)->whereNotIn('judul_gu', $excludedNumbers)->paginate(20);
        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_f', [
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
    }
}
