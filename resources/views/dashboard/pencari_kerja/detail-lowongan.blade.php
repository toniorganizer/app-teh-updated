@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Detail Informasi Lowongan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Detail Lowongan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-8 col-md-12">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title">{{$data->judul_lowongan}} <span><br>{{$data->perusahaan}}</span></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn">
                                        {{-- @if(!$id_informasii == null && !$id_informasii == null)
                                              @if($id_informasii->id_informasi && $id_informasii->id_pelamar == Auth::user()->email)
                                              <a href="#" class="btn btn-info">
                                                Lamaran Terkirim
                                              </a>
                                              @else
                                              <a href="/lamar-pekerjaan/{{$data->id_informasi_lowongan}}" class="btn btn-primary">
                                                Lamar sekarang
                                              </a>
                                              @endif
                                            @else
                                            <a href="/lamar-pekerjaan/{{$data->id_informasi_lowongan}}" class="btn btn-primary">
                                              Lamar sekarang
                                            </a>
                                          @endif --}}

                                            @if(Auth::user()->level == 2)
                                              @if($exists)
                                              <a href="#" class="btn btn-info">
                                                Lamaran Terkirim
                                              </a>
                                              @else
                                              <a href="/lamar-pekerjaan/{{$data->id_informasi_lowongan}}" class="btn btn-primary">
                                                Lamar sekarang
                                              </a>
                                              @endif
                                            @endif
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="meta-top-center">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-geo-alt"></i> <a href="#">{{$data->lokasi}}</a></li>
                                    </ul>
                                  </div>
                                  <div class="meta-top">
                                    <ul>
                                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"> {{date('d/m/Y', strtotime($data->created_at))}}</a></li>
                                      {{-- <li class="d-flex align-items-center"><i class="bi bi-clock-history"></i> <a href="#">12 Comments</a> --}}
                                      </li>
                                    </ul>
                                  </div>
                            </div>

                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Deskripsi Lowongan</h5>
                                {!!$data->deskripsi!!}
                                <hr />
                                <div class="meta-bottom">
                                <i class="bi bi-person-badge-fill"></i>
                                <ul class="cats">
                                    @if($data->pemberi_informasi_id == 4)
                                    <li>By Admin</li>
                                    @else
                                    <li>By Perusahaan</li>
                                    @endif
                                    
                                  </ul>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Reports -->
            </div>
        </div> 
            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Job Interview</h5>
                        <div class="post-item mt-3">
                            <i class="bi bi-mortarboard"></i>
                            <div class="judul">
                              <p>Lowongan :</p>
                              <div class="sub-judul">
                                <p>{{$data->judul_lowongan}}</p>
                              </div>
                            </div>
                        </div>

                        <div class="post-item mt-3">
                            <i class="bi bi-bag-check"></i>
                            <div class="judul">
                              <p>Perusahaan :</p>
                              <div class="sub-judul">
                                <p>{{$data->perusahaan}}</p>
                              </div>
                            </div>
                          </div>
          
                          <div class="post-item mt-3">
                            <i class="bi bi-clock"></i>
                            <div class="judul">
                              <p>Tanggal Publish :</p>
                              <div class="sub-judul">
                                <p>{{date('h/m/Y', strtotime($data->created_at))}}</p>
                              </div>
                            </div>
                          </div>
          
                          <div class="post-item mt-3">
                            <i class="bi bi-hourglass-split"></i>
                            <div class="judul">
                              <p>Tanggal Expired :</p>
                              <div class="sub-judul">
                                <p>{{date('h/m/Y', strtotime($data->created_at))}}</p>
                              </div>
                            </div>
                          </div>
          
                          <div class="post-item mt-3">
                            <i class="bi bi-geo-alt"></i>
                            <div class="judul">
                              <p>Lokasi :</p>
                              <div class="sub-judul">
                                <p>{{$data->lokasi}}</p>
                              </div>
                            </div>
                          </div>

                          <h5 class="card-title">Detail Perusahaan</h5>
                            <div class="post-item">
                            <div>
                              @if($data->pemberi_informasi_id == 2)
                              <h5>By Admin</h5>
                                <div class="post-item">
                                    <div class="sub-judul">
                                      <p>Pemberi informasi admin Dinas Tenaga Kerja Sumatera Barat</p>
                                    </div>
                                </div>
                              @else
                                <h5>{{$data->perusahaan}}</h5>
                                {{-- <p>{!!$data->deskripsi!!}</p> --}}
                                <div class="post-item">
                                    <div class="sub-judul">
                                      <p>{!!$item->deskripsi!!}</p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="meta-bottom">
                                    <ul class="detail-perusahaan">
                                      <li><a href="{{$item->id_pemberi_informasi}}">Lihat Detail Perusahaan</a></li>
                                    </ul>
                                    </div>
                                </div>
                                @endif
                            </div>
                            </div>
                </div><!-- End Website Traffic -->
            </div>
    </section>

</main>
@include('dashboard/templates/footer')
@endsection