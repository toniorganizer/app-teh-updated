<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td>LAPORAN IPK III - IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT</td></tr>
<tr><td></td><td></td><td>JANUARI S/D DESEMBER {{date('Y')}}</td></tr>
<tr><td></td><td></td><td>Dinas Tenaga Kerja dan Transmigrasi Propisi Sumatera Barat</td></tr>
<tr><td></td><td></td><td>Jl. Ujung Gurun No. 7 Padang</td></tr>
<tr><td></td><td></td><td>( 0751 ) 27430 - 37430</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><th rowspan="3">No.</th><th rowspan="3">PENCARI KERJA</th><th colspan="10">KELOMPOK UMUR</th><th colspan="3" rowspan="2"></th><th rowspan="2"></th><th rowspan="3">LOWONGAN</th><th rowspan="3">L</th><th rowspan="3">P</th><th rowspan="3">L/P</th><th rowspan="3">JML</th></tr><tr><td colspan="2">15-19</td><td colspan="2">20-29</td><td colspan="2">30-44</td><td colspan="2">45-54</td><td colspan="2">55+</td></tr><tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>JML</th><th></th></tr>
        <tr><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th></tr>
        <tr><td>1.</td><td>PENCARI KERJA YANG BELUM DITEMPATKAKN PADA TAHUN SEBELUMNYA</td>@foreach($laporan as $d)<td>{{$d->male_count_terdaftar}}</td><td>{{$d->female_count_terdaftar}}</td>@endforeach<td>{{$jmlLSebelumnya}}</td><td>{{$jmlPSebelumnya}}</td><td>{{$jmlSebelumnya}}</td><td>1.</td><td>LOWONGAN YANG BELUM DIPENUHI TAHUN SEBELUMNYA</td><td>{{$male_informasi_belum}}</td><td>{{$female_informasi_belum}}</td><td>{{$male_female_informasi_belum}}</td><td>{{$jumlah_informasi_belum_lalu}}</td></tr>
        <tr><td>2.</td><td>PENCARI KERJA YANG TERDAFTAR PADA TAHUN INI</td>@foreach($genderAgeCounts as $data)<td>{{ $data['male_count'] }}</td><td>{{ $data['female_count'] }}</td>@endforeach<td>{{$jmlL_terdaftar}}</td><td>{{$jmlP_terdaftar}}</td><td>{{$jml_terdaftar}}</td><td>2.</td><td>LOWONGAN YANG TERDAFTAR TAHUN INI</td><td>{{$male_informasi_terdaftar}}</td><td>{{$female_informasi_terdaftar}}</td><td>{{$male_female_informasi_terdaftar}}</td><td>{{$jumlah_informasi_terdaftar_now}}</td></tr>
        <tr><th>A.</th><th>JUMLAH (1+2)</th>@foreach($genderAgeCounts as $data)<th>{{ $data['jumlahMaleA'] }}</th><th>{{ $data['jumlahFemaleA'] }}</th>@endforeach<th>{{$jumlahLA}}</th><th>{{$jumlahPA}}</th><th>{{$jumlahA}}</th><th></th><th></th><th>{{$jumlah_informasi_male_a}}</th><th>{{$jumlah_informasi_female_a}}</th><th>{{$jumlah_informasi_male_female_a}}</th><th>{{$jumlah_informasi_a}}</th></tr>
        <tr><td>3.</td><td>PENCARI KERJA YANG DITEMPATKAN PADA TAHUN INI</td>@foreach($genderAgeCounts as $data)<td>{{$data['male_count_ditempatkan']}}</td><td>{{$data['female_count_ditempatkan']}}</td>@endforeach<td>{{$jmlL_ditempatkan}}</td><td>{{$jmlP_ditempatkan}}</td><td>{{$jmlDitempatkan}}</td><td>3.</td><td>LOWONGAN YANG DIPENUHI TAHUN INI</td><td>{{$informasi_terpenuhi_male}}</td><td>{{$informasi_terpenuhi_female}}</td><td>{{$informasi_terpenuhi_male_female}}</td><td>{{$jumlah_informasi_terpenuhi}}</td></tr>
        <tr><td>4.</td><td>PENCARI KERJA YANG DIHAPUSKAN TAHUN INI</td>@foreach($genderAgeCounts as $data)<td>{{$data['male_count_delete']}}</td><td>{{$data['female_count_delete']}}</td>@endforeach<td>{{$deleteUserNowL}}</td><td>{{$deleteUserNowP}}</td><td>{{$deleteUserNow}}</td><td>4.</td><td>LOWONGAN YANG DIHAPUSKAN TAHUN INI</td><td>{{$informasi_male_delete}}</td><td>{{$informasi_female_delete}}</td><td>{{$informasi_male_female_delete}}</td><td>{{$jumlah_informasi_delete}}</td></tr>
        <tr><th>B.</th><th>JUMLAH (3+4)</th>@foreach($genderAgeCounts as $data)<th>{{ $data['jumlahMaleB'] }}</th><th>{{ $data['jumlahFemaleB'] }}</th>@endforeach<th>{{$jumlahLB}}</th><th>{{$jumlahPB}}</th><th>{{$jumlahB}}</th><th></th><th></th><th>{{$jumlah_informasi_male_b}}</th><th>{{$jumlah_informasi_female_b}}</th><th>{{$jumlah_informasi_male_female_b}}</th><th>{{$jumlah_informasi_b}}</th></tr>
        <tr><td>5.</td><td>PENCARI KERJA YANG BELUM DITEMPATKAN PADA AKHIR TAHUN INI (A-B)</td>@foreach($genderAgeCounts as $data)<td>{{$data['jumlahMale']}}</td><td>{{$data['jumlahFemale']}}</td>@endforeach<td>{{$jumlahMale5}}</td><td>{{$jumlahFemale5}}</td><td>{{$jumlahAkhirPekerja}}</td><td>5.</td><td>LOWONGAN YANG BELUM DIPENUHI AKHIR TAHUN INI</td><td>{{$jumlah_informasi_male}}</td><td>{{$jumlah_informasi_female}}</td><td>{{$jumlah_informasi_male_female}}</td><td>{{$jumlah_informasi}}</td></tr>
</table>
</body>
</html>