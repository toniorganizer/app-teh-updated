@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan IPK-III-5</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan IPK-III-5</li>
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
              <h5 class="card-title">Edit data Laporan-IPK-III-5</h5>
              <div class="activity">
                <p style="text-align: justify">Perhatikan data sebelum melakukan perubahan. Fitur ini berfungsi untuk mengubah data jika aa kesalahan berdasarkan baris. Jika ingin mengubah data yang berada di baris empat, maka tekan action baris keempat.</p>

                <form id="search-form" action="/update-laporan-v/{{$data->nmr}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <h6>Jenis Pendidikan | {{$data->judul_lj}}</h6>
                    <div class="col-md-6">
                      <input type="hidden" value="{{$data->id_disnaker}}" name="id_disnaker" id="">
                      <input type="hidden" value="{{$data->type}}" name="type" id="">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Sisa Smstr Lalu (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="sisa_l" value="{{ $data->{'sisa_l_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Trdftar Smstr Ini (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="terdaftar_l" value="{{ $data->{'terdaftar_l_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Penempatan Smstr Ini (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="penempatan_l" value="{{ $data->{'penempatan_l_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Dihapuskan Smstr Ini (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="hapus_l" value="{{ $data->{'hapus_l_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Sisa Smstr Lalu (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="sisa_p" value="{{ $data->{'sisa_p_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Trdftar Smstr Ini (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="terdaftar_p" value="{{ $data->{'terdaftar_p_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Penempatan Smstr Ini (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="penempatan_p" value="{{ $data->{'penempatan_p_lj'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">Dihapuskan Smstr Ini (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="hapus_p" value="{{ $data->{'hapus_p_lj'} }}" class="form-control" id="inputEmail3">
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