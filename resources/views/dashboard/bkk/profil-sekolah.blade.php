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
                        <h2>{{$data->nama_sekolah}}</h2>
                        <h3>{{$data->username}}</h3>
                        <div class="social-links mt-2">
                            <a href="{{$data->website_sekolah}}" class="twitter" target="_blank"><i class="bi bi-globe2"></i></a>
                            <a href="https://web.facebook.com/{{$data->facebook_sekolah}}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Alamat</h5>
                                <p class="small fst-italic">{{$data->alamat}}</p>

                                <h5 class="card-title">Detail Profile</h5>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label ">Nama Sekolah</div>
                                    <div class="col-lg-8 col-md-8">{{$data->nama_sekolah}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Telepon</div>
                                    <div class="col-lg-8 col-md-8">{{$data->telepon_sekolah}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Email Sekolah</div>
                                    <div class="col-lg-8 col-md-8">{{$data->email_sekolah}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Website Sekolah</div>
                                    <div class="col-lg-8 col-md-8">{{$data->website_sekolah}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Instagram Sekolah</div>
                                    <div class="col-lg-8 col-md-8">{{$data->instagram_sekolah}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label">Facebook Sekolah</div>
                                    <div class="col-lg-8 col-md-8">{{$data->facebook_sekolah}}</div>
                                </div>
                                
                                <div class="text-right">
                                    <a data-toggle="modal" data-target="#edit-bkk{{$data->id_bkk}}" class="btn btn-primary">Lengkapi data</a>
                                    <a href="/home" class="btn btn-secondary mr-1">Kembali</a>
                                </div>
                            </div>
                            @include('dashboard/modal/modal-edit-profil-sekolah')
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@include('dashboard/templates/footer')
@endsection