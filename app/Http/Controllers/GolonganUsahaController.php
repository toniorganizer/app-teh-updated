<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DataGolonganUsaha;
use Illuminate\Support\Facades\DB;
use App\Models\PemangkuKepentingan;
use App\Exports\CetakLaporanVIPusat;
use App\Http\Controllers\Controller;
use App\Imports\GolonganUsahaImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class GolonganUsahaController extends Controller
{
    public function index(){
        $data = DataGolonganUsaha::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        $excludedNumbers = ['Sub Total','Total'];
        if($aturan->id_disnaker_kab == 0){
            $datalaporan = DataGolonganUsaha::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->whereNotIn('judul_gu', $excludedNumbers)->paginate(20);
        }else{
            $datalaporan = DataGolonganUsaha::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Laporan')->whereNotIn('judul_gu', $excludedNumbers)->paginate(20);
        }

        $lap = DB::table('data_golongan_usahas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_golongan_usahas.id_disnaker')->where('role_acc', 1)
            ->whereNotIn('judul_gu', $excludedNumbers)->where('type','Laporan')
            ->select('nmr', 'judul_gu', DB::raw('SUM(sisa_l_gu) as sisa_l'), DB::raw('SUM(sisa_p_gu) as sisa_p'), DB::raw('SUM(terdaftar_l_gu) as terdaftar_l'), DB::raw('SUM(terdaftar_p_gu) as terdaftar_p'), DB::raw('SUM(penempatan_l_gu) as penempatan_l'), DB::raw('SUM(penempatan_p_gu) as penempatan_p'), DB::raw('SUM(hapus_l_gu) as hapus_l'), DB::raw('SUM(hapus_p_gu) as hapus_p'))
            ->groupBy('nmr', 'judul_gu')
            ->oldest('id')
            ->paginate(20);

        $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        return view('dashboard.admin.data_laporan_vi', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'sidebar_data' => $sidebar_data,
            'dataLaporanKab' => $datalaporan,
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }

    public function importDataIPK6(Request $request){
        $role_importlaporan = DataGolonganUsaha::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->first();
        $role_importlampiran = DataGolonganUsaha::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->first();
        if($role_importlaporan){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }else{
            $bulan1 = $request->input('tgl1');
            $bulan2 = $request->input('tgl2');   

            Excel::import(new GolonganUsahaImport($bulan1, $bulan2), $request->file('file'));
            
            return redirect('/laporan-ipk-6')->with('success', 'Import data berhasil dilakukan!');
        }
        if($role_importlampiran){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }else{
            $bulan1 = $request->input('tgl1');
            $bulan2 = $request->input('tgl2');   

            Excel::import(new GolonganUsahaImport($bulan1, $bulan2), $request->file('file'));
            
            return redirect('/laporan-ipk-6')->with('success', 'Import data berhasil dilakukan!');
        }
    }

    public function deleteLaporanVI($id){
        DataGolonganUsaha::where('id_disnaker', $id)->delete();
        return redirect('/laporan-ipk-6')->with('success', 'Hapus data berhasil dilakukan');
     } 

    
     public function editLaporanVI(Request $request, $id){
        if($request->id_disnaker){
            if($request->type == 'Lampiran'){
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataGolonganUsaha::where('nmr', $id)->Where('id_disnaker', $request->id_disnaker)->where('type','Lampiran')->whereNotIn('judul_gu', $notIn)->first();
            }else{
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataGolonganUsaha::where('nmr', $id)->Where('id_disnaker', $request->id_disnaker)->where('type','Laporan')->whereNotIn('judul_gu', $notIn)->first();
            }
        }
        elseif($request->type == "Lampiran")
        {$notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataGolonganUsaha::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul_gu', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataGolonganUsaha::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->where('type','Laporan')->whereNotIn('judul_gu', $notIn)->first();
        }

        if($request->type == "Laporan"){
        return view('dashboard.pemangku-kepentingan.edit_data_laporan_iii_f', [
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'data' => $data
        ]);
        }else{
            return view('dashboard.pemangku-kepentingan.edit_data_laporan_iii_f', [
                'sub_title' => 'Lampiran',
                'title' => 'DataIPK',
                'data' => $data
            ]);
        }

    }

    public function updateLaporanVI(Request $request, $id){
        if($request->type == "Laporan"){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            DataGolonganUsaha::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_gu', $notIn)->update([
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
        }else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            DataGolonganUsaha::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_gu', $notIn)->update([
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
                return redirect('/detail-lampiran-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/lampiran')->with('success', 'Update data berhasil dilakukan');
            }
        }
     }

     public function CetakLaporanVI($id){
        $item = DataGolonganUsaha::where('id_disnaker', $id)->first();
        $data_user = User::where('email', $id)->first();
        $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
        if($data_user->icon == 0){
            return redirect('/laporan-ipk-6')->with('success', 'Mohon maaf, silahkan lakukan upload lambang lembaga terlebih dahulu pada menu profile!!!');
        }else{
            $lambang= $data_user->icon;
        }
        if($id == 'disnaker@gmail.com' || $data->status_lembaga == 3){
            $fileName = 'Laporan-IPK-6-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakLaporanVIPusat($id, $lambang), $fileName);
        }elseif($item == null){
            return redirect('/laporan-ipk-6')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
        $fileName = 'Laporan-IPK-6-'. $data->nama_lembaga .'.xlsx';
        return Excel::download(new CetakLaporanVIPusat($id, $lambang), $fileName);
        }
    }

    
    public function detailLaporanKabVI($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $excludedNumbers = ['Sub Total','Total', 'BH & TIDAK TAMAT SD', 'SD', 'SLTP UMUM','SLTP KEJURUAN', 'SETINGKAT SLTP','PENDIDIKAN MENENGAH ATAS','SMK - TEKNOLOGI DAN REKAYASA','SMK - TEKNOLOGI INFORMASI DAN KOMUNIKASI','SMK - KESEHATAN','SMK - SENI, KERAJINAN DAN PARIWISATA','SMK - AGRIBISNIS DAN AGROTEKNOLOGI','SMK - BISNIS DAN MANAJEMEN','SETINGKAT SMU LAINNYA','DIPLOMA I / AKTA I / DIPLOMA II / AKTA II','DIPLOMA III / AKTA III/ AKADEMI/S.MUDA','SARJANA ( S1 )','SARJANA ( S2 )', 'SETINGKAT SLTP', '0'];
        $datalaporan = DataGolonganUsaha::where('id_disnaker', $id)->where('type','Laporan')->whereNotIn('judul_gu', $excludedNumbers)->paginate(20);
        return view('dashboard.pemangku-kepentingan.detail_laporan_kab_f', [
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
    }
}
