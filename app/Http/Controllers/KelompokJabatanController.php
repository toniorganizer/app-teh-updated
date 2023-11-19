<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataKelompokJabatan;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CetakLaporanIIIPusat;
use App\Imports\KelompokJabatanImport;

class KelompokJabatanController extends Controller
{

    public function index(){
        $data = DataKelompokJabatan::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        // dd($aturan);
        $excludedNumbers = ['Sub Total','TOTAL', 'ANGGOTA ANGKATAN BERSENJATA (KECUALI','ANGGOTA BADAN LEGISLATIF, PEJABAT TINGGI', 'TENAGA PROFESIONAL', 'TEKNISI DAN KELOMPOK JABATAN YANG', 'PENATA USAHA','TENAGA USAHA JASA DAN PENJUAL DAGANGAN','PEKERJA-PEKERJA KETERAMPILAN BIDANG','PEKERJA KASAR TERAMPIL DAN SEJENISNYA','OPERATOR DAN PERAKIT MESIN DAN MESIN','PEKERJA KASAR'];
        $datalaporan = DataKelompokJabatan::where('id_disnaker', Auth::user()->email)->whereNotIn('judul_kj', $excludedNumbers)->paginate(20);


        $numbers = [
            '0110', '1110', '1120', '1130', '1141', '1142', '1143', '1210', '1221', '1223', '1224', '1225', '1226', '1227', '1228', '1229', '1231', '1232', '1233', '1234', '1235', '1236', '1237', '1311', '1314', '1315', '1316', '1317', '1318', '1319', '2111', '2112', '2113', '2114', '2121', '2122', '2131', '2132', '2139', '2141', '2142', '2143', '2144', '2145', '2146', '2147', '2148', '2149', '2211', '2212', '2213', '2221', '2222', '2230', '2310', '2320', '2330', '2331', '2332', '2340', '2351', '2352', '2411', '2412', '2419', '2421', '2422', '2429', '2431', '2432', '2441', '2442', '2443', '2444', '2445', '2446', '2451', '2452', '2453', '2454', '2455', '2460', '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3121', '3122', '3123', '3131', '3132', '3133', '3141', '3142', '3143', '3145', '3151', '3152', '3211', '3212', '3213', '3221', '3222', '3223', '3224', '3225', '3226', '3227', '3228', '3229', '3231', '3232', '3241', '3242', '3310', '3320', '3330', '3340', '3411', '3412', '3413', '3414', '3415', '3416', '3417', '3421', '3422', '3423', '3429', '3431', '3432', '3433', '3434', '3439', '3441', '3442', '3443', '3444', '3449', '3450', '3460', '3471', '3472', '3473', '3474', '3475', '3480', '4111', '4112', '4113', '4114', '4115', '4121', '4122', '4131', '4132', '4133', '4141', '4142', '4143', '4144', '4190', '4211', '4212', '4213', '4214', '4215', '4222', '4223', '5111', '5112', '5113', '5121', '5122', '5123', '5131', '5132', '5139', '5141', '5142', '5143', '5149', '5151', '5152', '5161', '5162', '5163', '5169', '5210', '5220', '5230', '6111', '6112', '6113', '6114', '6121', '6122', '6123', '6129', '6130', '6141', '6142', '6151', '6152', '6153', '6154', '6210', '7111', '7112', '7121', '7122', '7123', '7124', '7129', '7131', '7132', '7133', '7134', '7135', '7136', '7137', '7141', '7142', '7143', '7211', '7212', '7213', '7214', '7215', '7216', '7221', '7222', '7223', '7224', '7231', '7232', '7233', '7241', '7242', '7243', '7244', '7245', '7311', '7312', '7313', '7321', '7322', '7323', '7324', '7331', '7332', '7341', '7342', '7343', '7344', '7345', '7346', '7411', '7412', '7413', '7414', '7415', '7416', '7421', '7422', '7423', '7424', '7431', '7432', '7433', '7434', '7435', '7436', '7437', '7441', '7442', '8111', '8112', '8113', '8121', '8122', '8124', '8131', '8139', '8141', '8142', '8143', '8151', '8152', '8153', '8154', '8155', '8159', '8161', '8162', '8163', '8171', '8172', '8211', '8212', '8221', '8222', '8223', '8224', '8229', '8231', '8232', '8240', '8251', '8252', '8253', '8261', '8262', '8263', '8264', '8265', '8269', '8271', '8272', '8273', '8274', '8275', '8281', '8282', '8283', '8284', '8285', '8286', '8290', '8311', '8312', '8321', '8322', '8323', '8324', '8331', '8332', '8333', '8334', '8340', '9111', '9112', '9113', '9120', '9131', '9132', '9133', '9141', '9142', '9151', '9152', '9153', '9162', '9211', '9212', '9213', '9311', '9312', '9313', '9321', '9322', '9331', '9332', '9333'
        ];
        
        

        $lap = DB::table('data_kelompok_jabatans')
            ->whereIn('nmr', $numbers)
            ->whereNotIn('judul_kj', $excludedNumbers)
            ->select('nmr', 'judul_kj', DB::raw('SUM(sisa_l_kj) as sisa_l'), DB::raw('SUM(sisa_p_kj) as sisa_p'), DB::raw('SUM(terdaftar_l_kj) as terdaftar_l'), DB::raw('SUM(terdaftar_p_kj) as terdaftar_p'), DB::raw('SUM(penempatan_l_kj) as penempatan_l'), DB::raw('SUM(penempatan_p_kj) as penempatan_p'), DB::raw('SUM(hapus_l_kj) as hapus_l'), DB::raw('SUM(hapus_p_kj) as hapus_p'))
            ->groupBy('nmr', 'judul_kj')
            ->oldest('id')
            ->paginate(20);

        // dd($lap);

        return view('Dashboard.admin.data_laporan_III', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'dataLaporanKab' => $datalaporan,
            'sub_title' => 'Laporan IPK-III-3',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }

    
    public function importDataIPK3(Request $request){

            $bulan1 = $request->input('tgl1');
            $bulan2 = $request->input('tgl2');   
            
            Excel::import(new KelompokJabatanImport($bulan1, $bulan2), $request->file('file'));
            
            return redirect('/laporan-ipk-3')->with('success', 'Import data berhasil dilakukan!');
        
     }

     public function deleteLaporanIII($id){
        DataKelompokJabatan::where('id_disnaker', $id)->delete();
        return redirect('/laporan-ipk-3')->with('success', 'Hapus data berhasil dilakukan');
     } 

     public function editLaporanIII(Request $request, $id){
        if($request->id_disnaker){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKelompokJabatan::where('nmr', $id)->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_kj', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKelompokJabatan::where('nmr', $id)->where('id_disnaker', Auth::user()->email)->whereNotIn('judul_kj', $notIn)->first();
        }

        return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_c', [
            'sub_title' => 'Laporan IPK-III-3',
            'title' => 'DataIPK',
            'data' => $data
        ]);

    }

    public function updateLaporanIII(Request $request, $id){
        // dd($request->id_disnaker);
        $notIn = ['BH & TIDAK TAMAT SD','SD'];
        DataKelompokJabatan::where('nmr', $id)->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_kj', $notIn)->update([
            'sisa_l_kj' => $request->{'sisa_l'},
            'sisa_p_kj' => $request->{'sisa_p'},
            'terdaftar_l_kj' => $request->{'terdaftar_l'},
            'terdaftar_p_kj' => $request->{'terdaftar_p'},
            'penempatan_l_kj' => $request->{'penempatan_l'},
            'penempatan_p_kj' => $request->{'penempatan_p'},
            'hapus_l_kj' => $request->{'hapus_l'},
            'hapus_p_kj' => $request->{'hapus_p'},
        ]);

        if(Auth::user()->email == 'disnaker@gmail.com'){
            return redirect('/detail-laporan-kab-iii/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
        }else{
            return redirect('/laporan-ipk-3')->with('success', 'Update data berhasil dilakukan');
        }
     }

     public function CetakLaporanIII($id){
    // dd($id);
    $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
    $fileName = 'Laporan-IPK-3-'. $data->nama_lembaga .'.xlsx';
    return Excel::download(new CetakLaporanIIIPusat($id), $fileName);

    }

    public function detailLaporanKabIII($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        // dd($id);
        $excludedNumbers = ['Sub Total','TOTAL', 'ANGGOTA ANGKATAN BERSENJATA (KECUALI','ANGGOTA BADAN LEGISLATIF, PEJABAT TINGGI', 'TENAGA PROFESIONAL', 'TEKNISI DAN KELOMPOK JABATAN YANG', 'PENATA USAHA','TENAGA USAHA JASA DAN PENJUAL DAGANGAN','PEKERJA-PEKERJA KETERAMPILAN BIDANG','PEKERJA KASAR TERAMPIL DAN SEJENISNYA','OPERATOR DAN PERAKIT MESIN DAN MESIN','PEKERJA KASAR'];
        $datalaporan = DataKelompokJabatan::where('id_disnaker', $id)->whereNotIn('judul_kj', $excludedNumbers)->paginate(20);

        // dd($datalaporan);

        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_c', [
            'sub_title' => 'Laporan IPK-III-3',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
     }
}
