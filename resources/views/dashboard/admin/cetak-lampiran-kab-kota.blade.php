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
<table>
    <tr><th rowspan="2">No</th><th rowspan="2">Kab / Kota</th><th colspan="3">Pencari Kerja Terdaftar</th><th colspan="3">Lowongan Kerja Terdaftar</th><th colspan="3">PencariKerja Ditempatkan</th><th rowspan="2">Action</th></tr> 
    <tr><th>L</th><th>W</th><th>L + W</th><th>L</th><th>W</th><th>L + W</th><th>L</th><th>W</th><th>L + W</th></tr> 
    <tr>
      <th></th>
      <th></th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    </table>
</table>
</body>
</html>