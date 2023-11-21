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
              <h5 class="card-title">Table Laporan-IPK-III-1 | {{$nama->nama_lembaga}}</h5>
              <div class="activity overflow-scroll">
                <table class="table table-bordered center">
                    <tr><th rowspan="3">Pencari Kerja</th><th colspan="10">Kelompok umur</th><th colspan="3" rowspan="2">Jumlah</th><th rowspan="3">Lowongan</th><th rowspan="3">L</th><th rowspan="3">P</th><th rowspan="3">JML</th><th rowspan="3">Action</th></tr> 
                    <tr><td colspan="2">15-19</td><td colspan="2">20-29</td><td colspan="2">30-44</td><td colspan="2">45-54</td><td colspan="2">55+</td></tr> <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>JML</th></tr> 
                    <tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>1</th><th>2</th><th>3</th><th>4</th></tr>

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
                        <td><form action="/edit-laporan-i/{{$laporan->nmr}}">
                            <input type="hidden" name="id_disnaker" value="{{$laporan->id_disnaker}}">
                            <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                        </form>
                    </td>

                    </tr>
                    @endforeach
                    
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
            </div><!-- End Recent Activity -->
            </div>
        </div>

            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Template</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="{{Storage::url('public/file/Template.xlsx')}}" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Download Hasil</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="/cetak-laporan-i/{{$nama->email_lembaga}}" class="btn btn-info mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
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