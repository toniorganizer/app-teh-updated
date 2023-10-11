@extends('halaman-utama/main')

@section('content')
@include('halaman-utama/templates/header')

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Detail Informasi Lowongan</h2>
        <ol>
          <li><a href="/">Home</a></li>
          <li>Detail</li>
        </ol>
      </div>

    </div>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Blog Details Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row g-5">

        <div class="col-lg-8">

            <div class="post-author d-flex align-items-center">
                <img src="{{ Storage::url('public/informasi-lowongan/').$data->foto}}" class="rounded-circle flex-shrink-0" alt="">
                <div>
                    <div class="row">
                        <div class="col-lg-8">
                            <h4>{{$data->judul_lowongan}}</h4>
                            <h5>{{$data->perusahaan}}</h5>
                        </div>
                        <div class="btn col-lg-4">
                            <a href="/login" class="btn btn-primary">Lamar sekarang</a>
                        </div>
                    </div>
                  <div class="meta-top-center">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-geo-alt"></i> <a href="#">{{$data->lokasi}}</a></li>
                    </ul>
                  </div>

                  <div class="meta-top">
                    <ul>
                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"> {{date('d/m/Y', strtotime($data->created_at))}}</a></li>
                      <li class="d-flex align-items-center"><i class="bi bi-clock-history"></i> 
                        {{-- <a href="#">12 Comments</a> --}}
                      </li>
                    </ul>
                  </div><!-- End meta top -->
                </div>
              </div><!-- End post author -->

          <article class="blog-details">

            <h2 class="title">Deskripsi Lowongan</h2>

            <div class="content">
              {!!$data->deskripsi!!}
            </div><!-- End post content -->

            <div class="meta-bottom">
              <i class="bi bi-person-badge-fill"></i>
              <ul class="cats">
                @if($data->pemberi_informasi_id == 4)
                <li><a href="#">By Admin</a></li>
                @else
                <li><a href="#">By Perusahaan</a></li>
                @endif
                
              </ul>
              @if($data->verifikasi == 1)
              <i class="bi bi-check-circle"></i>
              <ul class="tags">
                <li><a href="#">Terverifikasi Disnaker</a></li>
              </ul>
              @elseif($data->verifikasi == 2)
              <i class="bi bi-x-circle"></i>
              <ul class="tags">
                <li><a href="#">Tidak disetujui</a></li>
              </ul>
              @else
              <i class="bi bi-arrow-counterclockwise"></i>
              <ul class="tags">
                <li><a href="#">Belum diverifikasi</a></li>
              </ul>
              @endif
            </div><!-- End meta bottom -->

          </article><!-- End blog post -->

        </div>

        <div class="col-lg-4">

          <div class="sidebar">

            <div class="sidebar-item recent-posts">
              <h3 class="sidebar-title">Job Interview</h3>
              <div>
                <div class="post-item mt-3">
                  <i class="bi bi-mortarboard"></i>
                  <div class="judul">
                    <p>Lowongan :</p>
                    <div class="sub-judul">
                      <p>{{$data->judul_lowongan}}</p>
                    </div>
                  </div>
                </div>

                <div class="post-item mt-3">
                  <i class="bi bi-bag-check"></i>
                  <div class="judul">
                    <p>Perusahaan :</p>
                    <div class="sub-judul">
                      <p>{{$data->perusahaan}}</p>
                    </div>
                  </div>
                </div>

                <div class="post-item mt-3">
                  <i class="bi bi-clock"></i>
                  <div class="judul">
                    <p>Tanggal Publish :</p>
                    <div class="sub-judul">
                      <p>{{date('h/m/Y', strtotime($data->created_at))}}</p>
                    </div>
                  </div>
                </div>

                <div class="post-item mt-3">
                  <i class="bi bi-hourglass-split"></i>
                  <div class="judul">
                    <p>Tanggal Expired :</p>
                    <div class="sub-judul">
                      <p>{{date('h/m/Y', strtotime($data->created_at))}}</p>
                    </div>
                  </div>
                </div>

                <div class="post-item mt-3">
                  <i class="bi bi-geo-alt"></i>
                  <div class="judul">
                    <p>Lokasi :</p>
                    <div class="sub-judul">
                      <p>{{$data->lokasi}}</p>
                    </div>
                  </div>
                </div>
                
              </div> 

            </div><!-- End sidebar recent posts-->

            <div class="sidebar-item recent-posts">
              <h3 class="sidebar-title">Tentang Pemberi Informasi</h3>

              <div class="mt-3">

                <div class="post-item mt-3">
                  <div>
                    @if($data->pemberi_informasi_id == 13)
                    <h5>By Admin</h5>
                    <p>Pemberi informasi admin Dinas Tenaga Kerja Sumatera Barat</p>
                    @else
                    <h5>{{$item->nama_instansi}}</h5>
                    <p>{!!$item->deskripsi!!}</p>
                    <a href="/login" class="btn-login">Lihat Profil Perusahaan</a>
                    @endif
                  </div>
                </div>

              </div> 

            </div><!-- End sidebar recent posts-->

            {{-- <div class="sidebar-item tags">
              <h3 class="sidebar-title">Tags</h3>
              <ul class="mt-3">
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>
            </div><!-- End sidebar tags--> --}}

          </div><!-- End Blog Sidebar -->

        </div>
      </div>

    </div>
  </section><!-- End Blog Details Section -->

</main><!-- End #main -->

@include('halaman-utama/templates/footer')
@endsection