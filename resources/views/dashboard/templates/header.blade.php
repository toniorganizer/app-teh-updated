<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/home" class="logo d-flex align-items-center">
            @if(Auth::user()->icon)
            <img src="{{ Storage::url('public/icon-lembaga/').Auth::user()->icon}}" alt="" />
            <span class="d-none d-lg-block">{{substr(Auth::user()->name, 18)}}</span>
            @else
            <img src="{{ asset('assets/img/sumbar.png')}}" alt="" />
            <span class="d-none d-lg-block">SUMBAR</span>
            @endif
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="
                    @if(Auth::user()->foto_user == 'default.jpg')
                    {{ Storage::url('public/user/default/').Auth::user()->foto_user}}
                    @else
                    {{ Storage::url('public/user/').Auth::user()->foto_user}}
                    @endif" alt="Profile" class="rounded-circle" />
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span> </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{Auth::user()->name}}</h6>
                        <span>{{Auth::user()->username}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="
                        @if(Auth::user()->level == 4)
                            {{route('sumber.show', Auth::user()->email) }}
                        @elseif(Auth::user()->level == 3)
                            {{route('pemerintah.show', Auth::user()->email) }}
                        @elseif(Auth::user()->level == 2)
                            /profil-tenaga-kerja/{{Auth::user()->email}}
                        @elseif(Auth::user()->level == 1)
                            /profil-admin/{{Auth::user()->email}}
                        @elseif(Auth::user()->level == 5)
                            {{route('bursa.show', Auth::user()->email) }}
                        @endif
                        ">
                            <i class="bi bi-person"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>logout</span>
                        </a>
                    </li>
                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->
        </ul>
    </nav>
    <!-- End Icons Navigation -->
</header>
<!-- End Header -->