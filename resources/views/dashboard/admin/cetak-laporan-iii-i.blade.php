<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>{{$title}}</td></tr>
<tr><td></td><td></td><td>{{$semester->tgl_1}} S/D {{$semester->tgl_2}}</td></tr>
<tr><td></td><td></td><td>Dinas Tenaga Kerja dan Transmigrasi Propisi Sumatera Barat</td></tr>
<tr><td></td><td></td><td>Jl. Ujung Gurun No. 7 Padang</td></tr>
<tr><td></td><td></td><td>( 0751 ) 27430 - 37430</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><th rowspan="3">No.</th><th rowspan="3">PENCARI KERJA</th><th colspan="10">KELOMPOK UMUR</th><th colspan="3" rowspan="2"></th><th rowspan="2"></th><th rowspan="3">LOWONGAN</th><th rowspan="3">L</th><th rowspan="3">P</th><th rowspan="3">JML</th></tr>
<tr><td colspan="2">15-19</td><td colspan="2">20-29</td><td colspan="2">30-44</td><td colspan="2">45-54</td><td colspan="2">55+</td></tr><tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>JML</th><th></th></tr>
        <tr><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th></th><th>1</th><th>2</th><th>3</th><th>4</th></tr>
        @foreach($data as $laporan)
        <tr>
                <td>{{$laporan->nmr}}</td>
                <td>{{ $laporan->pencari_kerja }}</td>
                <td>{{ += $laporan->{'15_L'} }}</td>
                <td>{{ $laporan->{'15_P'} }}</td>
                <td>{{ $laporan->{'20_L'} }}</td>
                <td>{{ $laporan->{'20_P'} }}</td>
                <td>{{ $laporan->{'30_L'} }}</td>
                <td>{{ $laporan->{'30_P'} }}</td>
                <td>{{ $laporan->{'45_L'} }}</td>
                <td>{{ $laporan->{'45_P'} }}</td>
                <td>{{ $laporan->{'55_L'} }}</td>
                <td>{{ $laporan->{'55_P'} }}</td>
                <td>{{ $laporan->L }}</td>
                <td>{{$laporan->P}}</td>
                <td>{{$laporan->jml }}</td>
                <td></td>
                <td>{{$laporan->lowongan}}</td>
                <td>{{ $laporan->lowongan_L }}</td>
                <td>{{ $laporan->lowongan_P }}</td>
                <td>{{ $laporan->jml_lowongan}}</td>
        </tr>
        @endforeach

</table>
</body>
</html>