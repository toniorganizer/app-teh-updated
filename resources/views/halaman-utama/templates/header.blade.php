<!-- ======= Header ======= -->
<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('assets/img/sumbar.png')}}" alt="">
            <h4>SUMBAR<span></span></h4>
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                {{-- <li class="dropdown"><a href="#"><span>Home</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="index.html">Home 1 - index.html</a></li>
                        <li><a href="index-2.html">Home 2 - index-2.html</a></li>
                        <li><a href="index-3.html">Home 3 - index-3.html</a></li>
                        <li><a href="index-4.html" class="active">Home 4 - index-4.html</a></li>
                    </ul>
                </li> --}}

                <li><a class="nav-link scrollto" href="/">Home</a></li>
                <li><a class="nav-link scrollto" href="/perusahaan-register">Registrasi Perusahaan</a></li>
                <li><a class="nav-link scrollto" href="/bkk-register">Registrasi BKK</a></li>
                <li><a class="nav-link scrollto" href="/lowongan-home">Lowongan</a></li>
                {{-- <li><a class="nav-link scrollto" href="#">FAQ</a></li> --}}
                <li><a class="nav-link scrollto" href="/hubungi">Hubungi</a></li>
                <a class="btn-getstarted scrollto" href="/user-register">Daftar</a>
                <a class="btn-login scrollto" href="/login">Login</a>
            </ul>
            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->

        {{-- <a class="btn-getstarted scrollto" href="/register">Masuk</a>
        <a class="btn-getstarted scrollto" href="/login">Login</a> --}}

    </div>
</header><!-- End Header -->