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
                                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun Baru Perusahaan</h5>
                                    <p class="text-center small">Masukan data perusahaan</p>
                                </div>

                                @if (session('success'))
                                <div class="alert alert-primary">
                                    {{ session('success') }}
                                </div>
                                @endif

                                <form action="register_perusahaan" method="post" class="row g-3" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Nama Perusahaan</label>
                                        <input autofocus type="text" name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="validationServer01" required value="{{old('nama_perusahaan')}}">
                                        @error('nama_perusahaan')
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                {{$message}}
                                              </small>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">E-mail Perusahaan</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="validationServer02" required value="{{old('email')}}">
                                        </div>
                                        @error('email')
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                {{$message}}
                                              </small>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="validationServer03" required value="{{old('username')}}">
                                        @error('username')
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                {{$message}}
                                              </small>
                                        @enderror
                                    </div>


                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="validationServer04" required>
                                        @error('password')
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                {{$message}}
                                              </small>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="yourPassword" class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="ulangi_password" class="form-control @error('ulangi_password') is-invalid @enderror" id="validationServer05Feedback" required>
                                        @error('ulangi_password')
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                {{$message}}
                                              </small>
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