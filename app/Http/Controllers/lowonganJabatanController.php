<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\CetakLaporanVPusat;
use App\Models\DataLowonganJabatan;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LowonganJabatanImport;
use Illuminate\Support\Facades\Redirect;

class lowonganJabatanController extends Controller
{
    public function index(){
        $data = DataLowonganJabatan::get();
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();
        $excludedNumbers = ['Sub Total','Total', 'BH & TIDAK TAMAT SD', 'SD', 'SLTP UMUM','SLTP KEJURUAN', 'SETINGKAT SLTP','PENDIDIKAN MENENGAH ATAS','SMK - TEKNOLOGI DAN REKAYASA','SMK - TEKNOLOGI INFORMASI DAN KOMUNIKASI','SMK - KESEHATAN','SMK - SENI, KERAJINAN DAN PARIWISATA','SMK - AGRIBISNIS DAN AGROTEKNOLOGI','SMK - BISNIS DAN MANAJEMEN','SETINGKAT SMU LAINNYA','DIPLOMA I / AKTA I / DIPLOMA II / AKTA II','DIPLOMA III / AKTA III/ AKADEMI/S.MUDA','SARJANA ( S1 )','SARJANA ( S2 )', 'SETINGKAT SLTP', '0'];
        if($aturan->id_disnaker_kab == 0){
            $datalaporan = DataLowonganJabatan::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->whereNotIn('judul_lj', $excludedNumbers)->paginate(20);
        }else{
            $datalaporan = DataLowonganJabatan::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Laporan')->whereNotIn('judul_lj', $excludedNumbers)->paginate(20);
        }

        $numbers = [1101, 1102, 1103, 1199, 2101, 2102, 2104, 2103, 2199, 3801 ,3002, 3100, 3101, 3102, 3103, 3104, 3105, 3106, 3107, 3108, 3109, 3110, 3111, 3112, 3113, 3114, 3115, 3116, 3117, 3118, 3119, 3200, 3201, 3202, 3203, 3700, 3701, 3702, 02, 4000, 4100, 4101, 4102, 4103, 4104, 4105, 4106, 4107, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 4116, 4118, 4119, 4108, 4121, 4122, 4123, 4124, 4125, 4126, 4127, 4128, 4129, 4199, 3301, 3302, 3401, 3402, 3403, 3404, 3405, 3406, 3407, 3501, 3502, 3503, 3504, 3505, 3506, 3507, 3601, 3602, 3603, 3701, 3702, 4201, 4202, 4203, 4204, 4205, 4206, 4208, 4209, 4210, 4211, 4212, 4213, 4214, 4215, 4216, 4217, 4218, 4219, 4220, 4221, 4222, 4223, 4226, 4227, 4228, 4229, 4230, 4231, 5101, 5102, 5103, 5104, 5105, 5106, 5107, 5108, 5109, 5110, 5111, 5112, 5201, 5202, 5203, 5204, 5205, 5206, 5207, 5208, 5209, 5210, 5212, 5213, 5214, 5215, 5216, 5217, 5218, 5219, 5220, 5221, 5222, 5301, 5302, 5303, 5304, 5305, 5306, 5307, 5308, 5309, 5310, 5311, 5312, 5401, 5402, 5403, 5404, 5405, 5406, 5407, 5408, 5409, 5410, 5501, 5502, 5503, 5504, 5505, 5506, 5507, 5508, 5509, 5510, 5511, 5512, 5513, 5515, 5516, 5517, 5518, 5519, 5525, 5524, 5526, 5527, 5528, 5529, 5530, 5531, 5532, 5533, 5534, 5535, 5599, 5601, 5602, 5604, 5605, 5606, 5607, 5608, 5609, 5610, 5611, 5612, 5613, 5614, 5615, 5616, 5621, 5622, 5623, 5624, 5625, 5626, 5627, 5628, 5629, 5630, 5631, 5632, 5620, 5634, 5636, 5637, 5638, 5640, 5641, 5642, 5643, 5644, 5645, 5646, 6101, 6102, 6103, 6104, 6105, 6106, 6107, 6108, 6109, 6199, 6201, 6202, 6203, 6204, 6205, 6206, 6207, 6208, 6209, 6210, 6211, 6212, 6213, 6214, 6215, 6216, 6217, 6299, 6223, 6301, 6302, 6303, 6304, 6305, 6306, 6307, 6308, 6309, 6310, 6311, 6312, 6401, 6402, 6403, 6404, 6405, 6501, 6502, 6503, 6504, 6505, 6506, 6507, 6508, 6509, 6510, 6511, 6512, 6513, 6514, 6515, 6516, 6519, 6518, 6520, 6521, 6522, 6523, 6524, 6525, 6526, 6527, 6528, 6529, 6599, 6601, 6602, 6603, 6604, 6605,6606, 6607, 6608, 6609, 6610, 6611, 6612, 6613, 6614, 6615, 6616, 6617, 6618, 6619, 6620, 6621, 6622, 6623, 6624, 6625, 6626, 6627, 6628, 6629, 6630, 6631, 6632, 6633, 6634, 6635, 6636, 6637, 6638, 6639, 6699, 7101, 7103, 7104, 7105, 7106, 7108, 7109, 7110, 7201, 7202, 7203, 7204, 7205, 7211, 7212, 7214, 7217, 7299, 7301, 7302, 7303, 7304, 7305, 7306, 7307, 7308, 7309, 7310, 7311, 7312, 7401, 7402, 7403, 7404, 7405, 7501, 7502, 7503, 7504, 7505, 7506, 7507, 7508, 7509, 7510, 7511, 7514, 7516, 7520, 7521, 7522, 7523, 7524, 7525, 7526, 7527, 7528, 7529, 7529, 7601, 7602, 7603, 7605, 7606, 7607, 7608, 7609, 7610, 7611, 7612, 7613, 7614, 7616, 7617, 7618, 7619, 7620, 7621, 7622, 7623, 7624, 7625, 7626, 7627, 7628, 7629, 7630, 7631, 7632, 7633, 7634, 7635, 7636, 7637, 7639, 7699];


        $lap = DB::table('data_lowongan_jabatans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_lowongan_jabatans.id_disnaker')->where('role_acc', 1)
            ->whereNotIn('judul_lj', $excludedNumbers)->where('type','Laporan')
            ->select('nmr', 'judul_lj', DB::raw('SUM(sisa_l_lj) as sisa_l'), DB::raw('SUM(sisa_p_lj) as sisa_p'), DB::raw('SUM(terdaftar_l_lj) as terdaftar_l'), DB::raw('SUM(terdaftar_p_lj) as terdaftar_p'), DB::raw('SUM(penempatan_l_lj) as penempatan_l'), DB::raw('SUM(penempatan_p_lj) as penempatan_p'), DB::raw('SUM(hapus_l_lj) as hapus_l'), DB::raw('SUM(hapus_p_lj) as hapus_p'))
            ->groupBy('nmr', 'judul_lj')
            ->oldest('id')
            ->paginate(20);

        $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();

        return view('Dashboard.admin.data_laporan_V', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'sidebar_data' => $sidebar_data,
            'dataLaporanKab' => $datalaporan,
            'sub_title' => 'Laporan IPK-III-5',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }

    public function importDataIPK5(Request $request){
        $role_importlaporan = DataLowonganJabatan::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->first();
        $role_importlampiran = DataLowonganJabatan::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->first();
        if($role_importlaporan){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }elseif($role_importlampiran){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }else{
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');   

        Excel::import(new LowonganJabatanImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/laporan-ipk-5')->with('success', 'Import data berhasil dilakukan!');
        }
    }

    public function deleteLaporanV($id){
        DataLowonganJabatan::where('id_disnaker', $id)->where('type','Laporan')->delete();
        return redirect('/laporan-ipk-5')->with('success', 'Hapus data berhasil dilakukan');
     } 

    
     public function editLaporanV(Request $request, $id){
        if($request->id_disnaker){
            if($request->type == 'Lampiran'){
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataLowonganJabatan::where('nmr', $id)->where('type','Lampiran')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_lj', $notIn)->first();
            }else{
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataLowonganJabatan::where('nmr', $id)->where('type','Laporan')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_lj', $notIn)->first();
            }
        }
        elseif($request->type == "Lampiran"){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataLowonganJabatan::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul_lj', $notIn)->first();
        }else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataLowonganJabatan::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul_lj', $notIn)->first();
        }


        if($request->type == "Laporan"){
            return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_e', [
                'sub_title' => 'Laporan IPK-III-5',
                'title' => 'DataIPK',
                'data' => $data
            ]);
        }else{
            return view('Dashboard.pemangku-kepentingan.edit_data_laporan_iii_e', [
                'sub_title' => 'Lampiran',
                'title' => 'DataIPK',
                'data' => $data
            ]);
        }

    }

    public function updateLaporanV(Request $request, $id){
        if($request->type == "Laporan"){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            DataLowonganJabatan::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_lj', $notIn)->update([
                'sisa_l_lj' => $request->{'sisa_l'},
                'sisa_p_lj' => $request->{'sisa_p'},
                'terdaftar_l_lj' => $request->{'terdaftar_l'},
                'terdaftar_p_lj' => $request->{'terdaftar_p'},
                'penempatan_l_lj' => $request->{'penempatan_l'},
                'penempatan_p_lj' => $request->{'penempatan_p'},
                'hapus_l_lj' => $request->{'hapus_l'},
                'hapus_p_lj' => $request->{'hapus_p'},
            ]);

            if(Auth::user()->email == 'disnaker@gmail.com'){
                return redirect('/detail-laporan-kab-v/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/laporan-ipk-5')->with('success', 'Update data berhasil dilakukan');
            }
        }else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            DataLowonganJabatan::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul_lj', $notIn)->update([
                'sisa_l_lj' => $request->{'sisa_l'},
                'sisa_p_lj' => $request->{'sisa_p'},
                'terdaftar_l_lj' => $request->{'terdaftar_l'},
                'terdaftar_p_lj' => $request->{'terdaftar_p'},
                'penempatan_l_lj' => $request->{'penempatan_l'},
                'penempatan_p_lj' => $request->{'penempatan_p'},
                'hapus_l_lj' => $request->{'hapus_l'},
                'hapus_p_lj' => $request->{'hapus_p'},
            ]);
            if(Auth::user()->email == 'disnaker@gmail.com'){
                return redirect('/detail-lampiran-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/lampiran')->with('success', 'Update data berhasil dilakukan');
            }
        }
     }

    public function CetakLaporanV($id){
        $item = DataLowonganJabatan::where('id_disnaker', $id)->first();
        $data_user = User::where('email', $id)->first();
        $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
        if($data_user->icon == 0){
            return redirect('/laporan-ipk-5')->with('success', 'Mohon maaf, silahkan lakukan upload lambang lembaga terlebih dahulu pada menu profile!!!');
        }else{
            $lambang= $data_user->icon;
        }
        if($id == 'disnaker@gmail.com' || $data->status_lembaga == 3){
            $fileName = 'Laporan-IPK-5-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakLaporanVPusat($id, $lambang), $fileName);
        }elseif($item == null){
            return redirect('/laporan-ipk-5')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
            $fileName = 'Laporan-IPK-5-'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakLaporanVPusat($id, $lambang), $fileName);
        }
    }

    public function detailLaporanKabV($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $excludedNumbers = ['Sub Total','Total', 'BH & TIDAK TAMAT SD', 'SD', 'SLTP UMUM','SLTP KEJURUAN', 'SETINGKAT SLTP','PENDIDIKAN MENENGAH ATAS','SMK - TEKNOLOGI DAN REKAYASA','SMK - TEKNOLOGI INFORMASI DAN KOMUNIKASI','SMK - KESEHATAN','SMK - SENI, KERAJINAN DAN PARIWISATA','SMK - AGRIBISNIS DAN AGROTEKNOLOGI','SMK - BISNIS DAN MANAJEMEN','SETINGKAT SMU LAINNYA','DIPLOMA I / AKTA I / DIPLOMA II / AKTA II','DIPLOMA III / AKTA III/ AKADEMI/S.MUDA','SARJANA ( S1 )','SARJANA ( S2 )', 'SETINGKAT SLTP', '0'];
        $datalaporan = DataLowonganJabatan::where('id_disnaker', $id)->where('type','Laporan')->whereNotIn('judul_lj', $excludedNumbers)->paginate(20);
        return view('Dashboard.pemangku-kepentingan.detail_laporan_kab_e', [
            'sub_title' => 'Laporan IPK-III-5',
            'title' => 'DataIPK',
            'dataLaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
     }
}
