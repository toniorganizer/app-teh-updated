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
<tr><th rowspan="3">No</th><th rowspan="3">GOLONGAN USAHA DAN LAPANGAN USAHA</th><th rowspan="2" colspan="2">Sisa Smtr Lalu</th><th rowspan="2" colspan="2">Yang terdaftar Smtr ini</th><th rowspan="2" colspan="2">Penempatan Smtr ini</th><th rowspan="2" colspan="2">Dihapuskan Smtr ini</th><th rowspan="2" colspan="2">Sisa Akhir Smtr ini</th></tr> 
<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
<tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr> 

@if($disnaker->email_lembaga == 'disnaker@gmail.com')
@if(isset($laporan) && $laporan->count() > 0)
@foreach($laporan as $lap)
    <tr>
        <td>{{$lap->nmr}}</td>
        <td>{{ $lap->judul_gu }}</td>
        <td>{{ $lap->sisa_l }}</td>
        <td>{{ $lap->sisa_p }}</td>
        <td>{{ $lap->terdaftar_l }}</td>
        <td>{{ $lap->terdaftar_p }}</td>
        <td>{{ $lap->penempatan_l }}</td>
        <td>{{ $lap->penempatan_p }}</td>
        <td>{{ $lap->hapus_l }}</td>
        <td>{{ $lap->hapus_p }}</td>
        <td>{{$lap->akhir_l_gu}}</td>
        <td>{{$lap->akhir_p_gu}}</td>
    </tr>
@endforeach
@endif
@else
@foreach($data as $item)
<tr>
    <td>{{$item->nmr}}</td>
    <td>{{$item->judul_gu}}</td>
    <td>{{$item->sisa_l_gu}}</td>
    <td>{{$item->sisa_p_gu}}</td>
    <td>{{$item->terdaftar_l_gu}}</td>
    <td>{{$item->terdaftar_p_gu}}</td>
    <td>{{$item->penempatan_l_gu}}</td>
    <td>{{$item->penempatan_p_gu}}</td>
    <td>{{$item->hapus_l_gu}}</td>
    <td>{{$item->hapus_p_gu}}</td>
    <td>{{$item->akhir_l_gu}}</td>
    <td>{{$item->akhir_p_gu}}</td>
</tr>
@endforeach
@endif
</table>
</body>
</html>