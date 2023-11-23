@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan IPK-III-6</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Laporan IPK-III-6</li>
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
              <h5 class="card-title">Edit data Laporan-IPK-III-6</h5>
              <div class="activity">
                <p style="text-align: justify">Perhatikan data sebelum melakukan perubahan. Fitur ini berfungsi untuk mengubah data jika aa kesalahan berdasarkan baris. Jika ingin mengubah data yang berada di baris empat, maka tekan action baris keempat.</p>

                <form id="search-form" action="/update-laporan-viii/{{$data->nmr}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <h6>Jenis Pendidikan | {{$data->judul}}</h6>
                    <div class="col-md-6">
                      <input type="hidden" value="{{$data->id_disnaker}}" name="id_disnaker" id="">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">AKL (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="akll" value="{{ $data->{'akll'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">AKAD (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="akadl" value="{{ $data->{'akadl'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">AKAL (Laki-laki)</label>
                            <div class="col-sm-5">
                              <input type="text" name="akanl" value="{{ $data->{'akanl'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">AKL (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="aklp" value="{{ $data->{'aklp'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">AKAD (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="akadp" value="{{ $data->{'akadp'} }}" class="form-control" id="inputEmail3">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-7 col-form-label">AKAN (Perempuan)</label>
                            <div class="col-sm-5">
                              <input type="text" name="akanp" value="{{ $data->{'akanp'} }}" class="form-control" id="inputEmail3">
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