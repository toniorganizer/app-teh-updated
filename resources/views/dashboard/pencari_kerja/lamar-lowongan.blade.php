@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Lamar Lowongan {{$data->judul_lowongan}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Lamar Lowongan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Halaman Lamar Lowongan Pekerjaan {{$data->judul_lowongan}}</h5>
                            <div class="row">
                            <div class="col-lg-11">
                                <p>Silahkan berikan informasi tentang diri anda melalui form di bawah. Curriculu Vitae wajib diisi.</p>
                            </div>
                            </div>
                        </div>

                        <form action="/lamar-lowongan-pekerjaan" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputCity" class="form-label">Curriculum Vitae</label>
                                        <input class="form-control @error('cv') is-invalid @enderror" name="cv" type="file" id="formFile">
                                        @error('cv')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                        <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                                        </div>
                                    <div class="col-lg-6">
                                        <label for="inputCity" class="form-label">Ijazah</label>
                                        <input class="form-control @error('ijazah') is-invalid @enderror" name="ijazah" type="file" id="formFile">
                                        @error('ijazah')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                        <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                                    </div>
                                    <div class="mt-2 col-lg-6">
                                        <label for="inputCity" class="form-label">Transkrip Nilai</label>
                                        <input class="form-control @error('nilai') is-invalid @enderror" name="nilai" type="file" id="formFile">
                                        @error('nilai')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                        <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                                    </div>
                                    <div class="mt-2 col-lg-6">
                                        <label for="inputCity" class="form-label">Portofolio</label>
                                        <input class="form-control @error('portofolio') is-invalid @enderror" name="portofolio" type="file" id="formFile">
                                        @error('portofolio')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                        <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                                    </div>
                                    <div class="mt-2 col-lg-12">
                                        <input type="hidden" name="id_informasi" value="{{$data->id_informasi_lowongan}}">
                                        <input type="hidden" name="id_pelamar" value="{{auth::user()->email}}">
                                        <label for="exampleInputEmail1">Jelaskan megenai diri anda</label>
                                        <div class="form-group mb-3">
                                            <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror ckeditor" id="ckeditor" rows="3"></textarea>
                                            @error('pesan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-11">
                                        <button type="submit" class="btn btn-primary mb-3 float-right">Kirim</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        
                        </div>
                    </div>
                </div>
            </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@include('dashboard/modal/modal-add-lowongan')
@endsection