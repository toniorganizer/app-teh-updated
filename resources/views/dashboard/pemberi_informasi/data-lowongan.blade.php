@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Lowongan yang telah dibuat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Data lowongan</li>
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
                        @if($item->foto_lowongan == 'default.jpg')
                          {{ Storage::url('public/informasi-lowongan/default/').$item->foto_lowongan}}
                          @else
                          {{ Storage::url('public/informasi-lowongan/').$item->foto_lowongan}}
                          @endif
                        " alt="Profile" class="rounded-circle">
                        <h2>{{$item->judul_lowongan}}</h2>
                        <h3>{{$item->bidang}}</h3>
                        <div class="social-links mt-2">
                            <span class="text-success small pt-1 fw-bold">{{$item->jumlah_pelamar}}</span> <span class="text-muted small pt-2 ps-1">Pendaftar</span>
                        </div>
                        <div class="social-links mt-2">
                            <center>
                                <a href="/lengkapi-data-lowongan/{{$item->id_informasi_lowongan}}" class="detail-pendaftar">Lengkapi data lowongan</a>
                                <a href="/detail-pendaftar/{{$item->id_informasi_lowongan}}" class="detail-pendaftar">Lihat Detail Pendaftar</a>
                            </center>
                        </div>
                        @if($item->verifikasi == 1)
                        <div class="verifikasi">
                            <i class="bi bi-check-circle"></i>
                            Disetujui Disnaker
                          </div>
                          @elseif($item->verifikasi == 2)
                          <div class="no-verifikasi">
                            <i class="bi bi-x-circle"></i>
                            Tidak disetujui
                          </div>
                          @else
                          <div class="verifikasi">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Belum diverifikasi
                          </div>
                          @endif
                    </div>
                </div>

            </div>
            @endforeach

            {{-- <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3"> --}}
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
                        {{-- <div class="tab-content pt-2">

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
                                
                                <div class="text-right">
                                    <a href="/edit-deskripsi/{{$data->id}}" class="btn btn-info">Edit deskripsi</a>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit-il{{$data->id}}">Edit detail</a>
                                    {{-- <a href="/pekerjaan-data" class="btn btn-secondary">Kembali</a> --}}
                                {{-- </div>
                            </div>
                            @include('dashboard/modal/modal-edit-informasi-lowongan')

                        </div><!-- End Bordered Tabs --> --}}

                    {{-- </div>
                </div> --}}

            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection