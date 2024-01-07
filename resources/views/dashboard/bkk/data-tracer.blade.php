@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tracer Alumni</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Data Tracer Alumni</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Tracer Alumni terdaftar</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Data Tracer Alumni yang terdaftar di dalam sistem.</p>
                            </div>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-primary">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Table with stripped rows -->
                        <div class="row">
                            <div class="col-md-12 overflow-scroll">
                                <a href="/cetak-alumni/{{Auth::user()->email}}" class="btn btn-success ml-2 mb-1"><i class="bi bi-file-earmark-excel"></i>Cetak</a>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Alumni</th>
                                            <th scope="col">Nama Sekolah</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Tahun Lulus</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1;?>
                                        @foreach ($data as $user)
                                            <tr>
                                                <th scope="row">{{$no++}}</th>
                                                <td><img width="40" height="40" class="mr-2 rounded-circle" src="@if($user->foto_pencari_kerja == 'default.jpg')
                                                    {{ Storage::url('public/user/default/').$user->foto_pencari_kerja}}
                                                    @else
                                                    {{ Storage::url('public/user/').$user->foto_pencari_kerja}}
                                                    @endif
                                                    ">{{$user->nama_lengkap}}</td>
                                                <td>{{$user->nama_sekolah}}</td>
                                                <td>{{$user->jurusan}}</td>
                                                <td>{{$user->tahun_lulus}}</td>
                                                <td>
                                                    <a href="/profil-tenaga-kerja/{{$user->email_pk}}" class="badge badge-info">Detail</a>
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
@include('dashboard/modal/modal-tenaga-kerja')
@endsection