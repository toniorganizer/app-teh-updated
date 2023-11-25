<?php

namespace App\Http\Controllers;

use App\Exports\CetakPencariPenerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataPencariPenerima;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use App\Imports\PencariPenerimaImport;
use App\Models\DataPencariKerja;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PencariPenerimaController extends Controller
{
    public function index(){
        $data = DataPencariPenerima::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        $excludedNumbers = ['Sub Total','Total'];
        $datalaporan = DataPencariPenerima::where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $excludedNumbers)->paginate(20);

        $lap = DB::table('data_pencari_penerimas')
            ->whereNotIn('judul', $excludedNumbers)
            ->select('nmr', 'judul', 'jmll', 'jmlp', DB::raw('SUM(akll) as akll'), DB::raw('SUM(aklp) as aklp'), DB::raw('SUM(akadl) as akadl'), DB::raw('SUM(akadp) as akadp'), DB::raw('SUM(akanl) as akanl'), DB::raw('SUM(akanp) as akanp'))
            ->groupBy('nmr', 'judul', 'jmll', 'jmlp')
            ->oldest('id')
            ->paginate(20);

        return view('Dashboard.admin.data_laporan_viii', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'dataLaporanKab' => $datalaporan,
            'sub_title' => 'Laporan IPK-III-6',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }

    
    public function importDataIPK8(Request $request){
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');   

        Excel::import(new PencariPenerimaImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/laporan-ipk-8')->with('success', 'Import data berhasil dilakukan!');
    }

    public function deleteLaporanVIII($id){
        DataPencariPenerima::where('id_disnaker', $id)->delete();
        return redirect('/laporan-ipk-8')->with('success', 'Hapus data berhasil dilakukan');
    }

    public function editLaporanVIII(Request $request, $id){
        if($request->id_disnaker){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataPencariPenerima::where('nmr', $id)->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataPencariPenerima::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }

        return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_h', [
            'sub_title' => 'Laporan IPK-III-8',
            'title' => 'DataIPK',
            'data' => $data
        ]);
    }

    public function updateLaporanVIII(Request $request, $id){
        DataPencariPenerima::where('nmr', $id)->where('id_disnaker', $request->id_disnaker)->update([
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
     }

     public function CetakLaporanVIII($id){
        $item = DataPencariPenerima::where('id_disnaker', $id)->first();
        if($id == 'disnaker@gmail.com'){
            $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
            $fileName = 'Laporan-IPK-8-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakPencariPenerima($id), $fileName);
        }elseif($item == null){
            return redirect('/laporan-ipk-8')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
            $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
            $fileName = 'Laporan-IPK-8-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakPencariPenerima($id), $fileName);
        }
    }

    public function detailLaporanKabVIII($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $excludedNumbers = ['Sub Total','Total'];
        $datalaporan = DataPencariPenerima::where('id_disnaker', $id)->whereNotIn('judul', $excludedNumbers)->paginate(20);
        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_h', [
            'sub_title' => 'Laporan IPK-III-8',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
    }


}