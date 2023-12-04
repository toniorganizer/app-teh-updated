<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            @if($title == 'Dashboard')
            <a class="nav-link " href="/home">
            @elseif($sub_title == 'Dashboard')
            <a class="nav-link " href="/home">
            @else
            <a class="nav-link collapsed" href="/home">
            @endif
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if(auth::user()->level == 1)

        <li class="nav-item">
            @if($title == 'Data')
                <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            @else
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
             @endif
              <i class="bi bi-menu-button-wide"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse @if($title == 'Data') show @endif" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/user-data" @if($sub_title == 'Data User') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Data User</span>
                    </a>
                </li>
                <li>
                    <a href="/tenaga-kerja-data" @if($sub_title == 'Data Tenaga Kerja') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Data Tenaga Kerja</span>
                    </a>
                </li>
                <li>
                    <a href="/pemangku-kepentingan-data" @if($sub_title == 'Data Pemangku Kepentingan') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Data Pemangku Kepentingan</span>
                    </a>
                </li>
                <li>
                    <a href="/pekerjaan-data" @if($sub_title == 'Data Pekerjaan') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Data Pekerjaan</span>
                    </a>
                </li>
            </ul>
          </li><!-- End Components Nav -->
          <li class="nav-item">
            @if($title == 'Pasar Kerja')
            <a class="nav-link " href="/pemerintah">
            @elseif($sub_title == 'Pasar Kerja')
            <a class="nav-link " href="/pemerintah">
            @else
            <a class="nav-link collapsed" href="/pemerintah">
            @endif
            <i class="bi bi-shop-window"></i>
                <span>Pasar Kerja</span>
            </a>
        </li>
          <li class="nav-item">
            @if($title == 'Cetak Laporan')
            <a class="nav-link " href="/laporan">
            @elseif($sub_title == 'Cetak Laporan')
            <a class="nav-link " href="/laporan">
            @else
            <a class="nav-link collapsed" href="/laporan">
            @endif
            <i class="bi bi-file-earmark"></i>
                <span>Laporan</span>
            </a>
        </li>
        @endif
        @if(auth::user()->level == 4)

        <li class="nav-item">
            @if($title == 'Data')
                <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            @else
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
             @endif
              <i class="bi bi-menu-button-wide"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse @if($title == 'Data') show @endif" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/lowongan-data" @if($sub_title == 'Data Lowongan') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Data Lowongan</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#Lowongan">
                      <i class="bi bi-circle"></i><span>Tambah Lowongan</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="/pelamar-data" @if($sub_title == 'Data Pelamar') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Data Pelamar</span>
                    </a>
                </li> --}}
            </ul>
          </li><!-- End Components Nav -->
          
        @endif
        @if(auth::user()->level == 3)
        <li class="nav-item">
            @if($title == 'Data Pekerjaan')
            <a class="nav-link " href="/pekerjaan-data">
            @elseif($sub_title == 'Data Pekerjaan')
            <a class="nav-link " href="/pekerjaan-data">
            @else
            <a class="nav-link collapsed" href="/pekerjaan-data">
            @endif
                <i class="bi bi-database"></i>
                <span>Data Pekerjaan</span>
            </a>
        </li>
        <li class="nav-item">
            @if($title == 'Data Tenaga Kerja')
            <a class="nav-link " href="/tenaga-kerja-data">
            @elseif($sub_title == 'Data Tenaga Kerja')
            <a class="nav-link " href="/tenaga-kerja-data">
            @else
            <a class="nav-link collapsed" href="/tenaga-kerja-data">
            @endif
            <i class="bi bi-person-check"></i>
                <span>Data Tenaga Kerja</span>
            </a>
        </li>
        @if(Auth::user()->id_user == 13)
        <li class="nav-item">
            @if($title == 'Data Lowongan')
            <a class="nav-link " href="/lowongan-data">
            @elseif($sub_title == 'Data Lowongan')
            <a class="nav-link " href="/lowongan-data">
            @else
            <a class="nav-link collapsed" href="/lowongan-data">
            @endif
            <i class="bi bi-person-check"></i>
                <span>Data Pelamar</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            @if($title == 'Data Rekomendasi')
            <a class="nav-link " href="/pemerintah">
            @elseif($sub_title == 'Data Rekomendasi')
            <a class="nav-link " href="/pemerintah">
            @else
            <a class="nav-link collapsed" href="/pemerintah">
            @endif
                <i class="bi bi-folder-check"></i>
                <span>Rekomendasi</span>
            </a>
        </li><!-- End Dashboard Nav -->

        {{-- <li class="nav-item">
            @if($title == 'Laporan')
            <a class="nav-link " href="/laporan">
            @elseif($sub_title == 'Laporan')
            <a class="nav-link " href="/laporan">
            @else
            <a class="nav-link collapsed" href="/laporan">
            @endif
            <i class="bi bi-file-earmark"></i>
                <span>Laporan</span>
            </a>
        </li><!-- End Dashboard Nav --> --}}

        <li class="nav-item">
            @if($title == 'DataIPK')
                <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            @else
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
             @endif
              <i class="bi bi-file-earmark"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse @if($title == 'DataIPK') show @endif" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/laporan" @if($sub_title == 'Laporan') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK Terdaftar</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-1" @if($sub_title == 'Laporan IPK-III-1') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK-III-1</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-2" @if($sub_title == 'Laporan IPK-III-2') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK-III-2</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-3" @if($sub_title == 'Laporan IPK-III-3') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK-III-3</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-4" @if($sub_title == 'Laporan IPK-III-4') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK-III-4</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-5" @if($sub_title == 'Laporan IPK-III-5') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK-III-5</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-6" @if($sub_title == 'Laporan IPK-III-6') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Laporan IPK-III-6</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan-ipk-8" @if($sub_title == 'Laporan IPK-III-8') class="active" @endif>
                        <i class="bi bi-circle"></i><span>Laporan IPK-III-8</span>
                    </a>
                </li>
                <li>
                    <a href="/lampiran" @if($sub_title == 'Lampiran') class="active" @endif>
                      <i class="bi bi-circle"></i><span>Lampiran</span>
                    </a>
                </li>
                @if (stripos(Auth::user()->name, 'kadis') !== false)
                <li>
                    <a href="" @if($sub_title == 'Verifikasi') class="active" @endif data-toggle="modal" data-target="#verifikasi-laporan{{$sidebar_data->id_pemangku_kepentingan}}">
                      <i class="bi bi-circle"></i><span>Verifikasi</span>
                    </a>
                </li>
                @endif
            </ul>
          </li><!-- End Components Nav -->
        @endif

        @if(auth::user()->level == 5)
        <li class="nav-item">
            @if($title == 'Data Lowongan')
            <a class="nav-link " href="/data-lowongan-pekerja">
            @elseif($sub_title == 'Data Lowongan')
            <a class="nav-link " href="/data-lowongan-pekerja">
            @else
            <a class="nav-link collapsed" href="/data-lowongan-pekerja">
            @endif
                <i class="bi bi-database"></i>
                <span>Data Lowongan</span>
            </a>
        </li>
        <li class="nav-item">
            @if($title == 'Data Tracer')
            <a class="nav-link " href="/tracer-data">
            @elseif($sub_title == 'Data Tracer')
            <a class="nav-link " href="/tracer-data">
            @else
            <a class="nav-link collapsed" href="/tracer-data">
            @endif
                <i class="bi bi-envelope-paper-heart"></i>
                <span>Data Tracer</span>
            </a>
        </li>
        <li class="nav-item">
            @if($title == 'Data Rekomendasi')
            <a class="nav-link " href="/pemerintah">
            @elseif($sub_title == 'Data Rekomendasi')
            <a class="nav-link " href="/pemerintah">
            @else
            <a class="nav-link collapsed" href="/pemerintah">
            @endif
                <i class="bi bi-cloud-fog2"></i>
                <span>Trend</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @endif

        @if(auth::user()->level == 2)
        <li class="nav-item">
            @if($title == 'Data Lowongan')
            <a class="nav-link " href="/data-lowongan-pekerja">
            @elseif($sub_title == 'Data Lowongan')
            <a class="nav-link " href="/data-lowongan-pekerja">
            @else
            <a class="nav-link collapsed" href="/data-lowongan-pekerja">
            @endif
                <i class="bi bi-database"></i>
                <span>Data Lowongan</span>
            </a>
        </li>

        <li class="nav-item">
            @if($title == 'Status Daftar')
            <a class="nav-link " href="{{ Route('pekerja.show', Auth::user()->email)}}">
            @elseif($sub_title == 'Status Daftar')
            <a class="nav-link " href="{{ Route('pekerja.show', Auth::user()->email)}}">
            @else
            <a class="nav-link collapsed" href="{{ Route('pekerja.show', Auth::user()->email)}}">
            @endif
                <i class="bi bi-envelope-exclamation"></i>
                <span>Status Daftar</span>
            </a>
        </li>

        <li class="nav-item">
            @if($title == 'Tracer Study')
            <a class="nav-link " href="/tracer-study">
            @elseif($sub_title == 'Tracer Study')
            <a class="nav-link " href="/tracer-study">
            @else
            <a class="nav-link collapsed" href="/tracer-study">
            @endif
                <i class="bi bi-envelope-paper-heart"></i>
                <span>Tracer Study @if(Auth::user()->status_tracer == 0)<span class="badge badge-danger">New</span>@else <span class="badge badge-primary">Oke</span> @endif</span>
            </a>
        </li>
        
        <!-- End Dashboard Nav -->
        @endif

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            @if($title == 'Profile')
            <a class="nav-link" href="
                @if(Auth::user()->level == 4)
                    {{route('sumber.show', Auth::user()->email) }}
                @elseif(Auth::user()->level == 3)
                    {{route('pemerintah.show', Auth::user()->email) }}
                @elseif(Auth::user()->level == 2)
                    /profil-tenaga-kerja/{{Auth::user()->email}}
                @elseif(Auth::user()->level == 1)
                    /profil-admin/{{Auth::user()->email}}
                @endif
            ">
            @elseif($sub_title == 'Profile')
            <a class="nav-link" href="
                @if(Auth::user()->level == 4)
                    {{route('sumber.show', Auth::user()->email) }}
                @elseif(Auth::user()->level == 3)
                    {{route('pemerintah.show', Auth::user()->email) }}
                @elseif(Auth::user()->level == 2)
                    /profil-tenaga-kerja/{{Auth::user()->email}}
                @elseif(Auth::user()->level == 1)
                    /profil-admin/{{Auth::user()->email}}
                @endif
            ">
            @else
            <a class="nav-link collapsed" href="
                @if(Auth::user()->level == 4)
                    {{route('sumber.show', Auth::user()->email) }}
                @elseif(Auth::user()->level == 3)
                    {{route('pemerintah.show', Auth::user()->email) }}
                @elseif(Auth::user()->level == 2)
                    /profil-tenaga-kerja/{{Auth::user()->email}}
                @elseif(Auth::user()->level == 1)
                    /profil-admin/{{Auth::user()->email}}
                @endif
            ">
            @endif
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/user-faq">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/logout">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
@if (stripos(Auth::user()->name, 'kadis') !== false)
@include('dashboard/modal/modal-verifikasi-laporan')
@endif
@include('dashboard/modal/modal-add-lowongan')