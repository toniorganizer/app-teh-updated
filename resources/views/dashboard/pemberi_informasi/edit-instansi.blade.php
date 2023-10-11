@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Data Instansi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Edit Data Instansi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Profil</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Edit Data profil Instansi selengkap mungkin untuk memudahkan pencari kerja</p>
                                @if (session('success'))
                                <div class="alert alert-primary">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                            <form action="{{ route('sumber.update', $data->id_pemberi_informasi)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-lg-11">
                                    <label for="exampleInputEmail1">Nama Instansi</label>
                                    <input type="text" name="nama_instansi" class="form-control @error('nama_instansi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->nama_instansi}}">
                                    @error('nama_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Bidang Instansi</label>
                                    <input type="text" name="bidang" class="form-control @error('bidang') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->bidang_instansi}}">
                                    @error('bidang')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">E-mail Instansi</label>
                                    <input type="email" name="email_instansi" class="form-control @error('email_instansi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->email_instansi}}" readonly>
                                    @error('email_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Website instansi</label>
                                    <input type="text" name="website_instansi" class="form-control @error('website_instansi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->website_instansi}}">
                                    @error('website_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Instagram instansi</label>
                                    <input type="text" name="instagram_instansi" class="form-control @error('instagram_instansi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->instagram_instansi}}">
                                    @error('instagram_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Facebook instansi</label>
                                    <input type="text" name="facebook_instansi" class="form-control @error('facebook_instansi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->facebook_instansi}}">
                                    @error('facebook_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Telepon instansi</label>
                                    <input type="text" name="telepon_instansi" class="form-control @error('telepon_instansi') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->telepon_instansi}}">
                                    @error('telepon_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="exampleInputEmail1">Alamat instansi</label>
                                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data->alamat}}">
                                    @error('alamat')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <label for="inputCity" class="form-label">Foto</label>
                                    <input class="form-control @error('foto_instansi') is-invalid @enderror" name="foto_instansi" type="file" id="formFile">
                                    @error('foto_instansi')
                                    <small id="emailHelp" class="form-text text-muted">
                                        {{$message}}
                                    </small>
                                    @enderror
                                    <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                                </div>
                                <div class="col-lg-11 mt-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi Instansi</label>
                                        <input type="hidden" name="id" value="{{$data->id_pemberi_informasi}}">
                                        <textarea name="deskripsi" class="form-control @error('foto_instansi') is-invalid @enderror ckeditor" id="ckeditor" rows="3">{{$data->deskripsi}}</textarea>
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
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@include('dashboard/modal/modal-add-lowongan')
@endsection