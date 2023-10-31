@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan IPK-III-1</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan IPK-III-1</li>
            </ol>
            @if (session('success'))
            <div class="alert alert-primary">
                {{ session('success') }}
            </div>
            @endif
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Table Laporan-IPK-III-1</h5>
              <div class="activity overflow-scroll">
                <table class="table table-bordered center">
                    <tr><th rowspan="3">Pencari Kerja</th><th colspan="10">Kelompok umur</th><th colspan="3" rowspan="2">Jumlah</th><th rowspan="3">Lowongan</th><th rowspan="3">L</th><th rowspan="3">P</th><th rowspan="3">JML</th><th rowspan="3">Action</th></tr> 
                    <tr><td colspan="2">15-19</td><td colspan="2">20-29</td><td colspan="2">30-44</td><td colspan="2">45-54</td><td colspan="2">55+</td></tr> <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>JML</th></tr> 
                    <tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>1</th><th>2</th><th>3</th><th>4</th></tr>

                    @if($aturan->status_lembaga == 1)
                    @foreach($datalaporan as $laporan)
                    <tr>
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
                        <td>{{$laporan->{'15_L'} + $laporan->{'20_L'} + $laporan->{'30_L'} + $laporan->{'45_L'} + $laporan->{'55_L'} }}</td>
                        <td>{{$laporan->{'15_P'} + $laporan->{'20_P'} + $laporan->{'30_P'} + $laporan->{'45_P'} + $laporan->{'55_P'} }}</td>
                        <td>{{$laporan->{'15_L'} + $laporan->{'15_P'} + $laporan->{'20_L'} +  $laporan->{'20_P'} + $laporan->{'30_L'} + $laporan->{'30_P'} + $laporan->{'45_L'} + $laporan->{'45_P'} + $laporan->{'55_L'} + $laporan->{'55_P'} }}</td>
                        <td>{{$laporan->lowongan}}</td>
                        <td>{{ $laporan->lowongan_L }}</td>
                        <td>{{ $laporan->lowongan_P }}</td>
                        <td>{{ $laporan->lowongan_L + $laporan->lowongan_P }}</td>
                        <td><a href="/edit-laporan-i/{{$laporan->nmr}}" class="badge badge-primary"><i class="bi bi-pencil-square"></i></a></td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
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
                        <td>{{ $jumlahL151 + $jumlahL201 + $jumlahL301 + $jumlahL451 + $jumlahL551 }}</td>
                        <td>{{ $jumlahP151 + $jumlahP201 + $jumlahP301 + $jumlahP451 + $jumlahP551 }}</td>
                        <td>{{ $jumlahL151 + $jumlahL201 + $jumlahL301 + $jumlahL451 + $jumlahL551 + $jumlahP151 + $jumlahP201 + $jumlahP301 + $jumlahP451 + $jumlahP551 }}</td>
                        <td>{{ $pencari_kerja1->lowongan }}</td>
                        <td>{{ $jumlahLowonganL1 }}</td>
                        <td>{{ $jumlahLowonganP1 }}</td>
                        <td>{{ $jumlahLowonganL1 + $jumlahLowonganP1 }}</td>
                    </tr>
                    <tr>
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
                        <td>{{ $jumlahL152 + $jumlahL202 + $jumlahL302 + $jumlahL452 + $jumlahL552 }}</td>
                        <td>{{ $jumlahP152 + $jumlahP202 + $jumlahP302 + $jumlahP452 + $jumlahP552 }}</td>
                        <td>{{ $jumlahL152 + $jumlahL202 + $jumlahL302 + $jumlahL452 + $jumlahL552 + $jumlahP152 + $jumlahP202 + $jumlahP302 + $jumlahP452 + $jumlahP552 }}</td>
                        <td>{{ $pencari_kerja2->lowongan }}</td>
                        <td>{{ $jumlahLowonganL2 }}</td>
                        <td>{{ $jumlahLowonganP2 }}</td>
                        <td>{{ $jumlahLowonganL2 + $jumlahLowonganP2 }}</td>
                    </tr>
                    <tr>
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
                        <td>{{ $jumlahL153 + $jumlahL203 + $jumlahL303 + $jumlahL453 + $jumlahL553 }}</td>
                        <td>{{ $jumlahP153 + $jumlahP203 + $jumlahP303 + $jumlahP453 + $jumlahP553 }}</td>
                        <td>{{ $jumlahL153 + $jumlahL203 + $jumlahL303 + $jumlahL453 + $jumlahL553 + $jumlahP153 + $jumlahP203 + $jumlahP303 + $jumlahP453 + $jumlahP553 }}</td>
                        <td>{{ $pencari_kerja3->lowongan }}</td>
                        <td>{{ $jumlahLowonganL3 }}</td>
                        <td>{{ $jumlahLowonganP3 }}</td>
                        <td>{{ $jumlahLowonganL3 + $jumlahLowonganP3 }}</td>
                    </tr>
                    <tr>
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
                        <td>{{ $jumlahL154 + $jumlahL204 + $jumlahL304 + $jumlahL454 + $jumlahL554 }}</td>
                        <td>{{ $jumlahP154 + $jumlahP204 + $jumlahP304 + $jumlahP454 + $jumlahP554 }}</td>
                        <td>{{ $jumlahL154 + $jumlahL204 + $jumlahL304 + $jumlahL454 + $jumlahL554 + $jumlahP154 + $jumlahP204 + $jumlahP304 + $jumlahP454 + $jumlahP554 }}</td>
                        <td>{{ $pencari_kerja4->lowongan }}</td>
                        <td>{{ $jumlahLowonganL4 }}</td>
                        <td>{{ $jumlahLowonganP4 }}</td>
                        <td>{{ $jumlahLowonganL4 + $jumlahLowonganP4 }}</td>
                    </tr>
                    @endif
                </table>
                
            </div>
          </div><!-- End Recent Activity -->
        </div>
        </div> 

        <div class="col-lg-8">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan-IPK-III-1</h5>
              <div class="activity">
                <p style="text-align: justify">  @if($aturan->status_lembaga == 1)<span class="fw-bold text-dark">Edit data dapat dilakukan dengan menekan tombol pada kolom action. Tombol hapus, digunakan untuk menghapus keseluruhan data yang sudah di import, hal ini bisa dilakukan jika ingin melakukan import ulang.</span>@endif</p>

                <p style="text-align: justify">Pelaksanaan pembuatan laporan dapat dilakukan dengan download template terlebih dahulu, kemudian isi template berdasarkan data laporan yang ada. Pastikan setiap kolom terisi dengan benar sebelum melakukan import data.</p>

                <p style="text-align: justify">Silahkan buat terlebih dahulu rentang tanggal terhadap laporan yang telah dibuat, kemudian pilih file laporan berdasarkan template yang sudah terisi data, selanjutnya pilih import. </p>

                <form id="search-form" action="/import" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input name="tgl1" type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input name="tgl2" type="date" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="file" class="form-control-file" name="file">
                    </div>
                    <div class="col-md-6 mt-2">
                        <button type="submit" class="btn btn-success mt-0"><i class="bi bi-cloud-arrow-up"></i> Import</button>
                    </div>
                </div>
                </form>
                
            </div>
          </div><!-- End Recent Activity -->
        </div>
        </div>

            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Template  @if($aturan->status_lembaga == 1) & Delete @endif</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="{{Storage::url('public/file/Template.xlsx')}}" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                            @if($aturan->status_lembaga == 1)
                            <div class="col-lg-3">
                                <a href="/delete-laporan-i/{{Auth::user()->email}}" class="btn btn-danger mt-0" onclick="return confirm('Anda yakin ingin menghapus data laporan IPK-III-I ?')"><i class="bi bi-trash3"></i></a>
                            </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-0">Download Hasil</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="/cetak-laporan-i/{{Auth::user()->email}}" class="btn btn-info mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                        </div><!-- End Website Traffic -->
                        @if(Auth::user()->email == 'disnaker@gmail.com')
                        <h5 class="card-title mb-0">Laporan Kab/Kota</h5>
                        <div class="activity">
                            @foreach($kab as $data)
                            <div class="activity-item d-flex">
                              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                              <div class="activity-content"><a href="/detail-laporan-kab/{{$data->email_lembaga}}" class="fw-bold text-dark">{{$data->nama_lembaga}}</a>
                              </div>
                            </div><!-- End activity item-->
                            @endforeach
                          </div>
                          @endif
                    </div>
                </div>  
            </div>        

    </section>

</main>
@include('dashboard/templates/footer')
@endsection