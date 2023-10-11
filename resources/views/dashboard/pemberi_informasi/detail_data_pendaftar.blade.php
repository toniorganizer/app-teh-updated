@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
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
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="
                        @if(Auth::user()->foto_user == 'default.jpg')
                        {{ Storage::url('public/user/default/').Auth::user()->foto_user}}
                        @else
                        {{ Storage::url('public/user/').Auth::user()->foto_user}}
                        @endif
                        " alt="Profile" class="rounded-circle">
                        <h2>{{$data->nama_lengkap}}</h2>
                        <h3>{{$data->username}}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Tentang</h5>
                                <p class="small fst-italic">{{$data->tentang}}</p>

                                <h5 class="card-title">Detail Profile</h5>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label ">Nama Lengkap</div>
                                    <div class="col-lg-8 col-md-8">{{$data->nama_lengkap}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Alamat</div>
                                    <div class="col-lg-8 col-md-8">{{$data->alamat}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Pendidikan Terakhir</div>
                                    <div class="col-lg-8 col-md-8">{{$data->pendidikan_terakhir}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Keterampilan</div>
                                    <div class="col-lg-8 col-md-8">{{$data->keterampilan}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Email</div>
                                    <div class="col-lg-8 col-md-8">{{$data->email_pk}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">No. Handphone</div>
                                    <div class="col-lg-8 col-md-8">{{$data->no_hp}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Status</div>
                                    <div class="col-lg-8 col-md-8">
                                        @if($data->status == 0)
                                            Data lamaran masuk
                                        @elseif($data->status == 1)
                                            Proses pemeriksanaan lamaran
                                        @else
                                            Silahkan hubungai pelamar melalui kontak yang tertera
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#verifikasi-lamaran{{$data->id_lamar}}">Verfikasi</a>
                                    <a href="/home" class="btn btn-secondary mr-1">Kembali</a>
                                </div>
                            </div>
                            @include('dashboard/modal/modal-verifikasi-lamaran')
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@include('dashboard/templates/footer')
@endsection