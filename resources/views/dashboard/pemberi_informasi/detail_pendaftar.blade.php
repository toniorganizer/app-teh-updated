@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Status Daftar Lowongan Pekerjaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Status Daftar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="col-12 overflow-scroll">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Data Pelamar <span>| Hingga hari ini</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Pendidikan</th>
                        <th scope="col">Keterampilan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                      <tr>
                        <th scope="row text-center"><a href="#">
                            <img height="50px" src="
                            @if(Auth::user()->foto_user == 'default.jpg')
                            {{ Storage::url('public/user/default/').Auth::user()->foto_user}}
                            @else
                            {{ Storage::url('public/user/').Auth::user()->foto_user}}
                            @endif
                            " alt=""></a></th>
                        <td>{{$item->nama_lengkap}}</td>
                        <td>{{$item->pendidikan_terakhir}}</td>
                        <td>{{$item->keterampilan}}</td>
                        <td>
                            @if($item->status == 0)
                            Lamaran Masuk
                            @elseif($item->status == 1)
                            Proses Verifikasi
                            @else
                            Memenuhi kriteria
                            @endif
                        </td>
                        <td><a href="/detail-data-pendaftar/{{$item->id_pelamar}}" class="badge bg-primary">Detail</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    </section>

</main><!-- End #main -->

@include('dashboard/templates/footer')
@endsection