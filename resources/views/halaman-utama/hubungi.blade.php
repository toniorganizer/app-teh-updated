@extends('halaman-utama/main')

@section('content')
@include('halaman-utama/templates/header')

<main id="main">

    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">
            <h2>Hubungi Kami</h2>
        </div>
      </section><!-- End Testimonials Section -->

    <section id="contact" class="contact">
        
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7978.575891894524!2d100.34722337770995!3d-0.9342371999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b92ea2cfa61f%3A0x2db71f9bff0fa265!2sDINAS%20TENAGA%20KERJA%20DAN%20TRANSMIGRASI%20PROVINSI%20SUMATERA%20BARAT!5e0!3m2!1sid!2sid!4v1694399239967!5m2!1sid!2sid"  frameborder="0" allowfullscreen></iframe>
          </div><!-- End Google Maps -->
        <div class="container">
  
          <div class="row gy-5 gx-lg-5">
  
            <div class="col-lg-4">
  
              <div class="info">
                <h3>Hubungi Kami</h3>
                <p>Dinas Tenaga Kerja dan Transmigrasi Provinsi Sumatera Barat</p>
  
                <div class="info-item d-flex">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h4>Lokasi:</h4>
                    <p>Jl. Ujung Gurun No.7, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114</p>
                  </div>
                </div><!-- End Info Item -->
  
                <div class="info-item d-flex">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h4>Email:</h4>
                    <p>disnakertrans@sumbarprov.go.id</p>
                  </div>
                </div><!-- End Info Item -->
  
                <div class="info-item d-flex">
                  <i class="bi bi-phone flex-shrink-0"></i>
                  <div>
                    <h4>Telephone:</h4>
                    <p>075127417</p>
                  </div>
                </div><!-- End Info Item -->
  
              </div>
  
            </div>
  
            <div class="col-lg-8">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Masukan nama" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail Anda" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" placeholder="Pesan" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Pesan anda telah terkirim. Terima kasih!</div>
                </div>
                <div class="text-center"><button type="submit">Kirim Pesan</button></div>
              </form>
            </div><!-- End Contact Form -->
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->
</main>

@include('halaman-utama/templates/footer')
@endsection