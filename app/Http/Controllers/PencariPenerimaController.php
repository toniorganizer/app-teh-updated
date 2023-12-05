<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\DB;
use App\Models\DataPencariPenerima;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CetakPencariPenerima;
use App\Imports\PencariPenerimaImport;
use Illuminate\Support\Facades\Redirect;

class PencariPenerimaController extends Controller
{
    public function index(){
        $data = DataPencariPenerima::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        $excludedNumbers = ['Sub Total','Total'];
        if($aturan->id_disnaker_kab == 0){
            $datalaporan = DataPencariPenerima::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->whereNotIn('judul', $excludedNumbers)->paginate(20);
        }else{
            $datalaporan = DataPencariPenerima::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Laporan')->whereNotIn('judul', $excludedNumbers)->paginate(20);
        }

        $lap = DB::table('data_pencari_penerimas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_penerimas.id_disnaker')->where('role_acc', 1)
            ->whereNotIn('judul', $excludedNumbers)->where('type','Laporan')
            ->select('nmr', 'judul', 'jmll', 'jmlp', DB::raw('SUM(akll) as akll'), DB::raw('SUM(aklp) as aklp'), DB::raw('SUM(akadl) as akadl'), DB::raw('SUM(akadp) as akadp'), DB::raw('SUM(akanl) as akanl'), DB::raw('SUM(akanp) as akanp'))
            ->groupBy('nmr', 'judul', 'jmll', 'jmlp')
            ->oldest('id')
            ->paginate(20);

        $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();

        return view('Dashboard.admin.data_laporan_viii', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'dataLaporanKab' => $datalaporan,
            'sidebar_data' => $sidebar_data,
            'sub_title' => 'Laporan IPK-III-8',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }

    
    public function importDataIPK8(Request $request){
        $role_importlaporan = DataPencariPenerima::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->first();
        $role_importlampiran = DataPencariPenerima::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->first();
        if($role_importlaporan){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }elseif($role_importlampiran){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }else{
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');   

        Excel::import(new PencariPenerimaImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/laporan-ipk-8')->with('success', 'Import data berhasil dilakukan!');
        }
    }

    public function deleteLaporanVIII($id){
        DataPencariPenerima::where('id_disnaker', $id)->where('type','Laporan')->delete();
        return redirect('/laporan-ipk-8')->with('success', 'Hapus data berhasil dilakukan');
    }

    public function editLaporanVIII(Request $request, $id){
        if($request->id_disnaker){
            if($request->type == 'Lampiran'){
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataPencariPenerima::where('nmr', $id)->where('type','Lampiran')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
            }else{
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataPencariPenerima::where('nmr', $id)->where('type','Laporan')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
            }
        }
        elseif($request->type == 'Lampiran'){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataPencariPenerima::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataPencariPenerima::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }

        if($request->type == "Laporan"){
            return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_h', [
                'sub_title' => 'Laporan IPK-III-8',
                'title' => 'DataIPK',
                'data' => $data
            ]);
        }else{
            return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_h', [
                'sub_title' => 'Lampiran',
                'title' => 'DataIPK',
                'data' => $data
            ]);
        }

    }

    public function updateLaporanVIII(Request $request, $id){
        if($request->type == "Laporan"){
            DataPencariPenerima::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', $request->id_disnaker)->update([
                'akll' => $request->{'akll'},
                'aklp' => $request->{'aklp'},
                'akadl' => $request->{'akadl'},
                'akadp' => $request->{'akadp'},
                'akanl' => $request->{'akanl'},
                'akanp' => $request->{'akanp'},
            ]);

            if(Auth::user()->email == 'disnaker@gmail.com'){
                return redirect('/detail-laporan-kab-viii/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/laporan-ipk-8')->with('success', 'Update data berhasil dilakukan');
            }
        }else{
            DataPencariPenerima::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', $request->id_disnaker)->update([
                'akll' => $request->{'akll'},
                'aklp' => $request->{'aklp'},
                'akadl' => $request->{'akadl'},
                'akadp' => $request->{'akadp'},
                'akanl' => $request->{'akanl'},
                'akanp' => $request->{'akanp'},
            ]);
            if(Auth::user()->email == 'disnaker@gmail.com'){
                return redirect('/detail-lampiran-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/lampiran')->with('success', 'Update data berhasil dilakukan');
            }
        }
     }

     public function CetakLaporanVIII($id){
        $item = DataPencariPenerima::where('id_disnaker', $id)->first();
        $data_user = User::where('email', $id)->first();
        $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
        if($data_user->icon == 0){
            return redirect('/laporan-ipk-8')->with('success', 'Mohon maaf, silahkan lakukan upload lambang lembaga terlebih dahulu pada menu profile!!!');
        }else{
            $lambang= $data_user->icon;
        }
        if($id == 'disnaker@gmail.com' || $data->status_lembaga == 3){
            $fileName = 'Laporan-IPK-8-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakPencariPenerima($id, $lambang), $fileName);
        }elseif($item == null){
            return redirect('/laporan-ipk-8')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
            $fileName = 'Laporan-IPK-8-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakPencariPenerima($id, $lambang), $fileName);
        }
    }

    public function detailLaporanKabVIII($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $excludedNumbers = ['Sub Total','Total'];
        $datalaporan = DataPencariPenerima::where('id_disnaker', $id)->where('type','Laporan')->whereNotIn('judul', $excludedNumbers)->paginate(20);
        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_h', [
            'sub_title' => 'Laporan IPK-III-8',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
    }


}
