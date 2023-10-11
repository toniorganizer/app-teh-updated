@extends('halaman-utama/main')

@section('content')
@include('halaman-utama/templates/header')

<section id="hero-fullscreen" class="hero-full d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center position-relative" data-aos="zoom-out">
        <div class="s003">
            <form action="/search-job" method="GET">
              @csrf
              <div class="inner-form">
                <div class="input-field first-wrap">
                  <div class="input-select">
                    <select data-trigger="" name="bidang">
                      <option value="">Semua type</option>
                      <option value="Programmer">Programmer</option>
                      <option value="Desainer">Desainer</option>
                      <option value="Jasa">Jasa</option>
                      <option value="Operator">Operator</option>
                      <option value="Teknisi">Teknisi</option>
                      <option value="Pendidik">Pendidik</option>
                      <option value="Pegawai">Pegawai</option>
                      <option value="Supir">Supir</option>
                      <option value="Animator">Animator</option>
                      <option value="Apoteker">Apoteker</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                </div>
                <div class="input-field second-wrap">
                  <input id="search" type="text" name="judul" placeholder="Cari lowongan pekerjaan.." />
                </div>
                <div class="input-field third-wrap">
                  <button class="btn-search" type="submit">
                    <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </form>
          </div>
    </div>
</section>

<main id="main">
    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="container">
          <div class="section-header">
            <h3 class="lowongan">Daftar Lowongan Pekerjaan</h3>
            <p>Temukan Informasi Lowongan Pekerjaan dan Peluang Karir disini</p>
          </div>

            <div class="row gy-4">

              @foreach ($data as $item)  
                <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out">
                    <div class="service-item position-relative">
                        <div class="icon">
                          <img class="rounded" width="50px" src="
                          @if($item->foto_lowongan == 'default.jpg')
                          {{ Storage::url('public/informasi-lowongan/default/').$item->foto_lowongan}}
                          @else
                          {{ Storage::url('public/informasi-lowongan/').$item->foto_lowongan}}
                          @endif
                          " alt="">
                        </div>
                        <h4><a href="/detail-informasi-lowongan/{{$item->id_informasi_lowongan}}" class="stretched-link">{{$item->judul_lowongan}}</a></h4>
                          <div class="icon">
                            {{-- <i class="bi bi-briefcase"></i> --}}
                            {{$item->name}}
                          </div>
                          <div class="icon-lokasi">
                            <i class="bi bi-geo-alt"></i>
                            {{mb_strimwidth($item->lokasi, 0, 42, "...");}}
                          </div>
                          <div class="icon-tanggal">
                            <i class="bi bi-clock"></i>
                            {{date('d/m/Y', strtotime($item->created_at))}}
                          </div>
                          <div class="gaji">
                            Estimasi gaji : Rp.{{$item->salary}}
                          </div>
                          @if($item->verifikasi == 1)
                          <div class="verifikasi">
                            <i class="bi bi-check-circle"></i>
                            Terverifikasi Disnaker
                          </div>
                          @elseif($item->verifikasi == 2)
                          <div class="no-verifikasi">
                            <i class="bi bi-x-circle"></i>
                            Tidak disetujui
                          </div>
                          @else
                            <div class="verifikasi">
                              <i class="bi bi-arrow-counterclockwise"></i>
                              Belum diverifikasi
                            </div>
                          @endif
                    </div>
                </div><!-- End Service Item -->
                @endforeach
            </div>
        </div>
    </section><!-- End Featured Services Section -->
</main>

@include('halaman-utama/templates/footer')
@endsection