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
        @if(Auth::user()->level != 1)
        <div class="col-lg-8">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan-IPK-III-1</h5>
              <div class="activity">
                <p style="text-align: justify">Pelaksanaan pembuatan laporan dapat dilakukan dengan menentukan rentang tanggal kemudian dapat mendownload template yang sudah disediakan. Pastikan setiap kolom terisi dengan benar sebelum melakukan import data.</p>

                <p>Silahkan buat terlebih dahulu rentang tanggal untuk laporan yang akan dibuat, kemudian pilih download untuk melakukan download template.</p>

                <form id="search-form" action="/export-ipk-1">
                <div class="row">
                    <div class="col">
                        <input name="tgl1" type="date" class="form-control">
                    </div>
                    <div class="col">
                        <input name="tgl2" type="date" class="form-control">
                    </div>
                </div>
                
                @foreach($data as $d)
                <div class="activity-item d-flex">
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  {{-- <div class="activity-content">
                    Pasar kerja <span class="fw-bold text-dark">bidang {{$d->bidang}} </span> berjumlah sebanyak <span class="fw-bold text-dark">{{$d->jumlah}} informasi lowongan</span>
                  </div> --}}
                </div><!-- End activity item-->
                @endforeach
              </div>

            </div>
          </div><!-- End Recent Activity -->
            </div>
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Download/Import</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></button>
                            </div>
                        </form>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-success mt-0"><i class="bi bi-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div><!-- End Website Traffic -->
                </div>
            </div>  
            @endif     
    </section>

</main>
@include('dashboard/templates/footer')
@endsection