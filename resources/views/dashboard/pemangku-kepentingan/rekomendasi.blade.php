@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rekomendasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Rekomendasi</li>
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
            <!-- Left side columns -->
            <div class="col-lg-12">
                
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistik Pasar Kerja</h5>
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div><!-- End Reports -->
            </div>
        </div> 
            <!-- Right side columns -->
        @if(Auth::user()->level != 1)
        <div class="col-lg-8">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rekomendasi</h5>
              <div class="activity">
                <p style="text-align: justify">Sehubungan dengan perkembangan terkini di pasar kerja, kami merekomendasikan Dinas Tenaga Kerja dan Dinas Pendidikan untuk mempertimbangkan langkah strategis dalam kebijakan pelaksanaan pendidikan kejuruan terkait dengan pemantauan pasar kerja aktif untuk mengidentifikasi tren dan permintaan tenaga kerja terbaru. Berdasarkan data pasar kerja yang telah ada, saat ini tren pasar kerja didominasi oleh :</p>
                
                @foreach($data as $d)
                <div class="activity-item d-flex">
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Pasar kerja <span class="fw-bold text-dark">bidang {{$d->bidang}} </span> berjumlah sebanyak <span class="fw-bold text-dark">{{$d->jumlah}} informasi lowongan</span>
                  </div>
                </div><!-- End activity item-->
                @endforeach

                <p style="text-align: justify">Dengan memantau tren pasar kerja terkini, Dinas Pendidikan dan Dinas Tenaga Kerja dapat melakukan koordinasi dan memastikan bahwa pendidikan kejuruan di wilayah Sumatera Barat dapat relevan dan memenuhi tuntutan pasar kerja yang terus berkembang. Hal ini dapat membantu menciptakan peluang kerja yang lebih baik bagi masyarakat dan mendukung pertumbuhan ekonomi yang berkelanjutan.</p>

              </div>

            </div>
          </div><!-- End Recent Activity -->
            </div>
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Traffic Pasar Kerja</h5>
                        {!! $jobcount->container() !!}
                    </div><!-- End Website Traffic -->
                </div>
            </div>  
            @endif     
    </section>

</main>
{{-- @include('dashboard/modal/modal-tracer-study') --}}
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
<script src="{{ $jobcount->cdn() }}"></script>
{{ $jobcount->script() }}
@include('dashboard/templates/footer')
@endsection