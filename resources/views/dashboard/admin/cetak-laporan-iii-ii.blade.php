<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
@if($semester->type == 'Lampiran')
    <tr><td></td><td></td><td colspan="10" style="text-align: center;">{{$title}}</td></tr>
    <tr><td></td><td></td><td colspan="10" style="text-align: center;">IPK III/9 : PENCARI KERJA YANG TERDAFTAR, DITEMPATKAN DAN DIHAPUSKAN </td></tr>
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
<tr><th></th><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th><th>(7)</th><th>(8)</th><th>(9)</th><th>(11)</th><th>(12)</th></tr> 

@if($disnaker->email_lembaga == 'disnaker@gmail.com')
    @if(isset($laporan) && $laporan->count() > 0)
        @foreach($laporan as $lap)
        @if(in_array($lap->judul, ['0', 'SARJANA ( S1 )']))
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l_s }}</td>
                <td>{{ $lap->sisa_p_s }}</td>
                <td>{{ $lap->terdaftar_l_s }}</td>
                <td>{{ $lap->terdaftar_p_s }}</td>
                <td>{{ $lap->penempatan_l_s }}</td>
                <td>{{ $lap->penempatan_p_s }}</td>
                <td>{{ $lap->hapus_l_s }}</td>
                <td>{{ $lap->hapus_p_s }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @elseif($lap->judul == 'JUMLAH     SMA')
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l_sma }}</td>
                <td>{{ $lap->sisa_p_sma }}</td>
                <td>{{ $lap->terdaftar_l_sma }}</td>
                <td>{{ $lap->terdaftar_p_sma }}</td>
                <td>{{ $lap->penempatan_l_sma }}</td>
                <td>{{ $lap->penempatan_p_sma }}</td>
                <td>{{ $lap->hapus_l_sma }}</td>
                <td>{{ $lap->hapus_p_sma }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @elseif($lap->judul == 'JUMLAH    SMK ')
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l_smk }}</td>
                <td>{{ $lap->sisa_p_smk }}</td>
                <td>{{ $lap->terdaftar_l_smk }}</td>
                <td>{{ $lap->terdaftar_p_smk }}</td>
                <td>{{ $lap->penempatan_l_smk }}</td>
                <td>{{ $lap->penempatan_p_smk }}</td>
                <td>{{ $lap->hapus_l_smk }}</td>
                <td>{{ $lap->hapus_p_smk }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @elseif($lap->judul == 'DIPLOMA III/AKTA III/AKADEMI / ')
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l_d }}</td>
                <td>{{ $lap->sisa_p_d }}</td>
                <td>{{ $lap->terdaftar_l_d }}</td>
                <td>{{ $lap->terdaftar_p_d }}</td>
                <td>{{ $lap->penempatan_l_d }}</td>
                <td>{{ $lap->penempatan_p_d }}</td>
                <td>{{ $lap->hapus_l_d }}</td>
                <td>{{ $lap->hapus_p_d }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @elseif($lap->judul == 'PASCA SARJANA ( S2 )')
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l_ss }}</td>
                <td>{{ $lap->sisa_p_ss }}</td>
                <td>{{ $lap->terdaftar_l_ss }}</td>
                <td>{{ $lap->terdaftar_p_ss }}</td>
                <td>{{ $lap->penempatan_l_ss }}</td>
                <td>{{ $lap->penempatan_p_ss }}</td>
                <td>{{ $lap->hapus_l_ss }}</td>
                <td>{{ $lap->hapus_p_ss }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @elseif($lap->judul == 'JUMLAH TOTAL')
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l_tot }}</td>
                <td>{{ $lap->sisa_p_tot }}</td>
                <td>{{ $lap->terdaftar_l_tot }}</td>
                <td>{{ $lap->terdaftar_p_tot }}</td>
                <td>{{ $lap->penempatan_l_tot }}</td>
                <td>{{ $lap->penempatan_p_tot }}</td>
                <td>{{ $lap->hapus_l_tot }}</td>
                <td>{{ $lap->hapus_p_tot }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @else
            <tr>
                <td>{{$lap->nmr}}</td>
                <td>{{ $lap->judul }}</td>
                <td>{{ $lap->sisa_l }}</td>
                <td>{{ $lap->sisa_p }}</td>
                <td>{{ $lap->terdaftar_l }}</td>
                <td>{{ $lap->terdaftar_p }}</td>
                <td>{{ $lap->penempatan_l }}</td>
                <td>{{ $lap->penempatan_p }}</td>
                <td>{{ $lap->hapus_l }}</td>
                <td>{{ $lap->hapus_p }}</td>
                <td>{{$lap->akhir_l}}</td>
                <td>{{$lap->akhir_p}}</td>
            </tr>
            @endif
    @endforeach

    @endif
@else
@foreach($data as $item)
<tr>
    <td>{{$item->nmr}}</td>
    <td>{{$item->judul}}</td>
    <td>{{$item->sisa_l}}</td>
    <td>{{$item->sisa_p}}</td>
    <td>{{$item->terdaftar_l}}</td>
    <td>{{$item->terdaftar_p}}</td>
    <td>{{$item->penempatan_l}}</td>
    <td>{{$item->penempatan_p}}</td>
    <td>{{$item->hapus_l}}</td>
    <td>{{$item->hapus_p}}</td>
    <td>{{$item->akhir_l}}</td>
    <td>{{$item->akhir_p}}</td>
</tr>
@endforeach
@endif
</table>
</body>
</html>