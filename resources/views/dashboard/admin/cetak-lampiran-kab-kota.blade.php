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

<tr><th rowspan="3">No</th><th rowspan="3">Kabupaten / Kota</th><th rowspan="1" colspan="3">Pencari Kerja Terdaftar</th><th rowspan="1" colspan="3">Lowongan Kerja Terdaftar</th><th rowspan="1" colspan="3">PencariKerja Ditempatkan</th></tr>
<tr><th></th><th></th><th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
<tr><th>L</th><th>W</th><th>L + W</th><th>L</th><th>W</th><th>L + W</th><th>L</th><th>W</th><th>L + W</th></tr>
<tr><th></th><th></th><th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr> 
@if($disnaker->email_lembaga == 'disnaker@gmail.com')
@if(isset($laporan) && $laporan->count() > 0)
@foreach($laporan as $lap)
<tr>
  <td>{{$lap->nmr}}</td>
  <td>{{$lap->judul}}</td>
  <td>{{$lap->pktl}}</td>
  <td>{{$lap->pktw}}</td>
  <td>{{$lap->jpkt}}</td>
  <td>{{$lap->lktl}}</td>
  <td>{{$lap->lktw}}</td>
  <td>{{$lap->jlkt}}</td>
  <td>{{$lap->pkdl}}</td>
  <td>{{$lap->pkdw}}</td>
  <td>{{$lap->jpkd}}</td>
</tr>
@endforeach
@endif
@else
@foreach($data as $item)
<tr>
  <td>{{$item->nmr}}</td>
  <td>{{$item->judul}}</td>
  <td>{{$item->pktl}}</td>
  <td>{{$item->pktw}}</td>
  <td>{{$item->jpkt}}</td>
  <td>{{$item->lktl}}</td>
  <td>{{$item->lktw}}</td>
  <td>{{$item->jlkt}}</td>
  <td>{{$item->pkdl}}</td>
  <td>{{$item->pkdw}}</td>
  <td>{{$item->jpkd}}</td>
</tr>
@endforeach
@endif
</table>
</body>
</html>