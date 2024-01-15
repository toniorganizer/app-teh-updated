@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Lamaran {{$data->judul_lowongan}}</h1>
        <nav class='mt-2'>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">{{$data->judul_lowongan}}</li>
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
                        @if($data->foto_pencari_kerja == 'default.jpg')
                        {{ Storage::url('public/user/default/').$data->foto_pencari_kerja}}
                        @else
                        {{ Storage::url('public/user/').$data->foto_pencari_kerja}}
                        @endif
                        " alt="Profile" class="rounded-circle">
                        <h2>{{$data->nama_lengkap}}</h2>
                        <h3>{{$data->pendidikan_terakhir}}</h3>
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
                                        @elseif($data->status == 2)
                                            Silahkan hubungai pelamar melalui kontak yang tertera
                                        @else
                                        Ditolak
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

                <div class="card">
                    <div class="card-body pt-3">
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Permohonan lamaran</h5>
                                <p class="small fst-italic">{!!$data->pesan!!}</p>

                                <h5 class="card-title">Lampiran</h5>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label ">File CV</div>
                                    @if($data->cv != '-')
                                    <div class="col-lg-8 col-md-8"><a href="{{Storage::url('public/syarat/'). $data->cv}}" target="_blank"> Lihat CV</a></div>
                                    @else
                                    CV tidak tersedia
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label ">Ijazah</div>
                                    @if($data->ijazah != '-')
                                    <div class="col-lg-8 col-md-8"><a href="{{Storage::url('public/syarat/'). $data->ijazah}}" target="_blank"> Lihat Ijazah</a></div>
                                    @else
                                    Ijazah tidak tersedia
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label ">Nilai</div>
                                    @if($data->nilai != '-')
                                    <div class="col-lg-8 col-md-8"><a href="{{Storage::url('public/syarat/'). $data->nilai}}" target="_blank"> Lihat nilai</a></div>
                                    @else
                                    Nilai tidak tersedia
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 label ">Portofolio</div>
                                    @if($data->portofolio != '-')
                                    <div class="col-lg-8 col-md-8"><a href="{{Storage::url('public/syarat/'). $data->portofolio}}" target="_blank"> Lihat Portofolio</a></div>
                                    @else
                                    Portofolio tidak tersedia
                                    @endif
                                </div>

                                <div class="text-right">
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#verifikasi-lamaran{{$data->id_lamar}}">Verfikasi</a>
                                    <a href="/lowongan-data" class="btn btn-secondary mr-1">Kembali</a>
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('dashboard/modal/modal-verifikasi-lamaran')

</main><!-- End #main -->
@include('dashboard/templates/footer')
@endsection