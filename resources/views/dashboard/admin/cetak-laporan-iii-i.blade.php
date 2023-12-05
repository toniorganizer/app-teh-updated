<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
@if($semester->type == 'Lampiran')
    <tr><td></td><td></td><td colspan="18" style="text-align: center;">{{$title}}</td></tr>
    <tr><td></td><td></td><td colspan="18" style="text-align: center;">IPK - III/1 IKHTISAR STATISTIK ANTAR KERJA</td></tr>
    @if($disnaker->email_lembaga == 'disnaker@gmail.com')
    <tr><td></td><td></td><td></td></tr>
    @else
    <tr><td></td><td></td><td colspan="18" style="text-align: center;">SEMESTER : {{$semester->tgl_1}} S/D {{$semester->tgl_2}}</td></tr>
    @endif
    <tr><td></td><td></td><td></td></tr>
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
<tr><th rowspan="3">No.</th><th rowspan="3">PENCARI KERJA</th><th colspan="10">KELOMPOK UMUR</th><th colspan="3" rowspan="2"></th><th rowspan="2"></th><th rowspan="3">LOWONGAN</th><th rowspan="3">L</th><th rowspan="3">P</th><th rowspan="3">JML</th></tr>
<tr><td colspan="2">15-19</td><td colspan="2">20-29</td><td colspan="2">30-44</td><td colspan="2">45-54</td><td colspan="2">55+</td></tr><tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>JML</th><th></th></tr>
        <tr><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th></th><th>1</th><th>2</th><th>3</th><th>4</th></tr>
        @if($disnaker->email_lembaga == 'disnaker@gmail.com')
        <tr>
                <td>{{$pencari_kerja1->nmr}}</td>
                <td>{{ $pencari_kerja1->pencari_kerja }}</td>
                <td>{{ $jumlahL151 }}</td>
                <td>{{ $jumlahP151 }}</td>
                <td>{{ $jumlahL201 }}</td>
                <td>{{ $jumlahP201 }}</td>
                <td>{{ $jumlahL301 }}</td>
                <td>{{ $jumlahP301 }}</td>
                <td>{{ $jumlahL451 }}</td>
                <td>{{ $jumlahP451 }}</td>
                <td>{{ $jumlahL551 }}</td>
                <td>{{ $jumlahP551 }}</td>
                <td>{{ $pencari_kerja1->L }}</td>
                <td>{{ $pencari_kerja1->P }}</td>
                <td>{{ $pencari_kerja1->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerja1->lowongan }}</td>
                <td>{{ $jumlahLowonganL1 }}</td>
                <td>{{ $jumlahLowonganP1 }}</td>
                <td>{{ $pencari_kerja1->jml_lowongan }}</td>
            </tr>
            <tr>
                <td>{{$pencari_kerja2->nmr}}</td>
                <td>{{ $pencari_kerja2->pencari_kerja }}</td>
                <td>{{ $jumlahL152 }}</td>
                <td>{{ $jumlahP152 }}</td>
                <td>{{ $jumlahL202 }}</td>
                <td>{{ $jumlahP202 }}</td>
                <td>{{ $jumlahL302 }}</td>
                <td>{{ $jumlahP302 }}</td>
                <td>{{ $jumlahL452 }}</td>
                <td>{{ $jumlahP452 }}</td>
                <td>{{ $jumlahL552 }}</td>
                <td>{{ $jumlahP552 }}</td>
                <td>{{ $pencari_kerja2->L }}</td>
                <td>{{ $pencari_kerja2->P }}</td>
                <td>{{ $pencari_kerja2->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerja2->lowongan }}</td>
                <td>{{ $jumlahLowonganL2 }}</td>
                <td>{{ $jumlahLowonganP2 }}</td>
                <td>{{ $pencari_kerja2->jml_lowongan }}</td>
            </tr>
            <tr>
                <td>{{$pencari_kerjaA->nmr}}</td>
                <td>{{ $pencari_kerjaA->pencari_kerja }}</td>
                <td>{{ $pencari_kerjaA->{'15_L'} }}</td>
                <td>{{ $pencari_kerjaA->{'15_P'} }}</td>
                <td>{{ $pencari_kerjaA->{'20_L'} }}</td>
                <td>{{ $pencari_kerjaA->{'20_P'} }}</td>
                <td>{{ $pencari_kerjaA->{'30_L'} }}</td>
                <td>{{ $pencari_kerjaA->{'30_P'} }}</td>
                <td>{{ $pencari_kerjaA->{'45_L'} }}</td>
                <td>{{ $pencari_kerjaA->{'45_P'} }}</td>
                <td>{{ $pencari_kerjaA->{'55_L'} }}</td>
                <td>{{ $pencari_kerjaA->{'55_P'} }}</td>
                <td>{{ $pencari_kerjaA->L }}</td>
                <td>{{ $pencari_kerjaA->P }}</td>
                <td>{{ $pencari_kerjaA->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerjaA->lowongan }}</td>
                <td>{{ $pencari_kerjaA->{'15_L'} }}</td>
                <td>{{ $pencari_kerjaA->{'15_L'} }}</td>
                <td>{{ $pencari_kerjaA->jml_lowongan }}</td>
            </tr>
            <tr>
                <td>{{$pencari_kerja3->nmr}}</td>
                <td>{{ $pencari_kerja3->pencari_kerja }}</td>
                <td>{{ $jumlahL153 }}</td>
                <td>{{ $jumlahP153 }}</td>
                <td>{{ $jumlahL203 }}</td>
                <td>{{ $jumlahP203 }}</td>
                <td>{{ $jumlahL303 }}</td>
                <td>{{ $jumlahP303 }}</td>
                <td>{{ $jumlahL453 }}</td>
                <td>{{ $jumlahP453 }}</td>
                <td>{{ $jumlahL553 }}</td>
                <td>{{ $jumlahP553 }}</td>
                <td>{{ $pencari_kerja3->L }}</td>
                <td>{{ $pencari_kerja3->P }}</td>
                <td>{{ $pencari_kerja3->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerja3->lowongan }}</td>
                <td>{{ $jumlahLowonganL3 }}</td>
                <td>{{ $jumlahLowonganP3 }}</td>
                <td>{{ $pencari_kerja3->jml_lowongan }}</td>
            </tr>
            <tr>
                <td>{{$pencari_kerja4->nmr}}</td>
                <td>{{ $pencari_kerja4->pencari_kerja }}</td>
                <td>{{ $jumlahL154 }}</td>
                <td>{{ $jumlahP154 }}</td>
                <td>{{ $jumlahL204 }}</td>
                <td>{{ $jumlahP204 }}</td>
                <td>{{ $jumlahL304 }}</td>
                <td>{{ $jumlahP304 }}</td>
                <td>{{ $jumlahL454 }}</td>
                <td>{{ $jumlahP454 }}</td>
                <td>{{ $jumlahL554 }}</td>
                <td>{{ $jumlahP554 }}</td>
                <td>{{ $pencari_kerja4->L }}</td>
                <td>{{ $pencari_kerja4->P }}</td>
                <td>{{ $pencari_kerja4->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerja4->lowongan }}</td>
                <td>{{ $jumlahLowonganL4 }}</td>
                <td>{{ $jumlahLowonganP4 }}</td>
                <td>{{ $pencari_kerja4->jml_lowongan }}</td>
            </tr>
            <tr>
                <td>{{$pencari_kerjaB->nmr}}</td>
                <td>{{ $pencari_kerjaB->pencari_kerja }}</td>
                <td>{{ $pencari_kerjaB->{'15_L'} }}</td>
                <td>{{ $pencari_kerjaB->{'15_P'} }}</td>
                <td>{{ $pencari_kerjaB->{'20_L'} }}</td>
                <td>{{ $pencari_kerjaB->{'20_P'} }}</td>
                <td>{{ $pencari_kerjaB->{'30_L'} }}</td>
                <td>{{ $pencari_kerjaB->{'30_P'} }}</td>
                <td>{{ $pencari_kerjaB->{'45_L'} }}</td>
                <td>{{ $pencari_kerjaB->{'45_P'} }}</td>
                <td>{{ $pencari_kerjaB->{'55_L'} }}</td>
                <td>{{ $pencari_kerjaB->{'55_P'} }}</td>
                <td>{{ $pencari_kerjaB->L }}</td>
                <td>{{ $pencari_kerjaB->P }}</td>
                <td>{{ $pencari_kerjaB->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerjaB->lowongan }}</td>
                <td>{{ $pencari_kerjaB->{'15_L'} }}</td>
                <td>{{ $pencari_kerjaB->{'15_L'} }}</td>
                <td>{{ $pencari_kerjaB->jml_lowongan }}</td>
            </tr>
            <tr>
                <td>{{$pencari_kerja5->nmr}}</td>
                <td>{{ $pencari_kerja5->pencari_kerja }}</td>
                <td>{{ $pencari_kerja5->{'15_L'} }}</td>
                <td>{{ $pencari_kerja5->{'15_P'} }}</td>
                <td>{{ $pencari_kerja5->{'20_L'} }}</td>
                <td>{{ $pencari_kerja5->{'20_P'} }}</td>
                <td>{{ $pencari_kerja5->{'30_L'} }}</td>
                <td>{{ $pencari_kerja5->{'30_P'} }}</td>
                <td>{{ $pencari_kerja5->{'45_L'} }}</td>
                <td>{{ $pencari_kerja5->{'45_P'} }}</td>
                <td>{{ $pencari_kerja5->{'55_L'} }}</td>
                <td>{{ $pencari_kerja5->{'55_P'} }}</td>
                <td>{{ $pencari_kerja5->L }}</td>
                <td>{{ $pencari_kerja5->P }}</td>
                <td>{{ $pencari_kerja5->jml }}</td>
                <td></td>
                <td>{{ $pencari_kerja5->lowongan }}</td>
                <td>{{ $pencari_kerja5->{'15_L'} }}</td>
                <td>{{ $pencari_kerja5->{'15_L'} }}</td>
                <td>{{ $pencari_kerja5->jml_lowongan }}</td>
            </tr>
        @else
                @foreach($data as $laporan)
                <tr>
                        <td>{{$laporan->nmr}}</td>
                        <td>{{ $laporan->pencari_kerja }}</td>
                        <td>{{ $laporan->{'15_L'} }}</td>
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
        @endif

</table>
</body>
</html>