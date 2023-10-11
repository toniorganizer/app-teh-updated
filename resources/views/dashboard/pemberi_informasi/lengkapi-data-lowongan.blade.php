@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Informasi Lowongan Pekerjaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Lengkapi Informasi Lowongan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lengkapi Informasi Lowongan</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Silahkan berikan informasi detail lowongan : Deskripsi pekerjaan, Persayaratan Khusus, Persayaratan Umum, Keterampilan yang dibutuhkan</p>
                            </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                            <form action="{{ route('sumber.update_informasi', $data->id_informasi_lowongan)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-11">
                                    <label for="exampleInputEmail1">Judul Lowongan</label>
                                    <input type="hidden" name="pemberi_id" value="{{Auth::user()->id_user}}" id="">
                                    <input type="text" name="judul_lowongan" class="form-control @error('judul_lowongan') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->judul_lowongan}}">
                                    @error('judul_lowongan')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Nama Perusahaan</label>
                                    <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->perusahaan}}">
                                    @error('perusahaan')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Salary</label>
                                    <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->salary}}">
                                    @error('salary')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Bidang</label>
                                    <input type="text" name="bidang" class="form-control @error('bidang') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->bidang}}">
                                    @error('bidang')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                                    <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->pendidikan}}">
                                    @error('pendidikan')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Pengalaman</label>
                                    <input type="text" name="pengalaman" class="form-control @error('pengalaman') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->pengalaman}}">
                                    @error('pengalaman')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Keterampilan</label>
                                    <input type="text" name="keterampilan" class="form-control @error('keterampilan') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->keterampilan}}">
                                    @error('keterampilan')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                <label for="exampleFormControlSelect2">Jenis Lowongan</label>
                                <select name="jenis_lowongan" class="form-control">
                                    <option>Pilih Jenis Lowongan</option>
                                    <option value="Full Time" {{ $data->jenis_lowongan == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="Part Time" {{ $data->jenis_lowongan == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                </select>
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->lokasi}}">
                                    @error('lokasi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Tanggal Dibuka</label>
                                    <input type="date" name="tgl_buka" class="form-control @error('tgl_buka') is-invalid @enderror" id="inputAddress2" value="{{$data->tgl_buka}}">
                                    @error('tgl_buka')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputAddress2" class="form-label">Tanggal Tutup</label>
                                    <input type="date" name="tgl_tutup" class="form-control @error('tgl_tutup') is-invalid @enderror" id="inputAddress2" value="{{$data->tgl_tutup}}">
                                    @error('tgl_tutup')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputCity" class="form-label">Foto Lowongan</label>
                                    <input class="form-control @error('foto') is-invalid @enderror" name="foto" type="file" id="formFile">
                                    @error('foto')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                    <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <input type="hidden" name="id" value="{{$data->id_informasi_lowongan}}">
                                    <label for="exampleFormControlSelect2">Deskripsi Lowongan</label>
                                    <div class="form-group mb-3">
                                        <textarea name="deskripsi" class="form-control ckeditor" id="ckeditor" rows="3">{{$data->deskripsi}}</textarea>
                                    </div>
                                    @error('deskripsi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
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
@include('dashboard/modal/modal-add-lowongan')
@endsection