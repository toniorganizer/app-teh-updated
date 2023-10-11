@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Data User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (session('success'))
    <div class="alert alert-primary">
        {{ session('success') }}
    </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data user terdaftar</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Berikut merupakan data user yang terdaftar di dalam sistem.</p>
                            </div>
                            <div class="col-lg-1 float-left">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#test">
                                    <i class="bi bi-person-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        
                        <div class="row">
                            <div class="col-md-12 overflow-scroll">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Nama</th>
                                            {{-- <th scope="col">E-mail</th> --}}
                                            <th scope="col">Level</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1;?>
                                        @foreach ($data as $user)
                                            <tr>
                                                <th scope="row">{{$no++}}</th>
                                                <td> {{$user->username}}</td>
                                                <td>{{$user->name}}</td>
                                                {{-- <td>{{$user->email}}</td> --}}
                                                <td>
                                                    @if($user->level == 1)
                                                    Admin
                                                    @elseif($user->level == 2)
                                                    Pencari Kerja
                                                    @elseif($user->level == 3)
                                                    Pemangku kepentingan
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="" class="badge badge-primary">Edit</a>
                                                    <a href="" class="badge badge-info">Detail</a>
                                                    <a href="/deleteUser/{{$user->email}}" class="badge badge-danger" onclick="return confirm('Yakin ingin menghpus?')">Hapus</a>
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
@include('dashboard/modal/modal-add-user')
@endsection