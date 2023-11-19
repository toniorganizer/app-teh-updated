<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>{{$title}}</td></tr>
@if($disnaker->email_lembaga == 'disnaker@gmail.com')
<tr><td></td><td></td><td></td></tr>
@else
<tr><td></td><td></td><td>{{$semester->tgl_1}} S/D {{$semester->tgl_2}}</td></tr>
@endif
<tr><td></td><td></td><td>Dinas Tenaga Kerja dan Transmigrasi Propisi Sumatera Barat</td></tr>
<tr><td></td><td></td><td>Jl. Ujung Gurun No. 7 Padang</td></tr>
<tr><td></td><td></td><td>( 0751 ) 27430 - 37430</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><th rowspan="3">No</th><th rowspan="3">Kelompok Jabatan</th><th rowspan="2" colspan="2">Sisa Smtr Lalu</th><th rowspan="2" colspan="2">Yang terdaftar Smtr ini</th><th rowspan="2" colspan="2">Penempatan Smtr ini</th><th rowspan="2" colspan="2">Dihapuskan Smtr ini</th><th rowspan="2" colspan="2">Sisa Akhir Smtr ini</th></tr> 
<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
<tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
<tr><th></th><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th><th>(7)</th><th>(8)</th><th>(9)</th><th>(11)</th><th>(12)</th></tr> 

@if($disnaker->email_lembaga == 'disnaker@gmail.com')
@if(isset($laporan) && $laporan->count() > 0)
@foreach($laporan as $lap)
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_kj }}</td>
        <td>{{ $lap->sisa_l }}</td>
        <td>{{ $lap->sisa_p }}</td>
        <td>{{ $lap->terdaftar_l }}</td>
        <td>{{ $lap->terdaftar_p }}</td>
        <td>{{ $lap->penempatan_l }}</td>
        <td>{{ $lap->penempatan_p }}</td>
        <td>{{ $lap->hapus_l }}</td>
        <td>{{ $lap->hapus_p }}</td>
        <td>{{$lap->akhir_l_kj}}</td>
        <td>{{$lap->akhir_p_kj}}</td>
    </tr>
@endforeach
@endif
@else
@foreach($data as $item)
<tr>
    <td>{{$item->nmr}}</td>
    <td>{{$item->judul_kj}}</td>
    <td>{{$item->sisa_l_kj}}</td>
    <td>{{$item->sisa_p_kj}}</td>
    <td>{{$item->terdaftar_l_kj}}</td>
    <td>{{$item->terdaftar_p_kj}}</td>
    <td>{{$item->penempatan_l_kj}}</td>
    <td>{{$item->penempatan_p_kj}}</td>
    <td>{{$item->hapus_l_kj}}</td>
    <td>{{$item->hapus_p_kj}}</td>
    <td>{{$item->akhir_l_kj}}</td>
    <td>{{$item->akhir_p_kj}}</td>
</tr>
@endforeach
@endif
</table>
</body>
</html>