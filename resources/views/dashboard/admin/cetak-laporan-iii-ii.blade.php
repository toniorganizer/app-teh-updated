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
<tr><th rowspan="3">No</th><th rowspan="3">Jenis Pendidikan</th><th rowspan="2" colspan="2">Sisa Smtr Lalu</th><th rowspan="2" colspan="2">Yang terdaftar Smtr ini</th><th rowspan="2" colspan="2">Penempatan Smtr ini</th><th rowspan="2" colspan="2">Dihapuskan Smtr ini</th><th rowspan="2" colspan="2">Sisa Akhir Smtr ini</th></tr> 
<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
<tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
<tr><th></th><th>(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th><th>(7)</th><th>(8)</th><th>(9)</th><th>(11)</th><th>(12)</th></tr> 

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
</table>
</body>
</html>