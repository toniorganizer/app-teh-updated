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
                <li class="breadcrumb-item active">Laporan IPK-III-2</li>
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

            <div class="col-xl-12">

                <div class="card">
                  <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <div class="tab-content pt-2">
                      {{-- <div class="tab-pane fade show active profile-overview"> --}}
                        <h5 class="card-title">LAPORAN-IPK-III-2 | IKHTISAR STATISTIK ANTAR KERJA PROPINSI SUMATERA BARAT</h5>
                        @if($aturan->status_lembaga == 3 && $aturan->role_acc == 2)
                            <div class="alert alert-warning" role="alert">
                                Silahkan menunggu di ruangan untuk proses perbaikan laporan.
                            </div>
                        @elseif($aturan->status_lembaga == 3 && $aturan->role_acc == 1)
                            <div class="alert alert-primary" role="alert">
                                Laporan sudah disetujui.
                            </div>
                        @endif
                        @if($aturan->status_lembaga == 1 && $aturan->role_acc == 2)
                            <div class="alert alert-warning" role="alert">
                                Silahkan ke ruangan kadis untuk proses perbaikan laporan.
                            </div>
                        @elseif($aturan->status_lembaga == 1 && $aturan->role_acc == 1)
                            <div class="alert alert-primary" role="alert">
                                Laporan sudah disetujui.
                            </div>
                        @endif
                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                                <tr><th rowspan="2">No</th><th rowspan="2">Jenis Pendidikan</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th></tr> 
                                <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                            <?php $no = ($dataLaporan->currentPage() - 1) * $dataLaporan->perPage() + 1; ?>
                            @if($aturan->status_lembaga == 1)
                                @foreach ($dataLaporanKab as $laporan)
                                <tr>
                                    @if($laporan->sisa_l == '-')
                                    <th>{{$no++}}</th>
                                    <th>{{ $laporan->judul }}</th>
                                    @else
                                    <td>{{$no++}}</td>
                                    <td>{{ $laporan->judul }}</td>
                                    @endif
                                    <td>{{$laporan->sisa_l}}</td>
                                    <td>{{$laporan->sisa_p}}</td>
                                    <td>{{$laporan->terdaftar_l}}</td>
                                    <td>{{$laporan->terdaftar_p}}</td>
                                    <td>{{$laporan->penempatan_l}}</td>
                                    <td>{{$laporan->penempatan_p}}</td>
                                    <td>{{$laporan->hapus_l}}</td>
                                    <td>{{$laporan->hapus_p}}</td>
                                    
                                </tr>
                                @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab as $laporan)
                            <tr>
                                @if($laporan->sisa_l == '-')
                                <th>{{$no++}}</th>
                                <th>{{ $laporan->judul }}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{ $laporan->judul }}</td>
                                @endif
                                <td>{{$laporan->sisa_l}}</td>
                                <td>{{$laporan->sisa_p}}</td>
                                <td>{{$laporan->terdaftar_l}}</td>
                                <td>{{$laporan->terdaftar_p}}</td>
                                <td>{{$laporan->penempatan_l}}</td>
                                <td>{{$laporan->penempatan_p}}</td>
                                <td>{{$laporan->hapus_l}}</td>
                                <td>{{$laporan->hapus_p}}</td>
                                @if($laporan->sisa_l != '-')
                                <td></td>
                                @endif
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan as $lap)
                                    <tr>
                                        @if($lap->sisa_l == '-')
                                        <th>{{$no++}}</th>
                                        <th>{{ $lap->judul }}</th>
                                        @else
                                        <td>{{$no++}}</td>
                                        <td>{{ $lap->judul }}</td>
                                        @endif
                                        <td>{{ $lap->sisa_l }}</td>
                                        <td>{{ $lap->sisa_p }}</td>
                                        <td>{{ $lap->terdaftar_l }}</td>
                                        <td>{{ $lap->terdaftar_p }}</td>
                                        <td>{{ $lap->penempatan_l }}</td>
                                        <td>{{ $lap->penempatan_p }}</td>
                                        <td>{{ $lap->hapus_l }}</td>
                                        <td>{{ $lap->hapus_p }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            
                            </table>
                            @if($aturan->status_lembaga == 1 || $aturan->status_lembaga == 3)
                            <div class="blog-pagination"> 
                                <nav aria-label="Page navigation">
                                  <ul class="pagination">
                                      <li class="page-item{{ ($dataLaporanKab->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporanKab->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporanKab->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporanKab->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporanKab->currentPage() == $dataLaporanKab->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab->nextPageUrl() }}" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                          </a>
                                      </li>
                                  </ul>
                              </nav>
            
                            </div>
                            @else
                            <div class="blog-pagination"> 
                                <nav aria-label="Page navigation">
                                  <ul class="pagination">
                                      <li class="page-item{{ ($dataLaporan->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporan->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporan->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporan->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporan->currentPage() == $dataLaporan->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan->nextPageUrl() }}" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                          </a>
                                      </li>
                                  </ul>
                              </nav>
            
                            </div>
                            @endif
                        </div>
                        
      
                    </div><!-- End Bordered Tabs -->
      
                  </div>
                </div>
      
              </div>

        <div class="col-lg-8">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan-IPK-III-2</h5>
              <div class="activity">
                <p style="text-align: justify">  @if($aturan->status_lembaga == 1)<span class="fw-bold text-dark">Edit data dapat dilakukan dengan menekan tombol pada kolom action. Tombol hapus, digunakan untuk menghapus keseluruhan data yang sudah di import, hal ini bisa dilakukan jika ingin melakukan import ulang.</span>@endif</p>

                <p style="text-align: justify">Pelaksanaan pembuatan laporan dapat dilakukan dengan download template terlebih dahulu, kemudian isi template berdasarkan data laporan yang ada. Pastikan setiap kolom terisi dengan benar sebelum melakukan import data.</p>

                <p style="text-align: justify">Silahkan buat terlebih dahulu rentang tanggal terhadap laporan yang telah dibuat, kemudian pilih file laporan berdasarkan template yang sudah terisi data, selanjutnya pilih import. </p>

                <form id="search-form" action="/importIPKII" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input name="tgl1" type="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input name="tgl2" type="date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <input type="file" class="form-control-file" name="file" required>
                    </div>
                    <div class="col-md-6 mt-2">
                        <button type="submit" class="btn btn-success mt-0"><i class="bi bi-cloud-arrow-up"></i> Import</button>
                    </div>
                </div>
                </form>
                
            </div>
          </div><!-- End Recent Activity -->
        </div>
        </div>

            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-0">Template  @if($aturan->status_lembaga == 1) & Delete @endif</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="{{Storage::url('public/file/Template-IPK-III-2-sheet.xlsx')}}" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                            @if($aturan->status_lembaga == 1)
                            <div class="col-lg-3">
                                <a href="/delete-laporan-ii/{{Auth::user()->email}}" class="btn btn-danger mt-0" onclick="return confirm('Anda yakin ingin menghapus data laporan IPK-III-2 ?')"><i class="bi bi-trash3"></i></a>
                            </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-0">Download Hasil</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="/cetak-laporan-ii/{{Auth::user()->email}}" class="btn btn-info mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                        </div><!-- End Website Traffic -->
                        @if(Auth::user()->email == 'disnaker@gmail.com')
                        <h5 class="card-title mb-0">Laporan Kab/Kota</h5>
                        <div class="activity">
                            @foreach($kab as $data)
                            <div class="activity-item d-flex">
                              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                              <div class="activity-content"><a href="/detail-laporan-kab-ii/{{$data->email_lembaga}}" class="fw-bold text-dark">{{$data->nama_lembaga}}</a>
                              </div>
                            </div><!-- End activity item-->
                            @endforeach
                          </div>
                          @endif
                    </div>
                </div>  
            </div>        

    </section>

</main>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>
@include('dashboard/templates/footer')
@endsection