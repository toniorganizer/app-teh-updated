<div class="modal fade" id="edit-il{{$data->id_informasi_lowongan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Edit data informasi lowongan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('lowongan.update', $data->id_informasi_lowongan)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Lowongan</label>
                      <input type="text" name="informasi" class="form-control @error('informasi') is-invalid @enderror" id="inputName5" value="{{$data->judul_lowongan}}">
                      @error('informasi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Perusahaan</label>
                      <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror" id="inputName5" value="{{$data->perusahaan}}">
                      @error('perusahaan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress5" class="form-label">Salary</label>
                      <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror" id="inputAddres5s" value="{{$data->salary}}">
                      @error('salary')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputAddress5" class="form-label">Bidang Pekerjaan</label>
                        <input type="text" name="bidang" class="form-control @error('bidang') is-invalid @enderror" id="inputAddres5s" value="{{$data->bidang}}">
                        @error('bidang')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                      <div class="col-12">
                        <label for="inputAddress5" class="form-label">Jurusan yang dibutuhkan</label>
                        <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" id="inputAddres5s" value="{{$data->jurusan}}">
                        @error('jurusan')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                      <div class="col-12">
                        <label for="exampleFormControlSelect2">Jenis Lowongan</label>
                        <select name="jenis_lowongan" class="form-control" id="exampleFormControlSelect1">
                            <option>Pilih Jenis Lowongan</option>
                            <option value="Full Time" {{ $data->jenis_lowongan == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ $data->jenis_lowongan == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                          </select>
                      </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Pendidikan</label>
                      <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" id="inputAddress2" value="{{$data->pendidikan}}">
                      @error('pendidikan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Pengalaman</label>
                        <input type="text" name="pengalaman" class="form-control @error('pengalaman') is-invalid @enderror" id="inputAddress2" value="{{$data->pengalaman}}">
                        @error('pengalaman')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">keterampilan</label>
                      <input type="text" name="keterampilan" class="form-control @error('keterampilan') is-invalid @enderror" id="inputAddress2" value="{{$data->keterampilan}}">
                      @error('keterampilan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="exampleFormControlSelect2">Kebutuhan Jenis Kelamin</label>
                      <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                          <option>Pilih Jenis Kelamin</option>
                          <option value="Laki-laki" {{ $data->jenis_lowongan == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="Perempuan" {{ $data->jenis_lowongan == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                          <option value="Laki-laki/Perempuan" {{ $data->jenis_lowongan == 'Laki-laki/Perempuan' ? 'selected' : '' }}>Laki-laki/Perempuan</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Alamat</label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" id="inputAddress2" value="{{$data->lokasi}}">
                        @error('lokasi')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    {{-- <div class="col-md-12">
                        <label for="inputCity" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="inputCity">{{$data->deskripsi}}</textarea>
                        @error('deskripsi')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div> --}}

                      <div class="col-12">
                        <label for="inputAddress2" class="form-label">Tanggal Dibuka</label>
                        <input type="date" name="tgl_buka" class="form-control @error('tgl_buka') is-invalid @enderror" id="inputAddress2" value="{{old('tgl_buka')}}">
                        @error('tgl_buka')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                      <div class="col-12">
                        <label for="inputAddress2" class="form-label">Tanggal Tutup</label>
                        <input type="date" name="tgl_tutup" class="form-control @error('tgl_tutup') is-invalid @enderror" id="inputAddress2" value="{{old('tgl_tutup')}}">
                        @error('tgl_tutup')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Foto</label>
                      <input class="form-control @error('foto') is-invalid @enderror" name="foto" type="file" id="formFile">
                      @error('foto')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                      <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button  type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
