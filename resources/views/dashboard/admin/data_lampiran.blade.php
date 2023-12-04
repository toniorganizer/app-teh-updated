@extends('dashboard/main')

@section('container')
@include('dashboard/templates/header')
@include('dashboard/templates/sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Lampiran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Lampiran</li>
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

                <div class="card">
                  <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview">Tabel 4.1</button>
                      </li>
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Tabel 4.8</button>
                      </li>
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabel49">Tabel 4.9</button>
                      </li>

                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabel410">Tabel 4.10</button>
                      </li>

                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabel411">Tabel 4.11</button>
                      </li>

                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabel412">Tabel 4.12</button>
                      </li>

                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabel413">Tabel 4.13</button>
                      </li>

                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabel414">Tabel 4.14</button>
                      </li>
      
                    </ul>
                    <div class="tab-content pt-2">
      
                      <div class="tab-pane fade show pt-3 profile-overview" id="profile-overview">
                        <h5 class="card-title">Tabel 4.1</h5>
                        <div class="activity overflow-scroll">
                            <table class="table datatable table-bordered center">
                                <tr><th rowspan="3">Pencari Kerja</th><th colspan="10">Kelompok umur</th><th colspan="3" rowspan="2">Jumlah</th><th rowspan="3">Lowongan</th><th rowspan="3">L</th><th rowspan="3">P</th><th rowspan="3">JML</th>
                                    {{-- <th rowspan="3">Action</th> --}}
                                </tr> 
                                <tr><td colspan="2">15-19</td><td colspan="2">20-29</td><td colspan="2">30-44</td><td colspan="2">45-54</td><td colspan="2">55+</td></tr> <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>JML</th></tr> 
                                <tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>1</th><th>2</th><th>3</th><th>4</th></tr>

                                @if($aturan->status_lembaga == 1)
                                    @foreach($datalaporan as $laporan)
                                    <tr>
                                        <td>{{ $laporan->pencari_kerja }}</td>
                                        <td>{{ $laporan->{'15_L'} }}</td>
                                        <td>{{ $laporan->{'15_P'} }}</td>
                                        <td>{{ $laporan->{'20_L'} }}</td>
                                        <td>{{ $laporan->{'20_P'} }}</td>
                                        <td>{{ $laporan->{'30_L'} }}</td>
                                        <td>{{ $laporan->{'30_P'} }}</td>
                                        <td>{{ $laporan->{'45_L'} }}</td>
                                        <td>{{ $laporan->{'45_P'} }}</td>
                                        <td>{{ $laporan->{'55_L'} }}</td>
                                        <td>{{ $laporan->{'55_P'} }}</td>
                                        <td>{{$laporan->{'15_L'} + $laporan->{'20_L'} + $laporan->{'30_L'} + $laporan->{'45_L'} + $laporan->{'55_L'} }}</td>
                                        <td>{{$laporan->{'15_P'} + $laporan->{'20_P'} + $laporan->{'30_P'} + $laporan->{'45_P'} + $laporan->{'55_P'} }}</td>
                                        <td>{{$laporan->{'15_L'} + $laporan->{'15_P'} + $laporan->{'20_L'} +  $laporan->{'20_P'} + $laporan->{'30_L'} + $laporan->{'30_P'} + $laporan->{'45_L'} + $laporan->{'45_P'} + $laporan->{'55_L'} + $laporan->{'55_P'} }}</td>
                                        <td>{{$laporan->lowongan}}</td>
                                        <td>{{ $laporan->lowongan_L }}</td>
                                        <td>{{ $laporan->lowongan_P }}</td>
                                        <td>{{ $laporan->lowongan_L + $laporan->lowongan_P }}</td>
                                        {{-- <td>
                                            <form action="edit-laporan-i/{{$laporan->nmr}}">
                                                @csrf
                                                <input type="hidden" value="{{$laporan->type}}" name="type">
                                                <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                            </form>
                                        </td> --}}

                                    </tr>
                                    @endforeach
                                @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                                @foreach($datalaporan as $laporan)
                                <tr>
                                    <td>{{ $laporan->pencari_kerja }}</td>
                                    <td>{{ $laporan->{'15_L'} }}</td>
                                    <td>{{ $laporan->{'15_P'} }}</td>
                                    <td>{{ $laporan->{'20_L'} }}</td>
                                    <td>{{ $laporan->{'20_P'} }}</td>
                                    <td>{{ $laporan->{'30_L'} }}</td>
                                    <td>{{ $laporan->{'30_P'} }}</td>
                                    <td>{{ $laporan->{'45_L'} }}</td>
                                    <td>{{ $laporan->{'45_P'} }}</td>
                                    <td>{{ $laporan->{'55_L'} }}</td>
                                    <td>{{ $laporan->{'55_P'} }}</td>
                                    <td>{{$laporan->{'15_L'} + $laporan->{'20_L'} + $laporan->{'30_L'} + $laporan->{'45_L'} + $laporan->{'55_L'} }}</td>
                                    <td>{{$laporan->{'15_P'} + $laporan->{'20_P'} + $laporan->{'30_P'} + $laporan->{'45_P'} + $laporan->{'55_P'} }}</td>
                                    <td>{{$laporan->{'15_L'} + $laporan->{'15_P'} + $laporan->{'20_L'} +  $laporan->{'20_P'} + $laporan->{'30_L'} + $laporan->{'30_P'} + $laporan->{'45_L'} + $laporan->{'45_P'} + $laporan->{'55_L'} + $laporan->{'55_P'} }}</td>
                                    <td>{{$laporan->lowongan}}</td>
                                    <td>{{ $laporan->lowongan_L }}</td>
                                    <td>{{ $laporan->lowongan_P }}</td>
                                    <td>{{ $laporan->lowongan_L + $laporan->lowongan_P }}</td>
                                    {{-- <td>
                                        <form action="edit-laporan-i/{{$laporan->nmr}}">
                                            @csrf
                                            <input type="hidden" value="{{$laporan->type}}" name="type">
                                            <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                        </form>
                                    </td> --}}

                                </tr>
                                @endforeach
                                @elseif($aturan->status_lembaga == 0)
                                    @if(is_null($pencari_kerja1))
                                    @else
                                    <tr>
                                        <td>{{ $pencari_kerja1->pencari_kerja }}</td>
                                        <td>{{ $jumlahL151 }}</td>
                                        <td>{{ $jumlahP151 }}</td>
                                        <td>{{ $jumlahL201 }}</td>
                                        <td>{{ $jumlahP201 }}</td>
                                        <td>{{ $jumlahL301 }}</td>
                                        <td>{{ $jumlahP301 }}</td>
                                        <td>{{ $jumlahL451 }}</td>
                                        <td>{{ $jumlahP451 }}</td>
                                        <td>{{ $jumlahL551 }}</td>
                                        <td>{{ $jumlahP551 }}</td>
                                        <td>{{ $jumlahL151 + $jumlahL201 + $jumlahL301 + $jumlahL451 + $jumlahL551 }}</td>
                                        <td>{{ $jumlahP151 + $jumlahP201 + $jumlahP301 + $jumlahP451 + $jumlahP551 }}</td>
                                        <td>{{ $jumlahL151 + $jumlahL201 + $jumlahL301 + $jumlahL451 + $jumlahL551 + $jumlahP151 + $jumlahP201 + $jumlahP301 + $jumlahP451 + $jumlahP551 }}</td>
                                        <td>{{ $pencari_kerja1->lowongan }}</td>
                                        <td>{{ $jumlahLowonganL1 }}</td>
                                        <td>{{ $jumlahLowonganP1 }}</td>
                                        <td>{{ $jumlahLowonganL1 + $jumlahLowonganP1 }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $pencari_kerja2->pencari_kerja }}</td>
                                        <td>{{ $jumlahL152 }}</td>
                                        <td>{{ $jumlahP152 }}</td>
                                        <td>{{ $jumlahL202 }}</td>
                                        <td>{{ $jumlahP202 }}</td>
                                        <td>{{ $jumlahL302 }}</td>
                                        <td>{{ $jumlahP302 }}</td>
                                        <td>{{ $jumlahL452 }}</td>
                                        <td>{{ $jumlahP452 }}</td>
                                        <td>{{ $jumlahL552 }}</td>
                                        <td>{{ $jumlahP552 }}</td>
                                        <td>{{ $jumlahL152 + $jumlahL202 + $jumlahL302 + $jumlahL452 + $jumlahL552 }}</td>
                                        <td>{{ $jumlahP152 + $jumlahP202 + $jumlahP302 + $jumlahP452 + $jumlahP552 }}</td>
                                        <td>{{ $jumlahL152 + $jumlahL202 + $jumlahL302 + $jumlahL452 + $jumlahL552 + $jumlahP152 + $jumlahP202 + $jumlahP302 + $jumlahP452 + $jumlahP552 }}</td>
                                        <td>{{ $pencari_kerja2->lowongan }}</td>
                                        <td>{{ $jumlahLowonganL2 }}</td>
                                        <td>{{ $jumlahLowonganP2 }}</td>
                                        <td>{{ $jumlahLowonganL2 + $jumlahLowonganP2 }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $pencari_kerja3->pencari_kerja }}</td>
                                        <td>{{ $jumlahL153 }}</td>
                                        <td>{{ $jumlahP153 }}</td>
                                        <td>{{ $jumlahL203 }}</td>
                                        <td>{{ $jumlahP203 }}</td>
                                        <td>{{ $jumlahL303 }}</td>
                                        <td>{{ $jumlahP303 }}</td>
                                        <td>{{ $jumlahL453 }}</td>
                                        <td>{{ $jumlahP453 }}</td>
                                        <td>{{ $jumlahL553 }}</td>
                                        <td>{{ $jumlahP553 }}</td>
                                        <td>{{ $jumlahL153 + $jumlahL203 + $jumlahL303 + $jumlahL453 + $jumlahL553 }}</td>
                                        <td>{{ $jumlahP153 + $jumlahP203 + $jumlahP303 + $jumlahP453 + $jumlahP553 }}</td>
                                        <td>{{ $jumlahL153 + $jumlahL203 + $jumlahL303 + $jumlahL453 + $jumlahL553 + $jumlahP153 + $jumlahP203 + $jumlahP303 + $jumlahP453 + $jumlahP553 }}</td>
                                        <td>{{ $pencari_kerja3->lowongan }}</td>
                                        <td>{{ $jumlahLowonganL3 }}</td>
                                        <td>{{ $jumlahLowonganP3 }}</td>
                                        <td>{{ $jumlahLowonganL3 + $jumlahLowonganP3 }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $pencari_kerja4->pencari_kerja }}</td>
                                        <td>{{ $jumlahL154 }}</td>
                                        <td>{{ $jumlahP154 }}</td>
                                        <td>{{ $jumlahL204 }}</td>
                                        <td>{{ $jumlahP204 }}</td>
                                        <td>{{ $jumlahL304 }}</td>
                                        <td>{{ $jumlahP304 }}</td>
                                        <td>{{ $jumlahL454 }}</td>
                                        <td>{{ $jumlahP454 }}</td>
                                        <td>{{ $jumlahL554 }}</td>
                                        <td>{{ $jumlahP554 }}</td>
                                        <td>{{ $jumlahL154 + $jumlahL204 + $jumlahL304 + $jumlahL454 + $jumlahL554 }}</td>
                                        <td>{{ $jumlahP154 + $jumlahP204 + $jumlahP304 + $jumlahP454 + $jumlahP554 }}</td>
                                        <td>{{ $jumlahL154 + $jumlahL204 + $jumlahL304 + $jumlahL454 + $jumlahL554 + $jumlahP154 + $jumlahP204 + $jumlahP304 + $jumlahP454 + $jumlahP554 }}</td>
                                        <td>{{ $pencari_kerja4->lowongan }}</td>
                                        <td>{{ $jumlahLowonganL4 }}</td>
                                        <td>{{ $jumlahLowonganP4 }}</td>
                                        <td>{{ $jumlahLowonganL4 + $jumlahLowonganP4 }}</td>
                                    </tr>
                                    @endif
                                @endif
                            </table>
                            
                        </div>
                      </div>
      
                      <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                        <h5 class="card-title">Tabel 4.8</h5>
                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                            <tr><th colspan="2" rowspan="3">TINGKAT PENDIDIKAN PENCARI KERJA DAN PENERIMA TENAGA KERJA</th><th colspan="6">Jenis Antar Kerja</th>
                                {{-- @if($aturan->status_lembaga == 1)<th rowspan="3" colspan="2">Action</th>@endif --}}
                            </tr>
                            <tr><th colspan="2">AKL</th><th colspan="2">AKAD</th><th colspan="2">AKAN</th></tr>
                            <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                            <?php $no = ($dataLaporan48->currentPage() - 1) * $dataLaporan48->perPage() + 1; ?>
                            @if($aturan->status_lembaga == 1)
                            @foreach ($dataLaporanKab48 as $laporan)
                            <tr>
                                @if($laporan->akll != '-')
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul}}</td>
                                @else
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul}}</th>
                                @endif
                                <td>{{$laporan->akll}}</td>
                                <td>{{$laporan->aklp}}</td>
                                <td>{{$laporan->akadl}}</td>
                                <td>{{$laporan->akadp}}</td>
                                <td>{{$laporan->akanl}}</td>
                                <td>{{$laporan->akanp}}</td>
                                {{-- @if($laporan->akanl != '-')
                                <td>
                                <form action="edit-laporan-viii/{{$laporan->nmr}}">
                                    @csrf
                                    <input type="hidden" value="{{$laporan->type}}" name="type">
                                    <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab48 as $laporan)
                            <tr>
                                @if($laporan->akll != '-')
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul}}</td>
                                @else
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul}}</th>
                                @endif
                                <td>{{$laporan->akll}}</td>
                                <td>{{$laporan->aklp}}</td>
                                <td>{{$laporan->akadl}}</td>
                                <td>{{$laporan->akadp}}</td>
                                <td>{{$laporan->akanl}}</td>
                                <td>{{$laporan->akanp}}</td>
                                {{-- @if($laporan->akanl != '-')
                                <td>
                                <form action="edit-laporan-viii/{{$laporan->nmr}}">
                                    @csrf
                                    <input type="hidden" value="{{$laporan->type}}" name="type">
                                    <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan48 as $lap)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$lap->judul}}</td>
                                    <td>{{$lap->akll}}</td>
                                    <td>{{$lap->aklp}}</td>
                                    <td>{{$lap->akadl}}</td>
                                    <td>{{$lap->akadp}}</td>
                                    <td>{{$lap->akanl}}</td>
                                    <td>{{$lap->akanp}}</td>
                                </tr>
                                @endforeach
                            @endif
                            
                            </table>
                            @if($aturan->status_lembaga == 1 || $aturan->status_lembaga == 3)
                            <div class="blog-pagination"> 
                                <nav aria-label="Page navigation">
                                  <ul class="pagination">
                                      <li class="page-item{{ ($dataLaporanKab48->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab48->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporanKab48->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporanKab48->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporanKab48->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporanKab48->currentPage() == $dataLaporanKab48->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab48->nextPageUrl() }}" aria-label="Next">
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
                                      <li class="page-item{{ ($dataLaporan48->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan48->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporan48->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporan48->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporan48->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporan48->currentPage() == $dataLaporan48->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan48->nextPageUrl() }}" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                          </a>
                                      </li>
                                  </ul>
                              </nav>
            
                            </div>
                            @endif
                      </div>
                      </div>
      
                      <div class="tab-pane fade pt-3" id="tabel49">
                        <h5 class="card-title">Tabel 4.9</h5>
                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                                <tr><th rowspan="2">No</th><th rowspan="2">Jenis Pendidikan</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th>
                                    {{-- @if($aturan->status_lembaga == 1)<th rowspan="2">Action</th>@endif --}}
                                </tr> 
                                <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                            <?php $no = ($dataLaporan49->currentPage() - 1) * $dataLaporan49->perPage() + 1; ?>
                            @if($aturan->status_lembaga == 1)
                            @foreach ($dataLaporanKab49 as $laporan)
                            <tr>
                              <td>{{$no++}}</td>
                                <td>{{$laporan->judul}}</td>
                                <td>{{$laporan->sisa_l}}</td>
                                <td>{{$laporan->sisa_p}}</td>
                                <td>{{$laporan->terdaftar_l}}</td>
                                <td>{{$laporan->terdaftar_p}}</td>
                                <td>{{$laporan->penempatan_l}}</td>
                                <td>{{$laporan->penempatan_p}}</td>
                                <td>{{$laporan->hapus_l}}</td>
                                <td>{{$laporan->hapus_p}}</td>
                                {{-- <td>
                                    <form action="edit-laporan-ii/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab49 as $laporan)
                            <tr>
                              <td>{{$no++}}</td>
                                <td>{{$laporan->judul}}</td>
                                <td>{{$laporan->sisa_l}}</td>
                                <td>{{$laporan->sisa_p}}</td>
                                <td>{{$laporan->terdaftar_l}}</td>
                                <td>{{$laporan->terdaftar_p}}</td>
                                <td>{{$laporan->penempatan_l}}</td>
                                <td>{{$laporan->penempatan_p}}</td>
                                <td>{{$laporan->hapus_l}}</td>
                                <td>{{$laporan->hapus_p}}</td>
                                {{-- <td>
                                    <form action="edit-laporan-ii/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan49 as $lap)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $lap->judul }}</td>
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
                                      <li class="page-item{{ ($dataLaporanKab49->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab49->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporanKab49->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporanKab49->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporanKab49->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporanKab49->currentPage() == $dataLaporanKab49->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab49->nextPageUrl() }}" aria-label="Next">
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
                                      <li class="page-item{{ ($dataLaporan49->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan49->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporan49->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporan49->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporan49->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporan49->currentPage() == $dataLaporan49->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan49->nextPageUrl() }}" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                          </a>
                                      </li>
                                  </ul>
                              </nav>
            
                            </div>
                            @endif
                        </div>
                      </div>
      
                      <div class="tab-pane fade pt-3" id="tabel410">
                        <h5 class="card-title">Tabel 4.10</h5>

                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                                <tr><th rowspan="2">No</th><th rowspan="2">Kelompok Jabatan</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th>
                                    {{-- @if($aturan->status_lembaga == 1)<th rowspan="2">Action</th>@endif --}}
                                </tr> 
                                <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                            
                            @if($aturan->status_lembaga == 1)
                            <?php $no=0; ?>
                            @foreach ($dataLaporanKab410 as $laporan)
                            <tr>
                              <td>{{$no++}}</td>
                                <td>{{$laporan->judul_kj}}</td>
                                <td>{{$laporan->sisa_l_kj}}</td>
                                <td>{{$laporan->sisa_p_kj}}</td>
                                <td>{{$laporan->terdaftar_l_kj}}</td>
                                <td>{{$laporan->terdaftar_p_kj}}</td>
                                <td>{{$laporan->penempatan_l_kj}}</td>
                                <td>{{$laporan->penempatan_p_kj}}</td>
                                <td>{{$laporan->hapus_l_kj}}</td>
                                <td>{{$laporan->hapus_p_kj}}</td>
                                {{-- @if($laporan->sisa_l_kj != '-')
                                <td>
                                    <form action="edit-laporan-iii/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            <?php $no=0; ?>
                            @foreach ($dataLaporanKab410 as $laporan)
                            <tr>
                              <td>{{$no++}}</td>
                                <td>{{$laporan->judul_kj}}</td>
                                <td>{{$laporan->sisa_l_kj}}</td>
                                <td>{{$laporan->sisa_p_kj}}</td>
                                <td>{{$laporan->terdaftar_l_kj}}</td>
                                <td>{{$laporan->terdaftar_p_kj}}</td>
                                <td>{{$laporan->penempatan_l_kj}}</td>
                                <td>{{$laporan->penempatan_p_kj}}</td>
                                <td>{{$laporan->hapus_l_kj}}</td>
                                <td>{{$laporan->hapus_p_kj}}</td>
                                {{-- @if($laporan->sisa_l_kj != '-')
                                <td>
                                    <form action="edit-laporan-iii/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan410 as $lap)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $lap->judul_kj }}</td>
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
                      </div>

                      </div>

                      <div class="tab-pane fade pt-3" id="tabel411">
                        <h5 class="card-title">Tabel 4.11</h5>

                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                                <tr><th rowspan="2">No</th><th rowspan="2">Jenis Pendidikan</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th>
                                    {{-- @if($aturan->status_lembaga == 1)<th rowspan="2">Action</th>@endif --}}
                                </tr> 
                                <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                            <?php $no = ($dataLaporan411->currentPage() - 1) * $dataLaporan411->perPage() + 1; ?>
                            @if($aturan->status_lembaga == 1)
                            @foreach ($dataLaporanKab411 as $laporan)
                            <tr>
                                @if($laporan->sisa_l_lp == '-')
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul_lp}}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul_lp}}</td>
                                @endif
                                <td>{{$laporan->sisa_l_lp}}</td>
                                <td>{{$laporan->sisa_p_lp}}</td>
                                <td>{{$laporan->terdaftar_l_lp}}</td>
                                <td>{{$laporan->terdaftar_p_lp}}</td>
                                <td>{{$laporan->penempatan_l_lp}}</td>
                                <td>{{$laporan->penempatan_p_lp}}</td>
                                <td>{{$laporan->hapus_l_lp}}</td>
                                <td>{{$laporan->hapus_p_lp}}</td>
                                {{-- @if($laporan->sisa_l_lp != '-')
                                <td>
                                    <form action="edit-laporan-iv/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab411 as $laporan)
                            <tr>
                                @if($laporan->sisa_l_lp == '-')
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul_lp}}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul_lp}}</td>
                                @endif
                                <td>{{$laporan->sisa_l_lp}}</td>
                                <td>{{$laporan->sisa_p_lp}}</td>
                                <td>{{$laporan->terdaftar_l_lp}}</td>
                                <td>{{$laporan->terdaftar_p_lp}}</td>
                                <td>{{$laporan->penempatan_l_lp}}</td>
                                <td>{{$laporan->penempatan_p_lp}}</td>
                                <td>{{$laporan->hapus_l_lp}}</td>
                                <td>{{$laporan->hapus_p_lp}}</td>
                                {{-- @if($laporan->sisa_l_lp != '-')
                                <td>
                                    <form action="edit-laporan-iv/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan411 as $lap)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $lap->judul_lp }}</td>
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
                            @if($aturan->status_lembaga == 1 || $aturan->status_lembaga == 1)
                            <div class="blog-pagination"> 
                                <nav aria-label="Page navigation">
                                  <ul class="pagination">
                                      <li class="page-item{{ ($dataLaporanKab411->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab411->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporanKab411->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporanKab411->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporanKab411->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporanKab411->currentPage() == $dataLaporanKab411->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporanKab411->nextPageUrl() }}" aria-label="Next">
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
                                      <li class="page-item{{ ($dataLaporan411->currentPage() == 1) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan411->previousPageUrl() }}" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                          </a>
                                      </li>
                                      @for ($i = 1; $i <= $dataLaporan411->lastPage(); $i++)
                                          <li class="page-item{{ ($dataLaporan411->currentPage() == $i) ? ' active' : '' }}">
                                              <a class="page-link" href="{{ $dataLaporan411->url($i) }}">{{ $i }}</a>
                                          </li>
                                      @endfor
                                      <li class="page-item{{ ($dataLaporan411->currentPage() == $dataLaporan411->lastPage()) ? ' disabled' : '' }}">
                                          <a class="page-link" href="{{ $dataLaporan411->nextPageUrl() }}" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                          </a>
                                      </li>
                                  </ul>
                              </nav>
            
                            </div>
                            @endif
                      </div>

                      </div>

                      <div class="tab-pane fade pt-3" id="tabel412">
                        <h5 class="card-title">Tabel 4.12</h5>

                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                                <tr><th rowspan="2">No</th><th rowspan="2">Jenis Jabatan</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th>
                                    {{-- @if($aturan->status_lembaga == 1)<th rowspan="2">Action</th>@endif --}}
                                </tr> 
                                <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                                <?php $no=0; ?>
                            @if($aturan->status_lembaga == 1)
                            @foreach ($dataLaporanKab412 as $laporan)
                            <tr>
                                @if($laporan->sisa_l_lj == '-')
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul_lj}}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul_lj}}</td>
                                @endif
                                <td>{{$laporan->sisa_l_lj}}</td>
                                <td>{{$laporan->sisa_p_lj}}</td>
                                <td>{{$laporan->terdaftar_l_lj}}</td>
                                <td>{{$laporan->terdaftar_p_lj}}</td>
                                <td>{{$laporan->penempatan_l_lj}}</td>
                                <td>{{$laporan->penempatan_p_lj}}</td>
                                <td>{{$laporan->hapus_l_lj}}</td>
                                <td>{{$laporan->hapus_p_lj}}</td>
                                {{-- @if($laporan->sisa_l_lj != '-')
                                <td>
                                    <form action="edit-laporan-v/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab412 as $laporan)
                            <tr>
                                @if($laporan->sisa_l_lj == '-')
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul_lj}}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul_lj}}</td>
                                @endif
                                <td>{{$laporan->sisa_l_lj}}</td>
                                <td>{{$laporan->sisa_p_lj}}</td>
                                <td>{{$laporan->terdaftar_l_lj}}</td>
                                <td>{{$laporan->terdaftar_p_lj}}</td>
                                <td>{{$laporan->penempatan_l_lj}}</td>
                                <td>{{$laporan->penempatan_p_lj}}</td>
                                <td>{{$laporan->hapus_l_lj}}</td>
                                <td>{{$laporan->hapus_p_lj}}</td>
                                {{-- @if($laporan->sisa_l_lj != '-')
                                <td>
                                    <form action="edit-laporan-v/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan412 as $lap)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $lap->judul_lj }}</td>
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
                      </div>

                      </div>

                      <div class="tab-pane fade pt-3" id="tabel413">
                        <h5 class="card-title">Tabel 4.13</h5>

                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                                <tr><th rowspan="2">No</th><th rowspan="2">GOLONGAN USAHA & LAPANGAN USAHA</th><th colspan="2">Sisa Smtr Lalu</th><th colspan="2">Yang terdaftar Smtr ini</th><th colspan="2">Penempatan Smtr ini</th><th colspan="2">Dihapuskan Smtr ini</th>
                                    {{-- @if($aturan->status_lembaga == 1)<th rowspan="2">Action</th>@endif --}}
                                </tr> 
                                <tr><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th><th>L</th><th>P</th></tr> 
                                <?php $no = 0;?>
                            @if($aturan->status_lembaga == 1)
                            @foreach ($dataLaporanKab413 as $laporan)
                            <tr>
                                @if($laporan->sisa_l_gu == '-')
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul_gu}}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul_gu}}</td>
                                @endif
                                <td>{{$laporan->sisa_l_gu}}</td>
                                <td>{{$laporan->sisa_p_gu}}</td>
                                <td>{{$laporan->terdaftar_l_gu}}</td>
                                <td>{{$laporan->terdaftar_p_gu}}</td>
                                <td>{{$laporan->penempatan_l_gu}}</td>
                                <td>{{$laporan->penempatan_p_gu}}</td>
                                <td>{{$laporan->hapus_l_gu}}</td>
                                <td>{{$laporan->hapus_p_gu}}</td>
                                {{-- @if($laporan->sisa_l_gu != '-')
                                <td>
                                    <form action="edit-laporan-vi/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab413 as $laporan)
                            <tr>
                                @if($laporan->sisa_l_gu == '-')
                                <th>{{$no++}}</th>
                                <th>{{$laporan->judul_gu}}</th>
                                @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul_gu}}</td>
                                @endif
                                <td>{{$laporan->sisa_l_gu}}</td>
                                <td>{{$laporan->sisa_p_gu}}</td>
                                <td>{{$laporan->terdaftar_l_gu}}</td>
                                <td>{{$laporan->terdaftar_p_gu}}</td>
                                <td>{{$laporan->penempatan_l_gu}}</td>
                                <td>{{$laporan->penempatan_p_gu}}</td>
                                <td>{{$laporan->hapus_l_gu}}</td>
                                <td>{{$laporan->hapus_p_gu}}</td>
                                {{-- @if($laporan->sisa_l_gu != '-')
                                <td>
                                    <form action="edit-laporan-vi/{{$laporan->nmr}}">
                                        @csrf
                                        <input type="hidden" value="{{$laporan->type}}" name="type">
                                        <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                    </form>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                                @foreach($dataLaporan413 as $lap)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $lap->judul_gu }}</td>
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
                      </div>

                      </div>

                      <div class="tab-pane fade pt-3" id="tabel414">
                        <h5 class="card-title">Tabel 4.14</h5>

                        <div class="activity overflow-scroll">
                        <table class="table datatable table-bordered">
                            <tr><th rowspan="2">No</th><th rowspan="2">Kab / Kota</th><th colspan="2">Pencari Kerja Terdaftar</th><th colspan="2">Lowongan Kerja Terdaftar</th><th colspan="2">PencariKerja Ditempatkan</th>
                                {{-- @if($aturan->status_lembaga == 1)<th rowspan="2">Action</th>@endif --}}
                            </tr> 
                            <tr><th>L</th><th>W</th><th>L</th><th>W</th><th>L</th><th>W</th></tr> 
                            <?php $no =0;?>
                            @if($aturan->status_lembaga == 1)
                            @foreach ($dataLaporanKab414 as $laporan)
                            <tr>
                            @if($laporan->pktl == '-')
                              <th>{{$no++}}</th>
                              <th>{{$laporan->judul}}</th>
                            @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul}}</td>
                            @endif
                              <td>{{$laporan->pktl}}</td>
                              <td>{{$laporan->pktw}}</td>
                              <td>{{$laporan->lktl}}</td>
                              <td>{{$laporan->lktw}}</td>
                              <td>{{$laporan->pkdl}}</td>
                              <td>{{$laporan->pkdw}}</td>
                              {{-- @if($laporan->pktl != '-')
                              <td>
                                <form action="edit-lampiran-kab-kota/{{$laporan->nmr}}">
                                    @csrf
                                    <input type="hidden" value="{{$laporan->type}}" name="type">
                                    <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                </form>
                            </td>
                              @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 3 && ($aturan->role_acc == 2 || $aturan->role_acc == 0))
                            @foreach ($dataLaporanKab414 as $laporan)
                            <tr>
                            @if($laporan->pktl == '-')
                              <th>{{$no++}}</th>
                              <th>{{$laporan->judul}}</th>
                            @else
                                <td>{{$no++}}</td>
                                <td>{{$laporan->judul}}</td>
                            @endif
                              <td>{{$laporan->pktl}}</td>
                              <td>{{$laporan->pktw}}</td>
                              <td>{{$laporan->lktl}}</td>
                              <td>{{$laporan->lktw}}</td>
                              <td>{{$laporan->pkdl}}</td>
                              <td>{{$laporan->pkdw}}</td>
                              {{-- @if($laporan->pktl != '-')
                              <td>
                                <form action="edit-lampiran-kab-kota/{{$laporan->nmr}}">
                                    @csrf
                                    <input type="hidden" value="{{$laporan->type}}" name="type">
                                    <button type="submit" class="badge badge-primary"><i class="bi bi-pencil-square"></i></button>
                                </form>
                            </td>
                              @endif --}}
                            </tr>
                            @endforeach
                            @elseif($aturan->status_lembaga == 0)
                            @foreach($dataLaporan414 as $lap)
                                @if($lap->pktl == '-')
                                    <th>{{$no++}}</th>
                                    <th>{{$lap->judul}}</th>
                                @else
                                    <td>{{$no++}}</td>
                                    <td>{{$lap->judul}}</td>
                                @endif
                                <td>{{$lap->pktl}}</td>
                                <td>{{$lap->pktw}}</td>
                                <td>{{$lap->lktl}}</td>
                                <td>{{$lap->lktw}}</td>
                                <td>{{$lap->pkdl}}</td>
                                <td>{{$lap->pkdw}}</td>
                              </tr>
                              @endforeach
                              @endif
                        </table>
                        </div>
                      </div>
      
                    </div><!-- End Bordered Tabs -->
      
                  </div>
                </div>
      
              </div>

        <div class="col-lg-8">
                <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lampiran Laporan</h5>
              <div class="activity">
                <p style="text-align: justify">  @if($aturan->status_lembaga == 1)<span class="fw-bold text-dark">Edit data dapat dilakukan dengan menekan tombol pada kolom action. Tombol hapus, digunakan untuk menghapus keseluruhan data yang sudah di import, hal ini bisa dilakukan jika ingin melakukan import ulang.</span>@endif</p>

                <p style="text-align: justify">Pelaksanaan pembuatan laporan dapat dilakukan dengan download template terlebih dahulu, kemudian isi template berdasarkan data laporan yang ada. Pastikan setiap kolom terisi dengan benar sebelum melakukan import data.</p>

                <p style="text-align: justify">Silahkan buat terlebih dahulu rentang tanggal terhadap laporan yang telah dibuat, kemudian pilih file laporan berdasarkan template yang sudah terisi data, selanjutnya pilih import. </p>

                <form id="search-form" action="/importLampiran" method="post" enctype="multipart/form-data">
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
                            <a href="{{Storage::url('public/file/Template-Lampiran.xlsx')}}" class="btn btn-primary mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                            @if($aturan->status_lembaga == 1)
                            <div class="col-lg-3">
                                <a href="/delete-lampiran/{{Auth::user()->email}}" class="btn btn-danger mt-0" onclick="return confirm('Anda yakin ingin menghapus data lampiran laporan ?')"><i class="bi bi-trash3"></i></a>
                            </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-0">Download Hasil</h5>
                        <div class="row">
                            <div class="col-lg-3">
                            <a href="/cetak-lampiran/{{Auth::user()->email}}" class="btn btn-info mt-0"><i class="bi bi-cloud-arrow-down"></i></a>
                            </div>
                        </div><!-- End Website Traffic -->
                        @if(Auth::user()->email == 'disnaker@gmail.com')
                        <h5 class="card-title mb-0">Lampiran Kab/Kota</h5>
                        <div class="activity">
                            @foreach($kab as $data)
                            <div class="activity-item d-flex">
                              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                              <div class="activity-content"><a href="/detail-lampiran-kab/{{$data->email_lembaga}}" class="fw-bold text-dark">{{$data->nama_lembaga}}</a>
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