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
                            <form action="/update-data-tracer" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-11">
                                    <label for="exampleInputEmail1">Tahun Lulus</label>
                                    <input type="hidden" name="id_user" value="{{Auth::user()->id_user}}" id="">
                                    <input type="hidden" name="email_pk" value="{{Auth::user()->email}}" id="">
                                    <input type="hidden" name="status" value="1" id="">
                                    <input type="text" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$data->tahun_lulus}}">
                                    @error('tahun_lulus')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Jurusan</label>
                                    <input type="text" name="jurusan" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror" id="inputAddress2" value="{{$data->jurusan}}">
                                    @error('jurusan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleFormControlSelect2">Sekollah Asal</label>
                                    <select name="id_bkk" class="form-control" id="exampleFormControlSelect1">
                                        <option>Pilih Sekolah</option>
                                        @foreach($bkk as $item)
                                            <option value="{{$item->id_bkk}}" {{ $data->bkk_id == $item->id_bkk ? 'selected' : '' }}>{{$item->nama_sekolah}}</option>
                                        @endforeach
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">
                                        Pilih sesuai dengan sekolah anda. jika belum tersedia, silahkan hubungi BKK untuk register sekolah terlebih dahulu. 
                                    </small>
                                    @error('judul_lowongan')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Status Bekerja</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_bekerja" id="exampleRadios1" value="Sudah Bekerja" {{ $data->status_bekerja == 'Sudah Bekerja' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios1">
                                          Sudah Bekerja
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_bekerja" id="exampleRadios2" value="Belum Bekerja" {{ $data->status_bekerja == 'Belum Bekerja' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios2">
                                          Belum Bekerja
                                        </label>
                                      </div>
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Tempat Kerja</label>
                                    <input type="text" name="tempat_kerja" id="tempat_kerja" class="form-control @error('tempat_kerja') is-invalid @enderror" id="inputAddress2" value="{{$data->tempat_kerja}}">
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