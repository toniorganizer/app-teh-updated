@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan IPK-III-4</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan IPK-III-4</li>
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
              <h5 class="card-title">Table Laporan-IPK-III-4 | {{$nama->nama_lembaga}}</h5>
              <div class="activity overflow-scroll">
                <table class="table table-bordered center">
                    <tr><th rowspan="2">No</th><th rowspan="2">Jenis Pendidikan</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th><th colspan="2">Sisa Akhir Smtr ini</th><th rowspan="2">Action</th></tr> 
                    
                    <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                    <?php $no = ($dataLaporan->currentPage() - 1) * $dataLaporan->perPage() + 1; ?>
                    @foreach ($dataLaporan as $laporan)
                    <tr>
                      <td>{{$no++}}</td>
                        <td>{{$laporan->judul_lp}}</td>
                        <td>{{$laporan->sisa_l_lp}}</td>
                        <td>{{$laporan->sisa_p_lp}}</td>
                        <td>{{$laporan->terdaftar_l_lp}}</td>
                        <td>{{$laporan->terdaftar_p_lp}}</td>
                        <td>{{$laporan->penempatan_l_lp}}</td>
                        <td>{{$laporan->penempatan_p_lp}}</td>
                        <td>{{$laporan->hapus_l_lp}}</td>
                        <td>{{$laporan->hapus_p_lp}}</td>
                        <td></td>
                        <td></td>
                        @if($laporan->sisa_l_lp != '-')
                        <td><form action="/edit-laporan-iv/{{$laporan->nmr}}">
                            <input type="hidden" name="id_disnaker" value="{{$laporan->id_disnaker}}">
                            <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                        </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    
                    </table>
                    <div class="blog-pagination"> 
                        <nav aria-label="Page navigation">
                          <ul class="pagination">
                              <li class="page-item{{ ($dataLaporan->currentPage() == 1) ? ' disabled' : '' }}">
                                  <a class="page-link" href="{{ $dataLaporan->previousPageUrl() }}" aria-label="Previous">
                                      <span aria-hidden="true">&laquo;</span>
                                  </a>
                              </li>
                              @for ($i = 1; $i <= $dataLaporan->lastPage(); $i++)
                                  <li class="page-item{{ ($dataLaporan->currentPage() == $i) ? ' active' : '' }}">
                                      <a class="page-link" href="{{ $dataLaporan->url($i) }}">{{ $i }}</a>
                                  </li>
                              @endfor
                              <li class="page-item{{ ($dataLaporan->currentPage() == $dataLaporan->lastPage()) ? ' disabled' : '' }}">
                                  <a class="page-link" href="{{ $dataLaporan->nextPageUrl() }}" aria-label="Next">
                                      <span aria-hidden="true">&raquo;</span>
                                  </a>
                              </li>
                          </ul>
                      </nav>
                      </div>
                
            </div>
          </div><!-- End Recent Activity -->
        </div>
        </div> 

        <div class="col-lg-8">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan-IPK-III-4</h5>
              <p style="text-align: justify">Pelaksanaan pembuatan laporan dapat dilakukan oleh Dinas Tenaga Kerja Kabupaten/Kota. Data Laporan yang ditampilkan pada tabel merupakan hasil kalkulasi dari masing-masing laporan yang di import oleh Dinas Kabupaten/Kota dan sudah disetujui oleh Kadis Dinas Kabupaten/Kota. Dinas Tenaga Kerja Provinsi dapat melihat detail laporan dari Kab/Kota dengan memilih menu Laporan Kab/Kota.</p>
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
                            <a href="{{Storage::url('public/file/Template-IPK-III-4.xlsx')}}" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Download Hasil</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="/cetak-laporan-iv/{{$nama->email_lembaga}}" class="btn btn-info mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                        </div><!-- End Website Traffic -->
                        @if(Auth::user()->email == 'disnaker@gmail.com')
                        <h5 class="card-title mb-0">Laporan Kab/Kota</h5>
                        <div class="activity">
                            @foreach($kab as $data)
                            <div class="activity-item d-flex">
                              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                              <div class="activity-content"><a href="/detail-laporan-kab-iv/{{$data->email_lembaga}}" class="fw-bold text-dark">{{$data->nama_lembaga}}</a>
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