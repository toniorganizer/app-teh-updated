<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataKabKota;
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
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataLowonganPendidikan;
use Illuminate\Support\Facades\Redirect;

class LampiranLaporanController extends Controller
{
    public function index(){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $aturan = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();


        $data = DataPencariKerja::get();
        $excludedNumbers41 = ['A.', 'B.', 5];
        if($aturan->id_disnaker_kab == 0){
            $datalaporan = DataPencariKerja::where('id_disnaker', Auth::user()->email)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->get();
        }else{
            $datalaporan = DataPencariKerja::where('id_disnaker', $aturan->id_disnaker_kab)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->get();
        }

        $users = ['1', '2', '3'];
        foreach($users as $user){
            $lap = DB::table('data_pencari_kerjas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)
            ->where('nmr', $user)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)
            ->select('pencari_kerja', DB::raw('SUM(15_L) as 15_L'), DB::raw('SUM(15_P) as 15_P'), DB::raw('SUM(20_L) as 20_L'), DB::raw('SUM(20_P) as 20_P'))
            ->groupBy('pencari_kerja')
            ->get();

            $lapor[$user] = $lap;
        }

        // menghitung jumlah untuk disnakerprov
        $jumlahL151 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja1 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahL152 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja2 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahL153 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja3 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahL154 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_L');
        $pencari_kerja4 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->first();
        $jumlahP151 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahP152 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahP153 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahP154 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('15_P');
        $jumlahLowonganL1 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP1 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL201 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahL202 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahL203 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahL204 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_L');
        $jumlahP201 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahP202 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahP203 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahP204 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('20_P');
        $jumlahLowonganL2 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP2 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL301 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahL302 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahL303 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahL304 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_L');
        $jumlahP301 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahP302 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahP303 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahP304 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('30_P');
        $jumlahLowonganL3 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP3 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL451 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahL452 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahL453 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahL454 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_L');
        $jumlahP451 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahP452 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahP453 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahP454 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('45_P');
        $jumlahLowonganL4 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_L');
        $jumlahLowonganP4 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('lowongan_P');

        $jumlahL551 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahL552 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahL553 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahL554 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_L');
        $jumlahP551 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 1)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');
        $jumlahP552 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 2)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');
        $jumlahP553 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 3)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');
        $jumlahP554 = DataPencariKerja::join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_kerjas.id_disnaker')->where('role_acc', 1)->where('nmr', 4)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->sum('55_P');

        //Tabel 4.8
        $excludedNumbers48 = ['SMK : JURUSAN','JUMLAH',''];
        if($aturan->id_disnaker_kab == 0){
            $datalaporan48 = DataPencariPenerima::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers48)->paginate(20);
        }else{
            $datalaporan48 = DataPencariPenerima::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers48)->paginate(20);
        }

        $lap48 = DB::table('data_pencari_penerimas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_pencari_penerimas.id_disnaker')->where('role_acc', 1)
            ->whereNotIn('judul', $excludedNumbers48)->where('type','Lampiran')
            ->select('nmr', 'judul', 'jmll', 'jmlp', DB::raw('SUM(akll) as akll'), DB::raw('SUM(aklp) as aklp'), DB::raw('SUM(akadl) as akadl'), DB::raw('SUM(akadp) as akadp'), DB::raw('SUM(akanl) as akanl'), DB::raw('SUM(akanp) as akanp'))
            ->groupBy('nmr', 'judul', 'jmll', 'jmlp')
            ->oldest('id')
            ->paginate(20);

            // Tabel 4.9
            $excludedNumbers49 = [' TOTAL : SLTA /SMK /D.I/D.II ','JUMLAH     SMA','JUMLAH    SMK ','DIPLOMA III/AKTA III/AKADEMI /','PASCA SARJANA ( S2 )','JUMLAH TOTAL','SARJANA ( S1 )'];
            if($aturan->id_disnaker_kab == 0){
                $datalaporan49 = DataJenisPendidikan::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers49)->paginate(20);
            }else{
                $datalaporan49 = DataJenisPendidikan::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers49)->paginate(20);
            }

            $start = 1000;
            $end = 7600;

            $lap49 = DB::table('data_jenis_pendidikans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_jenis_pendidikans.id_disnaker')->where('role_acc', 1)
                ->whereBetween('nmr', [$start, $end])->where('type','Lampiran')
                ->whereNotIn('judul', $excludedNumbers49)
                ->select('nmr', 'judul', DB::raw('SUM(sisa_l) as sisa_l'), DB::raw('SUM(sisa_p) as sisa_p'), DB::raw('SUM(terdaftar_l) as terdaftar_l'), DB::raw('SUM(terdaftar_p) as terdaftar_p'), DB::raw('SUM(penempatan_l) as penempatan_l'), DB::raw('SUM(penempatan_p) as penempatan_p'), DB::raw('SUM(hapus_l) as hapus_l'), DB::raw('SUM(hapus_p) as hapus_p'))
                ->groupBy('nmr', 'judul')
                ->oldest('id')
                ->paginate(20);

            // Laporan 410
            $excludedNumbers410 = ['JUMLAH'];
            if($aturan->id_disnaker_kab == 0){
                $datalaporan410 = DataKelompokJabatan::where('id_disnaker', Auth::user()->email)->whereNotIn('judul_kj', $excludedNumbers410)->where('type','Lampiran')->get();
            }else{
                $datalaporan410 = DataKelompokJabatan::where('id_disnaker', $aturan->id_disnaker_kab)->whereNotIn('judul_kj', $excludedNumbers410)->where('type','Lampiran')->get();
            }

            // dd($datalaporan);
            $start = 0;
            $end = 9;
            
            $lap410 = DB::table('data_kelompok_jabatans')
            ->where('type','Lampiran')
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('nmr', [$start, $end])
                            ->orWhere('nmr', '4.10');
                })
            ->whereNotIn('judul_kj', $excludedNumbers410)
                ->select('nmr', 'judul_kj', DB::raw('SUM(sisa_l_kj) as sisa_l'), DB::raw('SUM(sisa_p_kj) as sisa_p'), DB::raw('SUM(terdaftar_l_kj) as terdaftar_l'), DB::raw('SUM(terdaftar_p_kj) as terdaftar_p'), DB::raw('SUM(penempatan_l_kj) as penempatan_l'), DB::raw('SUM(penempatan_p_kj) as penempatan_p'), DB::raw('SUM(hapus_l_kj) as hapus_l'), DB::raw('SUM(hapus_p_kj) as hapus_p'))
                ->groupBy('nmr', 'judul_kj')
                ->oldest('id')
                ->get();

                // dd($lap410);

            // Tabel 411
            $excludedNumbers411 = ['DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA','PASCA SARJANA ( S2 )','JUMLAH TOTAL','SARJANA ( S1 )','PENDIDIKAN MENENGAH ATAS','SMK : JURUSAN ( TOTAL )'];
            if($aturan->id_disnaker_kab == 0){
                $datalaporan411 = DataLowonganPendidikan::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul_lp', $excludedNumbers411)->paginate(20);
            }else{
                $datalaporan411 = DataLowonganPendidikan::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Lampiran')->whereNotIn('judul_lp', $excludedNumbers411)->paginate(20);
            }

            $start = 1000;
            $end = 7600;

            $lap411 = DB::table('data_lowongan_pendidikans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_lowongan_pendidikans.id_disnaker')->where('role_acc', 1)
            ->whereBetween('nmr', [$start, $end])->where('type','Lampiran')
                ->whereNotIn('judul_lp', $excludedNumbers411)
                ->select('nmr', 'judul_lp', DB::raw('SUM(sisa_l_lp) as sisa_l'), DB::raw('SUM(sisa_p_lp) as sisa_p'), DB::raw('SUM(terdaftar_l_lp) as terdaftar_l'), DB::raw('SUM(terdaftar_p_lp) as terdaftar_p'), DB::raw('SUM(penempatan_l_lp) as penempatan_l'), DB::raw('SUM(penempatan_p_lp) as penempatan_p'), DB::raw('SUM(hapus_l_lp) as hapus_l'), DB::raw('SUM(hapus_p_lp) as hapus_p'))
                ->groupBy('nmr', 'judul_lp')
                ->oldest('id')
                ->paginate(20);

            // Tabel 412
            $excludedNumbers412 = ['JUMLAH'];
            if($aturan->id_disnaker_kab == 0){
                $datalaporan412 = DataLowonganJabatan::where('id_disnaker', Auth::user()->email)->whereNotIn('judul_lj', $excludedNumbers412)->where('type','Lampiran')->get();
            }else{
                $datalaporan412 = DataLowonganJabatan::where('id_disnaker', $aturan->id_disnaker_kab)->whereNotIn('judul_lj', $excludedNumbers412)->where('type','Lampiran')->get();
            }

            $lap412 = DB::table('data_lowongan_jabatans')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_lowongan_jabatans.id_disnaker')->where('role_acc', 1)
                ->whereNotIn('judul_lj', $excludedNumbers412)->where('type','Lampiran')
                ->select('nmr', 'judul_lj', DB::raw('SUM(sisa_l_lj) as sisa_l'), DB::raw('SUM(sisa_p_lj) as sisa_p'), DB::raw('SUM(terdaftar_l_lj) as terdaftar_l'), DB::raw('SUM(terdaftar_p_lj) as terdaftar_p'), DB::raw('SUM(penempatan_l_lj) as penempatan_l'), DB::raw('SUM(penempatan_p_lj) as penempatan_p'), DB::raw('SUM(hapus_l_lj) as hapus_l'), DB::raw('SUM(hapus_p_lj) as hapus_p'))
                ->groupBy('nmr', 'judul_lj')
                ->oldest('id')
                ->get();

            // Tabel 413
            $excludedNumbers413 = ['JUMLAH TOTAL'];
            if($aturan->id_disnaker_kab == 0){
                $datalaporan413 = DataGolonganUsaha::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul_gu', $excludedNumbers413)->get();
            }else{
                $datalaporan413 = DataGolonganUsaha::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Lampiran')->whereNotIn('judul_gu', $excludedNumbers413)->get();
            }

            $lap413 = DB::table('data_golongan_usahas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_golongan_usahas.id_disnaker')->where('role_acc', 1)
                ->whereNotIn('judul_gu', $excludedNumbers413)->where('type','Lampiran')
                ->select('nmr', 'judul_gu', DB::raw('SUM(sisa_l_gu) as sisa_l'), DB::raw('SUM(sisa_p_gu) as sisa_p'), DB::raw('SUM(terdaftar_l_gu) as terdaftar_l'), DB::raw('SUM(terdaftar_p_gu) as terdaftar_p'), DB::raw('SUM(penempatan_l_gu) as penempatan_l'), DB::raw('SUM(penempatan_p_gu) as penempatan_p'), DB::raw('SUM(hapus_l_gu) as hapus_l'), DB::raw('SUM(hapus_p_gu) as hapus_p'))
                ->groupBy('nmr', 'judul_gu')
                ->oldest('id')
                ->get();
            
            // Tabel 414
            $excludedNumbers414 = ['JUMLAH TOTAL','KABUPATEN','KOTA'];
            if($aturan->id_disnaker_kab == 0){
                $datalaporan414 = DataKabKota::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers414)->get();
            }else{
                $datalaporan414 = DataKabKota::where('id_disnaker', $aturan->id_disnaker_kab)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers414)->get();
            }

            $lap414 = DB::table('data_kab_kotas')->join('pemangku_kepentingans', 'pemangku_kepentingans.email_lembaga','=','data_kab_kotas.id_disnaker')->where('role_acc', 1)
                ->whereNotIn('judul', $excludedNumbers414)->where('type','Lampiran')
                ->select('nmr', 'judul', 'jpkt', 'jlkt','jpkd', DB::raw('SUM(pktl) as pktl'), DB::raw('SUM(pktw) as pktw'), DB::raw('SUM(lktl) as lktl'), DB::raw('SUM(lktw) as lktw'), DB::raw('SUM(pkdl) as pkdl'), DB::raw('SUM(pkdw) as pkdw'))
                ->groupBy('nmr', 'judul', 'jpkt', 'jlkt','jpkd')
                ->oldest('id')
                ->get();

                
        $sidebar_data = PemangkuKepentingan::where('email_lembaga', Auth::user()->email)->first();

        return view('dashboard.admin.data_lampiran', [
            'sub_title' => 'Lampiran',
            'title' => 'DataIPK',
            'sidebar_data' => $sidebar_data,
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
        $role_importlaporan = DataKabKota::where('id_disnaker', Auth::user()->email)->where('type','Laporan')->first();
        $role_importlampiran = DataKabKota::where('id_disnaker', Auth::user()->email)->where('type','Lampiran')->first();
        if($role_importlaporan){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }else{
        $bulan1 = $request->input('tgl1');
        $bulan2 = $request->input('tgl2');   

        Excel::import(new LampiranImport($bulan1, $bulan2), $request->file('file'));
        
        return redirect('/lampiran')->with('success', 'Import data berhasil dilakukan!');
        }

        if($role_importlampiran){
            return Redirect::back()->with('success', 'Import data sudah dilakukan, silahkan lakukan hapus data terlebih dahulu!');
        }else{
            $bulan1 = $request->input('tgl1');
            $bulan2 = $request->input('tgl2');   
    
            Excel::import(new LampiranImport($bulan1, $bulan2), $request->file('file'));
            
            return redirect('/lampiran')->with('success', 'Import data berhasil dilakukan!');
            }
    }

    public function CetakLampiran($id){
        $item = DataPencariKerja::where('id_disnaker', $id)->where('type', 'Lampiran')->first();
        $data_user = User::where('email', $id)->first();
        $data = PemangkuKepentingan::where('email_lembaga', $id)->first();
        if($data_user->icon == 0){
            return redirect('/lampiran')->with('success', 'Mohon maaf, silahkan lakukan upload lambang lembaga terlebih dahulu pada menu profile!!!');
        }else{
            $lambang= $data_user->icon;
        }
        if($id == 'disnaker@gmail.com' || $data->status_lembaga == 3){
            $fileName = 'Lampiran-Laporan ('. $data->nama_lembaga .').xlsx';
            return Excel::download(new CetakLampiran($id, $lambang), $fileName);
        }elseif($item == null){
            return redirect('/lampiran')->with('success', 'Mohon maaf, silahkan lakukan upload data terlebih dahulu!!!');
        }else{
        $fileName = 'Lampiran-Laporan ('. $data->nama_lembaga .').xlsx';
        return Excel::download(new CetakLampiran($id, $lambang), $fileName);
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
            if($request->type == 'Lampiran'){
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataKabKota::where('nmr', $id)->where('type','Lampiran')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
            }else{
                $notIn = ['BH & TIDAK TAMAT SD','SD'];
                $data = DataKabKota::where('nmr', $id)->where('type','Laporan')->Where('id_disnaker', $request->id_disnaker)->whereNotIn('judul', $notIn)->first();
            }
        }
        elseif($request->type == 'Lampiran'){
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKabKota::where('nmr', $id)->where('type','Lampiran')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }
        else{
            $notIn = ['BH & TIDAK TAMAT SD','SD'];
            $data = DataKabKota::where('nmr', $id)->where('type','Laporan')->where('id_disnaker', Auth::user()->email)->whereNotIn('judul', $notIn)->first();
        }


        return view('dashboard.pemangku-kepentingan.edit_lampiran_kab_kota', [
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
                return redirect('/detail-lampiran-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
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
            if(Auth::user()->email == 'disnaker@gmail.com'){
                return redirect('/detail-lampiran-kab/'. $request->id_disnaker )->with('success', 'Update data berhasil dilakukan');
            }else{
                return redirect('/lampiran')->with('success', 'Update data berhasil dilakukan');
            }
        }
     }

     public function detailLampiranKab($id){
        $kab = PemangkuKepentingan::where('status_lembaga', 1)->get();
        $nama = PemangkuKepentingan::where('email_lembaga', $id)->first();

        $data = DataPencariKerja::get();
        $excludedNumbers41 = ['A.', 'B.', 5];
        $datalaporan = DataPencariKerja::where('id_disnaker', $id)->where('type', 'Lampiran')->whereNotIn('nmr', $excludedNumbers41)->get();

        $excludedNumbers48 = ['SMK : JURUSAN','JUMLAH',''];
        $datalaporan48 = DataPencariPenerima::where('id_disnaker', $id)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers48)->paginate(20);

        $excludedNumbers49 = [' TOTAL : SLTA /SMK /D.I/D.II ','JUMLAH     SMA','JUMLAH    SMK ','DIPLOMA III/AKTA III/AKADEMI /','PASCA SARJANA ( S2 )','JUMLAH TOTAL','SARJANA ( S1 )'];
        $datalaporan49 = DataJenisPendidikan::where('id_disnaker', $id)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers49)->paginate(20);

        $excludedNumbers410 = ['JUMLAH'];
        $datalaporan410 = DataKelompokJabatan::where('id_disnaker', $id)->whereNotIn('judul_kj', $excludedNumbers410)->where('type','Lampiran')->get();

        $excludedNumbers411 = ['DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA','PASCA SARJANA ( S2 )','JUMLAH TOTAL','SARJANA ( S1 )','PENDIDIKAN MENENGAH ATAS','SMK : JURUSAN ( TOTAL )'];
        $datalaporan411 = DataLowonganPendidikan::where('id_disnaker', $id)->where('type','Lampiran')->whereNotIn('judul_lp', $excludedNumbers411)->paginate(20);

        $excludedNumbers412 = ['JUMLAH'];
        $datalaporan412 = DataLowonganJabatan::where('id_disnaker', $id)->whereNotIn('judul_lj', $excludedNumbers412)->where('type','Lampiran')->get();

        $excludedNumbers413 = ['JUMLAH TOTAL'];
        $datalaporan413 = DataGolonganUsaha::where('id_disnaker', $id)->where('type','Lampiran')->whereNotIn('judul_gu', $excludedNumbers413)->get();

        $excludedNumbers414 = ['JUMLAH TOTAL'];
        $datalaporan414 = DataKabKota::where('id_disnaker', $id)->where('type','Lampiran')->whereNotIn('judul', $excludedNumbers414)->get();

        // dd($datalaporan410);

        return view('dashboard.pemangku-kepentingan.detail_lampiran_kab', [
            'sub_title' => 'Lampiran',
            'title' => 'DataIPK',
            'dataLaporanKab414' => $datalaporan414,
            'dataLaporanKab413' => $datalaporan413,
            'dataLaporanKab412' => $datalaporan412,
            'dataLaporanKab411' => $datalaporan411,
            'dataLaporanKab410' => $datalaporan410,
            'dataLaporanKab49' => $datalaporan49,
            'dataLaporanKab48' => $datalaporan48,
            'datalaporan' => $datalaporan,
            'kab' => $kab,
            'nama' => $nama
        ]);
    }

}
