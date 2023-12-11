@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Struktur tenaga kerja</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Struktur tenaga kerja</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (session('success'))
    <div class="alert alert-primary">
        {{ session('success') }}
    </div>
    @endif

    <section class="section profile">
        <div class="row">
            @foreach ($data as $item)
            <div class="col-xl-4">
                    
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="
                        @if($item->foto_pencari_kerja == 'default.jpg')
                          {{ Storage::url('public/user/default/').$item->foto_pencari_kerja}}
                          @else
                          {{ Storage::url('public/user/').$item->foto_pencari_kerja}}
                          @endif
                        " alt="Profile" class="rounded-circle">
                        <h2>{{$item->nama_lengkap}}</h2>
                        <h3>{{$item->keterampilan}}</h3>
                        {{-- <div class="social-links mt-2">
                            <span class="text-success small pt-1 fw-bold">{{$item->jumlah_pelamar}}</span> <span class="text-muted small pt-2 ps-1">Pendaftar</span>
                        </div> --}}
                        <div class="social-links mt-2">
                            <center>
                                <a href="/profil-tenaga-kerja/{{$item->email_pk}}" class="detail-pendaftar">Lihat Tenaga Kerja</a>
                            </center>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection