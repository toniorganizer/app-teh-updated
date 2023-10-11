@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tenaga Kerja</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Data Tenaga Kerja</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data tenaga kerja terdaftar</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Berikut merupakan data tenaga kerja yang terdaftar di dalam sistem.</p>
                            </div>
                            @if(Auth::user()->level == 1)
                            <div class="col-lg-1 float-left mb-3">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tk">
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
                                            <th scope="col">Nama</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Pendidikan</th>
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
                                                <td>{{$user->email_pk}}</td>
                                                <td>{{$user->pendidikan_terakhir}}</td>
                                                <td>
                                                    <a href="/profil-tenaga-kerja/{{$user->email_pk}}" class="badge badge-info">Detail</a>
                                                    @if(Auth::user()->level == 1)
                                                    <a href="/deleteTenagaKerja/{{$user->email_pk}}" class="badge badge-danger" onclick="return confirm('Yakin ingin menghpus?')">Hapus</a>
                                                    @endif
                                                    @if(Auth::user()->level == 3)
                                                    <a href="/deleteTenagaKerja/{{$user->email_pk}}" class="badge badge-danger" onclick="return confirm('Yakin ingin menghpus?')">Hapus</a>
                                                    @endif
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