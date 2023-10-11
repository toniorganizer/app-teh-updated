@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Detail Informasi Pasar Kerja</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Detail Informasi Pasar Kerja</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                @if (session('success'))
                <div class="alert alert-primary">
                    {{ session('success') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="
                        @if($data->foto_lowongan == 'default.jpg')
                          {{ Storage::url('public/informasi-lowongan/default/').$data->foto_lowongan}}
                          @else
                          {{ Storage::url('public/informasi-lowongan/').$data->foto_lowongan}}
                          @endif
                        " alt="Profile" class="rounded-circle">
                        <h2>{{$data->judul_lowongan}}</h2>
                        <h3>{{$data->perusahaan}}</h3>
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
                        <!-- Bordered Tabs -->
                        {{-- <ul class="nav nav-tabs nav-tabs-bordered"> --}}

                            {{-- <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li> --}}

                            {{-- <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li> --}}

                        {{-- </ul> --}}
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Deskripsi Lowongan</h5>
                                <p class="small fst-italic">{!!mb_strimwidth($data->deskripsi, 0, 200, "...")!!}</p>

                                <h5 class="card-title">Detail</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Perusahaan</div>
                                    <div class="col-lg-9 col-md-8">{{$data->perusahaan}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Salary</div>
                                    <div class="col-lg-9 col-md-8">{{$data->salary}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Bidang Pekerjaan</div>
                                    <div class="col-lg-9 col-md-8">{{$data->bidang}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Lowongan</div>
                                    <div class="col-lg-9 col-md-8">{{$data->jenis_lowongan}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pendidikan</div>
                                    <div class="col-lg-9 col-md-8">{{$data->pendidikan}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Keterampilan</div>
                                    <div class="col-lg-9 col-md-8">{{$data->keterampilan}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Posting</div>
                                    <div class="col-lg-9 col-md-8">{{ date('d F Y', strtotime($data->created_at)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Edited</div>
                                    <div class="col-lg-9 col-md-8">{{ date('d F Y', strtotime($data->updated_at)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Verifikasi</div>
                                    <div class="col-lg-9 col-md-8">@if($data->verifikasi == 0) Belum Diverifikasi @elseif($data->verifikasi == 1) Disetujui @else Tidak Disetujui @endif</div>
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" data-role="{{$data->id}}" data-menu="Setujui">
                                        <label class="form-check-label" for="invalidCheck2">
                                            Setujui
                                          </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" data-role="{{$data->id}}" data-menu="Tidak disetujui">
                                        <label class="form-check-label" for="invalidCheck2">
                                            Tidak Setujui
                                          </label>
                                    </div> --}}
                                </div>
                                
                                <div class="text-right">
                                    @if(Auth::user()->level == 1)
                                    <a href="/edit-deskripsi/{{$data->id_informasi_lowongan}}" class="btn btn-info">Edit deskripsi</a>
                                    <a href="" class="btn btn-secondary mr-1" data-toggle="modal" data-target="#edit-verifikasi{{$data->id_informasi_lowongan}}">Verifikasi</a>
                                    <a href="" class="btn btn-primary mr-1" data-toggle="modal" data-target="#edit-il{{$data->id_informasi_lowongan}}">Edit detail</a>
                                    @elseif(Auth::user()->email == 'disnaker@gmail.com')
                                    {{-- <a href="/edit-deskripsi/{{$data->id_informasi_lowongan}}" class="btn btn-info">Edit deskripsi</a> --}}
                                    <a href="" class="btn btn-secondary mr-1" data-toggle="modal" data-target="#edit-verifikasi{{$data->id_informasi_lowongan}}">Verifikasi</a>
                                    {{-- <a href="" class="btn btn-primary mr-1" data-toggle="modal" data-target="#edit-il{{$data->id_informasi_lowongan}}">Edit detail</a> --}}
                                    @else
                                    <a href="/pekerjaan-data" class="btn btn-secondary">Kembali</a>
                                    @endif
                                </div>
                            </div>
                            @include('dashboard/modal/modal-edit-informasi-lowongan')
                            @include('dashboard/modal/modal-verifikasi-lowongan')

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection