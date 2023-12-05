<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
@if($semester->type == 'Lampiran')
    <tr><td></td><td></td><td colspan="10" style="text-align: center;">{{$title}}</td></tr>
    <tr><td></td><td></td><td colspan="10" style="text-align: center;">IPK III/11 : LOWONGAN KERJA YANG TERDAFTAR, DITEMPATKAN DAN DIHAPUSKAN</td></tr>
    <tr><td></td><td></td><td colspan="10" style="text-align: center;">DIRINCI MENURUT JENIS PENDIDIKAN</td></tr>
    @if($disnaker->email_lembaga == 'disnaker@gmail.com')
    <tr><td></td><td></td><td></td></tr>
    @else
    <tr><td></td><td></td><td colspan="10" style="text-align: center;">SEMESTER : {{$semester->tgl_1}} S/D {{$semester->tgl_2}}</td></tr>
    @endif
    <tr><td></td><td></td><td></td></tr>
@else
    <tr><td></td><td></td><td>{{$title}}</td></tr>
    @if($disnaker->email_lembaga == 'disnaker@gmail.com')
        <tr><td></td><td></td><td></td></tr>
    @else
        <tr><td></td><td></td><td>{{$semester->tgl_1}} S/D {{$semester->tgl_2}}</td></tr>
    @endif
    <tr><td></td><td></td><td>Dinas Tenaga Kerja dan Transmigrasi Propisi Sumatera Barat</td></tr>
    <tr><td></td><td></td><td>Jl. Ujung Gurun No. 7 Padang</td></tr>
    <tr><td></td><td></td><td>( 0751 ) 27430 - 37430</td></tr>
@endif
<tr><td></td><td></td><td></td></tr>
<tr><th rowspan="3">No</th><th rowspan="3">Jenis Pendidikan</th><th rowspan="2" colspan="2">Sisa Smtr Lalu</th><th rowspan="2" colspan="2">Yang terdaftar Smtr ini</th><th rowspan="2" colspan="2">Penempatan Smtr ini</th><th rowspan="2" colspan="2">Dihapuskan Smtr ini</th><th rowspan="2" colspan="2">Sisa Akhir Smtr ini</th></tr> 
<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
<tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr> 

@if($disnaker->email_lembaga == 'disnaker@gmail.com')
@if(isset($laporan) && $laporan->count() > 0)
@foreach($laporan as $lap)
@if($lap->judul_lp == 'Total' || $lap->judul_lp == 'SARJANA ( S1 )')
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_lp }}</td>
        <td>{{ $lap->sisa_l_s }}</td>
        <td>{{ $lap->sisa_p_s }}</td>
        <td>{{ $lap->terdaftar_l_s }}</td>
        <td>{{ $lap->terdaftar_p_s }}</td>
        <td>{{ $lap->penempatan_l_s }}</td>
        <td>{{ $lap->penempatan_p_s }}</td>
        <td>{{ $lap->hapus_l_s }}</td>
        <td>{{ $lap->hapus_p_s }}</td>
        <td>{{$lap->akhir_l_lp}}</td>
        <td>{{$lap->akhir_p_lp}}</td>
    </tr>
    @elseif($lap->judul_lp == 'SMK : JURUSAN ( TOTAL )')
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_lp }}</td>
        <td>{{ $lap->sisa_l_smk }}</td>
        <td>{{ $lap->sisa_p_smk }}</td>
        <td>{{ $lap->terdaftar_l_smk }}</td>
        <td>{{ $lap->terdaftar_p_smk }}</td>
        <td>{{ $lap->penempatan_l_smk }}</td>
        <td>{{ $lap->penempatan_p_smk }}</td>
        <td>{{ $lap->hapus_l_smk }}</td>
        <td>{{ $lap->hapus_p_smk }}</td>
        <td>{{$lap->akhir_l_lp}}</td>
        <td>{{$lap->akhir_p_lp}}</td>
    </tr>
    @elseif($lap->judul_lp == 'DIPLOMA III/AKTA III/AKADEMI / SARJANA MUDA')
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_lp }}</td>
        <td>{{ $lap->sisa_l_diplo }}</td>
        <td>{{ $lap->sisa_p_diplo }}</td>
        <td>{{ $lap->terdaftar_l_diplo }}</td>
        <td>{{ $lap->terdaftar_p_diplo }}</td>
        <td>{{ $lap->penempatan_l_diplo }}</td>
        <td>{{ $lap->penempatan_p_diplo }}</td>
        <td>{{ $lap->hapus_l_diplo }}</td>
        <td>{{ $lap->hapus_p_diplo }}</td>
        <td>{{$lap->akhir_l_lp}}</td>
        <td>{{$lap->akhir_p_lp}}</td>
    </tr>
    @elseif($lap->judul_lp == 'PASCA SARJANA ( S2 )')
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_lp }}</td>
        <td>{{ $lap->sisa_l_ss }}</td>
        <td>{{ $lap->sisa_p_ss }}</td>
        <td>{{ $lap->terdaftar_l_ss }}</td>
        <td>{{ $lap->terdaftar_p_ss }}</td>
        <td>{{ $lap->penempatan_l_ss }}</td>
        <td>{{ $lap->penempatan_p_ss }}</td>
        <td>{{ $lap->hapus_l_ss }}</td>
        <td>{{ $lap->hapus_p_ss }}</td>
        <td>{{$lap->akhir_l_lp}}</td>
        <td>{{$lap->akhir_p_lp}}</td>
    </tr>
    @elseif($lap->judul_lp == 'JUMLAH TOTAL')
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_lp }}</td>
        <td>{{ $lap->sisa_l_tot }}</td>
        <td>{{ $lap->sisa_p_tot }}</td>
        <td>{{ $lap->terdaftar_l_tot }}</td>
        <td>{{ $lap->terdaftar_p_tot }}</td>
        <td>{{ $lap->penempatan_l_tot }}</td>
        <td>{{ $lap->penempatan_p_tot }}</td>
        <td>{{ $lap->hapus_l_tot }}</td>
        <td>{{ $lap->hapus_p_tot }}</td>
        <td>{{$lap->akhir_l_lp}}</td>
        <td>{{$lap->akhir_p_lp}}</td>
    </tr>
@else
<tr>
    <td>{{$lap->nmr}}</td>
    <td>{{ $lap->judul_lp }}</td>
    <td>{{ $lap->sisa_l }}</td>
    <td>{{ $lap->sisa_p }}</td>
    <td>{{ $lap->terdaftar_l }}</td>
    <td>{{ $lap->terdaftar_p }}</td>
    <td>{{ $lap->penempatan_l }}</td>
    <td>{{ $lap->penempatan_p }}</td>
    <td>{{ $lap->hapus_l }}</td>
    <td>{{ $lap->hapus_p }}</td>
    <td>{{$lap->akhir_l_lp}}</td>
    <td>{{$lap->akhir_p_lp}}</td>
</tr>
@endif
@endforeach
@endif
@else
@foreach($data as $item)
<tr>
    <td>{{$item->nmr}}</td>
    <td>{{$item->judul_lp}}</td>
    <td>{{$item->sisa_l_lp}}</td>
    <td>{{$item->sisa_p_lp}}</td>
    <td>{{$item->terdaftar_l_lp}}</td>
    <td>{{$item->terdaftar_p_lp}}</td>
    <td>{{$item->penempatan_l_lp}}</td>
    <td>{{$item->penempatan_p_lp}}</td>
    <td>{{$item->hapus_l_lp}}</td>
    <td>{{$item->hapus_p_lp}}</td>
    <td>{{$item->akhir_l_lp}}</td>
    <td>{{$item->akhir_p_lp}}</td>
</tr>
@endforeach
@endif
</table>
</body>
</html>