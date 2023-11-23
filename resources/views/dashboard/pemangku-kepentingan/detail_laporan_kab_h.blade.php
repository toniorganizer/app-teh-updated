@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan IPK-III-8</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan IPK-III-8</li>
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

            <div class="col-xl-12">

                <div class="card">
                  <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <div class="tab-content pt-2">
                      {{-- <div class="tab-pane fade show active profile-overview"> --}}
                        <h5 class="card-title">Table Laporan-IPK-III-VIII</h5>
                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                            <tr><th colspan="2" rowspan="3">TINGKAT PENDIDIKAN PENCARI KERJA DAN PENERIMA TENAGA KERJA</th><th colspan="6">Jenis Antar Kerja</th>)<th rowspan="3" colspan="2">Action</th></tr>
                            <tr><th colspan="2">AKL</th><th colspan="2">AKAD</th><th colspan="2">AKAN</th></tr>
                            <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                            <?php $no = ($dataLaporan->currentPage() - 1) * $dataLaporan->perPage() + 1; ?>
                            
                                @foreach($dataLaporan as $lap)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$lap->judul}}</td>
                                    <td>{{$lap->akll}}</td>
                                    <td>{{$lap->aklp}}</td>
                                    <td>{{$lap->akadl}}</td>
                                    <td>{{$lap->akadp}}</td>
                                    <td>{{$lap->akanl}}</td>
                                    <td>{{$lap->akanp}}</td>
                                    @if($lap->akanp != '-')
                                    <td><form action="/edit-laporan-viii/{{$lap->nmr}}">
                                        <input type="hidden" name="id_disnaker" value="{{$lap->id_disnaker}}">
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
      
                    </div><!-- End Bordered Tabs -->
      
                  </div>
                </div>
      
              </div>

              <div class="col-lg-8">
                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Laporan-IPK-III-6</h5>
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
                                <a href="{{Storage::url('public/file/Template-IPK-III-8.xlsx')}}" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Download Hasil</h5>
                            <div class="row">
                                <div class="col-lg-3">
                                <a href="/cetak-laporan-viii/{{$nama->email_lembaga}}" class="btn btn-info mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                                </div>
                            </div><!-- End Website Traffic -->
                            @if(Auth::user()->email == 'disnaker@gmail.com')
                            <h5 class="card-title mb-0">Laporan Kab/Kota</h5>
                            <div class="activity">
                                @foreach($kab as $data)
                                <div class="activity-item d-flex">
                                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                  <div class="activity-content"><a href="/detail-laporan-kab-viii/{{$data->email_lembaga}}" class="fw-bold text-dark">{{$data->nama_lembaga}}</a>
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
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>
@include('dashboard/templates/footer')
@endsection