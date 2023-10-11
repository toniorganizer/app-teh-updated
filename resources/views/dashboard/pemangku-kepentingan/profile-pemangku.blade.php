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
                            @if($data->website_lembaga != '-')
                            <a href="{{$data->website_lembaga}}" class="twitter" target="_blank"><i class="bi bi-globe2"></i></a>
                            @endif
                            <a href="https://web.facebook.com/{{$data->facebook_lembaga}}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/{{$data->instagram_lembaga}}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Bidang Lembaga</h5>
                                <p class="small fst-italic">{{$data->bidang_lembaga}}</p>

                                <h5 class="card-title">Detail Profile</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama Lembaga</div>
                                    <div class="col-lg-9 col-md-8">{{$data->nama_lembaga}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8">{{$data->alamat_lembaga}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">E-mail Lembaga</div>
                                    <div class="col-lg-9 col-md-8">{{$data->email_lembaga}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Website</div>
                                    <div class="col-lg-9 col-md-8">{{$data->website_lembaga}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Instagram</div>
                                    <div class="col-lg-9 col-md-8">{{$data->instagram_lembaga}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Facebook</div>
                                    <div class="col-lg-9 col-md-8">{{$data->facebook_lembaga}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Telepon</div>
                                    <div class="col-lg-9 col-md-8">{{$data->telepon_lembaga}}</div>
                                </div>
                                
                                <div class="text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit-pk{{$data->id_pemangku_kepentingan}}">Lengkapi data</a>
                                    <a href="/home" class="btn btn-secondary mr-1">Kembali</a>
                                </div>
                            </div>
                            @include('dashboard/modal/modal-update-profile-lembaga')

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection