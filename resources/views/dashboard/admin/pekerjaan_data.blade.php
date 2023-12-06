@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Informasi Pekerjaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Data Pekerjaan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data informasi Lowongan pekerjaan</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Data informasi pasar kerja atau lowongan pekerjaan terdaftar sistem.</p>
                            </div>
                            {{-- @if(Auth::user()->level == 1)
                            <div class="col-lg-1 float-left">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Lowongan">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </div> --}}
                            @if(Auth::user()->email == 'disnaker@gmail.com')
                            <div class="col-lg-1 float-left">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Lowongan">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </div>
                            @endif
                        </div>

                        @if (session('success'))
                        <div class="alert alert-primary">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Table with stripped rows -->
                        <div class="row">
                            <div class="col-md-12 overflow-scroll">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Lowongan</th>
                                            <th scope="col">Perusahaan</th>
                                            <th scope="col">Bidang</th>
                                            <th scope="col">status</th>
                                            {{-- <th scope="col">Pengalaman</th> --}}
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1;?>
                                        @foreach ($data as $info_p)
                                            <tr>
                                                <th scope="row">{{$no++}}</th>
                                                <td>{{$info_p->judul_lowongan}}</td>
                                                <td>{{$info_p->perusahaan}}</td>
                                                <td>{{$info_p->bidang}}</td>
                                                <td>@if($info_p->status_lowongan == 1) Proses Verifikasi @elseif($info_p->status_lowongan == 2) Terpenuhi @else Belum terpenuhi @endif</td>
                                                {{-- <td>{{$info_p->pengalaman}}</td> --}}
                                                <td>
                                                    {{-- <a href="" class="badge badge-primary">Edit</a> --}}
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('lowongan.destroy', $info_p->id_informasi_lowongan) }}" method="POST">
                                                        <a href="{{ route('lowongan.show', $info_p->id_informasi_lowongan) }}" class="badge badge-info">Detail</a>
                                                        @if(Auth::user()->level == 1)
                                                        <button type="submit" class="badge badge-danger">Hapus</button>
                                                        @elseif(Auth::user()->email == 'disnaker@gmail.com')
                                                        <button type="submit" class="badge badge-danger">Hapus</button>
                                                        @endif
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        <!-- End Table with stripped rows -->
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@include('dashboard/modal/modal-add-lowongan')
@endsection