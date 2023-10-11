@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan saat ini</h5>
                        <div class="row">
                            <div class="col-lg-10">
                                <p>Berikut merupakan data laporan saat ini.</p>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <form id="search-form" action="/search-semester">
                                            Pilih Laporan berdasarkan semester (Rentang Bulan) : 
                                            <div class="row">
                                                <div class="col">
                                                    <select id="bulan1" name="bulan1" class="form-control form-control-sm mb-3 mt-2" name="">
                                                        <option value="">Pilih Bulan</option>
                                                        <option value="01" {{ session('bulan1') == 01 ? 'selected' : '' }}>Januari</option>
                                                        <option value="07" {{ session('bulan1') == 07 ? 'selected' : '' }}>Juli</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select id="bulan2" name="bulan2" class="form-control form-control-sm mb-3 mt-2" name="">
                                                        <option value="">Pilih Bulan</option>
                                                        <option value="06" {{ session('bulan2') == 06 ? 'selected' : '' }}>Juni</option>
                                                        <option value="12" {{ session('bulan2') == 12 ? 'selected' : '' }}>Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="col-lg-2 float-left mt-5">
                                <a href="/cetak-laporan-semester{{ session('bulan2') == 06 ? '?bulan1=01&bulan2=06' : '?bulan1=07&bulan2=12' }}" class="btn btn-success">
                                    Cetak <i class="bi bi-file-earmark-excel"></i>
                                </a>
                            </div>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-primary">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Table with stripped rows -->
                        <div class="row">
                            <div class="col-md-12 overflow-scroll">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                           <th rowspan="3" class="text-center">No.</th>
                                           <th rowspan="3" class="text-center">Pencari Kerja</th>
                                           <th colspan="10" class="text-center">Kelompok umur</th>
                                           <th colspan="3" rowspan="2"></th>
                                           <th rowspan="2"></th>
                                           <th rowspan="3" class="text-center">Lowongan</th>
                                           <th rowspan="3">L</th>
                                           <th rowspan="3">P</th>
                                           <th rowspan="3">L/P</th>
                                           <th rowspan="3">JML</th>
                                           <tr class="table-primary">
                                             <td colspan="2">15-19</td>
                                             <td colspan="2">20-29</td>
                                             <td colspan="2">30-44</td>
                                             <td colspan="2">45-54</td>
                                             <td colspan="2">55+</td>
                                             <tr class="table-primary">
                                                 <th>L</th>
                                                 <th>P</th>
                                                 <th>L</th>
                                                 <th>P</th>
                                                 <th>L</th>
                                                 <th>P</th>
                                                 <th>L</th>
                                                 <th>P</th>
                                                 <th>L</th>
                                                 <th>P</th>
                                                 <th>L</th>
                                                 <th>P</th>
                                                 <th>JML</th>
                                                 <th></th>
                                             </tr>
                                          </tr>
                                          </tr>
                                          <tr class="table-primary">
                                           <th></th>
                                           <th class="text-center">1</th>
                                           <th>2</th>
                                           <th>3</th>
                                           <th>4</th>
                                           <th>5</th>
                                           <th>6</th>
                                           <th>7</th>
                                           <th>8</th>
                                           <th>9</th>
                                           <th>10</th>
                                           <th>11</th>
                                           <th>12</th>
                                           <th>13</th>
                                           <th>14</th>
                                           <th></th>
                                           <th class="text-center">1</th>
                                           <th>2</th>
                                           <th>3</th>
                                           <th>4</th>
                                           <th>5</th>
                                          </tr>
                                          <tr>
                                           <td class="text-center">1.</th>
                                              <td>Pencari kerja yang belum ditempatkan pada semester sebelumnya</td>
                                              @foreach($laporan as $d)
                                              <td>{{$d->male_count_terdaftar}}</td>
                                              <td>{{$d->female_count_terdaftar}}</td>
                                              @endforeach
                                              <td>{{$jmlLSebelumnya}}</td>
                                              <td>{{$jmlPSebelumnya}}</td>
                                              <td>{{$jmlSebelumnya}}</td>
                                              <td>1.</td>
                                              <td>Lowongan yang belum dipenuhi semester sebelumnya</td>
                                              <td>{{$male_informasi_belum}}</td>
                                              <td>{{$female_informasi_belum}}</td>
                                              <td>{{$male_female_informasi_belum}}</td>
                                              <td>{{$jumlah_informasi_belum_lalu}}</td>
                                          </tr>
                                          <tr>
                                            <td class="text-center">2.</th>
                                                <td>Pencari kerja yang terdaftar pada semester ini</td>
                                                @foreach($genderAgeCounts as $data)
                                              <td>{{ $data['male_count'] }}</td>
                                              <td>{{ $data['female_count'] }}</td>
                                              @endforeach
                                              <td>{{$jmlL_terdaftar}}</td>
                                              <td>{{$jmlP_terdaftar}}</td>
                                              <td>{{$jml_terdaftar}}</td>
                                                <td>2.</td>
                                                <td>Lowongan yang terdaftar semester ini</td>
                                                <td>{{$male_informasi_terdaftar}}</td>
                                                <td>{{$female_informasi_terdaftar}}</td>
                                                <td>{{$male_female_informasi_terdaftar}}</td>
                                                <td>{{$jumlah_informasi_terdaftar_now}}</td>
                                            </tr>
                                          <tr class="table-primary">
                                            <th>A.</th>
                                            <th>Jumlah (1+2)</th>
                                            @foreach($genderAgeCounts as $data)
                                            <th>{{ $data['jumlahMaleA'] }}</th>
                                            <th>{{ $data['jumlahFemaleA'] }}</th>
                                            @endforeach
                                            <th>{{$jumlahLA}}</th>
                                            <th>{{$jumlahPA}}</th>
                                            <th>{{$jumlahA}}</th>
                                            <th></th>
                                            <th></th>
                                            <th>{{$jumlah_informasi_male_a}}</th>
                                            <th>{{$jumlah_informasi_female_a}}</th>
                                            <th>{{$jumlah_informasi_male_female_a}}</th>
                                            <th>{{$jumlah_informasi_a}}</th>
                                          </tr>
                                          <tr>
                                            <td>3.</td>
                                            <td>Pencari Kerja yang ditempatkan pada semester ini</td>
                                            
                                            @foreach($genderAgeCounts as $data)
                                            <td>{{$data['male_count_ditempatkan']}}</td>
                                            <td>{{$data['female_count_ditempatkan']}}</td>
                                            @endforeach
                                            <td>{{$jmlL_ditempatkan}}</td>
                                            <td>{{$jmlP_ditempatkan}}</td>
                                            <td>{{$jmlDitempatkan}}</td>
                                            <td>3.</td>
                                            <td>Lowongan yang dipenuhi semester ini</td>
                                            <td>{{$informasi_terpenuhi_male}}</td>
                                            <td>{{$informasi_terpenuhi_female}}</td>
                                            <td>{{$informasi_terpenuhi_male_female}}</td>
                                            <td>{{$jumlah_informasi_terpenuhi}}</td>
                                          </tr>
                                          <tr>
                                            <td>4.</td>
                                            <td>Pencari Kerja yang dihapuskan dalam semester ini</td>                                        
                                            @foreach($genderAgeCounts as $data)
                                            <td>{{$data['male_count_delete']}}</td>
                                            <td>{{$data['female_count_delete']}}</td>
                                            @endforeach
                                            <td>{{$deleteUserNowL}}</td>
                                            <td>{{$deleteUserNowP}}</td>
                                            <td>{{$deleteUserNow}}</td>
                                            <td>4.</td>
                                            <td>Lowongan yang dihapuskan semester ini</td>
                                            <td>{{$informasi_male_delete}}</td>
                                            <td>{{$informasi_female_delete}}</td>
                                            <td>{{$informasi_male_female_delete}}</td>
                                            <td>{{$jumlah_informasi_delete}}</td>
                                        </tr>
                                          <tr class="table-primary">
                                            <th>B.</th>
                                            <th>Jumlah (3+4)</th>
                                            @foreach($genderAgeCounts as $data)
                                            <th>{{ $data['jumlahMaleB'] }}</th>
                                            <th>{{ $data['jumlahFemaleB'] }}</th>
                                            @endforeach
                                            <th>{{$jumlahLB}}</th>
                                            <th>{{$jumlahPB}}</th>
                                            <th>{{$jumlahB}}</th>
                                            <th></th>
                                            <th></th>
                                            <th>{{$jumlah_informasi_male_b}}</th>
                                            <th>{{$jumlah_informasi_female_b}}</th>
                                            <th>{{$jumlah_informasi_male_female_b}}</th>
                                            <th>{{$jumlah_informasi_b}}</th>
                                          </tr>
                                          <tr>
                                            <td>5.</td>
                                            <td>Pencari Kerja yang belum ditempatkan pada akhir semester ini (A-B)</td>
                                            
                                            @foreach($genderAgeCounts as $data)
                                            <td>{{$data['jumlahMale']}}</td>
                                            <td>{{$data['jumlahFemale']}}</td>
                                            @endforeach
                                            <td>{{$jumlahMale5}}</td>
                                            <td>{{$jumlahFemale5}}</td>
                                            <td>{{$jumlahAkhirPekerja}}</td>
                                            <td>5.</td>
                                            <td>Lowongan yang belum dipenuhi akhir semester ini</td>
                                            <td>{{$jumlah_informasi_male}}</td>
                                            <td>{{$jumlah_informasi_female}}</td>
                                            <td>{{$jumlah_informasi_male_female}}</td>
                                            <td>{{$jumlah_informasi}}</td>
                                        </tr>
                                          </thead>
                                        </table>
                        <!-- End Table with stripped rows -->   
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->



@include('dashboard/templates/footer')
@include('dashboard/modal/modal-tenaga-kerja')

@endsection