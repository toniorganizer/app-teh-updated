@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Status Daftar Lowongan Pekerjaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Status Daftar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            @foreach($data as $item)
            <div class="col-xl-12">
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">{{$item->perusahaan}}</h4>
                    <p>Anda melamar di bagian <span class="alert-link"> {{$item->judul_lowongan}} </span> dengan status : <span class="alert-link">
                        @if($item->status == 0)
                            Lamaran terkirim
                        @elseif($item->status == 1)
                            Proses pemeriksanaan lamaran
                        @else
                            Selamat, Anda masuk kriteria perusahaan. Anda akan segera dihubungi melalui kontak yang tertera.
                        @endif
                        <hr>
                        <p class="mb-0">Selalu pantau halaman ini, karena sewaktu-waktu status dapat berubah tanpa pemberitahuan</p>    
                    </span></p>
                  </div>
            </div>
            @endforeach
            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection