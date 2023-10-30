@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan IPK-III-1</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan IPK-III-1</li>
            </ol>
            @if (session('success'))
            <div class="alert alert-primary">
                {{ session('success') }}
            </div>
            @endif
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">


        <div class="col-lg-12">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit data Laporan-IPK-III-1</h5>
              <div class="activity">
                <p style="text-align: justify">Perhatikan data sebelum melakukan perubahan. Fitur ini berfungsi untuk mengubah data jika aa kesalahan berdasarkan baris. Jika ingin mengubah data yang berada di baris empat, maka tekan action baris keempat.</p>

                <form id="search-form" action="/update-laporan-i/{{$data->nmr}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <h6>Pencari kerja</h6>
                    <div class="col-md-6">
                      <input type="hidden" value="{{$data->id_disnaker}}" name="id_disnaker" id="">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Laki-laki Umur 15-20</label>
                            <div class="col-sm-7">
                              <input type="text" name="15_L" value="{{ $data->{'15_L'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Laki-laki Umur 20-30</label>
                            <div class="col-sm-7">
                              <input type="text" name="20_L" value="{{ $data->{'20_L'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Laki-laki Umur 30-45</label>
                            <div class="col-sm-7">
                              <input type="text" name="30_L" value="{{ $data->{'30_L'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Laki-laki Umur 45-55</label>
                            <div class="col-sm-7">
                              <input type="text" name="45_L" value="{{ $data->{'45_L'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Laki-laki Umur 55+</label>
                            <div class="col-sm-7">
                              <input type="text" name="55_L" value="{{ $data->{'55_L'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Perempuan Umur 15-20</label>
                            <div class="col-sm-7">
                              <input type="text" name="15_P" value="{{ $data->{'15_P'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Perempuan Umur 20-35</label>
                            <div class="col-sm-7">
                              <input type="text" name="20_P" value="{{ $data->{'20_P'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Perempuan Umur 35-45</label>
                            <div class="col-sm-7">
                              <input type="text" name="30_P" value="{{ $data->{'30_P'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Perempuan Umur 45-55</label>
                            <div class="col-sm-7">
                              <input type="text" name="45_P" value="{{ $data->{'45_P'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Perempuan Umur 55+</label>
                            <div class="col-sm-7">
                              <input type="text" name="55_P" value="{{ $data->{'55_P'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                    </div>
                    <h6 class="mt-4">Ketersediaan lowongan</h6>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Laki-laki</label>
                            <div class="col-sm-7">
                              <input type="text" name="lowongan_L" value="{{ $data->lowongan_L }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Perempuan</label>
                            <div class="col-sm-7">
                              <input type="text" name="lowongan_P" value="{{ $data->lowongan_P }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6 mt-2">
                    </div>
                    <div class="col-md-6 mt-2">
                        <button type="submit" class="btn btn-success mt-0"><i class="bi bi-pencil-square"></i> update</button>
                    </div>
                </div>
                </form>
                
            </div>
          </div><!-- End Recent Activity -->
        </div>
        </div>   

    </section>

</main>
@include('dashboard/templates/footer')
@endsection