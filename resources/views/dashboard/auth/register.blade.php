@extends('dashboard/main')

@section('container')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="/" class="logo d-flex align-items-center w-auto">
                                <span class="d-none d-lg-block">Sistem Informasi Pasar Kerja</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun Baru</h5>
                                    <p class="text-center small">Masukan data personal</p>
                                </div>

                                @if (session('success'))
                                <div class="alert alert-primary">
                                    {{ session('success') }}
                                </div>
                                @endif

                                <form action="register" method="post" class="row g-3 needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="yourName" class="form-label">Nama</label>
                                                <input autofocus type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="yourName" required value="{{old('name')}}">
                                                <small id="emailHelp" class="form-text text-muted">Masukan nama lengkap</small>
                                                @error('name')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="yourName" class="form-label">Umur</label>
                                                <input autofocus type="text" name="umur" class="form-control @error('umur') is-invalid @enderror" id="yourumur" required value="{{old('umur')}}">
                                                <small id="emailHelp" class="form-text text-muted">Isi dengan format angka. Ex : 23</small>
                                                @error('umur')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">E-mail</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email" class="form-control" id="yourUsername" required value="{{old('email')}}">
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="inputAddress2" class="form-label">Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="Laki-laki">
                                            <label class="form-check-label" for="exampleRadios1">
                                              Laki-laki
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios2" value="Perempuan">
                                            <label class="form-check-label" for="exampleRadios2">
                                              Perempuan
                                            </label>
                                          </div>
                                          @error('jenis_kelamin')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="yourEmail" required value="{{old('username')}}">
                                        @error('username')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        @error('password')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Ulangi Password</label>
                                        <input type="password" name="ulangi_password" class="form-control" id="yourPassword" required>
                                        @error('ulangi_password')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button  type="submit" class="btn btn-primary w-100">Daftar</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Sudah punya akun? <a href="/login">Log in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endsection