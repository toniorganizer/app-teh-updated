<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataGolonganUsaha;
use Illuminate\Support\Facades\DB;
use App\Models\PemangkuKepentingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LampiranLaporanController extends Controller
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

        return view('Dashboard.admin.data_lampiran', [
            'data' => $data,
            'kab' => $kab,
            'aturan' => $aturan,
            'dataLaporanKab' => $datalaporan,
            'sub_title' => 'Lampiran',
            'title' => 'DataIPK',
            'dataLaporan' => $lap
        ]);
    }
}
