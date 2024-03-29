@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tracer Study</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Tracer Study</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (session('success'))
    <div class="alert alert-primary">
        {{ session('success') }}
    </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                @if(Auth::user()->status_tracer == 1)
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">Terima Kasih Telah Ikut Serta Dalam Pendataan Alumni</h4>
                                <p>Tracer Study dilakukan untuk pendataan yang sangat berguna bagi Sekolah dan Alumni</p>
                                <hr>
                                <p class="mb-0">Link ini digunakan jika ada perubahan data : <a href="/edit-data-tracer/{{Auth::user()->email}}"><span class="alert-link">Link update</span></a></p>
                              </div>
                        </div>
                        </div>
                    </div>
                </section>
                @else
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Silahkan Lakukan Tracer Study</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Tracer Study dilakukan untuk pendataan yang sangat berguna bagi Sekolah dan Alumni</p>
                            </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                            <form action="/update-tracer-study" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-11">
                                    <label for="exampleInputEmail1">Tahun Lulus</label>
                                    <input type="hidden" name="id_user" value="{{Auth::user()->id_user}}" id="">
                                    <input type="hidden" name="email_pk" value="{{Auth::user()->email}}" id="">
                                    <input type="hidden" name="status" value="1" id="">
                                    <input type="text" name="tahun_lulus" value="{{old('tahun_lulus')}}" class="form-control @error('tahun_lulus') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">
                                        Ex : Tahun 2019
                                    </small>
                                    @error('tahun_lulus')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Jurusan</label>
                                    <input type="text" name="jurusan" id="jurusan" value="{{old('jurusan')}}" class="form-control @error('jurusan') is-invalid @enderror" id="inputAddress2">
                                    <small id="emailHelp" class="form-text text-muted">
                                        Ex : Teknik Kimia Industri 
                                    </small>
                                    @error('jurusan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleFormControlSelect2">Sekollah Asal</label>
                                    <select name="id_bkk" class="form-control" id="exampleFormControlSelect1">
                                        <option value="0">Pilih Sekolah</option>
                                        @foreach($bkk as $item)
                                        <option value="{{$item->id_bkk}}">{{$item->nama_sekolah}}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">
                                        Pilih sesuai dengan sekolah anda. jika belum tersedia, silahkan hubungi BKK untuk register sekolah terlebih dahulu. 
                                    </small>
                                    @error('id_bkk')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Status Bekerja</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_bekerja" id="exampleRadios1" value="Sudah Bekerja">
                                        <label class="form-check-label" for="exampleRadios1">
                                          Sudah Bekerja
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_bekerja" id="exampleRadios2" value="Belum Bekerja">
                                        <label class="form-check-label" for="exampleRadios2">
                                          Belum Bekerja
                                        </label>
                                      </div>
                                      @error('status_bekerja')
                                        <small id="emailHelp" class="form-text text-muted">
                                            {{$message}}
                                        </small>
                                        @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Tempat Kerja</label>
                                    <input type="text" name="tempat_kerja" id="tempat_kerja" value="{{old('tempat_kerja')}}" class="form-control @error('tempat_kerja') is-invalid @enderror" id="inputAddress2" value="-">
                                    <small id="emailHelp" class="form-text text-muted">
                                        Abaikan jika belum bekerja.
                                    </small>
                                    @error('tempat_kerja')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-4"> 
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            </div>
                        </form>
                        
                            </div>
                            @endif
                        </div>
                        
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection