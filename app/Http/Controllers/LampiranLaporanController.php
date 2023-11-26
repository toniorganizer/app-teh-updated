<?php

namespace App\Http\Controllers;

use App\Models\PencariKerja;
use Illuminate\Http\Request;
use App\Exports\CetakLampiran;
use App\Imports\LampiranImport;
use App\Models\DataPencariKerja;
use App\Models\DataGolonganUsaha;
use Illuminate\Support\Facades\DB;
use App\Models\DataJenisPendidikan;
use App\Models\DataKelompokJabatan;
use App\Models\DataLowonganJabatan;
use App\Models\DataPencariPenerima;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use App\Models\DataKabKota;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataLowonganPendidikan;

class LampiranLaporanController extends Controller
{
    public function index(){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();


        $data = DataPencariKerja::get();
        $excludedNumbers41 = ['A.', 'B.', 5];
        $datalaporan = DataPencariKerja::where('id_disnaker', Auth::user()->email)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->get();

        $users = ['1', '2', '3'];
        foreach($users as $user){
            $lap = DB::table('data_pencari_kerjas')
            ->where('nmr', $user)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)
            ->select('pencari_kerja', DB::raw('SUM(15_L) as 15_L'), DB::raw('SUM(15_P) as 15_P'), DB::raw('SUM(20_L) as 20_L'), DB::raw('SUM(20_P) as 20_P'))
            ->groupBy('pencari_kerja')
            ->get();

            $lapor[$user] = $lap;
        }

        // menghitung jumlah untuk disnakerprov
        $jumlahL151 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja1 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahL152 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja2 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahL153 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja3 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahL154 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja4 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahP151 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahP152 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahP153 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahP154 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahLowonganL1 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP1 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL201 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahL202 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahL203 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahL204 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahP201 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahP202 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahP203 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahP204 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahLowonganL2 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP2 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL301 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahL302 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahL303 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahL304 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahP301 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahP302 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahP303 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahP304 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahLowonganL3 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP3 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL451 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahL452 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahL453 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahL454 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahP451 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahP452 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahP453 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahP454 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahLowonganL4 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP4 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL551 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahL552 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahL553 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahL554 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahP551 = DataPencariKerja::where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');
        $jumlahP552 = DataPencariKerja::where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');
        $jumlahP553 = DataPencariKerja::where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');
        $jumlahP554 = DataPencariKerja::where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');

