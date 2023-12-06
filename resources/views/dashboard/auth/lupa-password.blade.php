@extends('dashboard/main')

@section('container')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="/" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/sumbar.png" alt="">
                                <span class="d-none d-lg-block">SIPK</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                                    <p class="text-center small"></p>
                                </div>
                                @if(session('error'))
                                    <p class="alert alert-danger">{{session('error')}}</p>
                                @endif

                                @if(session('success'))
                                    <p class="alert alert-primary">{{session('success')}}</p>
                                @endif

                                @if(session('not-registered'))
                                    <p class="alert alert-danger">{{session('not-registered')}}</p>
                                @endif

                                <form class="row g-3 needs-validation" method="post" action="reset_password">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Masukan E-mail terdaftar</label>
                                        <div class="input-group has-validation">
                                            <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                            <input autofocus type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="yourUsername">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password Baru</label>
                                        <input type="password" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" id="yourPassword">
                                        @error('password_baru')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Ulangi Password</label>
                                        <input type="password" name="ulangi_password" class="form-control @error('ulangi_password') is-invalid @enderror" id="yourPassword">
                                        @error('ulangi_password')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Reset</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Halaman login? <a href="/login">Login</a></p>
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