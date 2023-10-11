<div class="modal fade" id="edit-tk{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Edit data tenaga kerja </h5><p class="font-weight-bold"> {{$data->nama_lengkap}}</p>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('pekerja.update', $data->id_pencari_kerja) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Username</label>
                      <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" id="inputName5" value="{{$data->username}}" readonly>
                      @error('username')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputAddress5" class="form-label">E-mail</label>
                        <input type="text" name="email_pk" id="email_pk" class="form-control @error('email') is-invalid @enderror" id="inputAddres5s" value="{{$data->email_pk}}" readonly>
                        @error('email')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama') is-invalid @enderror" id="inputName5" value="{{$data->nama_lengkap}}">
                      @error('nama')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Alamat</label>
                      <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" id="inputAddress2" value="{{$data->alamat}}">
                      <small id="emailHelp" class="form-text text-muted">Ex : Sungai Rumbai, Dharmasraya</small>
                      @error('alamat')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Umur</label>
                        <input type="text" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror" id="inputAddress2" value="{{$data->umur}}">
                        <small id="emailHelp" class="form-text text-muted">Ex : 25 (Hanya angka)</small>
                        @error('umur')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                      <div class="col-12">
                        <label for="inputAddress2" class="form-label">Jenis Kelamin</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="jenis_kelamin" class="custom-control-input" value="Perempuan" {{ $data->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="jenis_kelamin" class="custom-control-input" value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio1">Perempuan</label>
                          </div>
                      </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Pendidikan</label>
                      <input type="text" name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" id="inputAddress2" value="{{$data->pendidikan_terakhir}}">
                      <small id="emailHelp" class="form-text text-muted">Ex : Sekolah Menengah Kejuruan/S1-Ekonomi</small>
                      @error('pendidikan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Keterampilan</label>
                      <input type="text" name="keterampilan" id="keterampilan" class="form-control @error('keterampilan') is-invalid @enderror" id="inputCity" value="{{$data->keterampilan}}">
                      <small id="emailHelp" class="form-text text-muted">Ex : Pemograman, Desain grafis, dan Ms. Office</small>
                      @error('keterampilan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">No. Handphone</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="inputCity" value="{{$data->no_hp}}">
                        @error('no_hp')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Tentang</label>
                        <textarea name="tentang" id="tentang" class="form-control @error('tentang') is-invalid @enderror" id="inputCity">{{$data->tentang}}</textarea>
                        <small id="emailHelp" class="form-text text-muted">Ex : Saya sangat menyukai bidang Teknologi</small>
                        @error('tentang')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Foto</label><br>
                      <img src="
                      @if($data->foto_pencari_kerja == 'default.jpg')
                        {{ Storage::url('public/user/default/').$data->foto_pencari_kerja}}
                        @else
                        {{ Storage::url('public/user/').$data->foto_pencari_kerja}}
                        @endif
                      " width="100" height="40" class="img-thumbnail mb-2" alt="">
                      <input class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto"type="file" id="formFile">
                      @error('foto')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                      <small id="emailHelp" class="form-text text-muted">File max. 1 MB</small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
