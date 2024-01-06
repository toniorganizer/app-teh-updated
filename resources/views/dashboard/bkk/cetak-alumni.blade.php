<!DOCTYPE html>
<html>
<head>

<body>
<table>
<tr><td></td><td></td></tr>
<tr><td></td><td colspan="4" style="text-align: center;">{{$title}}</td></tr>
<tr><td></td><td colspan="4" style="text-align: center;">{{$alamat}}</td></tr>
<tr><td></td><td colspan="4" style="text-align: center;">{{$telepon}}</td></tr>
<tr><td></td><td></td></tr>
<tr>
    <th scope="col">No.</th>
    <th scope="col">Nama Alumni</th>
    <th scope="col">Nama Sekolah</th>
    <th scope="col">Jurusan</th>
    <th scope="col">Tahun Lulus</th>
</tr>
<?php $no = 1; ?>
@foreach($data as $item)
    <tr>
        <td>{{$no++}}</td>
        <td>{{$item->nama_lengkap}}</td>
        <td>{{$item->nama_sekolah}}</td>
        <td>{{$item->jurusan}}</td>
        <td>{{$item->tahun_lulus}}</td>
    </tr>     
@endforeach
</table>
</body>
</html>