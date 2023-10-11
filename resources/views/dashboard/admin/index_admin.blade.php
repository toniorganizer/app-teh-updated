@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            @if (session('success'))
            <div class="alert alert-primary">
                {{ session('success') }}
            </div>
            @endif
            @if(auth::user()->level == 2)
                @if($status_ak1->tgl_expired <= now())
                <div class="alert alert-primary" role="alert">
                    Status Kartu Anda sudah otomatis berubah menjadi <span class="alert-link">Bekerja.</span>
                </div> 
                @else
                <div class="alert alert-warning" role="alert">
                    Status Kartu Anda akan berakhir pada tanggal <span class="alert-link">{{date('d F Y', strtotime($status_ak1->tgl_expired))}}</span>.@if($tglSaatIni >= $tgl) Silahkan diperpanjang sebelum tanggal tersebut, jika tidak diperpanjang maka status akan otomatis berubah menjadi <span class="alert-link">Bekerja.</span>
                    
                    <form action="perpanjangKartu" method="POST">
                        @csrf
                            <input type="hidden" name="status" value="Belum Bekerja">
                            <input type="hidden" name="id" value="{{$status_ak1->id_pencari_kerja}}">
                            <button class="btn btn-info mt-2">Perpanjang hingga 6 bulan kedepan</button>
                    </form>
                    @endif
                </div>
                @endif
            @endif
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                
                <div class="row">
                    @if(auth::user()->level == 2)
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Lowongan Kerja <span><br><?php echo date('d-m-Y'); ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-shop-window"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$jumlah_loker}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="/data-lowongan-pekerja" class="detail-pendaftar">Lihat Detail Lowongan</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Jumlah Mendaftar <span> <br> <?php echo date('d-m-Y'); ?></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cloud-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$jumlah_lamaran}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="{{Route('pekerja.show', Auth::user()->email)}}" class="detail-pendaftar">Lihat Status Daftar</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @elseif(Auth::user()->level == 5)

                       <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Jumlah Alumni Terdata</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$jumlah_alumni}}</h6>
                                        <span class="text-success small pt-1 fw-bold">
                                        @if($alumni_bekerja > 0)
                                        {{$alumni_bekerja}}
                                        @else
                                        0
                                        @endif    
                                        </span> <span class="text-muted small pt-2 ps-1">Alumni Diterima Bekerja</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Jumlah Lowongan Kerja</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-shop-window"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$jumlah_loker}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="/data-lowongan-pekerja" class="detail-pendaftar">Lihat Detail Lowongan</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Statistik Pasar Kerja</h5>
                                {!! $chart->container() !!}

                            </div>

                        </div>
                    </div><!-- End Reports -->
                    @else
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                @if(Auth::user()->level == 1)
                                <h5 class="card-title">User Terdaftar Pada Sistem 
                                    {{-- <span>| s.d <?php echo date('d-m-Y'); ?></span> --}}
                                </h5>
                                @endif
                                @if(Auth::user()->level == 3)
                                <h5 class="card-title">Tenaga Kerja Terdaftar
                                    {{-- <span>| s.d <?php echo date('d-m-Y'); ?></span> --}}
                                </h5>
                                @endif
                                @if(Auth::user()->level == 4)
                                <h5 class="card-title">Tenaga Kerja Terdaftar
                                    {{-- <span>| s.d <?php echo date('d-m-Y'); ?></span> --}}
                                </h5>
                                @endif
                                

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    @if(Auth::user()->level == 1)
                                    <div class="ps-3">
                                        <h6>{{$user}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="/user-data" class="detail-pendaftar">Lihat Detail User</a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->level == 3)
                                    <div class="ps-3">
                                        <h6>{{$pencari_kerja}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="/tenaga-kerja-data" class="detail-pendaftar">Lihat Detail Tenaga Kerja</a>
                                        </div>
                                    @endif
                                    @if(Auth::user()->level == 4)
                                    <div class="ps-3">
                                        <h6>{{$pencari_kerja}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="/tenaga-kerja-data" class="detail-pendaftar">Lihat Detail Tenaga Kerja</a>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Informasi Pasar Kerja Terdata 
                                    {{-- <span>| s.d <?php echo date('d-m-Y'); ?></span> --}}
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-shop-window"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$jumlah_loker}}</h6>
                                        <div class="dashboard-detail mt-2">
                                            <a href="/pekerjaan-data" class="detail-pendaftar">Lihat Detail Informasi</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Statistik Pasar Kerja</h5>
                                {!! $chart->container() !!}

                            </div>

                        </div>
                    </div><!-- End Reports -->
             @endif
            </div>
        </div> 
            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Traffic Pasar Kerja</h5>
                        {!! $jobcount->container() !!}
                </div><!-- End Website Traffic -->
            </div>
    </section>

</main>
{{-- @include('dashboard/modal/modal-tracer-study') --}}
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
<script src="{{ $jobcount->cdn() }}"></script>
{{ $jobcount->script() }}
@include('dashboard/templates/footer')
@endsection