        //Tabel 4.8
        $excludedNumbers48 = ['SMK : JURUSAN','JUMLAH',''];
        $datalaporan48 = DataPencariPenerima::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers48)->paginate(20);

        $lap48 = DB::table('data_pencari_penerimas')
            ->whereNotIn('judul', $excludedNumbers48)->where('type','Lampiran')
            ->select('nmr', 'judul', 'jmll', 'jmlp', DB::raw('SUM(akll) as akll'), DB::raw('SUM(aklp) as aklp'), DB::raw('SUM(akadl) as akadl'), DB::raw('SUM(akadp) as akadp'), DB::raw('SUM(akanl) as akanl'), DB::raw('SUM(akanp) as akanp'))
            ->groupBy('nmr', 'judul', 'jmll', 'jmlp')
            ->oldest('id')
            ->paginate(20);

            // Tabel 4.9
            $excludedNumbers49 = [' TOTAL : SLTA /SMK /D.I/D.II ','JUMLAH     SMA','JUMLAH    SMK ','DIPLOMA III/AKTA III/AKADEMI /','PASCA SARJANA ( S2 )','JUMLAH TOTAL','SARJANA ( S1 )'];
            $datalaporan49 = DataJenisPendidikan::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers49)->paginate(20);


            $numbers = [1101, 1102, 1103, 1199, 2101, 2102, 2104, 2103, 2199, 3801 ,3002, 3100, 3101, 3102, 3103, 3104, 3105, 3106, 3107, 3108, 3109, 3110, 3111, 3112, 3113, 3114, 3115, 3116, 3117, 3118, 3119, 3200, 3201, 3202, 3203, 3700, 3701, 3702, 02, 4000, 4100, 4101, 4102, 4103, 4104, 4105, 4106, 4107, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 4116, 4118, 4119, 4108, 4121, 4122, 4123, 4124, 4125, 4126, 4127, 4128, 4129, 4199, 3301, 3302, 3401, 3402, 3403, 3404, 3405, 3406, 3407, 3501, 3502, 3503, 3504, 3505, 3506, 3507, 3601, 3602, 3603, 3701, 3702, 4201, 4202, 4203, 4204, 4205, 4206, 4208, 4209, 4210, 4211, 4212, 4213, 4214, 4215, 4216, 4217, 4218, 4219, 4220, 4221, 4222, 4223, 4226, 4227, 4228, 4229, 4230, 4231, 5101, 5102, 5103, 5104, 5105, 5106, 5107, 5108, 5109, 5110, 5111, 5112, 5201, 5202, 5203, 5204, 5205, 5206, 5207, 5208, 5209, 5210, 5212, 5213, 5214, 5215, 5216, 5217, 5218, 5219, 5220, 5221, 5222, 5301, 5302, 5303, 5304, 5305, 5306, 5307, 5308, 5309, 5310, 5311, 5312, 5401, 5402, 5403, 5404, 5405, 5406, 5407, 5408, 5409, 5410, 5501, 5502, 5503, 5504, 5505, 5506, 5507, 5508, 5509, 5510, 5511, 5512, 5513, 5515, 5516, 5517, 5518, 5519, 5525, 5524, 5526, 5527, 5528, 5529, 5530, 5531, 5532, 5533, 5534, 5535, 5599, 5601, 5602, 5604, 5605, 5606, 5607, 5608, 5609, 5610, 5611, 5612, 5613, 5614, 5615, 5616, 5621, 5622, 5623, 5624, 5625, 5626, 5627, 5628, 5629, 5630, 5631, 5632, 5620, 5634, 5636, 5637, 5638, 5640, 5641, 5642, 5643, 5644, 5645, 5646, 6101, 6102, 6103, 6104, 6105, 6106, 6107, 6108, 6109, 6199, 6201, 6202, 6203, 6204, 6205, 6206, 6207, 6208, 6209, 6210, 6211, 6212, 6213, 6214, 6215, 6216, 6217, 6299, 6223, 6301, 6302, 6303, 6304, 6305, 6306, 6307, 6308, 6309, 6310, 6311, 6312, 6401, 6402, 6403, 6404, 6405, 6501, 6502, 6503, 6504, 6505, 6506, 6507, 6508, 6509, 6510, 6511, 6512, 6513, 6514, 6515, 6516, 6519, 6518, 6520, 6521, 6522, 6523, 6524, 6525, 6526, 6527, 6528, 6529, 6599, 6601, 6602, 6603, 6604, 6605,6606, 6607, 6608, 6609, 6610, 6611, 6612, 6613, 6614, 6615, 6616, 6617, 6618, 6619, 6620, 6621, 6622, 6623, 6624, 6625, 6626, 6627, 6628, 6629, 6630, 6631, 6632, 6633, 6634, 6635, 6636, 6637, 6638, 6639, 6699, 7101, 7103, 7104, 7105, 7106, 7108, 7109, 7110, 7201, 7202, 7203, 7204, 7205, 7211, 7212, 7214, 7217, 7299, 7301, 7302, 7303, 7304, 7305, 7306, 7307, 7308, 7309, 7310, 7311, 7312, 7401, 7402, 7403, 7404, 7405, 7501, 7502, 7503, 7504, 7505, 7506, 7507, 7508, 7509, 7510, 7511, 7514, 7516, 7520, 7521, 7522, 7523, 7524, 7525, 7526, 7527, 7528, 7529, 7529, 7601, 7602, 7603, 7605, 7606, 7607, 7608, 7609, 7610, 7611, 7612, 7613, 7614, 7616, 7617, 7618, 7619, 7620, 7621, 7622, 7623, 7624, 7625, 7626, 7627, 7628, 7629, 7630, 7631, 7632, 7633, 7634, 7635, 7636, 7637, 7639, 7699];


            $lap49 = DB::table('data_jenis_pendidikans')
                ->whereIn('nmr', $numbers)->where('type','Lampiran')
                ->whereNotIn('judul', $excludedNumbers49)
                ->select('nmr', 'judul', DB::raw('SUM(sisa_l) as sisa_l'), DB::raw('SUM(sisa_p) as sisa_p'), DB::raw('SUM(terdaftar_l) as terdaftar_l'), DB::raw('SUM(terdaftar_p) as terdaftar_p'), DB::raw('SUM(penempatan_l) as penempatan_l'), DB::raw('SUM(penempatan_p) as penempatan_p'), DB::raw('SUM(hapus_l) as hapus_l'), DB::raw('SUM(hapus_p) as hapus_p'))
                ->groupBy('nmr', 'judul')
                ->oldest('id')
                ->paginate(20);

            // Laporan 410
            $excludedNumbers410 = ['JUMLAH'];
            $datalaporan410 = DataKelompokJabatan::where('id_disnaker', Auth::user()->email)->whereNotIn('judul_kj', $excludedNumbers410)->where('type','Lampiran')->get();

            // dd($datalaporan);

            $numbers = [
                '0110', '1110', '1120', '1130', '1141', '1142', '1143', '1210', '1221', '1223', '1224', '1225', '1226', '1227', '1228', '1229', '1231', '1232', '1233', '1234', '1235', '1236', '1237', '1311', '1314', '1315', '1316', '1317', '1318', '1319', '2111', '2112', '2113', '2114', '2121', '2122', '2131', '2132', '2139', '2141', '2142', '2143', '2144', '2145', '2146', '2147', '2148', '2149', '2211', '2212', '2213', '2221', '2222', '2230', '2310', '2320', '2330', '2331', '2332', '2340', '2351', '2352', '2411', '2412', '2419', '2421', '2422', '2429', '2431', '2432', '2441', '2442', '2443', '2444', '2445', '2446', '2451', '2452', '2453', '2454', '2455', '2460', '3111', '3112', '3113', '3114', '3115', '3116', '3117', '3118', '3119', '3121', '3122', '3123', '3131', '3132', '3133', '3141', '3142', '3143', '3145', '3151', '3152', '3211', '3212', '3213', '3221', '3222', '3223', '3224', '3225', '3226', '3227', '3228', '3229', '3231', '3232', '3241', '3242', '3310', '3320', '3330', '3340', '3411', '3412', '3413', '3414', '3415', '3416', '3417', '3421', '3422', '3423', '3429', '3431', '3432', '3433', '3434', '3439', '3441', '3442', '3443', '3444', '3449', '3450', '3460', '3471', '3472', '3473', '3474', '3475', '3480', '4111', '4112', '4113', '4114', '4115', '4121', '4122', '4131', '4132', '4133', '4141', '4142', '4143', '4144', '4190', '4211', '4212', '4213', '4214', '4215', '4222', '4223', '5111', '5112', '5113', '5121', '5122', '5123', '5131', '5132', '5139', '5141', '5142', '5143', '5149', '5151', '5152', '5161', '5162', '5163', '5169', '5210', '5220', '5230', '6111', '6112', '6113', '6114', '6121', '6122', '6123', '6129', '6130', '6141', '6142', '6151', '6152', '6153', '6154', '6210', '7111', '7112', '7121', '7122', '7123', '7124', '7129', '7131', '7132', '7133', '7134', '7135', '7136', '7137', '7141', '7142', '7143', '7211', '7212', '7213', '7214', '7215', '7216', '7221', '7222', '7223', '7224', '7231', '7232', '7233', '7241', '7242', '7243', '7244', '7245', '7311', '7312', '7313', '7321', '7322', '7323', '7324', '7331', '7332', '7341', '7342', '7343', '7344', '7345', '7346', '7411', '7412', '7413', '7414', '7415', '7416', '7421', '7422', '7423', '7424', '7431', '7432', '7433', '7434', '7435', '7436', '7437', '7441', '7442', '8111', '8112', '8113', '8121', '8122', '8124', '8131', '8139', '8141', '8142', '8143', '8151', '8152', '8153', '8154', '8155', '8159', '8161', '8162', '8163', '8171', '8172', '8211', '8212', '8221', '8222', '8223', '8224', '8229', '8231', '8232', '8240', '8251', '8252', '8253', '8261', '8262', '8263', '8264', '8265', '8269', '8271', '8272', '8273', '8274', '8275', '8281', '8282', '8283', '8284', '8285', '8286', '8290', '8311', '8312', '8321', '8322', '8323', '8324', '8331', '8332', '8333', '8334', '8340', '9111', '9112', '9113', '9120', '9131', '9132', '9133', '9141', '9142', '9151', '9152', '9153', '9162', '9211', '9212', '9213', '9311', '9312', '9313', '9321', '9322', '9331', '9332', '9333'
            ];
            
            $lap410 = DB::table('data_kelompok_jabatans')
                ->whereIn('nmr', $numbers)
                ->whereNotIn('judul_kj', $excludedNumbers410)->where('type','Lampiran')
                ->select('nmr', 'judul_kj', DB::raw('SUM(sisa_l_kj) as sisa_l'), DB::raw('SUM(sisa_p_kj) as sisa_p'), DB::raw('SUM(terdaftar_l_kj) as terdaftar_l'), DB::raw('SUM(terdaftar_p_kj) as terdaftar_p'), DB::raw('SUM(penempatan_l_kj) as penempatan_l'), DB::raw('SUM(penempatan_p_kj) as penempatan_p'), DB::raw('SUM(hapus_l_kj) as hapus_l'), DB::raw('SUM(hapus_p_kj) as hapus_p'))
                ->groupBy('nmr', 'judul_kj')
                ->oldest('id')
                ->get();

            // Tabel 411
            $excludedNumbers411 = ['DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA','PASCA SARJANA ( S2 )','JUMLAH TOTAL','SARJANA ( S1 )','PENDIDIKAN MENENGAH ATAS','SMK : JURUSAN ( TOTAL )'];
            $datalaporan411 = DataLowonganPendidikan::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul_lp', $excludedNumbers411)->paginate(20);

            $numbers = [1101, 1102, 1103, 1199, 2101, 2102, 2104, 2103, 2199, 3801 ,3002, 3100, 3101, 3102, 3103, 3104, 3105, 3106, 3107, 3108, 3109, 3110, 3111, 3112, 3113, 3114, 3115, 3116, 3117, 3118, 3119, 3200, 3201, 3202, 3203, 3700, 3701, 3702, 02, 4000, 4100, 4101, 4102, 4103, 4104, 4105, 4106, 4107, 4109, 4110, 4111, 4112, 4113, 4114, 4115, 4116, 4118, 4119, 4108, 4121, 4122, 4123, 4124, 4125, 4126, 4127, 4128, 4129, 4199, 3301, 3302, 3401, 3402, 3403, 3404, 3405, 3406, 3407, 3501, 3502, 3503, 3504, 3505, 3506, 3507, 3601, 3602, 3603, 3701, 3702, 4201, 4202, 4203, 4204, 4205, 4206, 4208, 4209, 4210, 4211, 4212, 4213, 4214, 4215, 4216, 4217, 4218, 4219, 4220, 4221, 4222, 4223, 4226, 4227, 4228, 4229, 4230, 4231, 5101, 5102, 5103, 5104, 5105, 5106, 5107, 5108, 5109, 5110, 5111, 5112, 5201, 5202, 5203, 5204, 5205, 5206, 5207, 5208, 5209, 5210, 5212, 5213, 5214, 5215, 5216, 5217, 5218, 5219, 5220, 5221, 5222, 5301, 5302, 5303, 5304, 5305, 5306, 5307, 5308, 5309, 5310, 5311, 5312, 5401, 5402, 5403, 5404, 5405, 5406, 5407, 5408, 5409, 5410, 5501, 5502, 5503, 5504, 5505, 5506, 5507, 5508, 5509, 5510, 5511, 5512, 5513, 5515, 5516, 5517, 5518, 5519, 5525, 5524, 5526, 5527, 5528, 5529, 5530, 5531, 5532, 5533, 5534, 5535, 5599, 5601, 5602, 5604, 5605, 5606, 5607, 5608, 5609, 5610, 5611, 5612, 5613, 5614, 5615, 5616, 5621, 5622, 5623, 5624, 5625, 5626, 5627, 5628, 5629, 5630, 5631, 5632, 5620, 5634, 5636, 5637, 5638, 5640, 5641, 5642, 5643, 5644, 5645, 5646, 6101, 6102, 6103, 6104, 6105, 6106, 6107, 6108, 6109, 6199, 6201, 6202, 6203, 6204, 6205, 6206, 6207, 6208, 6209, 6210, 6211, 6212, 6213, 6214, 6215, 6216, 6217, 6299, 6223, 6301, 6302, 6303, 6304, 6305, 6306, 6307, 6308, 6309, 6310, 6311, 6312, 6401, 6402, 6403, 6404, 6405, 6501, 6502, 6503, 6504, 6505, 6506, 6507, 6508, 6509, 6510, 6511, 6512, 6513, 6514, 6515, 6516, 6519, 6518, 6520, 6521, 6522, 6523, 6524, 6525, 6526, 6527, 6528, 6529, 6599, 6601, 6602, 6603, 6604, 6605,6606, 6607, 6608, 6609, 6610, 6611, 6612, 6613, 6614, 6615, 6616, 6617, 6618, 6619, 6620, 6621, 6622, 6623, 6624, 6625, 6626, 6627, 6628, 6629, 6630, 6631, 6632, 6633, 6634, 6635, 6636, 6637, 6638, 6639, 6699, 7101, 7103, 7104, 7105, 7106, 7108, 7109, 7110, 7201, 7202, 7203, 7204, 7205, 7211, 7212, 7214, 7217, 7299, 7301, 7302, 7303, 7304, 7305, 7306, 7307, 7308, 7309, 7310, 7311, 7312, 7401, 7402, 7403, 7404, 7405, 7501, 7502, 7503, 7504, 7505, 7506, 7507, 7508, 7509, 7510, 7511, 7514, 7516, 7520, 7521, 7522, 7523, 7524, 7525, 7526, 7527, 7528, 7529, 7529, 7601, 7602, 7603, 7605, 7606, 7607, 7608, 7609, 7610, 7611, 7612, 7613, 7614, 7616, 7617, 7618, 7619, 7620, 7621, 7622, 7623, 7624, 7625, 7626, 7627, 7628, 7629, 7630, 7631, 7632, 7633, 7634, 7635, 7636, 7637, 7639, 7699];


            $lap411 = DB::table('data_lowongan_pendidikans')
                ->whereIn('nmr', $numbers)
                ->whereNotIn('judul_lp', $excludedNumbers411)->where('type','Lampiran')
                ->select('nmr', 'judul_lp', DB::raw('SUM(sisa_l_lp) as sisa_l'), DB::raw('SUM(sisa_p_lp) as sisa_p'), DB::raw('SUM(terdaftar_l_lp) as terdaftar_l'), DB::raw('SUM(terdaftar_p_lp) as terdaftar_p'), DB::raw('SUM(penempatan_l_lp) as penempatan_l'), DB::raw('SUM(penempatan_p_lp) as penempatan_p'), DB::raw('SUM(hapus_l_lp) as hapus_l'), DB::raw('SUM(hapus_p_lp) as hapus_p'))
                ->groupBy('nmr', 'judul_lp')
                ->oldest('id')
                ->paginate(20);

            // Tabel 412
            $excludedNumbers412 = ['JUMLAH'];
            $datalaporan412 = DataLowonganJabatan::where('id_disnaker', Auth::user()->email)->whereNotIn('judul_lj', $excludedNumbers412)->where('type','Lampiran')->get();

            $lap412 = DB::table('data_lowongan_jabatans')
                ->whereNotIn('judul_lj', $excludedNumbers412)->where('type','Lampiran')
                ->select('nmr', 'judul_lj', DB::raw('SUM(sisa_l_lj) as sisa_l'), DB::raw('SUM(sisa_p_lj) as sisa_p'), DB::raw('SUM(terdaftar_l_lj) as terdaftar_l'), DB::raw('SUM(terdaftar_p_lj) as terdaftar_p'), DB::raw('SUM(penempatan_l_lj) as penempatan_l'), DB::raw('SUM(penempatan_p_lj) as penempatan_p'), DB::raw('SUM(hapus_l_lj) as hapus_l'), DB::raw('SUM(hapus_p_lj) as hapus_p'))
                ->groupBy('nmr', 'judul_lj')
                ->oldest('id')
                ->get();

            // Tabel 413
            $excludedNumbers413 = ['JUMLAH TOTAL'];
            $datalaporan413 = DataGolonganUsaha::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul_gu', $excludedNumbers413)->get();

            $lap413 = DB::table('data_golongan_usahas')
                ->whereNotIn('judul_gu', $excludedNumbers413)->where('type','Lampiran')
                ->select('nmr', 'judul_gu', DB::raw('SUM(sisa_l_gu) as sisa_l'), DB::raw('SUM(sisa_p_gu) as sisa_p'), DB::raw('SUM(terdaftar_l_gu) as terdaftar_l'), DB::raw('SUM(terdaftar_p_gu) as terdaftar_p'), DB::raw('SUM(penempatan_l_gu) as penempatan_l'), DB::raw('SUM(penempatan_p_gu) as penempatan_p'), DB::raw('SUM(hapus_l_gu) as hapus_l'), DB::raw('SUM(hapus_p_gu) as hapus_p'))
                ->groupBy('nmr', 'judul_gu')
                ->oldest('id')
                ->get();
            
            // Tabel 414
            $excludedNumbers414 = ['JUMLAH TOTAL'];
            $datalaporan414 = DataKabKota::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers414)->get();

            $lap414 = DB::table('data_kab_kotas')
                ->whereNotIn('judul', $excludedNumbers414)->where('type','Lampiran')
                ->select('nmr', 'judul', 'jpkt', 'jlkt','jpkd', DB::raw('SUM(pktl) as pktl'), DB::raw('SUM(pktw) as pktw'), DB::raw('SUM(lktl) as lktl'), DB::raw('SUM(lktw) as lktw'), DB::raw('SUM(pkdl) as pkdl'), DB::raw('SUM(pkdw) as pkdw'))
                ->groupBy('nmr', 'judul', 'jpkt', 'jlkt','jpkd')
                ->oldest('id')
                ->get();


        return view('Dashboard.admin.data_lampiran', [
            'sub_title' => 'Lampiran',
            'title' => 'DataIPK',
            'dataLaporan414' => $lap414,
            'dataLaporanKab414' => $datalaporan414,
            'dataLaporan413' => $lap413,
            'dataLaporanKab413' => $datalaporan413,
            'dataLaporan412' => $lap412,
            'dataLaporanKab412' => $datalaporan412,
            'dataLaporan411' => $lap411,
            'dataLaporanKab411' => $datalaporan411,
            'dataLaporan410' => $lap410,
            'dataLaporanKab410' => $datalaporan410,
            'dataLaporan49' => $lap49,
            'dataLaporanKab49' => $datalaporan49,
            'dataLaporan48' => $lap48,
            'dataLaporanKab48' => $datalaporan48,
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
        ]);
    }

    public function importLampiran(Request $request){
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');   

        Excel::import(new LampiranImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/lampiran')->with('success', 'Import data berhasil dilakukan!');
    }

    public function CetakLampiran($id){
        $item = DataGolonganUsaha::where('id_disnaker', $id)->first();
        if($id == 'disnaker@gmail.com'){
            $data = PemangkuKepentingan::where('email_lembaga', $id)->orWhere('type', 'Lampiran')->first();
            $fileName = 'Lampiran-Laporan'. $data->nama_lembaga .'.xlsx';
            return Excel::download(new CetakLampiran($id), $fileName);
        }elseif($item == null){
            return redirect('/lampiran')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
        $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
        $fileName = 'Lampiran-Laporan'. $data->nama_lembaga .'.xlsx';
        return Excel::download(new CetakLampiran($id), $fileName);
        }
    }

    public function deleteLampiran($id){
        DataPencariKerja::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataJenisPendidikan::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataLowonganPendidikan::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataKelompokJabatan::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataLowonganJabatan::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataGolonganUsaha::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataKabKota::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        DataPencariPenerima::where('id_disnaker', $id)->where('type','Lampiran')->delete();
        return redirect('/lampiran')->with('success', 'Hapus data berhasil dilakukan');
     } 

     public function editLampiranKabKota(Request $request, $id){
        if($request->id_disnaker){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKabKota::where('nmr', $id)->where('type','Laporan')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
        }
        elseif($request->type == 'Lampiran'){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKabKota::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKabKota::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }

        return view('Dashboard.pemangku-kepentingan.edit_lampiran_kab_kota', [
            'sub_title' => 'Lampiran',
            'title' => 'DataIPK',
            'data' => $data
        ]);
     }

     public function updateLampiranKabKota(Request $request, $id){
        if($request->type == "Laporan"){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            DataKabKota::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->update([
                'pktl' => $request->{'pktl'},
                'pktw' => $request->{'pktw'},
                'lktl' => $request->{'lktl'},
                'lktw' => $request->{'lktw'},
                'pkdl' => $request->{'pkdl'},
                'pktw' => $request->{'pktw'},
            ]);
    
            if(Auth::user()->email == 'disnaker@gmail.com'){
                return redirect('/detail-laporan-kab-iii/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/lampiran')->with('success', 'Update data berhasil dilakukan');
            }
        }else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            DataKabKota::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->update([
                'pktl' => $request->{'pktl'},
                'pktw' => $request->{'pktw'},
                'lktl' => $request->{'lktl'},
                'lktw' => $request->{'lktw'},
                'pkdl' => $request->{'pkdl'},
                'pktw' => $request->{'pktw'},
            ]);
            return redirect('/lampiran')->with('success', 'Update data berhasil dilakukan');
        }
     }
}
