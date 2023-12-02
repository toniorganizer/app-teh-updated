<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
@if($disnaker->email_lembaga == 'disnaker@gmail.com' || $semester->type == 'Lampiran')
    <tr><td></td><td></td><td colspan="8" style="text-align: center;">{{$title}}</td></tr>
    <tr><td></td><td></td><td colspan="8" style="text-align: center;">IPK III/8 : PENEMPATAN PENCARI KERJA MENURUT JENIS ANTAR KERJA UNTUK TINGKAT PENDIDIKAN</td></tr>
    <tr><td></td><td></td><td colspan="8" style="text-align: center;">DAN LEMBAGA PENERIMAAN TENAGA KERJA BERDASARKAN JENIS KELAMIN</td></tr>
    @if($disnaker->email_lembaga == 'disnaker@gmail.com')
    <tr><td></td><td></td><td></td></tr>
    @else
    <tr><td></td><td></td><td colspan="8" style="text-align: center;">SEMESTER : {{$semester->tgl_1}} S/D {{$semester->tgl_2}}</td></tr>
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
<tr><th colspan="2" rowspan="3">TINGKAT PENDIDIKAN PENCARI KERJA DAN PENERIMA TENAGA KERJA</th><th colspan="6">Jenis Antar Kerja</th><th rowspan="2" colspan="2">Jumlah</th></tr>
<tr><th colspan="2">AKL</th><th colspan="2">AKAD</th><th colspan="2">AKAN</th></tr>
<tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr>
<tr><th colspan="2">(1)</th><th>(2)</th><th>(3)</th><th>(4)</th><th>(5)</th><th>(6)</th><th>(7)</th><th>(8)</th><th>(9)</th></tr>

@if($disnaker->email_lembaga == 'disnaker@gmail.com')
@if(isset($laporan) && $laporan->count() > 0)
@foreach($laporan as $lap)
@if($lap->judul == 'Sub Total' || $lap->judul == 'SMK : JURUSAN')
<tr>
    <td>{{$lap->nmr}}</td>
    <td>{{$lap->judul}}</td>
    <td>{{$lap->akll_s}}</td>
    <td>{{$lap->aklp_s}}</td>
    <td>{{$lap->akadl_s}}</td>
    <td>{{$lap->akadp_s}}</td>
    <td>{{$lap->akanl_s}}</td>
    <td>{{$lap->akanp_s}}</td>
    <td>{{$lap->jmll}}</td>
    <td>{{$lap->jmlp}}</td>
</tr>
@else
<tr>
    <td>{{$lap->nmr}}</td>
    <td>{{$lap->judul}}</td>
    <td>{{$lap->akll}}</td>
    <td>{{$lap->aklp}}</td>
    <td>{{$lap->akadl}}</td>
    <td>{{$lap->akadp}}</td>
    <td>{{$lap->akanl}}</td>
    <td>{{$lap->akanp}}</td>
    <td>{{$lap->jmll}}</td>
    <td>{{$lap->jmlp}}</td>
</tr>
@endif
@endforeach
@endif
@else
@foreach($data as $item)
<tr>
    <td>{{$item->nmr}}</td>
    <td>{{$item->judul}}</td>
    <td>{{$item->akll}}</td>
    <td>{{$item->aklp}}</td>
    <td>{{$item->akadl}}</td>
    <td>{{$item->akadp}}</td>
    <td>{{$item->akanl}}</td>
    <td>{{$item->akanp}}</td>
    <td>{{$item->jmll}}</td>
    <td>{{$item->jmlp}}</td>
</tr>
@endforeach
@endif
</table>
</body>
</html>