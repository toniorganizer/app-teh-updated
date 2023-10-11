@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Informasi Pekerjaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Edit Deskripsi Lowongan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit deskripsi informasi lowongan</h5>
                        <div class="row">
                            <div class="col-lg-11">
                                <p>Silahkan berikan informasi detail lowongan : Deskripsi pekerjaan, Persayaratan Khusus, Persayaratan Umum, Keterampilan yang dibutuhkan</p>
                            </div>
                            </div>
                        </div>

                        <form action="/update-deskripsi-lowongan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                    @if (session('success'))
                                    <div class="alert alert-primary">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    <input type="hidden" name="id" value="{{$data->id_informasi_lowongan}}">
                                    <div class="form-group mb-3">
                                        <textarea name="deskripsi" class="form-control ckeditor" id="ckeditor" rows="3">{{$data->deskripsi}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-11">
                                    <button type="submit" class="btn btn-primary mb-3 float-right">Update</button>
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